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
    public function test_read_property()
    {
        $property = factory(Property::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/properties/'.$property->id
        );

        $this->assertApiResponse($property->toArray());
    }

    /** @test */

    public function get_all_property()
    {
        $this->response = $this->json(
            'GET','/api/properties'
        )

        ->assertStatus(200);
    }


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
    public function can_not_create_property_with_invalid_address()
    {
        $property = factory(Property::class)->make([
            'address'   =>  null,
        ])->toArray();


        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["address"]);
    }

    /**
     * @test
     */
    public function can_not_create_property_with_land_width_notNumber()
    {
        $property = factory(Property::class)->make([
            'land_width' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["land_width"]);
    }

    /**
     * @test
     */
    public function can_not_create_property_with_land_length_notNumber()
    {
        $property = factory(Property::class)->make([
            'land_length' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["land_length"]);
    }

    /** @test */
    public function can_not_create_property_with_null_title_deed_type()
    {
        $property = factory(Property::class)->make([
            'title_deed_type' => null
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["title_deed_type"]);
    }

    /** @test */
    public function can_not_create_property_with_notString_title_deed_type()
    {
        $property = factory(Property::class)->make([
            'title_deed_type' => 1234
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["title_deed_type"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_title_deed_no()
    {
        $property = factory(Property::class)->make([
            'title_deed_no' => "ten"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["title_deed_no"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_issued_year()
    {
        $property = factory(Property::class)->make([
            'issued_year' => 1234
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["issued_year"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_parcel_no()
    {
        $property = factory(Property::class)->make([
            'parcel_no' => "Ten"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["parcel_no"]);
    }






    /**
     * @test
     */
    public function can_not_create_property_with_sale_price_asking_notNumber()
    {
        $property = factory(Property::class)->make([
            'sale_price_asking' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["sale_price_asking"]);
    }

    /**
     * @test
     */
    public function can_not_create_property_with_sale_price_asking_per_sqm_notNumber()
    {
        $property = factory(Property::class)->make([
            'sale_price_asking_per_sqm' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["sale_price_asking_per_sqm"]);
    }

    /** @test */
    public function can_not_create_property_with_sale_price_notNumber()
    {
        $property = factory(Property::class)->make([
            'sale_price' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["sale_price"]);
    }

    /** @test */
    public function can_not_create_property_with_sale_price_per_sqm_notNumber()
    {
        $property = factory(Property::class)->make([
            'sale_price_per_sqm' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["sale_price_per_sqm"]);
    }

    /** @test */
    public function can_not_create_property_with_sale_list_price_notNumber()
    {
        $property = factory(Property::class)->make([
            'sale_list_price' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["sale_list_price"]);
    }

    /** @test */
    public function can_not_create_property_with_sale_list_price_per_sqm_notNumber()
    {
        $property = factory(Property::class)->make([
            'sale_list_price_per_sqm' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["sale_list_price_per_sqm"]);
    }

    /** @test */
    public function can_not_create_property_with_sold_price_notNumber()
    {
        $property = factory(Property::class)->make([
            'sold_price' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["sold_price"]);
    }

    /** @test */
    public function can_not_create_property_with_sold_price_per_sqm_notNumber()
    {
        $property = factory(Property::class)->make([
            'sold_price_per_sqm' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["sold_price_per_sqm"]);
    }


    /** @test */
    public function can_not_create_property_with_sale_commission_notNumber()
    {
        $property = factory(Property::class)->make([
            'sale_commission' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["sale_commission"]);
    }

    /** @test */
    public function can_not_create_property_with_rent_price_asking_notNumber()
    {
        $property = factory(Property::class)->make([
            'rent_price_asking' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["rent_price_asking"]);
    }

    /** @test */
    public function can_not_create_property_with_rent_price_asking_per_sqm_notNumber()
    {
        $property = factory(Property::class)->make([
            'rent_price_asking_per_sqm' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["rent_price_asking_per_sqm"]);
    }

    /** @test */
    public function can_not_create_property_with_rent_price_notNumber()
    {
        $property = factory(Property::class)->make([
            'rent_price' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["rent_price"]);
    }

    /** @test */
    public function can_not_create_property_with_rent_price_per_sqm_notNumber()
    {
        $property = factory(Property::class)->make([
            'rent_price_per_sqm' => "ABC"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["rent_price_per_sqm"]);
    }

    /** @test */
    public function can_not_create_property_with_rent_list_price_notNumber()
    {
        $property = factory(Property::class)->make([
            'rent_list_price' => "twenty"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["rent_list_price"]);
    }

    /** @test */
    public function can_not_create_property_with_rent_list_price_per_sqm_notNumber()
    {
        $property = factory(Property::class)->make([
            'rent_list_price_per_sqm' => "twenty"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["rent_list_price_per_sqm"]);
    }

    /** @test */
    public function can_not_create_property_with_rented_price_notNumber()
    {
        $property = factory(Property::class)->make([
            'rented_price' => "ten"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["rented_price"]);
    }

    /** @test */
    public function can_not_create_property_with_rented_price_per_sqm_notNumber()
    {
        $property = factory(Property::class)->make([
            'rented_price_per_sqm' => "fifty five"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["rented_price_per_sqm"]);
    }

    /** @test */
    public function can_not_create_property_with_rental_commission_notNumber()
    {
        $property = factory(Property::class)->make([
            'rental_cmmission' => "six hundred"
        ])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["rental_cmmission"]);
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
