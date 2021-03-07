<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'address' => 'required|string|max:150',
        ];
    }

    public function messages(){
      return [
          'address.required' => 'El :attribute es obligatorio.',
          'community_id.required' => 'El campo community es obligatorio',

      ];
    }

    public function attributes(){
      return [
        'address' => 'nombre del producto',
     ];
    }

}
