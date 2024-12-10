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

    /**
     * Create new account
     * @param array $account
     * @param mixed $banner
     * @param mixed $gallery
     * @return bool
     */
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

    /**
     * Update new account
     * @param string $uuid
     * @param array $account
     * @param mixed $banner
     * @param mixed $gallery
     * @return bool
     */
    public function updateAccount($uuid, array $account, $banner, $gallery = [])
    {
        try {
            $findAccount = Account::getByUuid($uuid);

            if (empty($findAccount)) {
                $this->logWritter($this->logChannel, "Cannot find account $uuid to update!");
                return false;
            }

            $accountUpdated = $findAccount?->update($account);
            if (!$accountUpdated) {
                $this->logWritter($this->logChannel, "Cannot update account $$uuid!");
                return false;
            }

            if (!empty($account['removed_image'])) {
                // handle delete image
            }

            $folderId = config('google.accounts_folder_id');

            if ($banner) {
                $bannerUploaded = $this->googleDriveService->uploadSingleFile($banner, $folderId);
            }

            // Add banner image
            if (!empty($bannerUploaded['src_url']) && !empty($bannerUploaded['id'])) {
                // remove old banner
                $this->imageService->deleteBanner($findAccount->banner->account_id ?? '');

                $bannerData = [
                    'account_id' => $findAccount->id,
                    'image_link' => $bannerUploaded['src_url'],
                    'is_banner' => 1,
                    'file_id' => $bannerUploaded['id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $this->imageService->createGallery($bannerData);
            }

            // Add gallery
            if (!empty($gallery)) {
                $imagesUploaded = $this->googleDriveService->uploadMultipleFiles($gallery, $folderId);
            }

            if (!empty($imagesUploaded)) {
                $galleryData = array_map(function ($img) use ($findAccount) {
                    if (!empty($img['src_url']) && !empty($img['id'])) {
                        return [
                            'account_id' => $findAccount->id,
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
