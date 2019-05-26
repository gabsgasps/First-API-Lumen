<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\clientes;

class ApiController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function listaUsuarios() {
    	$json = [
    		'usuario1' => [
    			'nome' => 'Gabriel',
    			'idade' => 18
    		],
    		'usuario2' => [
    			'nome' => 'João',
    			'idade' => 19
    		]
    	];

    	return  response($json, 200)->header('Content-Type', 'application/json');
    }

    public function listaClientes() {

        $clientes = clientes::all();

        return  response($clientes, 200)->header('Content-Type', 'application/json');
    }

    public function listaCliente($id) {
        // $id representa o param passado na requisição
        $clientes = clientes::find($id);

        return  response($clientes, 200)->header('Content-Type', 'application/json');
    }

    public function cadastraCliente(Request $data) {
        
        $cliente = clientes::create([
            'nome' => $data->nome,
            'cnpj' => $data->cnpj
        ]);

        return  response($cliente, 200)->header('Content-Type', 'application/json');
    }

    public function deletaCliente($id) {

        // $id representa o param passado na requisição
        $cliente = clientes::find($id);

        $cliente->delete();

        return  response($cliente, 200)->header('Content-Type', 'application/json');
    }

    public function alteraCliente($id, Request $data) {

        // $id representa o param passado na requisição
        $cliente = clientes::find($id);

        $cliente->nome = $data->nome;
        $cliente->cnpj = $data->cnpj;
        $cliente->save();

        return  response($cliente, 200)->header('Content-Type', 'application/json');
    }
}
