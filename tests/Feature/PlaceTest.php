<?php

namespace Tests\Feature;

use Illuminate\Foundation\esting\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Place;


class PlaceTest extends TestCase
{

    public function test_place_list()
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson("/api/places");
        $this->_test_ok($response);
    }


    public function test_place_create() : int
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $title  = "test";
        $latitude  = 41.38879;
        $longitude  = 2.15899;
        $descripcion  = "test test test";
        $visibility_id  = 1;
        $name  = "avatar.png";
        $size = 500;
        $upload = UploadedFile::fake()->image($name)->size($size);
        
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/places", [
            "title" => $title,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "descripcion" => $descripcion,
            "visibility_id" => $visibility_id,
            "upload" => $upload
        ]);
        
        $this->_test_ok($response, 201);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'title',
                'latitude',
                'longitude',
                'descripcion',
                'author_id',
                'visibility_id',
            ]
        ]);

        $json = $response->getData();
        return $json->data->id;
    }
    public function test_place_create_error()
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $title  = "test";
        $latitude  = 41.1122;
        $longitude  = 2.15899;
        $descripcion  = "";
        $visibility_id  = 1;
        $name  = "avatar.png";
        $size = 500; 
        $upload = UploadedFile::fake()->image($name)->size($size);
        
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/places", [
            "title" => $title,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "descripcion" => $descripcion,
            "visibility_id" => $visibility_id,
            "upload" => $upload
        ]);
    
        $this->_test_error($response);
    }
    

    /**
     * @depends test_place_create
     */
    public function test_place_read(int $id)
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson("/api/places/{$id}");
        $this->_test_ok($response);
    }
    public function test_place_read_notfound()
    {
        $id = "not_exists";
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson("/api/places/{$id}");
        $this->_test_notfound($response);
    }


    /**
     * @depends test_place_create
     */
    public function test_place_update(int $id)
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $newTitle = "Updated Title 2";
        $newDescription = "Updated description";
        $newLatitude = 42.12345;
        $newLongitude = 3.98765;
        $newVisibility = 2;

        $name  = "photo.jpg";
        $size = 1000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->putJson("/api/places/{$id}", [
            "title" => $newTitle,
            "latitude" => $newLatitude,
            "longitude" => $newLongitude,
            "descripcion" => $newDescription,
            "visibility_id" => $newVisibility,
            "upload" => $upload
        ]);
    
        // Verificar una respuesta exitosa
        $this->_test_ok($response);
        $response->assertJsonStructure([
            'data' => [
                'title',
                'latitude',
                'longitude',
                'descripcion',
                "visibility_id",
            ],
        ]);
    }
    /**
     * @depends test_place_create
     */
    public function test_place_update_error(int $id)
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $newTitle = "Updated Titlewwwwwwwwwwwwwwwwwww 2";
        $newDescription = "Updated description";
        $newLatitude = 42.12345;
        $newLongitude = 3.98765;
        $newVisibility = 2;
        $name  = "photo.jpg";
        $size = 30000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
    
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->putJson("/api/places/{$id}", [
            "title" => $newTitle,
            "latitude" => $newLatitude,
            "longitude" => $newLongitude,
            "descripcion" => $newDescription,
            "visibility_id" => $newVisibility,
            "upload" => $upload
        ]);
    
        $this->_test_error($response);
    }
    public function test_place_update_notfound()
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $nonExistentId = 9999; 
        $newTitle = "Updated Title";
        $newDescription = "Updated description";
        $newLatitude = 42.12345;
        $newLongitude = 3.98765;
        $newVisibility = 2;
        $name = "photo.jpg";
        $size = 1000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
    
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->putJson("/api/places/{$nonExistentId}", [
            "title" => $newTitle,
            "latitude" => $newLatitude,
            "longitude" => $newLongitude,
            "descripcion" => $newDescription,
            "visibility_id" => $newVisibility,
            "upload" => $upload
        ]);
    
        $response->assertStatus(404);
    }

    /**
     * @depends test_place_create
     */
    public function test_place_favorite(int $id)
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/places/{$id}/favorite");
        $this->_test_ok($response);
        $response->assertJson(['data' => ['Lugar marcado como favorito.']]);
    }
    public function test_place_favorite_not_found()
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson("/api/places/UNEXIST/favorite");
        $response->assertJson(['error' => 'Lugar no encontrado.']);
        $response->assertStatus(404);
    }


    /**
     * @depends test_place_create
     */
    public function test_place_unfavorite(int $id)
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson("/api/places/{$id}/unfavorite");
        $this->_test_ok($response);
    }
    public function test_place_unfavorite_not_found()
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson("/api/places/UNEXIST/unfavorite");
        $response->assertJson(['error' => 'Lugar no encontrado.']);
        $response->assertStatus(404);
    }


    /**
     * @depends test_place_create
     */
    public function test_place_delete(int $id)
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson("/api/places/{$id}");
        $this->_test_ok($response);
        $this->assertDatabaseMissing('places', ['id' => $id]);
        $this->get("/api/places/{$id}")->assertStatus(404);
    }
    public function test_place_delete_notfound()
    {
        $token = "4|cK6771fJcPA78RlGhbI1AzrCU6XAQNqjR187pphIa44ec3dc";
        $nonExistentId = 9999;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson("/api/places/{$nonExistentId}");
        $response->assertStatus(404);
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
        $response->assertStatus(422)->assertJsonStructure([
           'message',
           'errors',
        ])
        ->assertJson([
           'message' => true,
        ])
        ->assertJsonMissing([
           'success' => true,
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
            fn ($message) => !empty($message) && is_string($message)
        );       
    } 
}