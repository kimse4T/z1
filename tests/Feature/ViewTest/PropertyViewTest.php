<?php

namespace Tests\Feature\ViewTest;

use App\Models\Property;
use Tests\Traits\ViewTestTrait;
use Tests\TestCase;

class PropertyViewTest extends TestCase
{
    use ViewTestTrait;

    protected $routeList = 'property.index';
    protected $routeShow = 'property.show';
    protected $modelName = Property::class;
    protected $viewList = 'crud::list';
    protected $viewShow = 'properties.show';
    protected $email = 'dev@dev.com';
    protected $password= '123456789';
}
