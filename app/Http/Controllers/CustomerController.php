<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function getClientes(){
        $clientes = Customer::get();
        return $clientes;
    }

    public function insert(Request $request){
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->cpf = $request->cpf;
        $customer->telefone = $request->telefone;
        $customer->save();
    }

    public function delete(Request $request){
        $customer = Customer::find($request->id);
        $customer->delete();
    }

    public function edit(Request $request){
        $customer = App\Customer::find($request->id);
        $customer->name = $request->name;
        $customer->cpf = $request->cpf;
        $customer->telefone = $request->telefone;
        $customer->save();
    }
}
