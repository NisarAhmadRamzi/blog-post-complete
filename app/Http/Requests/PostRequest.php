<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      
        return [
            'title' => 'required',
            'sub_title' => 'required',
            'file' => 'nullable|file', // Optionally, add 'file' rule to ensure it's a valid file
            'description' => 'required',
            'topic' =>'required|array',
        ];
    }
}
