<?php

namespace JobsLaravelPackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOpeningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'short_description' => ['required', 'string', 'max:500'],
            'category_id' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:100'],
            'salary_type' => ['required', 'string', 'max:100'],
            'salary_range' => ['nullable', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:5'],
            'experience' => ['required', 'string', 'max:100'],
            'expertise' => ['required', 'string', 'max:100'],
            'featured_expire_at' => ['nullable', 'date'],
            'live_expire_at' => ['nullable', 'date'],
            'attachment' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'fields' => ['nullable', 'array'],
            'status' => ['nullable', 'integer'],
            'apply_type' => ['nullable', 'integer'],
            'meta' => ['nullable', 'array'],
            'expired_at' => ['nullable', 'date'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer'],
            'locations' => ['nullable', 'array'],
            'locations.*' => ['integer'],
        ];
    }
}
