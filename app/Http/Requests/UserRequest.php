<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\ServerBag;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id =  request()->route()->parameter('nasabah') ?? request()->route()->parameter('admin');
        return [
            "nama" => ['required'],
            'username' => ['required', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            "password" => ['nullable'],
            "no_hp" => ['required'],
            "alamat" => ['required'],
        ];
    }

    public function messages()
    {
        return [
            "nama.required" => "Nama tidak boleh kosong.",
            "username.required" => "Username tidak boleh kosong.",
            "username.unique" => "Username sudah digunakan.",
            "email.unique" => "Email sudah digunakan.",
            "email.required" => "Email tidak boleh kosong.",
            "password.required" => "Password tidak boleh kosong.",
            "no_hp.required" => "No telepon tidak boleh kosong.",
            "alamat.required" => "Alamat tidak boleh kosong.",
        ];
    }
}
