<?php

namespace App\Repositories;

use App\Traits\UploadFileTrait;
use App\Traits\UploadFileUsingMediaLibraryTrait;
use App\Traits\UploadImageTrait;

class Repository
{
    use UploadImageTrait,UploadFileTrait ,UploadFileUsingMediaLibraryTrait;
}
