<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('login-form');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/', // Memastikan ada minimal satu huruf kapital
            ],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 3 karakter.',
            'password.regex'    => 'Password harus mengandung minimal satu huruf kapital.',
        ]);

        // Kalo gagal kembali ke hal login
        if ($validator->fails()) {
            return redirect()->route('login.form')
                ->withErrors($validator)
                ->withInput();
        }
        return redirect()->route('dashboard')
            ->with('success', 'Login berhasil!.');

    }
}
