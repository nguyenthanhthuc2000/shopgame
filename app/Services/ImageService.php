<?php

namespace App\Services;

use App\Models\Image;
use Exception;

class ImageService extends BaseService
{
    /**
     * @var string $logChannel
     */
    protected $logChannel;
    protected $googleDriveService;
    public function __construct()
    {
        $this->logChannel = 'images_save';
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

    /**
     * Delete banner from database
     * @param string $imageId
     * @param int|string $accountId
     * @return bool
     */
    public function delete($imageId, $accountId = '')
    {
        try {
            $image = Image::whereFileId($imageId);

            if (!empty($accountId)) {
                $image = $image->whereAccountId($accountId);
            }

            $image->first();

            if (!$image) {
                throw new Exception("Image with account ID {$accountId} not found.");
            }

            return $image->delete();
        } catch (Exception $e) {
            $this->logWritter($this->logChannel, $e->getMessage(), $e);
            return false;
        }
    }

    /**
     * Delete banner from database
     * @param int|string $accountId
     * @return bool
     */
    public function deleteBanner($accountId)
    {
        try {
            $image = Image::whereAccountId($accountId)->isBanner()->first();

            if (!$image) {
                throw new Exception("Image with account ID {$accountId} not found.");
            }

            return $image->delete();
        } catch (Exception $e) {
            $this->logWritter($this->logChannel, $e->getMessage(), $e);
            return false;
        }
    }
}
