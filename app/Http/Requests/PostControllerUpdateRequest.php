<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostControllerUpdateRequest extends FormRequest
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
            'name' => 'required|min:3|max:200',
            'author' => 'string|max:200|nullable',
            'category_id' => 'required|integer|exists:categories,id',
            'shelf_id' => 'required|integer|exists:shelves,id',
            'tag_id' => 'integer|exists:tags,id|nullable',
            'reader_id' => 'integer|exists:readers,id|nullable',
            'date_take' => 'date|nullable',
            'image' => 'image|mimetypes:image/jpeg,image/png',
        ];
    }
}
