<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class ArticlesTest extends TestCase
{
    //make sure you disable middleware for jwt authentication in articles controller

    public function test_index()
    {
      $this->json('get', '/articles')
        ->seeJson([
          'per_page' => 2,
          'current_page' => 1
        ]);
    }

    public function test_create_invalid_data()
    {
      $this->call('post', '/auth/login', ['email'=>'dwikunto@geeksfarm.com', 'password'=>'12345678']);
      $this->json('post', '/articles', ['title'=>'', 'content'=>''])
        ->seeJson([
          'title' => ['The title field is required.'],
          'content' => ['The content field is required.'] 
        ]);
    }

    public function test_create_valid_data()
    {
      $this->call('post', '/auth/login', ['email'=>'dwikunto@geeksfarm.com', 'password'=>'12345678']);
      $this->json('post', '/articles', ['title'=>'data from test file', 'content'=>'lorem ipsum dolor c amet'])
        ->seeJson([
          'status' => 'success create data'
        ]);
    }

    public function test_show_blank_data()
    {
      $this->json('get', '/articles/qwerty')
        ->seeJson([
          'info' => 'article not found'
        ]);
    }

    public function test_show_present_data()
    {
      $this->json('get', '/articles/1')
        ->seeJson([
          'id' => 1
        ]);
    }

    public function test_update_invalid_data()
    {
      $this->json('put', '/articles/1', ['title'=>''])
        ->seeJson([
          'title' => ['The title field is required.'],
          'content' => ['The content field is required.']
        ]);
    }

    public function test_update_valid_data()
    {
      $this->json('patch', '/articles/1', ['title'=>'ok mamen', 'content'=>'lorem ipsum'])
        ->seeJson([
          'status' => 'success update article'
        ]);
    }

    public function test_destroy_blank_data()
    {
      $this->json('delete', '/articles/qwerty')
        ->seeJson([
          'status' => 'article not found'
        ]);
    }

    public function test_destroy_present_data()
    {
      $this->json('delete', '/articles/1')
        ->seeJson([
          'status' => 'success delete article'
        ]);
    }
}
