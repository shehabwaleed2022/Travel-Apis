<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelRequest extends FormRequest
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
            'is_public' => ['boolean'],
            'name' => ['string', 'min:3', 'max:30', 'unique:travel,name'],
            'description' => ['string', 'min:3', 'max:255'],
            'num_of_days' => ['numeric', 'min:1'],
        ];
    }
}
