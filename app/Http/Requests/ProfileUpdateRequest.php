<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'unidade' => ['string', 'max:255'],
            'grau' => ['string', 'max:1'],
            'pes' => ['numeric', Rule::in([1, 2, 3])],
            'celular' => ['string', 'nullable', 'max:11'],
            'telefone' => ['string', 'nullable', 'max:10'],
        ];
    }
}
