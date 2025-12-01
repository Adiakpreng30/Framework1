<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\search;

class PelangganController extends Controller
{
   public function index(Request $request)
    {
        $searchableColumns = ['first_name','last_name','gender','email'];
        $filterableColumns = ['gender'];
        $pageData['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
        ->search($request,$searchableColumns)
        ->paginate(10)->withQueryString() ;
        // $data['dataPelanggan'] = Pelanggan::simplePaginate(10);
        return view('admin.pelanggan.index', $pageData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
        ]);

        Pelanggan::create($validatedData);


        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
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

        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Validasi data berdasarkan aturan dari gambar
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);

        // Menggunakan $validatedData untuk memperbarui data
        $pelanggan->update($validatedData);

        return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Berhasil!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');

    }
}
