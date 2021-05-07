<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class HouseCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $lot = Request::input('lot');
        return [
            'address' => 'required|string|max:150',
            'community' => 'required|unique:houses,community_id,NULL,id,lot,' . $lot,
            'lot' => 'required|integer',
            'start_date' => 'required',
            'subcontractor' => 'required',
        ];
    }

    public function messages()
    {
    return [
        'lot.required' => 'Require This house already exists',
        'lot.unique' => 'This house already exists',
        'community.unique' => 'This house already exists'
    ];
}
}
