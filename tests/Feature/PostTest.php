<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class PostTest extends TestCase
{
    public function test_post_list()
    {
        $response = $this->getJson("/api/posts");
        $this->_test_ok($response);
    }

    public function test_post_create() : int
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $title  = "hola";
        $description = "adsasdasdasd";
        $visibility_id = 1;

        $name  = "avatar.png";
        $size = 500;
        $upload = UploadedFile::fake()->image($name)->size($size);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/posts", [
            "title" => $title,
            "description" => $description,
            "visibility_id" => $visibility_id,
            "upload" => $upload
        ]);

        $this->_test_ok($response, 201);
        $response->assertJsonStructure([
            'data' => [
                'author_id',
                'file_id',
                'title',
                'description',
                'visibility_id',
            ],
        ]);

        $json = $response->getData();
        return $json->data->id;
    }

    public function test_post_create_error()
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $title  = "";
        $description = "adsasdasdasd";
        $visibility_id = 1;
        
        $name  = "avatar.png";
        $size = 500;
        $upload = UploadedFile::fake()->image($name)->size($size);
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/posts", [
            "title" => $title,
            "description" => $description,
            "visibility_id" => $visibility_id,
            "upload" => $upload
        ]);
    
        $this->_test_error($response);
    }

    /**
     * @depends test_post_create
     */
    public function test_post_read(int $id)
    {
        $response = $this->getJson("/api/posts/{$id}");
        $this->_test_ok($response);
    }
   
    public function test_post_read_notfound()
    {
        $id = "not_exists";
        $response = $this->getJson("/api/posts/{$id}");
        $this->_test_notfound($response);
    }

    /**
     * @depends test_post_create
     */
    public function test_post_update(int $id)
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $title  = "Pruebitas";
        $description = "Alo";
        $visibility_id = 1;

        $name  = "photo.jpg";
        $size = 1000;
        $upload = UploadedFile::fake()->image($name)->size($size);
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/posts/{$id}", [
            "title" => $title,
            "description" => $description,
            "visibility_id" => $visibility_id,
            "upload" => $upload
        ]);

        $this->_test_ok($response);
        $response->assertJsonStructure([
            'data' => [
                'author_id',
                'file_id',
                'title',
                'description',
                'visibility_id',
            ],
        ]);
    }

    /**
     * @depends test_post_create
     */
    public function test_post_update_error(int $id)
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $title  = "";
        $description = "Alo";
        $visibility_id = 1;

        $name  = "photo.jpg";
        $size = 1000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/posts/{$id}", [
            "title" => $title,
            "description" => $description,
            "visibility_id" => $visibility_id,
            "upload" => $upload
        ]);
        // Check ERROR response
        $this->_test_error($response);
    }

    public function test_post_update_notfound()
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $id = "not_exists";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/posts/{$id}", []);
        $this->_test_notfound($response);
    }

    /**
     * @depends test_post_create
     */
    public function test_post_like(int $id)
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/posts/{$id}/likes");
        $this->_test_ok($response);
    }

    /**
     * @depends test_post_create
     */
    public function test_post_delete(int $id)
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson("/api/posts/{$id}");
        $this->_test_ok($response);
    }
 
 
    public function test_post_delete_notfound()
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $id = "not_exists";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson("/api/posts/{$id}");
        $this->_test_notfound($response);
    }

    protected function _test_ok($response, $status = 200)
    {
        // Check JSON response
        $response->assertStatus($status);
        // Check JSON properties
        $response->assertJson([
            "success" => true,
        ]);
        // Check JSON dynamic values
        $response->assertJsonPath("data",
            fn ($data) => is_array($data)
        );
    }
 
    protected function _test_error($response)
    {
        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors',
        ])->assertJson([
            'message' => true,
        ])->assertJsonMissing([
            'success' => true,
        ]);

        $response->assertJsonPath("message",
            fn ($message) => !empty($message) && is_string($message)
        );
        
        $response->assertJsonPath("errors",
            fn ($errors) => is_array($errors)
        );
    }
   
    protected function _test_notfound($response)
    {
        // Check JSON response
        $response->assertStatus(404);
        // Check JSON properties
        $response->assertJson([
            "success" => false,
            "message" => true // any value
        ]);
        // Check JSON dynamic values
        $response->assertJsonPath("message",
            fn ($message) => !empty($message) && is_string($message)
        );       
    } 
}