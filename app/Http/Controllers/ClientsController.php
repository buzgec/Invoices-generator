<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.all_clients', compact('clients'));
    }

    public function create()
    {
        return view('clients.create_client');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required | alpha | unique:clients,name',
            'vat_number' => 'required | digits:9 | unique:clients,vat_number',
            'id_number' => 'required | digits:8 | unique:clients,id_number',
            'checking_account1' => 'required | digits:3',
            'checking_account2' => 'required | digits:13',
            'checking_account3' => 'required | digits:2',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'web_address' => 'required'
        ]);

        $checking_account = $request->checking_account1 . '-' . $request->checking_account2 . '-' . $request->checking_account3;
        $client = Client::create([
            'name' => $request->name,
            'vat_number' => $request->vat_number,
            'id_number' => $request->id_number,
            'checking_account' => $checking_account,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'web' => $request->web_address
        ]);

        return redirect('/clients/all_clients')->with('success', 'Client created successfully.');

}

    public function edit($client)
    {
        $client = Client::find(Crypt::decrypt($client));
        return view('clients.edit_client', compact('client'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required | alpha',
            'vat_number' => 'required | digits:9',
            'id_number' => 'required | digits:8',
            'checking_account1' => 'required | digits:3',
            'checking_account2' => 'required | digits:13',
            'checking_account3' => 'required | digits:2',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'web_address' => 'required'
        ]);

        $checking_account = $request->checking_account1 . '-' . $request->checking_account2 . '-' . $request->checking_account3;
        $client = Client::find($request->client_id);
        $client->name = $request->name;
        $client->vat_number = $request->vat_number;
        $client->id_number = $request->id_number;
        $client ->checking_account = $checking_account;
        $client->city = $request->city;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->web = $request->web_address;
        $client->save();

        return redirect('/clients/all_clients')->with('success', 'Client updated successfully.');
    }

    public function destroy($client_id)
    {
        $client = Client::find(Crypt::decrypt($client_id));
        $client->delete();
        session()->flash('success', 'Client deleted successfully.');
        return redirect('/clients/all_clients');
    }
}
