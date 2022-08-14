<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $name = request()->isMethod('put') ? 'required | string | min:3 | max:50' : 'unique:roles,name| required | string | min:3 | max:50';

        return [
            //
            'name' => $name,
            'guard_name' => ['required','string','min:3','max:50'],
            'permissions' => ['required','array']
        ];
    }
}
