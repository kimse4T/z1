<?php namespace Tests\Repositories;

use App\Models\Property;
use App\Repositories\PropertyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PropertyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PropertyRepository
     */
    protected $propertyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->propertyRepo = \App::make(PropertyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_property()
    {
        $property = factory(Property::class)->make()->toArray();

        $createdProperty = $this->propertyRepo->create($property);

        $createdProperty = $createdProperty->toArray();
        $this->assertArrayHasKey('id', $createdProperty);
        $this->assertNotNull($createdProperty['id'], 'Created Property must have id specified');
        $this->assertNotNull(Property::find($createdProperty['id']), 'Property with given id must be in DB');
        $this->assertModelData($property, $createdProperty);
    }

    /**
     * @test read
     */
    public function test_read_property()
    {
        $property = factory(Property::class)->create();

        $dbProperty = $this->propertyRepo->find($property->id);

        $dbProperty = $dbProperty->toArray();
        $this->assertModelData($property->toArray(), $dbProperty);
    }

    /**
     * @test update
     */
    public function test_update_property()
    {
        $property = factory(Property::class)->create();
        $fakeProperty = factory(Property::class)->make()->toArray();

        $updatedProperty = $this->propertyRepo->update($fakeProperty, $property->id);

        $this->assertModelData($fakeProperty, $updatedProperty->toArray());
        $dbProperty = $this->propertyRepo->find($property->id);
        $this->assertModelData($fakeProperty, $dbProperty->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_property()
    {
        $property = factory(Property::class)->create();

        $resp = $this->propertyRepo->delete($property->id);

        $this->assertTrue($resp);
        $this->assertNull(Property::find($property->id), 'Property should not exist in DB');
    }
}
