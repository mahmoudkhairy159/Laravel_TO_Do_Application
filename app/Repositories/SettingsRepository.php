<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class   SettingsRepository extends Repository
{

    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function getSettings()
    {
        $settings = $this->model->get()->first();
        if (!$settings) {
            $settings =  Setting::create([]);
        }
        return $settings;
    }

    public function create(array $data)
    {
        if (request()->hasFile('logo')) {
            $data['logo'] = $this->uploadImage(request()->file('logo'), 'admins');
        }
        if (request()->hasFile('logo_light')) {
            $data['logo_light'] = $this->uploadImage(request()->file('logo_light'), 'admins');
        }
        return   $this->model->create($data);
    }

    public function update(array $data)
    {
        $settings =  $this->model->first();
        if (!$settings) {
            $settings = new Setting();
        }
        if (request()->hasFile('logo')) {
            if ($settings->logo) {
                $this->deleteFile($settings->logo, 's3');
            }
            $data['logo'] = $this->uploadImageS3(request()->file('logo'), Setting::IMAGE_DIRECTORY);
        }

        if (request()->hasFile('logo_light')) {
            if ($settings->logo_light) {
                $this->deleteFile($settings->logo_light, 's3');
            }
            $data['logo_light'] = $this->uploadImageS3(request()->file('logo_light'), Setting::IMAGE_DIRECTORY,);
        }

        return   $settings->update($data);
    }
}
