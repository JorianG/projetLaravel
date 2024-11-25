@extends('layouts.app')

@section('title', 'Detail d\'un eleve')
@section('content')
    <div class="">

        <div class="card">
            <div class="card-header">
                <h2>{{ $eleve->nom }} {{ $eleve->prenom }}</h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                <li class="list-group-item"><strong>Image:</strong> <img src="{{ asset('storage/' . $eleve->image) }}" alt="Image" style="max-width:150px"></li>
                    <li class="list-group-item"><strong>Date de Naissance:</strong> {{ \Carbon\Carbon::parse($eleve->dateNaissance)->format('d/m/Y') }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $eleve->email }}</li>
                    <li class="list-group-item"><strong>Numéro d'Étudiant:</strong> {{ $eleve->numeroEtudiant }}</li>
                   
                </ul>
            </div>
            <div class="card-footer">
                <a href="{{ route('eleve.index') }}" class="btn btn-primary">Retour à la liste</a>
                <a href="{{ route('eleve.edit', $eleve->id) }}" class="btn btn-warning">Modifier</a>

                <!-- Formulaire pour supprimer l'élève -->
                <form action="{{ route('eleve.destroy', $eleve->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
