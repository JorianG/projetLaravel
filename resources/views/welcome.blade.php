<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')
@section('title', 'Welcome to Our Application')
@section('content')
    <div class="container">
        <h1>Bienvenue sur mon application des gestion de notes</h1>
        <a href="{{ url('/eleve') }}" class="btn btn-primary">Liste des Eleves</a>
        
        @can('access-module-management')
        <a href="{{ url('/module') }}" class="btn btn-primary">Liste des Modules</a>
        @endcan

        @can('access-evaluation-management')
        <a href="{{ url('/evaluation') }}" class="btn btn-primary">Liste des Evaluations</a>
        @endcan
    </div>
@endsection