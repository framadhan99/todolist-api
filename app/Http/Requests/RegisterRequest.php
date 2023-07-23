<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users',
            // 'password' => 'required|between:8,255|confirmed'
            'password' => 'required'
        ];
    }

    public function getData()
    {
        $data = $this->validated();
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    public function messages(): array
    {

        return [
            'name.required' => 'Nama harus isi',
            'email.email' => 'Format email salah',
            'email.required' => 'Email harus di isi',
            'password.required' => 'Password harus di isi',


        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true,
            'message' => $errors->first('email') == "Email harus di isi" && $errors->first("password") == "Password harus di isi" && $errors->first("name") == 'Nama harus isi' ? 'Nama, Email dan password tidak boleh kosong' :  $errors->first()
        ], 422));
    }
}
