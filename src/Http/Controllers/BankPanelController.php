<?php

namespace Codificar\Bank\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Requests as Input;

use Codificar\Bank\Models\Bank;
use Codificar\Bank\Http\Requests\BankPanelFormRequest;


//For Request

class BankPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemsperpage = Input::input('itemsperpage');
        return $itemsperpage ? Bank::paginate($itemsperpage) : Bank::all();
    }

    /**
     * Filter a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        //Paginate
        $page = (Input::has('page') && Input::input('page') ? Input::input('page') : 1);
        $itemsperpage = (Input::has('itemsperpage') && Input::input('itemsperpage') ? Input::input('itemsperpage') : null);
        //Data        
        $id = Input::input('id');
        $name = Input::input('name');
        $code = Input::input('code');

        $agency_max_length = Input::input('agency_max_length');

        $agency_digit_required = Input::input('agency_digit_required');

        $agency_digit_max_length = Input::input('agency_digit_max_length');
        $account_max_length = Input::input('account_max_length');
        $account_digit_required = Input::input('account_digit_required');
        $account_digit_max_length = Input::input('account_digit_max_length');   
        $country_iso = Input::input('country_iso');         

         
        $data = Bank::search($id, $name, $code, $agency_max_length, $agency_digit_required,
        $agency_digit_max_length, $account_max_length, $account_digit_required,
        $account_digit_max_length, $country_iso);

        return $itemsperpage ? $data->paginate($itemsperpage) : $data->input();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankPanelFormRequest $request)
    {
        $result =  Bank::create($request->all());
        return response()->json([
            'value' => $result,
            'sucess' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Bank::inputById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankPanelFormRequest $request, $id)
    {
        $result = Bank::where('id', $id)->update($request->all());
        return response()->json([
            'value' => $request->all(),
            'sucess' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Bank::where('id', $id)->delete();
        return response()->json([
            'value' => $id,
            'sucess' => true
        ]);
    }
}
