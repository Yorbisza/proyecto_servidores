<?php

namespace App\Http\Controllers;

use App\Models\BaseDatos;
use App\Models\contrasenas;
use App\Models\ambientes;
use App\Models\ContrasenasDB;
use App\Models\status;
use App\Models\Capitanias;

use Illuminate\Http\Request;

class BaseDatosController extends Controller
{
     public function index()
    {
        $database = BaseDatos::paginate(5);
        $contrasenas = contrasenas::whereIn('db_id', $database->pluck('id'))->get();
        // $ambientes = ambientes::find($serve->ambiente_id); // Busca el ambiente relacionado directamente
        $ambientes = ambientes::whereIn('id', $database->pluck('ambiente_id'))->get();
        $status = status::whereIn('id', $database->pluck('status_id'))->get();


        return view('modules/baseDatos/index', compact('database', 'contrasenas', 'ambientes', 'status'));

        // return view('servidores.show', $serve);
    }
    public function create()
    {
        $ambientes = ambientes::all();
        return view('modules/baseDatos/create', compact('ambientes'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'nombre_servidor' => 'required|string|max:255',
            'nombre_database' => 'required|string|max:255',
            'ip_database' => 'required|ip',
            'puerto' => 'required|string|max:10',
            'nombre_usuario' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'ambiente_id' => 'required',
        ]);
$dbData = [
            'nombre_servidor' => $validatedData['nombre_servidor'],
            'nombre_database' => $validatedData['nombre_database'],
            'ip_database' => $validatedData['ip_database'],
            'puerto' => $validatedData['puerto'],
            'ambiente_id' => $validatedData['ambiente_id'],
        ];
        $dbData_id = BaseDatos::create($dbData);

        $passwordData =[
            'db_id' => $dbData_id->id,
            'nombre_usuario' => $validatedData['nombre_usuario'],
            'password' => $validatedData['password'],
        ];
        ContrasenasDB::create($passwordData);
         return to_route('baseDatos.index');
    }
}
