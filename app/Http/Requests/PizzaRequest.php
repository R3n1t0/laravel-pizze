<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PizzaRequest extends FormRequest
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
            'nome'=> 'required|min:3|max:50',
            'prezzo'=> 'required|numeric|between:0,99.99',
            'ingredients'=>'required',
        ];
    }

    public function messages(){

        return [

            'nome.required' => 'Questo campo e obligatorio',
            'nome.min' => 'Questo campo avere minimo :min caratteri',
            'nome.max' => 'Questo campo deve avere massimo :max caratteri',
            'ingredients.required' => 'Questo campo e obligatorio',
            'prezzo.required' => 'Questo campo e obligatorio',
            'prezzo.numeric' => 'In questo campo devi inserire un numero',
            'prezzo.between' => 'Inserisci un prezzo da 0 a 99,99',
        ];
    }
}
