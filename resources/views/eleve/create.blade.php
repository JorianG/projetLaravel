<!-- resources/views/produits/create.blade.php -->

@extends('layouts.app')

@section('title', 'Ajouter un Eleve')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">


        <form action="{{ route('eleve.store') }}" class="form-control mt-2" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="nom">Nom</label>
                <input type="text" 
                       name="nom" 
                       class="form-control @error('nom') is-invalid @enderror" 
                       value="{{ old('nom') }}" 
                       required>
                @error('nom')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="prenom">Prénom</label>
                <input type="text" 
                       name="prenom" 
                       class="form-control @error('prenom') is-invalid @enderror" 
                       value="{{ old('prenom') }}" 
                       required>
                @error('prenom')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="dateNaissance">Date de naissance</label>
                <input type="date" 
                       name="dateNaissance" 
                       class="form-control @error('dateNaissance') is-invalid @enderror" 
                       value="{{ old('dateNaissance') }}" 
                       required>
                @error('dateNaissance')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="numeroEtudiant">Numéro étudiant</label>
                <input type="text" 
                       name="numeroEtudiant" 
                       class="form-control @error('numeroEtudiant') is-invalid @enderror" 
                       value="{{ old('numeroEtudiant') }}" 
                       required>
                @error('numeroEtudiant')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" 
                       name="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" 
                       required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="image">Image</label>
                <input type="file" 
                       name="image" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       accept="image/*">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-2">
                    <i class="bi bi-person-plus-fill me-1"></i>Ajouter l'élève
                </button>
            </div>
        </form>
    </div>
@endsection
