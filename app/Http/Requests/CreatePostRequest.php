<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => ['string', 'required'],
            'slug' => ['string', 'unique:posts'],
            'content' => ['string'],
            'files' => ['array', 'required'],
        ];
    }

    public function prepareForValidation() {

        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

}
