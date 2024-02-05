<!-- resources/views/products/create.blade.php -->
@extends('master')
@section('content')
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_name">category Name:</label>
            <input type="text" class="form-control" id="category_name" name="category_name">
        </div>
       
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection


