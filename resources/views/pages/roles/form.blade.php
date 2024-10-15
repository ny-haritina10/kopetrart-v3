@extends('templates.home')

@section('aside')
<x-navbar.main active="/center"></x-navbar.main>
@endsection

@section('content')
    <div class="container">
        <h1>{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h1>

        <form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
            @csrf
            @if(isset($role))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="label">Label</label>
                <input type="text" name="label" value="{{ isset($role) ? $role->label : old('label') }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
                {{ isset($role) ? 'Update' : 'Create' }}
            </button>
        </form>
    </div>
@endsection