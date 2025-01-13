<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use App\Services\GoogleDriveService;
use App\Models\Image;

class UploadToGoogleDrive implements ShouldQueue
{
    use Queueable;

    public $filePath;
    public $folderId;
    public $accountId;
    public $isBanner;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath, $accountId, $isBanner = 0, $folderId = null)
    {
        $this->filePath = $filePath;
        $this->folderId = $folderId;
        $this->accountId = $accountId;
        $this->isBanner = $isBanner;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $uploadData = app()->make(GoogleDriveService::class)->uploadFile($this->filePath, $this->folderId);

        if (!empty($uploadData)) {
            $bannerData = [
                'account_id' => $this->accountId,
                'image_link' => $uploadData['src_url'],
                'is_banner' => $this->isBanner,
                'file_id' => $uploadData['id'],
                'created_at' => now(),
            ];
    
            Image::insert($bannerData);
            Storage::delete($this->filePath);
        }
    }
}
