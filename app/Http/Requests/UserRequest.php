<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Lang;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $formType = $this->input('formType');

        switch ($formType) {
            case config('custom.create'):
                return [
                    'email' => 'required|email|unique:users',
                    'name' => 'required',
                ];
            
            case config('custom.update'):
                return [
                    'name' => 'required',
                    'password'=>'nullable|string|min:6|confirmed',
                    'phone' => 'nullable|numeric',
                    'avatar' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',
                ];
        }
    }

    public function messages()
    {
        return [
            'email.email' => Lang::get('validation.email'),
            'email.required' => Lang::get('validation.required'),
            'email.unique' => Lang::get('validation.unique'),
            'name.required' => Lang::get('validation.required'),
            'password.string' => Lang::get('validation.string'),
            'password.min' => Lang::get('validation.min.string', ['min' => 6]),
            'password.confirmed' => Lang::get('validation.confirmed'),
            'phone.numeric' => Lang::get('validation.numeric'),
            'avatar.image' => Lang::get('validation.image'),
            'avatar.mimes' => Lang::get('validation.mimes', ['value' => 'jpg,jpeg,bmp,png']),
            'avatar.max' => Lang::get('validation.max.file', ['max' => 2000]),
        ];
    }
}
