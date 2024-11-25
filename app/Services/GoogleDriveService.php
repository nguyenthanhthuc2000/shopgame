<?php

namespace App\Services;

use Exception;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
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
        $this->client->setAuthConfig(storage_path(config('google.credentials_file_path')));
        $this->client->addScope(Drive::DRIVE);
        $this->driveService = new Drive($this->client);
    }

    /**
     * Upload a file to Google Drive.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string|null $folderId The ID of the target folder on Google Drive. If null, uploads to root.
     * @return array|null The file details (ID, name, public URL), or null on failure.
     */
    public function uploadFile($file, $folderId = null)
    {
        try {
            // Prepare file metadata
            $fileMetadata = [
                'name' => $file->getClientOriginalName(),
            ];

            if ($folderId) {
                $fileMetadata['parents'] = [$folderId]; // Assign to a specific folder if provided
            }

            // Read file content
            $content = file_get_contents($file->getRealPath());
            if ($content === false) {
                throw new Exception('Unable to read file content.');
            }

            // Create a Google Drive file instance
            $googleFile = new DriveFile($fileMetadata);

            // Upload file to Google Drive
            $uploadedFile = $this->driveService->files->create(
                $googleFile,
                [
                    'data' => $content,
                    'mimeType' => $file->getMimeType(),
                    'uploadType' => 'multipart',
                ]
            );
            // Check if file ID is returned correctly
            if (empty($uploadedFile->id)) {
                throw new Exception('File upload failed. No file ID returned.');
            }

            // Get the file ID
            $fileId = $uploadedFile->id;

            // Set the file as public
            $this->makeFilePublic($fileId);

            // Get the public URL of the file
            $fileInfo = $this->driveService->files->get($fileId, [
                'fields' => 'id, name, webViewLink, webContentLink'
            ]);

            // Return file details including public URL
            return [
                'id' => $fileInfo->id,
                'name' => $fileInfo->name,
                'public_url' => $fileInfo->webViewLink,
                'src_url' => 'https://drive.google.com/thumbnail?id=' . $fileInfo->id,
            ];
        } catch (Exception $e) {
            // Log the error for debugging
            Log::channel($this->logChannel ?? 'stack')->error(
                'Google Drive Upload Error: ' . $e->getMessage(),
                ['fileName' => $file->getClientOriginalName()]
            );

            return null; // Return null on failure
        }
    }

    /**
     * Make a file public by setting its permission.
     *
     * @param string $fileId The ID of the file to make public.
     */
    protected function makeFilePublic($fileId)
    {
        try {
            $permission = new \Google\Service\Drive\Permission([
                'type' => 'anyone',
                'role' => 'reader', // Can be 'reader' for public access
            ]);

            $this->driveService->permissions->create($fileId, $permission);
        } catch (\Exception $e) {
            Log::channel($this->logChannel ?? 'stack')->error(
                'Error setting public permission: ' . $e->getMessage(),
                ['fileId' => $fileId]
            );
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
