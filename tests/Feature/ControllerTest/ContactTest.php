<?php

namespace Tests\Feature\ControllerTest;

use App\Models\Contact;
use Tests\TestCase;
use Tests\Traits\ControllerTestTrait;

class ContactTest extends TestCase
{
    use ControllerTestTrait;

    // User Dev
    private $email = 'dev@dev.com';
    private $password = '123456789';

    // Table and Model
    private $table = 'contacts';
    private $model = Contact::class;

    // Route
    private $routeList = 'contact.index';
    private $routeShow = 'contact.show';
    private $routeStore = 'contact.store';
    private $routeUpdate = 'contact.update';
    private $routeDelete = 'contact.destroy';

    // View
    private $viewList = 'crud::list';
    private $viewShow = 'contacts.show';

    // Expect fields
    private $not_null_fields = ['first_name','last_name','salutation','type','phone'];
    private $is_email_fields = ['email'];
    private $only_string_fields = ['first_name','last_name','type'];
    private $only_number_fields = ['identity_card'];

}
