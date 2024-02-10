<?php

namespace App\Http\Requests\UserService;

use App\Traits\Parameters;
use App\Traits\ValidateParameters;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserServicesCreateValidate extends FormRequest
{
    use ValidateParameters, Parameters;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            $this->domain => $this->_required.'|'.$this->_string,
            $this->email => $this->emailGlobal
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
