<?php

namespace Codificar\Bank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

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
                'ispb' =>  'unique:bank'
            ];
        }else if($this->method() == "PUT"){
            return [                
                'name' => 'required',
                'code' => ['required',
                    Rule::unique('bank')->ignore($this->code, 'code')
                ],
                'ispb' => [Rule::unique('bank')->ignore($this->ispb, 'ispb')],
            ];
        }              
    }

    public function messages() {
        $messages = [
            'name.required'             => 'O nome do banco é obrigatório',
            'code.required'             => 'O código do banco é obrigatório',
            'code.unique'               => 'O código informado já está cadastrado',
            'ispb.unique'               => 'O ISPB informado já está cadastrado',                  
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