<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\AppSetting\AppSettingResource;
use App\Types\CacheKeysType;

class AppSettingsController extends Controller
{




    public function index()
    {
        try {
            $settings = app(CacheKeysType::APP_SETTINGS_CACHE);
            $settings = new AppSettingResource($settings);
            return $this->returnData($settings,__('global.success_retrieve'));
        } catch (\Exception $e) {

            return $this->returnError($e->getMessage());
        }
    }
}
