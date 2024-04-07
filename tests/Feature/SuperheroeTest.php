<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Superhero;

class SuperheroeTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Authorization' =>  env('TOKEN'),
            'Accept' => 'application/json'
        ]);
    }


    public function test_unauthorizaded(): void
    {
        $this->withHeaders([
            'Authorization' =>  '',
            'Accept' => 'application/json'
        ]);

        $response = $this->get('/superheroes/all');
        $response->assertStatus(401);
    }


    public function test_status_ok_with_authorization(): void
    {
        $response = $this->get('/superheroes/all');
        $response->assertStatus(200);
    }

    public function test_response_contain_status(): void
    {
        $response = $this->get('/superheroes/all');
        $response->assertSee(value: 'status');
        $response->assertStatus(200);
    }


    public function test_response_contain_validations_errors(): void
    {
        $response = $this->getJson('/superheroes/all?strengthTo=aa&sortBy=adad&sortOrder=ddd&pagination=5');
        $response->assertJson(['response' => [
            "The strength to field must be an integer.",
            "the sortBy parameter must by one of this options 'name','fullName','strength','speed','durability','power','combat','race','height/0','height/1','weight/0','weight/1','eyeColor','hairColor','publisher'",
            "the sortOrder parameter must by 'asc' or 'desc' value"
        ]]);
        $response->assertStatus(400);
    }


    public function test_response_contain_data_generate_by_factory(): void
    {
        $supeheroes = Superhero::factory()->create();
        $response = $this->getJson('/superheroes/all?sortBy=id&sortOrder=desc&pagination=5');
        $response->assertJson(['response' => ['data' => [$supeheroes->toArray()]]]);
        $response->assertStatus(200);
    }
}
