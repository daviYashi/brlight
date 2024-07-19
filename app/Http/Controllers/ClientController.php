<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        
        if (!$clients) {
            return response()->json(['message' => 'Clientes não cadastrados.'], 404);
        }

        return response()->json($clients, 200);
    }


    public function create(Request $request)
    {
        $cpf = $request->input('cpf');
        
        if(Client::query()->where('cpf', $cpf)->exists('id')){
            return response()->json(['message' => 'CPF já cadastrado.'], 409);
        } 
        
        $client = new Client();
        $client->name = $request->input('name');
        $client->phone = $request->input('phone');
        $client->cpf = $request->input('cpf');
        $client->car_plate = $request->input('car_plate');
        $client->save();

        
        return response()->json(['message' => 'Cliente cadastrado com sucesso.'], 201);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente não encontrado.'], 404);
        }

        $client->name = $request->input('name');
        $client->phone = $request->input('phone');
        $client->cpf = $request->input('cpf');
        $client->car_plate = $request->input('car_plate');
        $client->save();

        return response()->json(['message' => 'Cliente atualizado com sucesso.'], 200);
    }

    public function delete($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente não encontrado.'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Cliente removido com sucesso.'], 200);
    }

    public function getById($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente não encontrado.'], 404);
        }
            return response()->json($client, 200);
    }

    public function getByLastCarPlateDigit($number)
    {
        $clients = Client::whereRaw("RIGHT(car_plate, 1) = ?", [$number])->get();
        return response()->json($clients, 200);
    }
}

