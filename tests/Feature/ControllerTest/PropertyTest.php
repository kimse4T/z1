<?php

namespace Tests\Feature\ControllerTest;

use App\Models\Property;
use Tests\TestCase;
use Tests\Traits\ControllerTestTrait;

class PropertyTest extends TestCase
{
    use ControllerTestTrait;

    private $email = 'dev@dev.com';
    private $password = '123456789';
    private $entity = 'property';
    private $model = Property::class;
    private $not_null_fields = ['address'];

}
