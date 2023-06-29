<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Matricula;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user() ?? auth()->user();
        $matricula = Matricula::where('user_id', $user->id)->first();

        return view('profile.edit', compact('user', 'matricula'));
    }

    /**
     * Display the list of users.
     */
    public function usuarios(Request $request): View
    {
        $usuarios = User::all();

        return view('profile.usuarios', compact('usuarios'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        $matricula = Matricula::find($user->matricula->id);

        $matricula->unidade = $request->unidade;
        $matricula->grau = $request->grau;
        $matricula->pes = $request->pes;
        $matricula->celular = $request->celular;
        $matricula->telefone = $request->telefone;

        $matricula->save();

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/');
    }
}
