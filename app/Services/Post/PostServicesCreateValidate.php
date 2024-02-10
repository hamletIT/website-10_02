<?php

namespace App\Services\Post;

use App\Traits\Parameters;
use App\Rules\WebsiteIdExists;
use App\Rules\WebsiteTitleExists;
use App\Traits\ValidateParameters;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostServicesCreateValidate extends FormRequest
{
    use Parameters, ValidateParameters;

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
            $this->websiteId => [$this->_required, $this->_integer, new WebsiteIdExists],
            $this->title => [$this->_required, $this->_string, new WebsiteTitleExists],
            $this->description => $this->_required.'|'.$this->_string,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
