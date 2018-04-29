<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Lang;

class SeminarRequest extends FormRequest
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
                    'name' => 'required|unique:seminars',
                    'chairman' => 'required',
                    'time' => 'required',
                    'members' => 'required',
                    'description' => 'required',
                ];
            
            case config('custom.update'):
                return [
                    'name' => 'required',
                    'chairman' => 'required',
                    'time' => 'required',
                    'members' => 'required',
                    'description' => 'required',
                ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => Lang::get('validation.required'),
            'name.unique' => Lang::get('validation.unique'),
            'name.required' => Lang::get('validation.required'),
            'chairman.required' => Lang::get('validation.required'),
            'time.required' => Lang::get('validation.required'),
            'members.required' => Lang::get('validation.required'),
            'description.required' => Lang::get('validation.required'),
        ];
    }
}
