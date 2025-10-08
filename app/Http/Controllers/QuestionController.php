<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'       => 'required|max:50',
            'email'      => ['required', 'email'],
            'pertanyaan' => 'required|max:300|min:3',
        ], [
            'nama.required'       => 'Nama tidak boleh kosong',
            'nama.max'            => 'Nama maksimal 50 karakter',
            'email.required'      => 'Email tidak boleh kosong',
            'pertanyaan.required' => 'Pertanyaan tidak boleh kosong',
            'pertanyaan.min'      => 'Pertanyaan minimal 3 karakter',
            'email.email'         => 'Format email tidak valid',
        ]);

        $nama       = $validatedData['nama'];
        $pertanyaan = $validatedData['pertanyaan'];
        $email      = $validatedData['email'];

        $pesan = "Terimakasih {$nama}! Pertanyaan Anda: '{$pertanyaan}' akan segera direspon melalui email {$email}";

        // Redirect kembali dengan membawa pesan yang sudah dirangkai
        return redirect()->back()->with('success', $pesan);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
