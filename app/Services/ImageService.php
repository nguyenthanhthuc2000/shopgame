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
