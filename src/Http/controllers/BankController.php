<?php

namespace Codificar\Bank\Http\Controllers;

use Codificar\Bank\Models\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//FormRequest
use Codificar\Bank\Http\Requests\ProviderAddGenericFormRequest;

//Resource
use Codificar\Bank\Http\Resources\ProviderGenericReportResource;
use Codificar\Bank\Http\Resources\ProviderAddGenericResource;

use Input, Validator;
use Provider, Settings, Ledger, Finance;
class BankController extends Controller {

    public function getGenericReport()
    {
        // Get the provider id (some projects is 'provider_id' and others is just 'id')
        $providerId = Input::get('provider_id') ? Input::get('provider_id') : Input::get('id');
        $provider = Provider::find($providerId);
        
        $generic_report = Bank::getGenericSummary($provider->ledger->id, 'provider');
        
        // Return data
		return new ProviderGenericReportResource([
			'generic_report' => $generic_report
		]);
    }
}