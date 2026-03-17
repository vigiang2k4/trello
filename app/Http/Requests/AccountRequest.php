<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool  // Sửa tên function từ true thành authorize
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Lấy tên route hiện tại
        $route = $this->route()->getName();

        // Rules cho đăng ký
        if ($route === 'register_') {
            return [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',

                'name' => 'nullable|string|max:255',
            ];
        }

        // Rules cho đăng nhập
        if ($route === 'login_') {
            return [
                'email' => 'required|email',
                'password' => 'required'
            ];
        }

        // Rules mặc định nếu không match với route nào
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'name.max' => 'Tên không được vượt quá 255 ký tự',

            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',

            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
        ];
    }
}
