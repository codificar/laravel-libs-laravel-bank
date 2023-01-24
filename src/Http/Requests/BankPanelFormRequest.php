<?php

namespace Codificar\Bank\Http\Requests;

use Codificar\Bank\Models\Country;
use http\Env\Request;
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
                'ispb' =>  $this->country_id === Country::BRAZIL_ID? 'unique:bank' :''
            ];
        }else if($this->method() == "PUT"){
            return [                
                'name' => 'required',
                'code' => $this->country_id === Country::BRAZIL_ID?
                    ['required', Rule::unique('bank')->ignore($this->code, 'code')]
                    : [],
            ];
        }              
    }

    public function messages() {
        $messages = [
            'name.required' => trans('bank.name_required'),
            'code.required' => trans('bank.code_required'),
            'code.unique' => trans('bank.code_unique'),
            'ispb.unique' => trans('bank.ispb_unique'),
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