<?php

namespace Tests\Feature\ControllerTest;

use App\Models\Property;
use App\Unit;
use App\PropertyTitleDeed;
use Tests\TestCase;
use Tests\Traits\ControllerTestTrait;

class PropertyTest extends TestCase
{
    use ControllerTestTrait;

    private $email = 'dev@dev.com';
    private $password = '123456789';
    private $entity = 'property';
    private $model = Property::class;

    private $other_table_as_array = Unit::class;
    private $other_table_as_json = PropertyTitleDeed::class;
    private $jsonFieldName = 'propertyTitleDeedRepeatable';
    private $arrayIdField = 'unit_id';

    private $not_null_fields = ['address'];

}
