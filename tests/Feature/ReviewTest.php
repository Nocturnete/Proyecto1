<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    private static $token = "5|Q3lC9NaluhSGznHqwsrzwecHeB6STKRNplM9ZS8Vfaf2be98";

    public function test_reviews_list()
    {
        $id = 244;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . self::$token])->getJson("/api/places/{$id}/reviews");
        $this->_test_ok($response);
    }

    public function test_review_create() : int
    {
        $placeId = 1;
        $review = "Review suuuuuu";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . self::$token])->postJson("/api/places/{$placeId}/reviews", [
            "review" => $review,
        ]);
        $this->_test_ok($response, 201);
        $response->assertJsonPath("data.review", $review);
        $json = $response->getData();
        return $json->data->id;
    }
    public function test_review_create_notfound()
    {
        $review = "Review suuuuuu";
        $place = "999";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . self::$token])->postJson("/api/places/{$place}/reviews", [
            "review" => $review
        ]);
        $this->_test_notfound($response);
    }
    public function test_review_create_unauthorized()
    {
        $placeId = 1;
        $review = "Review review review";
        $response = $this->postJson("/api/places/{$placeId}/reviews", [
            "review" => $review,
        ]);
        $response->assertStatus(401); 
    }
    public function test_review_create_noitems()
    {
        $placeId = 1;
        $review = "";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . self::$token])->postJson("/api/places/{$placeId}/reviews", [
            "review" => $review,
        ]);
        $this->_test_error($response);
    }


    /**
     * @depends test_review_create
     */
    public function test_review_delete(int $review_id)
    {
        $placeId = 1;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . self::$token])->deleteJson("/api/places/{$placeId}/reviews" . "/" . $review_id);
        $this->_test_ok($response);
    }
    public function test_review_delete_notfound()
    {
        $placeId = 1;
        $review_id = "99999";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . self::$token,])->deleteJson("/api/places/{$placeId}/reviews" . "/" . $review_id);
        $this->_test_notfound($response);
    }
    /**
     * @depends test_review_create
     */
    public function test_review_delete_unauthorized(int $review_id)
    {
        $placeId = 1;
        $response = $this->deleteJson("/api/places/{$placeId}/reviews" . "/" . $review_id);
        $response->assertStatus(401); 
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
    // Check response
    $response->assertStatus(422);
    // Check validation errors
    $response->assertInvalid(["review"]);
    // Check JSON properties
    $response->assertJson([
        "message" => true, // any value
        "errors"  => true, // any value
    ]);       
    // Check JSON dynamic values
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
            fn ($message) => !empty($message) && is_string($message));       
    }
}
