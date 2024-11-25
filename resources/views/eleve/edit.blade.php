@extends('layouts.app')
@section('title', "Modifier Élève")
@section('content')
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('eleve.update', $eleve->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $eleve->nom) }}" required>
                @error('nom')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $eleve->prenom) }}" required>
                @error('prenom')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dateNaissance" class="form-label">Date de Naissance</label>
                <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" value="{{ old('dateNaissance', $eleve->dateNaissance) }}" required>
                @error('dateNaissance')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $eleve->email) }}" required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="numeroEtudiant" class="form-label">Numéro d'Étudiant</label>
                <input type="text" class="form-control" id="numeroEtudiant" name="numeroEtudiant" value="{{ old('numeroEtudiant', $eleve->numeroEtudiant) }}" required>
                @error('numeroEtudiant')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                @if($eleve->image)
                    <label for="image">Image</label>
                        <img class="mb-3" src="{{ asset('storage/' . $eleve->image) }}" alt="Current image" style="max-width: 100px;">
                @endif
                <input type="file" name="image" class="form-control" id="image">
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('eleve.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
