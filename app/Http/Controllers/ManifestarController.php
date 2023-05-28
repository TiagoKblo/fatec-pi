<?php

namespace App\Http\Controllers;

use App\Models\Edital;
use Illuminate\Http\Request;

class ManifestarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /*
     * Tela de criação de manifestação
     */
    public function create(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $id = $request->query('id_edital');
        $edital = Edital::findOrFail($id);

        return view('manifestar.create')->with('edital', $edital);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo "Manifestou!!!";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
