<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $id = $this->request->get("id");

        return [
            'title' => ['required', 'min:3','unique:posts,title,' . $id],
            'description' => ['required','min:50']
        ];
    }

   
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()      // if you want to override the error message
    {
        return [
            //'title.required' => 'Overrided Required Message',
        ];
    }
}
