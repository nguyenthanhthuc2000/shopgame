<?php

namespace App\Services;

use App\Models\Account;
use App\Jobs\UploadToGoogleDrive;
use App\Models\Image;
use Exception;

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
        $this->setModel(new Account);
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
            $folderId = config('google.accounts_folder_id');
            $accountCreated = Account::create($account);

            if (!empty($banner)) {
                UploadToGoogleDrive::dispatch($banner->store('temp'), $accountCreated->id, Image::IS_BANNER, $folderId);
            }

            foreach ($gallery as $file) {
                UploadToGoogleDrive::dispatch($file->store('temp'), $accountCreated->id, Image::IS_IMAGE_DETAIL, $folderId);
            }

            return true;
        } catch (Exception $e) {
            $this->logWritter($e->getMessage(), $e);
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
    public function updateAccount($uuid, array $account, $banner = null, $gallery = [])
    {
        try {
            $findAccount = Account::getByUuid($uuid);

            if (empty($findAccount)) {
                throw new Exception("Cannot find account $uuid to update!");
            }

            $accountUpdated = $findAccount?->update($account);
            if (!$accountUpdated) {
                throw new Exception("Cannot update account $$uuid!");
            }

            if (!empty($account['removed_image'])) {
                foreach ($account['removed_image'] as $imageId) {
                    $this->imageService->delete($imageId ?? '', $findAccount->banner->account_id ?? '');
                }
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
            $this->logWritter($e->getMessage(), $e);
            return false;
        }
    }

    /**
     * Delete account
     */
    public function delete(string $uuid): bool
    {
        try {
            $account = $this->model->findByUuid($uuid);

            if (empty($account) || !$account->canDelete()) {
                return false;
            }

            return $account->delete();
        } catch (Exception $e) {
            $this->logWritter($e->getMessage(), $e);
            return false;
        }
    }
}
