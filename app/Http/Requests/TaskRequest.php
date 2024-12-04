<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'title' => 'required|string|max:255',
            'status' => 'in:pending,in_progress,completed',
        ];
    }
}