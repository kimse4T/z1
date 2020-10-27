<?php

namespace Tests\Feature\ViewTest;

use App\Models\Contact;
use Tests\Traits\ViewTestTrait;
use Tests\TestCase;

class ContactViewTest extends TestCase
{
    use ViewTestTrait;

    protected $routeList = 'contact.index';
    protected $routeShow = 'contact.show';
    protected $modelName = Contact::class;
    protected $viewList = 'crud::list';
    protected $viewShow = 'contacts.show';
    protected $email = 'dev@dev.com';
    protected $password= '123456789';
}
