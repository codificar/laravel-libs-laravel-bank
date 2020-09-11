<?php

namespace Codificar\Bank\Http\Controllers;

use Codificar\Bank\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//FormRequest
use Codificar\Bank\Http\Requests\ProviderAddBankFormRequest;

//Resource
use Codificar\Bank\Http\Resources\ProviderBankReportResource;
use Codificar\Bank\Http\Resources\ProviderAddBankResource;

use View;
class CountryController extends Controller {

    /**
	*  Return list of all countries
	*/
	public function countries(){
		$countries = Country::all();
		return $countries;
	}

}