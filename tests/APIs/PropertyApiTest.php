<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Property;

class PropertyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_property()
    {
        $property = factory(Property::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertApiResponse($property);
    }

    /**
     * @test
     */
    public function test_read_property()
    {
        $property = factory(Property::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/properties/'.$property->id
        );

        $this->assertApiResponse($property->toArray());
    }

    /**
     * @test
     */
    public function test_update_property()
    {
        $property = factory(Property::class)->create();
        $editedProperty = factory(Property::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/properties/'.$property->id,
            $editedProperty
        );

        $this->assertApiResponse($editedProperty);
    }

    /**
     * @test
     */
    public function test_delete_property()
    {
        $property = factory(Property::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/properties/'.$property->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/properties/'.$property->id
        );

        $this->response->assertStatus(404);
    }
}
