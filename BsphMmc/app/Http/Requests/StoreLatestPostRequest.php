<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLatestPostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'type' => 'required|in:news,announcement,event,document',
            'featured_image' => 'nullable|string|max:255',
            'file_path' => 'nullable|string|max:255',
            'event_date' => 'nullable|date|required_if:type,event',
            'author' => 'nullable|string|max:100',
            'status' => 'nullable|in:draft,published',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'type.required' => 'The type field is required.',
            'type.in' => 'The selected type is invalid. Valid types are: news, announcement, event, document.',
            'event_date.required_if' => 'The event date field is required when type is event.',
            'event_date.date' => 'The event date must be a valid date.',
            'author.max' => 'The author may not be greater than 100 characters.',
            'status.in' => 'The selected status is invalid. Valid statuses are: draft, published.',
        ];
    }
}
