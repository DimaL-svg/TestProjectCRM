<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'phone'   => 'required|string|regex:/^\+\d{10,15}$/',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
    public function messages()
    {
        return [
        
        ];
    }
}
