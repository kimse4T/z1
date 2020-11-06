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
    }

    /** @test */
    public function update_property()
    {
        $property = $this->createProperty();
        $id = Property::latest()->first()->id;
        $unit_id=[Unit::latest()->first()->id];
        $titledeed_id = PropertyTitleDeed::latest()->first()->id;

        $property = factory(Property::class)->make()->toArray();
        $titledeed = factory(PropertyTitleDeed::class)->make();
        $unit = factory(Unit::class)->make()->toArray();

        $titledeed = $titledeed->toArray();
        $titledeed['id'] = $titledeed_id;
        $titledeed['title_deed_image']=null;

        $titledeed = json_encode([$titledeed]);
        $property['propertyTitleDeedRepeatable']=$titledeed;
        $property = array_merge($property,$unit);

        $property['id']=$id;
        $property['unit_id']=$unit_id;

        $this->response = $this->put('/admin/property/'.$id,$property);

        $this->response->assertStatus(302);
    }

    /** @test */
    public function delete_property()
    {
        $property = $this->createProperty();
        $id = Property::latest()->first()->id;

        $this->response = $this->delete('/admin/property/'.$id);

        $this->response->assertStatus(200);
    }

    public function createProperty()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed = factory(PropertyTitleDeed::class)->make();
        $unit = factory(Unit::class)->make()->toArray();

        $titledeed = json_encode([$titledeed->toArray()]);
        $property['propertyTitleDeedRepeatable']=$titledeed;
        $property = array_merge($property,$unit);

        return $this->post('/admin/property',$property);
    }
}
