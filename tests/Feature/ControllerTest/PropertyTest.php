<?php

namespace Tests\Feature\ControllerTest;

use App\Models\Property;
use App\Unit;
use App\PropertyTitleDeed;
use Tests\TestCase;
use Tests\Traits\TestTrait;

class PropertyTest extends TestCase
{
    use TestTrait;

    // Admin User
    private $email = "dev@dev.com";
    private $password = "123456789";

    //Table
    private $table = "properties";

    public function setUp():void
    {
        parent::setUp();
        $this->loginAsDev();
    }

    /** @test */
    public function list_property()
    {
        $this->response = $this->get('/admin/property');
        $this->assertViewList('crud::list');
    }

    /** @test */
    public function show_property()
    {
        $property = Property::latest()->first();

        $this->response = $this->get('/admin/property/'.$property->id.'/show');
        $this->assertViewShow('properties.show');
    }

    /** @test */
    public function create_property()
    {
        $this->createProperty();

        $this->response->assertStatus(302);
        $this->response->assertRedirect('/admin/property');
    }

    /** @test */
    public function can_not_create_with_null_fields_when_request_indication()
    {
        $this->createProperty(['is_appraisal' => true,'address' => null],
                                                ['title_deed_type' => ""],
                                                ['unit_name'=>[null],
                                                 'unit_gross_floor_area'=>[null],
                                                 'unit_floor'=>[null],
                                                 'unit_storey'=>[null],
                                                 'unit_completion_year'=>[null]
                                                ]);

        $this->assertErrorValidation(['address',
                                      'title_deed_type',
                                      'unit_name',
                                      'unit_gross_floor_area',
                                      'unit_floor',
                                      'unit_storey',
                                      'unit_completion_year'
                                    ]);
    }

    /** @test */
    public function update_property()
    {
        $this->updateProperty();
        $this->assertSuccessUpdate();
    }

    /** @test */
    public function can_not_update_with_null_fields_when_request_indication()
    {
        $this->updateProperty(['is_appraisal' => true,'address' => null],
                                                ['title_deed_type' => ""],
                                                ['unit_name'=>[null],
                                                 'unit_gross_floor_area'=>[null],
                                                 'unit_floor'=>[null],
                                                 'unit_storey'=>[null],
                                                 'unit_completion_year'=>[null]
                                                ]);

        $this->assertErrorValidation(['address',
                                      'title_deed_type',
                                      'unit_name',
                                      'unit_gross_floor_area',
                                      'unit_floor',
                                      'unit_storey',
                                      'unit_completion_year'
                                    ]);
    }

    /** @test */
    public function delete_property()
    {
        $property = $this->createProperty();
        $id = Property::latest()->first()->id;

        $this->response = $this->delete('/admin/property/'.$id);
        $this->response->assertStatus(200);
    }

    public function createProperty($property_field = null,$title_deed_fields = null,$unit_fields = null)
    {
        if($title_deed_fields == null){
            $title_deed_fields = [];
        }
        if($property_field == null){
            $property_field = [];
        }
        if($unit_fields == null){
            $unit_fields = [];
        }

        $property = factory(Property::class)->make($property_field)->toArray();
        $titledeed = factory(PropertyTitleDeed::class)->make($title_deed_fields);
        $unit = factory(Unit::class)->make($unit_fields)->toArray();

        $titledeed = json_encode([$titledeed->toArray()]);
        $property['propertyTitleDeedRepeatable']=$titledeed;
        $property = array_merge($property,$unit);

        $this->response = $this->post('/admin/property',$property);
    }

    public function updateProperty($property_field = null,$title_deed_fields = null,$unit_fields = null)
    {
        if($title_deed_fields == null)
        {
            $title_deed_fields = [];
        }
        if($property_field == null){
            $property_field = [];
        }
        if($unit_fields == null){
            $unit_fields = [];
        }

        $property = $this->createProperty();
        $id = Property::latest()->first()->id;
        $unit_id=[Unit::latest()->first()->id];
        $titledeed_id = PropertyTitleDeed::latest()->first()->id;

        $property = factory(Property::class)->make($property_field)->toArray();
        $titledeed = factory(PropertyTitleDeed::class)->make($title_deed_fields);
        $unit = factory(Unit::class)->make($unit_fields)->toArray();

        $titledeed = $titledeed->toArray();
        $titledeed['id'] = $titledeed_id;
        $titledeed['title_deed_image']=null;

        $titledeed = json_encode([$titledeed]);
        $property['propertyTitleDeedRepeatable']=$titledeed;
        $property = array_merge($property,$unit);

        $property['id']=$id;
        $property['unit_id']=$unit_id;

        $this->response = $this->put('/admin/property/'.$id,$property);
    }
}
