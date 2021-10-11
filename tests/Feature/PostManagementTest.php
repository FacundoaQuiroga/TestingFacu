<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function list_of_posts_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        Post::factory()->count(3)->create(); //datos de prueba

        $response = $this->get('/posts'); //llamo a la ruta

        $response->assertOk();

        $posts = Post::all();

        $response->assertViewIs('posts.index');
        $response->assertViewHas('posts', $posts);
    }

    /** @test */
    public function a_post_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create(); //datos de prueba

        $response = $this->get('/posts/' . $post->id); //llamo a la ruta

        $response->assertOk();

        $post = Post::first();

        $response->assertViewIs('posts.show');
        $response->assertViewHas('post', $post);
    }


    /** @test */
    public function a_post_can_be_created()
    {

        $this->withoutExceptionHandling();

        $response = $this->post('/posts', [
            'title' => 'Test Title',
            'content' => 'Test Content'
        ]);

        
        $this->assertCount(1, Post::all());

        $post = Post::first();

        $this->assertEquals($post->title, 'Test Title');
        $this->assertEquals($post->content, 'Test Content');

        $response->assertRedirect('/posts/' . $post->id);
    }

    /** @test */
    public function post_title_is_required()
    {
        //$this->withoutExceptionHandling();

        $response = $this->post('/posts', [
            'title' => '',
            'content' => 'Test Content'
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function post_content_is_required()
    {
        //$this->withoutExceptionHandling();

        $response = $this->post('/posts', [
            'title' => 'Test Title',
            'content' => ''
        ]);

        $response->assertSessionHasErrors(['content']);
    }


    /** @test */
    public function a_post_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create(); //datos de prueba

        $response = $this->put('/posts/' . $post->id, [
            'title' => 'Test Title',
            'content' => 'Test Content'
        ]);

        
        $this->assertCount(1, Post::all());

        $post = $post->fresh();

        $this->assertEquals($post->title, 'Test Title');
        $this->assertEquals($post->content, 'Test Content');

        $response->assertRedirect('/posts/' . $post->id);
    }

    /** @test */
    public function a_post_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create(); //datos de prueba

        $response = $this->delete('/posts/' . $post->id);

        $this->assertCount(0, Post::all());

        $response->assertRedirect('/posts/');
    }

}
