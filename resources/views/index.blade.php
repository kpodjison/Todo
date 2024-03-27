@extends('layout.layout')
@section('title','Home')

@section('header')
    @parent
@endsection

@section('main-content')
   <h3 class="text-center my-2">Latest Todos</h3>
   <div class="table-responsive row">
       <div class="col-md-10 offset-md-1">
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
               <tr>
                   <th scope="row">1</th>
                   <td>Otto</td>
                   <td>
                       <span class="badge bg-success p-2 rounded text-white">Completed</span>
                       <span class="badge bg-warning p-2 rounded text-black">Pending</span>
                   </td>

                   <td>
                       <div class="btn-group gap-2 btn-sm" role="group">
                           <button type="button" class="btn btn-info rounded"><i class="fa-regular fa-pen-to-square"></i></button>
                           <button type="button" class="btn btn-success rounded"> <i class="fa-solid fa-check"></i></button>
                           <button type="button" class="btn btn-warning rounded"><i class="fa-regular fa-circle-xmark"></i></button>
                           <button type="button" class="btn btn-danger rounded"><i class="fa-solid fa-trash"></i></button>

                       </div>
                   </td>
               </tr>
               <tr>
                   <th scope="row">1</th>
                   <td>Otto</td>
                   <td>
                       <span class="badge bg-success p-2 rounded text-white">Completed</span>
                       <span class="badge bg-warning p-2 rounded text-black">Pending</span>
                   </td>

                   <td>
                       <div class="btn-group gap-2 btn-sm" role="group">
                           <button type="button" class="btn btn-info rounded"><i class="fa-regular fa-pen-to-square"></i></button>
                           <button type="button" class="btn btn-success rounded"> <i class="fa-solid fa-check"></i></button>
                           <button type="button" class="btn btn-warning rounded"><i class="fa-regular fa-circle-xmark"></i></button>
                           <button type="button" class="btn btn-danger rounded"><i class="fa-solid fa-trash"></i></button>

                       </div>
                   </td>
               </tr>

           </tbody>
       </table>
       </div>
   </div>
@endsection

@section('footer')
    @parent
@endsection
