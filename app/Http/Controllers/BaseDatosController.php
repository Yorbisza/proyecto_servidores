<?php

namespace App\Http\Controllers;

use App\Models\BaseDatos;
use App\Models\contrasenas;
use App\Models\ambientes;
use App\Models\ContrasenasDB;
use App\Models\status;
use App\Models\Capitanias;
use App\Models\UsuarioCategorias;

use Illuminate\Http\Request;

class BaseDatosController extends Controller
{
    public function index()
    {
        $database = BaseDatos::paginate(5);
        $contrasenas = ContrasenasDB::whereIn('db_id', $database->pluck('id'))->get();
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
        try {
            $validatedData = $request->validate([
                'nombre_servidor' => 'required|string|max:255',
                'nombre_database' => 'required|string|max:255',
                'ip_database' => 'required|ip',
                'puerto' => 'required|string|max:10',
                'nombre_usuario' => 'nullable|string|max:255',
                'password' => 'nullable|string|max:255',
                'ambiente_id' => 'required',
                'categoria_id' => 'required',

            ]);

             $usuario = new UsuarioCategorias();

    // Guardar el usuario
    $usuario->fill($validatedData); // Asegúrate de que solo los campos necesarios se llenen
    $usuario->save();

    // Obtener el ID del usuario recién creado
    $user_categoria_id = $usuario->id;

            $dbData = [
                'nombre_servidor' => $validatedData['nombre_servidor'],
                'nombre_database' => $validatedData['nombre_database'],
                'ip_database' => $validatedData['ip_database'],
                'puerto' => $validatedData['puerto'],
                'ambiente_id' => $validatedData['ambiente_id'],
                'user_categoria_id' => $user_categoria_id, // Relacionar el ID del usuario

            ];

            $dbData_id = BaseDatos::create($dbData);

           
            return redirect()->route('baseDatos.index')->with('success', 'Base de datos creada exitosamente.');
        } catch (\Exception $e) {
            // Retorna un error en formato JSON
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

     public function show(string $id)
    {
        // Buscar el servidor por su ID
        $dbData = BaseDatos::find($id);


        // Verificar si el servidor fue encontrado
        if (!$dbData) {
            return redirect()->route('baseDatos.index')->with('error', 'Servidor no encontrado.');
        }

        // Buscar la contraseña asociada al servidor
        $contrasena = ContrasenasDB::where('db_id', $dbData->id)->first();
        $ambientes = ambientes::find($dbData->ambiente_id); // Busca el ambiente relacionado directamente



        // Pasar los datos del servidor y la contraseña a la vista
        return view('modules/baseDatos/show', compact('dbData', 'contrasena', 'ambientes'));
    }
    public function edit(string $id)
    {
        $dbData = BaseDatos::find($id);
        $contrasenas = ContrasenasDB::whereIn('db_id', $dbData->pluck('id'))->get();
        $ambientes = ambientes::all();

        return view('modules/baseDatos/edit', compact('dbData', 'contrasenas', 'ambientes'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nombre_servidor' => 'required|string|max:255',
            'nombre_database' => 'required|string|max:255',
            'ip_database' => 'required|ip',
            'puerto' => 'required|string|max:10',
            'nombre_usuario' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'ambiente_id' => 'required|exists:ambientes,id',
        ]);


        $dbData_id = BaseDatos::findOrFail($id);

        $dbData = [
            'nombre_servidor' => $validatedData['nombre_servidor'],
            'nombre_database' => $validatedData['nombre_database'],
            'ip_database' => $validatedData['ip_database'],
            'puerto' => $validatedData['puerto'],
            'ambiente_id' => $validatedData['ambiente_id'],
        ];
        $dbData_id->update($dbData);

        $passwordData = [
            'db_id' => $dbData_id->id,
            'nombre_usuario' => $validatedData['nombre_usuario'] ?? null,
            'password' => $validatedData['password'] ?? null,
        ];


        $contrasena = ContrasenasDB::where('db_id', $dbData_id->id)->first();

        if ($contrasena) {

            $contrasena->update($passwordData);
        } else {

            ContrasenasDB::create($passwordData);
        }

        return to_route('baseDatos.index');
    }

     public function destroy($id)
    {

        $dbData = BaseDatos::find($id);


        if (!$dbData) {
            return redirect()->route('baseDatos.index')->with('error', 'Servidor no encontrado.');
        }


        ContrasenasDB::where('db_id', $dbData->id)->delete();


        BaseDatos::destroy($id);

        return redirect()->route('baseDatos.index')->with('success', 'Servidor eliminado correctamente.');
    }

}
