<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar la autenticación
    public function login(Request $request)
    {
        // Validación de los campos de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirigir al usuario al dashboard si la autenticación es exitosa
            return redirect()->intended(route('dashboard')); // redirige a la página que el usuario intentó acceder antes del login o al dashboard si no hay una.
        }

        // Si no se puede autenticar, redirigir con mensaje de error
        return redirect()->back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput($request->only('email')); // Mantener el valor del email en el campo de entrada en caso de error
    }


    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function showForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Se requiere confirmación de la contraseña
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        // Crear el usuario en la base de datos con la contraseña encriptada
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Aquí encriptamos la contraseña
        ]);

        // Redirigir o realizar otras acciones después del registro
        return redirect()->route('login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }
}
