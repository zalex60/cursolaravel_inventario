<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'nombre' => 'required|min:4',
            'email' => 'required|unique:users,email,'.$this->id,
            'perfil_id' => 'required|exists:perfiles,id',
            'area_id' => 'required|exists:areas,id',
        ];
    }
}
