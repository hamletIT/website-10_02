<?php

namespace App\Http\Requests\PostService;

use App\Traits\Parameters;
use App\Traits\ValidateParameters;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostServicesGetValidate extends FormRequest
{
    use Parameters, ValidateParameters;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            $this->id => $this->_required.'|'.$this->_integer,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
