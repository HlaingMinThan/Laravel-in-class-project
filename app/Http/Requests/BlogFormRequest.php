<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogFormRequest extends FormRequest
{
    public $isUpdate;
    public function __construct()
    {
        $this->isUpdate = str_contains(request()->url(), 'update');
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            "title" => ['required', 'max:200'],
            "photo" => [$this->isUpdate ? '' : 'required', 'image'],
            "slug" => ['required', 'max:100'],
            "intro" => ['required'],
            "reading_time" => ['required'],
            "body" => ['required'],
            "category_id" => ['required', Rule::exists('categories', 'id')],
        ];
    }
}
