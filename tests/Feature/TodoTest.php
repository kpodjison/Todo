<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_homepage_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_add_todo_can_be_rendered(){
        $response = $this->get('/add-todo');
        $response->assertStatus(200);
    }
    public function test_user_can_add_todo(){
        $data = [
            'name'=> 'Coding',
            'status' => 'completed'
        ];
        $response = $this->post('/add-todo',$data);
        $response->assertSessionHas('success');
    }

    public function test_user_cannot_add_todo_with_invalid_data(){
        $data = [
            'name'=> 'Coding is a good thing to do. It bring out my happy. Keep running',
            'status' => 'completed is too long'
        ];
        $response = $this->post('/add-todo',$data);
        $response->assertStatus(302)
        ->assertSessionHasErrors(['name','status']);
    }

    public function test_edit_todo_can_be_rendered(){
        //add todos
        Todo::factory(5)->create();

        $response = $this->get('/edit-todo/1');
        $response->assertStatus(200);
    }

    public function  test_user_can_edit_todo(){
        $myTodo = Todo::create([
            'name'=> 'My test todo',
            'status' => 'pending'
        ]);
        $this->assertDatabaseHas('todos',[
            'name'=> 'My test todo',
            'status' => 'pending'
        ]);
        $insertId = $myTodo->id;

        $editedTodo = [
            'name'=> 'My first test todo',
            'status' => 'completed'
        ];

        $response = $this->post("/edit-todo/".$insertId,$editedTodo); //edit Todo
        $response->assertStatus(302);

        //check if DB has edited values
        $this->assertDatabaseHas('todos',[
            'name'=> 'My first test todo',
            'status' => 'completed'
        ]);
    }

    public function  test_user_can_delete_todo(){
        $myTodo = Todo::create([
            'name'=> 'My second todo',
            'status' => 'pending'
        ]);

        $insertId = $myTodo->id;

        $this->assertDatabaseHas('todos',[
            'name'=> 'My second todo',
            'status' => 'pending'
        ]);

        $response = $this->post("/delete-todo/".$insertId); //delete Todo
        $this->assertDatabaseMissing('todos',[
            'name'=> 'My second todo',
            'status' => 'pending'
        ]);
        $response->assertStatus(200);

    }
}
