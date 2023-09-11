<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTravelRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'is_public' => ['required' , 'boolean'],
            'name' => ['required' , 'string','min:3' , 'max:30', 'unique:travel,name'],
            'description' => ['required' , 'string' , 'min:3' , 'max:255'],
            'num_of_days' => ['required' , 'numeric' , 'min:1'],
        ];
    }
}
