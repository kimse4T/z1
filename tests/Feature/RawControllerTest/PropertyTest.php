<?php

namespace Tests\Feature\RawControllerTest;

use App\Models\Property;
use App\Unit;
use App\PropertyTitleDeed;
use Tests\TestCase;
use Tests\Traits\RawControllerTestTrait;

class PropertyTest extends TestCase
{
    use RawControllerTestTrait;

    /** @test */
    public function list_property()
    {
        $this->response = $this->get('/admin/property');

        $this->response->assertStatus(200);
    }

    /** @test */
    public function show_property()
    {
        $property = Property::latest()->first();

        $this->response = $this->get('/admin/property/'.$property->id.'/show');

        $this->response->assertStatus(200);
    }

    /** @test */
    public function create_property()
    {
        $this->response = $this->createProperty();

        $this->response->assertStatus(302);

        $this->response->assertRedirect('/admin/property');
    }

    /** @test */
    public function can_not_create_property_with_null_address()
    {
        $this->response = $this->createProperty(['address' => null]);

        $this->response->assertSessionHasErrors('address');
    }

    /** @test */
    public function can_not_create_with_null_title_deed_type_when_request_indication()
    {
        $this->response = $this->createProperty(['is_appraisal' => true],['title_deed_type' => ""]);

        $this->response->assertSessionHasErrors('title_deed_type');
    }

    /** @test */
    public function can_not_create_with_null_building_name_when_request_indication()
    {
        $this->response = $this->createProperty(['is_appraisal' => true],[],['unit_name'=>[null]]);

        $this->response->assertSessionHasErrors('unit_name');
    }

    /** @test */
    public function can_not_create_with_null_unit_gross_floor_area_when_request_indication()
    {
        $this->response = $this->createProperty(['is_appraisal' => true],[],['unit_gross_floor_area'=>[null]]);

        $this->response->assertSessionHasErrors('unit_gross_floor_area');
    }

    /** @test */
    public function can_not_create_with_null_unit_floor_when_request_indication()
    {
        $this->response = $this->createProperty(['is_appraisal' => true],[],['unit_floor'=>[null]]);

        $this->response->assertSessionHasErrors('unit_floor');
    }

    /** @test */
    public function can_not_create_with_null_unit_storey_when_request_indication()
    {
        $this->response = $this->createProperty(['is_appraisal' => true],[],['unit_storey'=>[null]]);

        $this->response->assertSessionHasErrors('unit_storey');
    }

    /** @test */
    public function can_not_create_with_null_unit_completion_year_when_request_indication()
    {
        $this->response = $this->createProperty(['is_appraisal' => true],[],['unit_completion_year'=>[null]]);

        $this->response->assertSessionHasErrors('unit_completion_year');
    }

    /** @test */
    public function update_property()
    {
        $this->updateProperty();

        $this->response->assertStatus(302);
    }

    /** @test */
    public function can_not_update_property_with_null_address()
    {
        $this->updateProperty(['address' => null]);

        $this->response->assertSessionHasErrors('address');
    }

    /** @test */
    public function can_not_update_with_null_title_deed_type_when_request_indication()
    {
        $this->updateProperty(['is_appraisal' => true],['title_deed_type' => ""]);

        $this->response->assertSessionHasErrors('title_deed_type');
    }

    /** @test */
    public function can_not_update_with_null_building_name_when_request_indication()
    {
        $this->updateProperty(['is_appraisal' => true],[],['unit_name'=>[null]]);

        $this->response->assertSessionHasErrors('unit_name');
    }

    /** @test */
    public function can_not_update_with_null_unit_gross_floor_area_when_request_indication()
    {
        $this->updateProperty(['is_appraisal' => true],[],['unit_gross_floor_area'=>[null]]);

        $this->response->assertSessionHasErrors('unit_gross_floor_area');
    }

    /** @test */
    public function can_not_update_with_null_unit_floor_when_request_indication()
    {
        $this->updateProperty(['is_appraisal' => true],[],['unit_floor'=>[null]]);

        $this->response->assertSessionHasErrors('unit_floor');
    }

    /** @test */
    public function can_not_update_with_null_unit_storey_when_request_indication()
    {
        $this->updateProperty(['is_appraisal' => true],[],['unit_storey'=>[null]]);

        $this->response->assertSessionHasErrors('unit_storey');
    }

    /** @test */
    public function can_not_update_with_null_unit_completion_year_when_request_indication()
    {
        $this->updateProperty(['is_appraisal' => true],[],['unit_completion_year'=>[null]]);

        $this->response->assertSessionHasErrors('unit_completion_year');
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

        return $this->post('/admin/property',$property);
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
