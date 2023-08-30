<?php

namespace App\Http\Requests\Post;

class StorePostRequest extends PostRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:posts',
            'content' => 'required|string',
            'file'  => 'required|image|max:10240',

        ];
    }
    public function attributes()
    {
        return array_merge(parent::attributes(),[
            'file'=>'miniaturka','title'=>'tytuł','content'=>'treść'
        ]);
    }
}
