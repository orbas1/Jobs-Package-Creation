<?php

namespace JobsLaravelPackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOpeningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'short_description' => ['sometimes', 'string', 'max:500'],
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'type' => ['sometimes', 'string', 'max:100'],
            'salary_type' => ['sometimes', 'string', 'max:100'],
            'salary_range' => ['nullable', 'string', 'max:255'],
            'currency' => ['sometimes', 'string', 'max:5'],
            'experience' => ['sometimes', 'string', 'max:100'],
            'expertise' => ['sometimes', 'string', 'max:100'],
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
            'categories.*' => ['integer', 'exists:categories,id'],
            'locations' => ['nullable', 'array'],
            'locations.*' => ['integer', 'exists:locations,id'],
            'skill_tags' => ['nullable', 'array', 'max:' . config('jobs.limits.max_skill_tags')],
            'skill_tags.*' => ['integer', 'exists:skill_tags,id'],
        ];
    }
}
