<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {

        return [
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
            'message' => $errors->first('email') == "Email harus di isi" && $errors->first("password") == "Password harus di isi" ? 'Email dan password tidak boleh kosong' : $errors->first()
        ], 422));
    }
}
