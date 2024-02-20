<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_comments_list()
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $id = 180;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson("/api/posts/{$id}/comments");
        $this->_test_ok($response);
    }

    public function test_comment_create() : int
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $comment = "Comentario siumba";
        $id = 180;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/posts/{$id}/comments", [
            "comment" => $comment,
        ]);
        $this->_test_ok($response, 201);
        $response->assertJsonPath("data.comment", $comment);
        $json = $response->getData();
        return $json->data->id;
    }

    public function test_comment_create_error()
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $comment = "";
        $id = 180;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/posts/{$id}/comments", [
            "comment" => $comment
        ]);
        $this->_test_error($response);
    }

    public function test_comment_create_post_not_found()
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $comment = "Comentario siumba";
        $id = "ads";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/posts/{$id}/comments", [
            "comment" => $comment
        ]);
        $this->_test_notfound($response);
    }

    /**
    * @depends test_comment_create
    */
    public function test_comment_delete(int $commentId)
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $id = 180;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson("/api/posts/{$id}/comments/{$commentId}");
        $this->_test_ok($response, 200);
    }

    /**
    * @depends test_comment_create
    */
    public function test_comment_delete_post_not_found(int $commentId)
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $id = "asd";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson("/api/posts/{$id}/comments/{$commentId}");
        $this->_test_notfound($response, 200);
    }

    public function test_comment_delete_comment_not_found()
    {
        $token = "85|kfv77x5c3MyGlmK3BVn6iStTdzHDI48EPuV1XFqO419cd3a5";
        $id = 180;
        $commentId = "asd";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson("/api/posts/{$id}/comments/{$commentId}");
        $this->_test_notfound($response, 200);
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
