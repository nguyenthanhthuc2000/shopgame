<?php

namespace App\Services;

use App\Models\Account;
use Exception;
use Illuminate\Support\Facades\Auth;

class AccountService extends BaseService
{
    /**
     * @var string $logChannel
     */
    protected $logChannel;

    /**
     * @var GoogleDriveService $googleDriveService
     */
    protected $googleDriveService;

    /**
     * @var ImageService $imageService
     */
    protected $imageService;

    public function __construct(GoogleDriveService $googleDriveService, ImageService $imageService)
    {
        $this->logChannel = 'account_transactions';
        $this->googleDriveService = $googleDriveService;
        $this->imageService = $imageService;
    }

    public function storeAccount(array $account, $banner, $gallery = [])
    {
        try {
          
            $accountCreated = Account::create($account);

            if (!$accountCreated) {
                return false;
            }

            $folderId = config('google.accounts_folder_id');

            if ($banner) {
                $bannerUploaded = $this->googleDriveService->uploadSingleFile($banner, $folderId);
            }

            if (!empty($gallery)) {
                $imagesUploaded = $this->googleDriveService->uploadMultipleFiles($gallery, $folderId);
            }

            if (!empty($bannerUploaded['src_url']) && !empty($bannerUploaded['id'])) {
                $bannerData = [
                    'account_id' => $accountCreated->id,
                    'image_link' => $bannerUploaded['src_url'],
                    'is_banner' => 1,
                    'file_id' => $bannerUploaded['id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $this->imageService->createGallery($bannerData);
            }
            if (!empty($imagesUploaded)) {
                $galleryData = array_map(function ($img) use ($accountCreated) {
                    if (!empty($img['src_url']) && !empty($img['id'])) {
                        return [
                            'account_id' => $accountCreated->id,
                            'image_link' => $img['src_url'],
                            'file_id' => $img['id'],
                            'is_banner' => 0,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }, $imagesUploaded);
                $this->imageService->createGallery($galleryData);
            }

            return true;
        } catch (Exception $e) {
            $this->logWritter($this->logChannel, $e->getMessage(), $e);
           return false;
        }
    }
}
