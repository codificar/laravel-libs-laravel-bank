<?php

namespace Codificar\Bank\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankPanelFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Codificar\Bank\Models\Bank;

//For Request

class BankPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Bank::paginate(10);
    }

    /**
     * Filter a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        //Paginate
        $page = (Input::has('page') && Input::get('page') ? Input::get('page') : 1);
        $itemsperpage = (Input::has('itemsperpage') && Input::get('itemsperpage') ? Input::get('itemsperpage') : 10);
        //Data        
        $id = Input::get('id');
        $name = Input::get('name');
        $code = Input::get('code');

        $agency_max_length = Input::get('agency_max_length');

        $agency__digit_required = Input::get('agency__digit_required');

        $agency__digit_max_length = Input::get('agency__digit_max_length');
        $account_max_length = Input::get('account_max_length');
        $account__digit_required = Input::get('account__digit_required');
        $account_digit_max_length = Input::get('account_digit_max_length');         

         
        $data = Bank::search($id, $name, $code, $agency_max_length, $agency__digit_required,
        $agency__digit_max_length, $account_max_length, $account__digit_required,
        $account_digit_max_length)->paginate(10);

        return $data;
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
        return Bank::findOrfail($id);
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
