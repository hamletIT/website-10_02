<?php

namespace App\Services\SubscriptionService;

use App\Traits\Parameters;
use App\Traits\ValidateParameters;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Exceptions\HttpResponseException;

class SubscriptionServicesCreateValidate extends FormRequest
{
    use ValidateParameters, Parameters;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            $this->domain => $this->_required,
            $this->email => $this->_required,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
