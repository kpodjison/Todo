@extends('layout.layout')
@section('title','Edit')

@section('header')
    @parent
@endsection

@section('main-content')
   <h3 class="text-center my-2">Edit Todo</h3>
   <div class="row">

       <div class="col-md-10 offset-md-1 border rounded shadow-sm p-3">

           @if (session('errorMsg'))
               <div class="alert alert-danger alert-dismissible fade show " role="alert">
                   <p>{{ session('errorMsg') }}</p>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
           @endif

           <form method="POST" action="/edit-todo/{{ $todo->id }}">
               @csrf
               <div class="mb-3">
                   <label for="name" class="form-label">Name</label>
                   <input type="text" class="form-control" id="name" placeholder="Enter item name" name="name" value="{{ $todo ? $todo->name : old('name') }}" required>
                   @error('name')
                   <p class="text-danger">{{ $message }}</p>
                   @enderror
               </div>
               <div class="mb-3">
                   <label for="todo-status" class="form-label">Status</label>
                   <select id="todo-status" class="form-select" name="status">
                       <option value="pending" {{ ($todo && $todo->status == 'pending' ) ? 'selected' : (old('status') == 'pending' ? 'selected' : '') }} selected>Pending</option>
                       <option value="completed" {{ ($todo && $todo->status == 'completed' ) ? 'selected' : ( old('status') == 'completed' ? 'selected' : '') }}>Completed</option>
                   </select>
                   @error('status')
                   <p class="text-danger">{{ $message }}</p>
                   @enderror
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
           </form>
       </div>
   </div>
@endsection

@section('footer')
    @parent
@endsection
