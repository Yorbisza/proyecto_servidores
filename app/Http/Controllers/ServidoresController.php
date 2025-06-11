<?php

namespace App\Http\Controllers;

use App\Models\ambientes;
use App\Models\Categorias;
use App\Models\contrasenas;
use App\Models\servidores;
use App\Models\status;
use App\Models\Capitanias;
use App\Models\UsuarioCategorias;
use Illuminate\Http\Request;

class ServidoresController extends Controller
{

    public function index()
    {
        $serve = servidores::paginate(5);
        //$usuarioCategorias = UsuarioCategorias::whereIn('serve_id', $serve->pluck('id'))->get();
        $usuarioCategorias = UsuarioCategorias::whereIn('id', $serve->pluck('user_categoria_id'))->get();

        // $ambientes = ambientes::find($serve->ambiente_id); // Busca el ambiente relacionado directamente
        $ambientes = ambientes::whereIn('id', $serve->pluck('ambiente_id'))->get();
        $status = status::whereIn('id', $serve->pluck('status_id'))->get();
        $capitanias = Capitanias::whereIn('id', $serve->pluck('capitania_id'))->get();


        return view('modules/servidores/index', compact('serve', 'usuarioCategorias', 'ambientes', 'status', 'capitanias'));

        // return view('servidores.show', $serve);
    }
    public function create()
    {
        //$serve = servidores::all(); // Obtener todos los servidores
        //return view('servidores.create', compact('serve'));
        $ambientes = ambientes::all();
        $capitanias = Capitanias::where('deleted_at','=', null)->get();
        $categorias = Categorias::all();
        return view('modules/servidores/create', compact('ambientes',  'capitanias', 'categorias'));
    }

public function store(Request $request)
{
    // Validar los datos del request
    $validatedData = $request->validate([
        'nombre_servidores' => 'required|string|max:255',
        'ip_servidores' => 'required|ip',
        'puerto' => 'required|string|max:10',
        'nombre_usuario' => 'nullable|string|max:255',
        'password' => 'nullable|string|max:255',
        'ambiente_id' => 'required',
        'capitania_id' => 'required',
        'categoria_id' => 'required',
    ]);

    // Crear un nuevo modelo de UsuarioCategorias
    $usuario = new UsuarioCategorias();

    // Guardar el usuario
    $usuario->fill($validatedData); // Asegúrate de que solo los campos necesarios se llenen
    $usuario->save();

    // Obtener el ID del usuario recién creado
    $user_categoria_id = $usuario->id;

    // Crear datos para el servidor
    $servidorData = [
        'nombre_servidores' => $validatedData['nombre_servidores'],
        'ip_servidores' => $validatedData['ip_servidores'],
        'puerto' => $validatedData['puerto'],
        'ambiente_id' => $validatedData['ambiente_id'],
        'capitania_id' => $validatedData['capitania_id'],
        'user_categoria_id' => $user_categoria_id, // Relacionar el ID del usuario
    ];

    // Crear el servidor
    $servidor = servidores::create($servidorData);

    // Redirigir al índice de servidores
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
        $capitanias = Capitanias::find($serve->capitania_id); // Busca el ambiente relacionado directamente



        // Pasar los datos del servidor y la contraseña a la vista
        return view('modules/servidores/show', compact('serve', 'contrasena', 'ambientes', 'capitanias'));
    }


    public function edit(string $id)
    {
        $serve = servidores::find($id);
        $contrasenas = contrasenas::whereIn('serve_id', $serve->pluck('id'))->get();
        $ambientes = ambientes::all();
        $capitanias = Capitanias::all();

        return view('modules/servidores/edit', compact('serve', 'contrasenas', 'ambientes', 'capitanias'));
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
            'capitania_id' => 'required',
        ]);


        $servidor = servidores::findOrFail($id);


        $servidorData = [
            'nombre_servidores' => $validatedData['nombre_servidores'],
            'ip_servidores' => $validatedData['ip_servidores'],
            'puerto' => $validatedData['puerto'],
            'ambiente_id' => $validatedData['ambiente_id'],
            'capitania_id' => $validatedData['capitania_id'],
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
