<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ApiTokenController extends Controller
{
    public function index()
    {
        $tokens = ApiToken::all();
        return view('api.tokens.index', compact('tokens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $token = ApiToken::create([
            'token' => Str::random(60),
            'description' => $request->description,
            'active' => true,
        ]);



        return redirect()->route('api-tokens.index')
            ->with('success', 'Token API créé avec succès.');
    }

    public function destroy(ApiToken $token)
    {
        $token->delete();
        return redirect()->route('api-tokens.index')
            ->with('success', 'Token API supprimé avec succès.');
    }

    public function toggleActive(ApiToken $token)
    {
        $token->update(['active' => !$token->active]);
        return redirect()->route('api-tokens.index')
            ->with('success', 'Statut du token mis à jour avec succès.');
    }
} 