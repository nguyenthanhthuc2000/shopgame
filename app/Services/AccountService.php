<?php

namespace App\Services;

use Exception;
use App\Models\Account;
use App\Jobs\UploadToGoogleDrive;
use App\Models\Image;

class AccountService extends BaseService
{
    /**
     * @var string $logChannel
     */
    protected $logChannel = 'account_transactions';

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
        $this->googleDriveService = $googleDriveService;
        $this->imageService = $imageService;
    }

    /**
     * Set model
     */
    public function setModel(): self
    {
        $this->model = new Account;

        return $this;
    }

    /**
     * Create new account
     * 
     * @param array $accountData
     * @param mixed $banner
     * @param mixed $gallery
     * @return bool
     */
    public function storeAccount(array $accountData, $banner, $gallery = [])
    {
        try {
            $folderId = config('google.accounts_folder_id');
            $accountCreated = Account::create($accountData);
            $delay = now()->addMilliseconds(100);

            if (!empty($banner)) {
                $delay = now()->addMilliseconds(100);
                UploadToGoogleDrive::dispatch($banner->store('temp'), $accountCreated->id, Image::IS_BANNER, $folderId)->delay($delay);
            }

            foreach ($gallery as $index => $file) {
                $delay = now()->addMilliseconds(($index + 1) * 100);
                UploadToGoogleDrive::dispatch($file->store('temp'), $accountCreated->id, Image::IS_IMAGE_DETAIL, $folderId)->delay($delay);
            }

            return true;
        } catch (Exception $e) {
            $this->logWritter($e->getMessage(), $e);
            return false;
        }
    }

    /**
     * Update new account
     * 
     * @param \App\Models\Account $account
     * @param array $accountData
     * @param mixed $banner
     * @param mixed $gallery
     * @return bool
     */
    public function updateAccount($account, $accountData, $banner = null, $gallery = [])
    {
        try {
            $account->update($accountData);

            if (!empty($account['removed_image'])) {
                foreach ($account['removed_image'] as $imageId) {
                    $this->imageService->delete($imageId ?? '', $account->banner->account_id ?? '');
                }
            }

            $folderId = config('google.accounts_folder_id');

            if ($banner) {
                $bannerUploaded = $this->googleDriveService->uploadSingleFile($banner, $folderId);
            }

            // Add banner image
            if (!empty($bannerUploaded['src_url']) && !empty($bannerUploaded['id'])) {
                // remove old banner
                $this->imageService->deleteBanner($account->banner->account_id ?? '');

                $bannerData = [
                    'account_id' => $account->id,
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
                $galleryData = array_map(function ($img) use ($account) {
                    if (!empty($img['src_url']) && !empty($img['id'])) {
                        return [
                            'account_id' => $account->id,
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
            $this->logWritter($e->getMessage(), $e);
            return false;
        }
    }

    /**
     * Delete account
     * 
     * @param \App\Models\Account $account
     */
    public function delete(Account $account): bool
    {
        try {
            if (!$account->canDelete()) {
                return false;
            }
            return $account->delete();
        } catch (Exception $e) {
            $this->logWritter($e->getMessage(), $e);
            return false;
        }
    }
}
