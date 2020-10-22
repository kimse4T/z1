<?php

namespace Tests\Feature;

use App\Models\Listing;
use Tests\Traits\ViewTestTrait;
use Tests\TestCase;

class ListingViewTest extends TestCase
{
    use ViewTestTrait;

    protected $routeList = 'listing.index';
    protected $routeShow = 'listing.show';
    protected $modelName = Listing::class;
    protected $viewList = 'crud::list';
    protected $viewShow = 'listings.show';
    protected $email = 'dev@dev.com';
    protected $password= '123456789';
}
