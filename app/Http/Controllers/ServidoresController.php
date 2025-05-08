<?php

namespace App\Http\Controllers;

use App\Models\ambientes;
use App\Models\contrasenas;
use App\Models\servidores;
use App\Models\status;
use Illuminate\Http\Request;

class ServidoresController extends Controller
{

    public function index()
    {
        $serve = servidores::paginate(5);
        $contrasenas = contrasenas::whereIn('serve_id', $serve->pluck('id'))->get();
        // $ambientes = ambientes::find($serve->ambiente_id); // Busca el ambiente relacionado directamente
        $ambientes = ambientes::whereIn('id', $serve->pluck('ambiente_id'))->get();
        $status = status::whereIn('id', $serve->pluck('status_id'))->get();


        return view('modules/servidores/index', compact('serve', 'contrasenas', 'ambientes', 'status'));

        // return view('servidores.show', $serve);
    }
    public function create()
    {
        //$serve = servidores::all(); // Obtener todos los servidores
        //return view('servidores.create', compact('serve'));
        $ambientes = ambientes::all();
        $status = status::all();
        return view('modules/servidores/create', compact('ambientes', 'status'));
    }

    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'nombre_servidores' => 'required|string|max:255',
            'ip_servidores' => 'required|ip',
            'puerto' => 'required|string|max:10',
            'nombre_usuario' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'ambiente_id' => 'required',
            'status_id' => 'required',
        ]);

        $servidorData = [
            'nombre_servidores' => $validatedData['nombre_servidores'],
            'ip_servidores' => $validatedData['ip_servidores'],
            'puerto' => $validatedData['puerto'],
            'ambiente_id' => $validatedData['ambiente_id'],
            'status_id' => $validatedData['status_id'],
        ];
        $servidor = servidores::create($servidorData);

        $passwordData = [
            'serve_id' => $servidor->id,
            'nombre_usuario' => $validatedData['nombre_usuario'] ?? null,
            'password' => $validatedData['password'] ?? null,
        ];
        contrasenas::create($passwordData);

        return to_route('servidores.index');
    }

    public function show(string $id)
    {
        // Buscar el servidor por su ID
        $serve = servidores::find($id);

        // Verificar si el servidor fue encontrado
        if (!$serve) {
            return redirect()->route('servidores.index')->with('error', 'Servidor no encontrado.');
        }

        // Buscar la contraseña asociada al servidor
        $contrasena = contrasenas::where('serve_id', $serve->id)->first();
        $ambientes = ambientes::find($serve->ambiente_id); // Busca el ambiente relacionado directamente
        $status = status::find($serve->status_id); // Busca el ambiente relacionado directamente



        // Pasar los datos del servidor y la contraseña a la vista
        return view('modules/servidores/show', compact('serve', 'contrasena', 'ambientes', 'status'));
    }


    public function edit(string $id)
    {
        $serve = servidores::find($id);
        $contrasenas = contrasenas::whereIn('serve_id', $serve->pluck('id'))->get();
        $ambientes = ambientes::all();
        $status = status::all();

        return view('modules/servidores/edit', compact('serve', 'contrasenas', 'ambientes', 'status'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nombre_servidores' => 'required|string|max:255',
            'ip_servidores' => 'required',
            'puerto' => 'required|string|max:10',
            'nombre_usuario' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'ambiente_id' => 'required',
            'status_id' => 'required',
        ]);


        $servidor = servidores::findOrFail($id);


        $servidorData = [
            'nombre_servidores' => $validatedData['nombre_servidores'],
            'ip_servidores' => $validatedData['ip_servidores'],
            'puerto' => $validatedData['puerto'],
            'ambiente_id' => $validatedData['ambiente_id'],
            'status_id' => $validatedData['status_id'],
        ];
        $servidor->update($servidorData);

        $passwordData = [
            'serve_id' => $servidor->id,
            'nombre_usuario' => $validatedData['nombre_usuario'] ?? null,
            'password' => $validatedData['password'] ?? null,
        ];


        $contrasena = contrasenas::where('serve_id', $servidor->id)->first();

        if ($contrasena) {

            $contrasena->update($passwordData);
        } else {

            contrasenas::create($passwordData);
        }

        return to_route('servidores.index');
    }

    public function destroy($id)
    {

        $servidor = servidores::find($id);


        if (!$servidor) {
            return redirect()->route('servidores.index')->with('error', 'Servidor no encontrado.');
        }


        contrasenas::where('serve_id', $servidor->id)->delete();


        servidores::destroy($id);

        return redirect()->route('servidores.index')->with('success', 'Servidor eliminado correctamente.');
    }

}
