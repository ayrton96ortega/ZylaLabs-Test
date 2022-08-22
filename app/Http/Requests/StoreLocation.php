<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'country' => 'required|string',
            'region' => 'required|string',
            'lat' => 'required|string',
            'lon' => 'required|string',
            'timezone_id' => 'required|string',
            'localtime' => 'required|string',
            'localtime_epoch' => 'required|numeric',
            'utc_offset' => 'required|string',
        ];
    }
}
