@extends('layout.layout')
@section('title','Home')

@section('header')
    @parent
@endsection

@section('main-content')
    <div class="d-flex flex-row justify-content-between my-3 px-md-4">
        <div><h3 class="">Latest Todos</h3></div>
        <div class="d-flex gap-2">
            <form method="POST" action="/">
                @csrf
                <div class="mb-3 d-flex gap-3">
                    <div class="d-flex gap-2 align-items-center">
                        <label for="todo-status" class="form-label fw-bold">Filter</label>
                        <select id="todo-status" class="form-select" name="status">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>

                    </div>
                    <div>
                        <input type="hidden" name="flag" value="latest-todo" />
                        <button type="submit" class="btn btn-primary btn-sm my-2">Filter</button>
                    </div>

                </div>

            </form>

        </div>

    </div>

   <div class="table-responsive row">
       <div class="col-md-10 offset-md-1 border p-2 rounded">
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
                                       onclick="setTodoPending({{$todo}})">
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
           @if(count($latestTodos) == 0)
               <tr>
                   <td colspan="4" class="text-center text-danger">  <p>No Items Found</p></td>
               </tr>
           @endif

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
