<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class TodoController extends Controller
{
     public function index(){
         $latestTodos = Todo::whereDate('created_at','<=',now()->today())->paginate(5);
         return view('index')->with('latestTodos',$latestTodos);
     }

    public function addToDoIndex(){
        return view('addToDoIndex');
    }

    public function addToDo(Request $request){
         //validation
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string|max:30',
                'status' => 'nullable|string|max:9'
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();;
        }

        //save to db
        try {
            Todo::create($request->all());
            return redirect()->route('home')->with('success', 'Item Added Successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('errorMsg', 'Failed To Added Item!!');
        }


    }

    public function editToDoIndex($id){

         //get item from db
        try {
            $todo = Todo::find($id);
            return view('editToDoIndex')->with('todo',$todo);
        }catch (\Exception $e){
            return redirect()->back()->with('errorMsg', 'Item Not Found!!');
        }


    }
    public function editToDo(Request $request,$id){


        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string|max:30',
                'status' => 'nullable|string|max:9',
                'changed' =>'nullable|boolean'
            ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();;
        }

        try {

            $todoItem = Todo::findOrFail($id);
            $todoItem->update([
                'name' => $request['name'],
                'status' => $request['status']
            ]);

            if( isset($request['changed'])){
                return  \response()->json(['message' => "Item Status Updated Successfully"], 200);
            }
            return redirect()->route('view-todo')->with('todoItem', $todoItem);

        } catch (\Exception $e) {
            if( isset($request['changed'])){
                return  \response()->json(['errorMsg' => 'Failed to Update Item Status!!']);

            }

            return redirect()->back()->with('errorMsg', 'Failed To Update Item!!');
        }

    }

    public function viewTodo(){
        return view('viewToDoIndex')
            ->with('todoItem',session('todoItem'))
            ->with('success', 'Item Updated Successfully');
    }
    public function viewTodoIndex($id){
        try {

            $todoItem = Todo::findOrFail($id);
            return view('viewToDoIndex')
                ->with('todoItem',$todoItem)
                ->with('success', 'Item Updated Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('errorMsg', 'Item Not Found!!');
        }

    }

    public function deleteTodo($id){

        try {
            $todo = Todo::find($id);
            $todo->delete();
            return  \response()->json(['message' => "Item Deleted Successfully"], 200);
        }catch (\Exception $e){
            return  \response()->json(['errorMsg' => 'Failed to Delete Item!!']);
        }
    }


}
