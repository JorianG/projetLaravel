<!-- resources/views/module/create.blade.php -->

@extends('layouts.app')

@section('title', 'Ajouter un Module')

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

        <form action="{{ route('module.store') }}" class="form-control mt-2" method="POST">
            @csrf

            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
            </div>

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-2"><i class="bi bi-plus-circle-fill me-1"></i>Ajouter le module</button>
            </div>
        </form>
    </div>
@endsection
