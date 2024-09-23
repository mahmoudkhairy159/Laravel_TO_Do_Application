<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SettingsRepository;
use App\Http\Requests\Admin\Settings\UpdateSettingsRequest;
use App\Types\CacheKeysType;

class SettingController extends Controller
{

    protected $_config;
    protected $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->_config = request('_config');
        $this->settingsRepository = $settingsRepository;
        $this->middleware('auth');
    }
    public function index()
    {
        $settings = $this->settingsRepository->getSettings();
        // return $settings;

        return view($this->_config['view'], compact('settings'));
    }


    public function update(UpdateSettingsRequest $request)
    {

        $data = $request->validated();

        $updated = $this->settingsRepository->update($data);
        if (!$updated) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $this->clearSettingsCache();
        $request->session()->put('success', 'Settings Updated SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }


    private function clearSettingsCache()
    {
        $this->deleteCache(CacheKeysType::APP_SETTINGS_CACHE);
    }
}
