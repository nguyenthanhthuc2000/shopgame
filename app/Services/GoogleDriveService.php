<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Log;

class GoogleDriveService
{
    protected $client;
    protected $logChannel;
    protected $driveService;

    public function __construct()
    {
        $this->initializeClient();
        $this->logChannel = 'google_log';
    }

    /**
     * Initialize the Google Client and Drive Service.
     */
    private function initializeClient()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path(config('credentials_file_path')));
        $this->client->addScope(Drive::DRIVE);
        $this->driveService = new Drive($this->client);
    }

    /**
     * Upload a file to Google Drive.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string|null $folderId
     * @return string|null The file ID on Google Drive.
     */
    public function uploadFile($file, $folderId = null)
    {
        $fileMetadata = [
            'name' => $file->getClientOriginalName(),
            'parents' => $folderId ? [$folderId] : [],
        ];

        $content = file_get_contents($file->getRealPath());
        $googleFile = new Drive\DriveFile($fileMetadata);

        try {
            $uploadedFile = $this->driveService->files->create(
                $googleFile,
                [
                    'data' => $content,
                    'mimeType' => $file->getMimeType(),
                    'uploadType' => 'multipart',
                ]
            );

            return $uploadedFile->id; // Return the file ID
        } catch (\Exception $e) {
            Log::channel($this->logChannel)->error('Google Drive Upload Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create a folder in Google Drive.
     *
     * @param string $folderName
     * @param string|null $parentFolderId
     * @return string|null The folder ID on Google Drive.
     */
    public function createFolder($folderName, $parentFolderId = null)
    {
        $fileMetadata = [
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => $parentFolderId ? [$parentFolderId] : [],
        ];

        try {
            $folder = $this->driveService->files->create(new Drive\DriveFile($fileMetadata));
            return $folder->id; // Return the folder ID
        } catch (\Exception $e) {
            Log::channel($this->logChannel)->error('Google Drive Folder Creation Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete a file on Google Drive.
     *
     * @param string $fileId The ID of the file to delete.
     * @return bool True if deleted successfully, false otherwise.
     */
    public function deleteFile(string $fileId): bool
    {
        try {
            $this->driveService->files->delete($fileId);
            return true; // Successfully deleted
        } catch (\Exception $e) {
            Log::channel($this->logChannel)->error('Google Drive File Deletion Error: ' . $e->getMessage());
            return false; // Failed to delete
        }
    }

    /**
     * Delete a folder on Google Drive.
     *
     * @param string $folderId The ID of the folder to delete.
     * @return bool True if deleted successfully, false otherwise.
     */
    public function deleteFolder(string $folderId): bool
    {
        // Deleting a folder works the same as deleting a file
        return $this->deleteFile($folderId);
    }
}
