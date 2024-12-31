@extends('layouts.app')  {{-- Changed from layout.app --}}
@section('title', 'Liste des Eleves')
@section('content')
    <div class="mt-2">
        {{-- Message flash pour les notifications --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('eleve.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus-fill me-1"></i> Ajouter un Eleve
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{ route('eleve.index') }}" method="GET" class="d-flex">
                    <input type="text" 
                           name="search" 
                           class="form-control me-2" 
                           placeholder="Rechercher par nom, prénom ou numéro étudiant..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </form>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
                <th>Email</th>
                <th>Numéro d'Étudiant</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($eleves as $eleve)
                <tr>
                    <td>{{ $eleve->id }}</td>
                    <td><img src="{{ asset('storage/' . $eleve->image) }}" alt="Image" style="max-width:50px;"></td>
                    <td>{{ $eleve->nom }}</td>
                    <td>{{ $eleve->prenom }}</td>
                    <td>{{ $eleve->dateNaissance }}</td>
                    <td>{{ $eleve->email }}</td>
                    <td>{{ $eleve->numeroEtudiant }}</td>
                    <td>
                        <a href="{{ route('eleve.show', $eleve->id) }}" class="btn btn-primary btn-sm">Profil</a>
                        @can('access-evaluation-management')
                        <a href="{{ route('notesEleve', $eleve->id) }}" class="btn btn-primary btn-sm">Notes</a>
                        @endcan
                        <a href="{{ route('eleve.edit', $eleve->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('eleve.destroy', $eleve->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève?');">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $eleves->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
