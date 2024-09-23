<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd(request()->all());
        $rules = [
            'emails' => 'nullable|string',
            'phone_numbers' => 'nullable|string',
            'map_latitude' => 'nullable|numeric',
            'map_longitude' => 'nullable|numeric',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'behance_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'patreon_link' => 'nullable|url',
            'google_maps_api_key' => 'nullable',
            'google_analytics_clint_id' => 'nullable',
            'google_recaptcha_api_key' => 'nullable',
        ];
        foreach (core()->getSupportedLanguagesKeys() as $key) {
            if ($key !== '_token' && $key !== '_method' && $key !== 'image' && $key !== 'status') {
                $rules[$key . '.title'] = 'required|string|max:255';
                $rules[$key . '.slogan'] = 'required|string';
                $rules[$key . '.summary'] = 'required|string';
                $rules[$key . '.address'] = 'nullable|string';
            }
        }
        $rules['maintenance_mode'] = 'required|in:1,0';

        $rules['logo'] = 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:60000';
        $rules['logo_light'] = 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:60000';


        return $rules;
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     // Throw a validation exception with a JSON response
    //     dd($validator->errors());
    // }
}
