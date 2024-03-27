@extends('layout.layout')
@section('title','Home')

@section('header')
    @parent
@endsection

@section('main-content')
   <h3 class="text-center my-2">Latest Todos</h3>
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
           @foreach ($latestTodos as $key => $todo)
               <tr>
                   <th scope="row">{{ ($latestTodos->currentPage() - 1) * $latestTodos->perPage() + $key + 1 }}</th>
                   <td><a href="/view-todo/{{$todo->id}}">{{ $todo->name}}</a></td>
                   <td>
                       @if( $todo->status == 'completed')
                           <span class="badge bg-success p-2 rounded text-white">Completed</span>
                       @else
                           <span class="badge bg-warning p-2 rounded text-black">Pending</span>
                       @endif

                   </td>
                   <td>
                       <div class="btn-group gap-2 btn-sm" role="group">
                           <a href="/edit-todo/{{$todo->id}}" type="button" class="btn btn-info rounded"><i class="fa-regular fa-pen-to-square"></i></a>
                           @if($todo->status == 'completed')
                               <button type="button" class="btn btn-success rounded"
                                       onclick="setTodoPending({{$todo}},)">
                                   <i class="fa-solid fa-check"></i>
                               </button>
                           @else
                               <button type="button" class="btn btn-warning rounded"
                                       onclick="completeTodo({{$todo}},)">
                                   <i class="fa-regular fa-circle-xmark"></i>
                               </button>
                           @endif
                           <button type="button" class="btn btn-danger rounded" onclick="deleteTodo({{$todo->id}})"><i class="fa-solid fa-trash"></i></button>

                       </div>
                   </td>
               </tr>

           @endforeach

           </tbody>
       </table>
               @if(!empty($latestTodos))
                 {{$latestTodos->links()}}
               @endif
       </div>
   </div>
@endsection

@section('footer')
    @parent
@endsection
