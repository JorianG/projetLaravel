@extends('layouts.app')
@section('title', 'Gestion des Tokens API')
@section('content')
<div class="container">
    <h2>Gestion des Tokens API</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire de création de token -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Créer un nouveau token</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('api-tokens.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" 
                           name="description" 
                           class="form-control @error('description') is-invalid @enderror" 
                           required>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Créer Token</button>
            </form>
        </div>
    </div>

    <!-- Liste des tokens -->
    <div class="card">
        <div class="card-header">
            <h4>Tokens existants</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Token</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tokens as $token)
                        <tr>
                            <td>{{ $token->description }}</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" 
                                           value="{{ $token->token }}" 
                                           class="form-control" 
                                           readonly>
                                    <button class="btn btn-outline-secondary copy-btn" 
                                            data-token="{{ $token->token }}">
                                        Copier
                                    </button>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $token->active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $token->active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('api-tokens.toggle', $token) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="btn btn-warning btn-sm">
                                        {{ $token->active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                <form action="{{ route('api-tokens.destroy', $token) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce token ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.copy-btn').forEach(button => {
        button.addEventListener('click', function() {
            const token = this.dataset.token;
            const input = this.previousElementSibling;
            
            // Sélectionner le texte
            input.select();
            input.setSelectionRange(0, 99999); // Pour mobile
            
            // Copier le texte
            try {
                navigator.clipboard.writeText(token).then(() => {
                    // Change temporairement le texte du bouton
                    const originalText = this.textContent;
                    this.textContent = 'Copié !';
                    setTimeout(() => {
                        this.textContent = originalText;
                    }, 2000);
                });
            } catch (err) {
                // Fallback pour les navigateurs plus anciens
                document.execCommand('copy');
                const originalText = this.textContent;
                this.textContent = 'Copié !';
                setTimeout(() => {
                    this.textContent = originalText;
                }, 2000);
            }
        });
    });
});
</script>
@endsection 