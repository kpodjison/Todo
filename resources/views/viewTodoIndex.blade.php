@extends('layout.layout')
@section('title','View')

@section('header')
    @parent
@endsection

@section('main-content')
   <h3 class="text-center my-2">View Item</h3>
   <div class="table-responsive row">
       <div class="col-md-10 offset-md-1">
           @if (session('success'))
               <div class="alert alert-success alert-dismissible fade show " role="alert">
                   <p>{{ session('success') }}</p>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
           @endif

            <table class="table table-striped">
           <thead>
           <tr>
               <th scope="col">#</th>
               <th scope="col">Name</th>
               <th scope="col">Status</th>
               <th scope="col">Action</th>
           </tr>
           </thead>
           <tbody>
           @if(isset($todoItem))
               <tr>
                   <th scope="row">1</th>
                   <td>{{ $todoItem->name}}</a></td>
                   <td>
                       @if( $todoItem->status == 'completed')
                           <span class="badge bg-success p-2 rounded text-white">Completed</span>
                       @else
                           <span class="badge bg-warning p-2 rounded text-black">Pending</span>
                       @endif

                   </td>
                   <td>
                       <div class="btn-group gap-2 btn-sm" role="group">
                           <a href="/edit-todo/{{$todoItem->id}}" type="button" class="btn btn-info rounded"><i class="fa-regular fa-pen-to-square"></i></a>
                           @if($todoItem->status == 'completed')
                               <button type="button" class="btn btn-warning rounded"><i class="fa-regular fa-circle-xmark"></i></button>
                           @else
                               <button type="button" class="btn btn-success rounded"> <i class="fa-solid fa-check"></i></button>
                           @endif
                           <button type="button" class="btn btn-danger rounded" onclick="deleteTodo({{$todoItem->id}})"><i class="fa-solid fa-trash"></i></button>

                       </div>
                   </td>
               </tr>
           @else
               <tr>
                   <td colspan="4" class="text-center text-danger">  <p>No Item Found</p></td>
               </tr>


           @endif

           </tbody>
       </table>
       </div>
   </div>
@endsection

@section('footer')
    @parent
@endsection
