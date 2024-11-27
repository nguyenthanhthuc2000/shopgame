<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Image;
use Exception;
use Illuminate\Http\UploadedFile;

class ImageService extends BaseService
{
    /**
     * @var string $logChannel
     */
    protected $logChannel;

    /**
     * @var GoogleDriveService $googleDriveService
     */

    protected $googleDriveService;
    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->logChannel = 'images_save';
        $this->googleDriveService = $googleDriveService;
    }

    /**
     * Insert banner to Google Drive
     * @param array $fileData
     * @return array
     */
    public function createBanner(array $fileData)
    {
        try {
            $fileData['is_banner'] = 1;

            $created = Image::create($fileData);

            return $created;
        } catch (Exception $e) {
            $this->logWritter($this->logChannel, $e->getMessage(), $e);
            return [];
        }
    }

    /**
     * Insert gallery to Google Drive
     * @param array $fileData
     * @return array
     */
    public function createGallery(array $fileData)
    {
        try {
            $created = Image::insert($fileData);

            return $created;
        } catch (Exception $e) {
            $this->logWritter($this->logChannel, $e->getMessage(), $e);
            return [];
        }
    }
}
