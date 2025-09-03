<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => ['sometimes','required','string','max:255'],
            'description' => ['sometimes','nullable','string','max:10000'],
            'status' => ['sometimes','required','in:'.implode(',', array_keys(Task::getStatuses()))],
        ];
    }
}
