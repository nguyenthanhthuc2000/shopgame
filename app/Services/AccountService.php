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
                throw new Exception("Could not create account");
            }

            $folderId = config('google.accounts_folder_id');

            if ($banner) {
                $banner = $this->googleDriveService->uploadSingleFile($banner, $folderId);
            }

            if (!empty($gallery)) {
                $imagesDetail = $this->googleDriveService->uploadMultipleFiles($gallery, $folderId);
            }


            if (!empty($banner)) {
                $bannerData = [
                    'user_id' => Auth::id(),
                    'image_link' => $banner['src_url'] ?? '',
                    'file_id' => $banner['id'] ?? '',
                ];
                $this->imageService->createBanner($bannerData);
            }
            if (!empty($imagesDetail)) {
                $galleryData = array_map(function ($img) {
                    return [
                        'user_id' => Auth::id(),
                        'image_link' => $img['src_url'] ?? '',
                        'file_id' => $img['id'] ?? '',
                        'is_banner' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $imagesDetail);
                $this->imageService->createGallery($galleryData);
            }

            return [
                'account_info' => $accountCreated,
                'banner' => $banner ?? [],
                'gallery' => $imagesDetail ?? []
            ];
        } catch (Exception $e) {
            $this->logWritter($this->logChannel, $e->getMessage(), $e);
            return [];
        }
    }
}
