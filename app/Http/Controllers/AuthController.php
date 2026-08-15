<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Procesa el inicio de sesión.
     */
    public function login(Request $request)
    {
        $credenciales = $request->validate(
            [
                'email' => [
                    'required',
                    'email',
                ],
                'password' => [
                    'required',
                ],
            ],
            [
                'email.required' =>
                    'Debe ingresar su correo institucional.',

                'email.email' =>
                    'Debe ingresar un correo válido.',

                'password.required' =>
                    'Debe ingresar su contraseña.',
            ]
        );

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            /*
             * Redirección según el rol del usuario.
             */
            if (Auth::user()->rol === 'administrador') {
                return redirect()
                    ->route('admin.dashboard')
                    ->with(
                        'success',
                        'Sesión iniciada como administrador.'
                    );
            }

            return redirect()
                ->route('funcionario.dashboard')
                ->with(
                    'success',
                    'Sesión iniciada correctamente.'
                );
        }

        return back()
            ->withErrors([
                'email' =>
                    'El correo o la contraseña no son correctos.',
            ])
            ->onlyInput('email');
    }

    /**
     * Muestra el formulario de registro.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Registra una nueva cuenta de funcionario.
     */
    public function register(Request $request)
    {
        $datos = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'email' => [
                    'required',
                    'email',
                    'unique:users,email',
                ],
                'password' => [
                    'required',
                    'min:6',
                    'confirmed',
                ],
            ],
            [
                'name.required' =>
                    'Debe ingresar su nombre.',

                'email.required' =>
                    'Debe ingresar su correo institucional.',

                'email.email' =>
                    'Debe ingresar un correo válido.',

                'email.unique' =>
                    'Este correo ya se encuentra registrado.',

                'password.required' =>
                    'Debe ingresar una contraseña.',

                'password.min' =>
                    'La contraseña debe tener al menos 6 caracteres.',

                'password.confirmed' =>
                    'La confirmación de contraseña no coincide.',
            ]
        );

        /*
         * Los usuarios creados desde el registro público
         * siempre quedan con rol funcionario.
         */
        $usuario = User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => $datos['password'],
            'rol' => 'funcionario',
        ]);

        Auth::login($usuario);

        $request->session()->regenerate();

        return redirect()
            ->route('funcionario.dashboard')
            ->with(
                'success',
                'Cuenta creada correctamente.'
            );
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Sesión cerrada correctamente.'
            );
    }
}