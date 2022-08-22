<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
            //aca debe ir la logica de reglas para autorizar la carga de datos.
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
            "observation_time" => 'required|string',
            "temperature" => 'required|numeric',
            "weather_code" => 'required|numeric',
            "weather_icons" => 'required|string',
            "weather_descriptions" => 'required|string',
            "wind_speed" => 'required|numeric',
            "wind_degree" => 'required|numeric',
            "wind_dir" => 'required|string',
            "pressure" => 'required|numeric',
            "precip" => 'required|numeric',
            "humidity" => 'required|numeric',
            "cloudcover" => 'required|numeric',
            "feelslike" => 'required|numeric',
            "uv_index" => 'required|numeric',
            "visibility" => 'required|numeric',
            "is_day" => 'required'
        ];
    }
}
