<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Person;
use App\Model\Client;
use App\Model\Provider;
use Exception;
use Illuminate\Support\Facades\DB;


class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = DB::table('people as p')
            ->join('clients', 'p.id', '=', 'clients.id')
            ->join('cities as c', 'c.id', '=', 'p.city_id')
            ->select(
                'p.id',
                'type_document',
                'document',
                'prefix',
                'p.name',
                'surname',
                'email',
                'telephone',
                'direction',
                'p.departament_id',
                'city_id',
                'c.name as name_city',
                'regimen_type',
                'type_person',
                'responsible_iva',
                'business_name'
            )
            ->orderBy('p.id', 'desc')->get();
        return $persons;
    }
    public function providersindex()
    {
        $persons = DB::table('people as p')
            ->join('providers as pro', 'p.id', '=', 'pro.id')
            ->join('cities as c', 'c.id', '=', 'p.city_id')
            ->select(
                'p.id',
                'type_document',
                'document',
                'prefix',
                'p.name',
                'surname',
                'email',
                'telephone',
                'direction',
                'p.departament_id',
                'city_id',
                'c.name as name_city',
                'company_name',
                'services',
                'landline',
                'banking_entity',
                'account_type',
                'account_number'
            )
            ->orderBy('p.id', 'desc')->get();
        return $persons;
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $person = new Person();
            $person->type_document = $request->type_document;
            $person->document = $request->document;
            $person->prefix = $request->prefix;
            $person->is_client = $request->is_client;
            $person->name = $request->name;
            $person->surname = $request->surname;
            $person->email = $request->email;
            $person->telephone = $request->telephone;
            $person->departament_id = $request->departament_id;
            $person->city_id = $request->city_id;
            $person->direction = $request->direction;
            $person->save();
            if ($request->is_client == 1) {
                $client = new Client();
                $client->type_person = $request->type_person;
                $client->regimen_type = $request->regimen_type;
                $client->responsible_iva = $request->responsible_iva;
                $client->business_name = $request->business_name;
                $client->tributary_information = $request->tributary_information;
                $client->id = $person->id;
                $client->save();
                DB::commit();
                return response()->json(['message' => 'El cliente ha sido registrado'], 200);
            } else {
                $provider = new Provider();
                $provider->company_name = $request->company_name;
                $provider->services = $request->services;
                $provider->landline = $request->landline;
                $provider->banking_entity = $request->banking_entity;
                $provider->account_type = $request->account_type;
                $provider->account_number = $request->account_number;
                $provider->id = $person->id;
                $provider->save();
                DB::commit();
                return response()->json(['message' => 'El proveedor ha sido registrado'], 200);
            }
        } catch (Exception $e) {
            DB::rollBack();
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            if ($request->is_client) {
                $client = Client::findOrFail($request->id);
                $person = Person::findOrFail($client->id);
            } else {
                $provider = Provider::findOrFail($request->id);
                $person = Person::findOrFail($provider->id);
            }
            $person->type_document = $request->type_document;
            $person->document = $request->document;
            $person->prefix = $request->prefix;
            $person->is_client = $request->is_client;
            $person->name = $request->name;
            $person->surname = $request->surname;
            $person->email = $request->email;
            $person->telephone = $request->telephone;
            $person->departament_id = $request->departament_id;
            $person->city_id = $request->city_id;
            $person->direction = $request->direction;
            $person->save();
            if ($request->is_client) {
                $client->type_person = $request->type_person;
                $client->regimen_type = $request->regimen_type;
                $client->responsible_iva = $request->responsible_iva;
                $client->business_name = $request->business_name;
                $client->tributary_information = $request->tributary_information;
                $client->save();
                DB::commit();
                return response()->json(['message' => 'El cliente ha sido modificado'], 201);
            } else {
                $provider->company_name = $request->company_name;
                $provider->services = $request->services;
                $provider->landline = $request->landline;
                $provider->banking_entity = $request->banking_entity;
                $provider->account_type = $request->account_type;
                $provider->account_number = $request->account_number;
                $provider->id = $person->id;
                $provider->save();
                DB::commit();
                return response()->json(['message' => 'El proveedor ha sido modificado'], 201);
            }
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}