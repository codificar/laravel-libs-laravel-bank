<?php

namespace Codificar\Bank\Http\Controllers;

use Codificar\Bank\Models\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//FormRequest
use Codificar\Bank\Http\Requests\ProviderAddBankFormRequest;

//Resource
use Codificar\Bank\Http\Resources\ProviderBankReportResource;
use Codificar\Bank\Http\Resources\ProviderAddBankResource;

use View;
class BankController extends Controller {

    /**
	*  Return list of all banks
	*/
	public function banks(){
		$banks = Bank::all();
		return Response::json($banks);
	}

	/**
	*  Painel Index
	*/
	public function index(){
		$banks = Bank::all();
		return View::make('bank::index')->with('banks', $banks);
	}

	/**
	* Painel Create
	*/
	public function create(){
		return View::make('bank::create');
	}

	/**
	* Painel update
	*/
	public function update($id){
		return View::make('bank::update')->with('id', $id);
	}

	    /**
     * Filter a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterByCountryISO(Request $request)
    {		
		//Data        
        $country_iso = Input::get('country_iso');         
        
        $data = Bank::getAllByCountryISO($country_iso);

        return $data;
    }
}