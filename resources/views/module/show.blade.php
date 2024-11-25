    @extends('layouts.app')

    @section('title', 'Detail d\'un module')
    @section('content')
        <div class="mt-2">

            <div class="card">
                <div class="card-header">
                    <h2>{{ $module->code }} - {{ $module->name }}</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Code:</strong> {{ $module->code }}</li>
                        <li class="list-group-item"><strong>Nom:</strong> {{ $module->name }}</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('module.index') }}" class="btn btn-primary">Retour à la liste</a>
                    <a href="{{ route('module.edit', $module->id) }}" class="btn btn-warning">Modifier</a>

                    <!-- Formulaire pour supprimer le module -->
                    <form action="{{ route('module.destroy', $module->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce module ?')">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
