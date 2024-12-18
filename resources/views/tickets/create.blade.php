@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')
    <h1>Create Ticket</h1>
    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <p></p>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
