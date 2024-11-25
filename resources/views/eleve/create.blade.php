<!-- resources/views/produits/create.blade.php -->

@extends('layouts.app')

@section('title', 'Ajouter un Eleve')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">

        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('eleve.store') }}" class="form-control mt-2" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
            </div>

            <div class="form-group">
                <label for="dateNaissance">Date de naissance</label>
                <input type="date" name="dateNaissance" class="form-control" value="{{ old('dateNaissance') }}" required>
            </div>

            <div class="form-group">
                <label for="numeroEtudiant">Numéro étudiant</label>
                <input type="text" name="numeroEtudiant" class="form-control" value="{{ old('numeroEtudiant') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-2">
                    <i class="bi bi-person-plus-fill me-1"></i>Ajouter l'élève
                </button>
            </div>
        </form>
    </div>
@endsection
