<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Capitanias;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller {

    //contructor para permisos de usuarios en el sistema
    function __construct() {

        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario', ['only' => ['index']]);
        $this->middleware('permission:crear-usuario', ['only' => ['create','store']]);
        $this->middleware('permission:editar-usuario', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-usuario', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //Sin paginación
        /* $usuarios = User::all();
        return view('usuarios.index',compact('usuarios')); */
        $usuarios = User::select('users.*', 'capitanias.nombre as capitania')->leftjoin('capitanias', 'capitanias.id', '=','users.capitanias_id')->get();
        //Con paginación
        //$usuarios = User::paginate(5);
        return view('usuarios.index',compact('usuarios'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //aqui trabajamos con name de las tablas de users
        $roles = Role::pluck('name','name')->all();
        $capitanias = Capitanias::where('deleted_at','=', null)->get();

        return view('usuarios.crear',compact('roles','capitanias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, [
            'capitanias_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index');
    }
    public function edit($id)  {

        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $capitanias = Capitanias::where('deleted_at','=', null)->get();

        $userRole = $user->roles->pluck('name','name')->all();

        return view('usuarios.editar',compact('user','roles','userRole','capitanias'));
    }


    public function update(Request $request, $id) {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

         User::find($id)->delete();
        return redirect()->route('usuarios.index')->with('eliminar', 'ok');
    }
}
