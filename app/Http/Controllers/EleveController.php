<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Dotenv\Loader\Loader;
use Illuminate\Http\Request;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $eleves = Eleve::query()
            ->when($search, function ($query, $search) {
                return $query->where('nom', 'LIKE', "%{$search}%")
                            ->orWhere('prenom', 'LIKE', "%{$search}%")
                            ->orWhere('numeroEtudiant', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        // If it's a search, append the search query to pagination links
        if ($search) {
            $eleves->appends(['search' => $search]);
        }

        return view('eleve.index', compact('eleves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eleve.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'dateNaissance' => 'required|date',
            'email' => 'required|string|unique:users|email|max:255',
            'numeroEtudiant' => 'required|unique:eleves|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');
        $validated['imagePath'] = $imagePath;

        // Create user account
        $user = User::create([
            'name' => $request->prenom . ' ' . $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->numeroEtudiant), // Using student number as initial password
            'role' => 'student',
        ]);

        // Create eleve and link to user
        $eleve = new Eleve($validated);
        $eleve->user_id = $user->id;
        $eleve->save();

        // Send welcome email
        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('eleve.index')
            ->with('success', 'Student created successfully with associated user account.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $eleve = Eleve::with('user')->findOrFail($id);
        $imagePath = $eleve->image;
        return view('eleve.show', compact('eleve', 'imagePath'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $eleve = Eleve::findOrFail($id);
        return view('eleve.edit', compact('eleve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'dateNaissance' => 'required|date',
            'email' => 'required|string|email|unique:eleves,email,' . $id . '|max:255',
            'numeroEtudiant' => 'required|string|unique:eleves,numeroEtudiant,' . $id . '|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $eleve = Eleve::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        $eleve->update($validated);
        return redirect()->route('eleve.index')->with('success', 'Élève modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $eleve = Eleve::findOrFail($id);
        $eleve->delete();

        return redirect()->route('eleve.index')->with('success', 'Élève supprimé avec succès.');
    }
}
