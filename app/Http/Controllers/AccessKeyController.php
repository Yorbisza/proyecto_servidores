<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessKeyController extends Controller
{
    public function verifyAccessKey(Request $request)
    {
        $request->validate([
            'access_key' => 'required|string',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar que el usuario esté autenticado
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Usuario no autenticado.']);
        }

        // Lógica para verificar la clave de acceso
        if (Hash::check($request->access_key, $user->password)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Clave de acceso incorrecta.']);
    }
}
