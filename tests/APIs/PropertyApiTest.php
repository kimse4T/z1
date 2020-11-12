<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Property;
use App\PropertyTitleDeed;
use App\Unit;
use App\User;

class PropertyApiTest extends TestCase
{
    use ApiTestTrait;


    public function setUp():void
    {
        parent::setUp();

        //use as user that has login for access all api route
        //can use without withHeader('Authorization',$this->token)
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
    }

     /**
     * @test
     */
    public function test_read_property()
    {
        $property = factory(Property::class)->create();

        // dd($property);

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

        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertApiResponse($property);
    }

    /** @test */
    public function can_not_create_property_with_invalid_address()
    {
        $property = factory(Property::class)->make([
            'address'   =>  null,
        ])->toArray();

        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["address"]);
    }

    /**
     * @test
     */
    public function can_not_create_property_with_invalid_title_deed_type()
    {
        $property = factory(Property::class)->make()->toArray();

        $titledeed=factory(PropertyTitleDeed::class)->make(['title_deed_type'=>123])->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["title_deed_type"]);
    }

    /**
     * @test
     */
    public function can_not_create_property_with_land_width_notNumber()
    {
        $property = factory(Property::class)->make([
            'land_width' => "ABC"
        ])->toArray();

        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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

        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["land_length"]);
    }

    /** @test */
    public function can_not_create_property_with_null_title_deed_type()
    {
        $property = factory(Property::class)->make()->toArray();

        $titledeed=factory(PropertyTitleDeed::class)->make(['title_deed_type'=>null])->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["title_deed_type"]);
    }

    /** @test */
    public function can_not_create_property_with_notString_title_deed_type()
    {
        $property = factory(Property::class)->make()->toArray();

        $titledeed=factory(PropertyTitleDeed::class)->make(['title_deed_type'=>123])->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["title_deed_type"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_title_deed_no()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make([
            'title_deed_no' => "ten"
        ])->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["title_deed_no"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_issued_year()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make([
            'issued_year' => "ABC"
        ])->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["issued_year"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_parcel_no()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make([
            'parcel_no' => "Ten"
        ])->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["parcel_no"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_total_size_by_title_deed()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make([
            'total_size_by_title_deed' => "Ten"
        ])->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["total_size_by_title_deed"]);
    }

    /** @test */
    public function can_not_create_property_with_notString_unit_name()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_name' =>  123
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_name"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_width()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_width' =>  "ten"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_width"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_length()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_length' =>  "twenty"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_length"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_total_size()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_total_size' =>  "two hundred"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_total_size"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_gross_floor_area()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_gross_floor_area' =>  "one"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_gross_floor_area"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_bedroom()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_bedroom' =>  "three"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_bedroom"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_bathroom()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_bathroom' =>  "four"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_bathroom"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_livingroom()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_livingroom' =>  "one"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_livingroom"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_floor()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_floor' =>  "two"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_floor"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_storey()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_storey' =>  "one"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_storey"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_car_parking()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_car_parking' =>  "four"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_car_parking"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_motor_parking()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_motor_parking' =>  "one"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_motor_parking"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_cost_estimates()
    {
        $property = factory(Property::class)->make()->toArray();
        // $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_cost_estimates' =>  "forty"
        ])->toArray();

        $property = array_merge($property,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_cost_estimates"]);
    }

     /** @test */
     public function can_not_create_property_with_notNumber_unit_useful_life()
     {
         $property = factory(Property::class)->make()->toArray();
         $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

         $unit=factory(Unit::class)->make([
             'unit_usefull_life' =>  "one hundred"
         ])->toArray();

         $property = array_merge($property,$unit,$titledeed);

         $this->response = $this->json(
             'POST',
             '/api/properties', $property
         );

         $this->assertErrorValidation(["unit_usefull_life"]);
     }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_effective_age()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_effective_age' =>  "ninety nine"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_effective_age"]);
    }

    /** @test */
    public function can_not_create_property_with_notNumber_unit_completion_year()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make([
            'unit_completion_year' =>  "fifty"
        ])->toArray();

        $property = array_merge($property,$titledeed,$unit);

        $this->response = $this->json(
            'POST',
            '/api/properties', $property
        );

        $this->assertErrorValidation(["unit_completion_year"]);
    }


    /**
     * @test
     */
    public function can_not_create_property_with_sale_price_asking_notNumber()
    {
        $property = factory(Property::class)->make([
            'sale_price_asking' => "ABC"
        ])->toArray();
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        $titledeed=factory(PropertyTitleDeed::class)->make()->toArray();

        $unit=factory(Unit::class)->make()->toArray();

        $property = array_merge($property,$titledeed,$unit);

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
        // $property = factory(Property::class)->create();
        // $titledeed= factory(PropertyTitleDeed::class)->create(['property_id'=>$property->id]);
        $unit = factory(Unit::class)->states('single')->make(['property_id'=>1]);
        dd($unit);

        $editedProperty = factory(Property::class)->make();
        $edittitleDeed = factory(PropertyTitleDeed::class)->make([
            'property_id'=>$editedProperty->id,
        ]);
        $editunit = factory(Unit::class)->make([
            'property_id'=>$editedProperty->id,
        ]);

        $editedProperty = array_merge($editedProperty->toArray(),$edittitleDeed->toArray(),$editunit->toArray());

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
