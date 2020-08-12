<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\CheckAdminUsername;
use App\Rules\CheckAdminPassword;
use App\Rules\CheckAdminIsCorp;

class BankPanelFormRequest extends FormRequest{

    public $admin;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {      
        if($this->method() == "POST"){
            return [
                'name' => 'required',
                'code' => 'required|unique:bank',
            ];
        }else if($this->method() == "PUT"){
            return [                
                'name' => 'required',
                'code' => 'required|unique:bank,code,'. $this->code,
            ];
        }              
    }

    public function messages() {
        $messages = [
            'first_name.required' => "Preencha o nome",
            'code.required' => "Preencha o código",
            'code.unique' => "Este código já foi cadastrado",
        ];

        return $messages;
    }

    /**
     * retorna um json caso a validação falhe.
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
        response()->json(
            [
                'success' => false,
                'errors' => $validator->errors()->all(),
                'error_code' => \ApiErrors::REQUEST_FAILED
            ]
        ));
    }
}