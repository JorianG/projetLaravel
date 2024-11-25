@extends('layouts.app')  {{-- Changed from layout.app --}}
@section('title', 'Liste des Modules')
@section('content')
    <div class=" mt-2">

        {{-- Message flash pour les notifications --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('module.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill me-1"></i> Ajouter un Module</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($modules as $module)
                <tr>
                    <td>{{ $module->id }}</td>
                    <td>{{ $module->code }}</td>
                    <td>{{ $module->name }}</td>
                    <td>
                        <a href="{{ route('module.show', $module->id) }}" class="btn btn-primary btn-sm">Voir</a>
                        <a href="{{ route('module.edit', $module->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('module.destroy', $module->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce module?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <ul class="pagination justify-content-end ">
            {{ $modules->links('pagination::bootstrap-4') }}
        </ul>
    </div>
@endsection
