<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
    public string $coverPath;
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
            'nome' => 'required|min:3',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'cover.required' => 'A capa é obrigatória.',
        ];
    }

    public function messages()
    {
        return [
            'cover.required' => 'A capa é obrigatória.',
            'cover.image' => 'O arquivo da capa deve ser uma imagem.',
            'cover.mimes' => 'A capa deve ser uma imagem do tipo jpeg, png, jpg.',
            'cover.max' => 'A capa não pode exceder 2MB.',
        ];
    }
    
}
