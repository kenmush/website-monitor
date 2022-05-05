<?php

namespace App\Http\Requests\ReportType;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:report_types,name',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}