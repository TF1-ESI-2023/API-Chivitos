<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chivito;
use Illuminate\Support\Facades\Http;

class ChivitoController extends Controller
{
    public function Mostrar(Request $request){
        $arrayPelado = [];
        $chivitos = Chivito::all();

        foreach($chivitos as $chivito){
            $arrayPelado[] = [
                "id" => $chivito -> id,
                "nombre" => $chivito -> nombre,
                "descripcion" => $chivito -> descripcion,
                "precio" => $chivito -> precio,
                "chef" => $this -> obtenerDatosDeChef($chivito -> chef_id, $request)
            ];
        }
        return $arrayPelado;
    }

    private function obtenerDatosDeChef($id, $request){
        $tokenHeader = [
            "Authorization" => $request -> header("Authorization"),
            "Accept" => "application/json",
            "Content-Type" => "application/json"
        ];

        $response = Http::withHeaders($tokenHeader) -> get ( "http://localhost:8000/api/v1/user/" . $id);
        return $response -> json();
    }

    public function Crear(Request $request){
        $chivito = new Chivito();
        $chivito->nombre = $request->nombre;
        $chivito->descripcion = $request->descripcion;
        $chivito->precio = $request->precio;
        $chivito->chef_id = $request->chef_id;
        $chivito->save();
        return $chivito;
    }
}
