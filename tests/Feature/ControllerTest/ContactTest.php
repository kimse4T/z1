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
    private $entity = 'contact';
    private $model = Contact::class;

    // Expect fields
    private $not_null_fields = ['first_name','last_name','salutation','type','phone'];
    private $is_email_fields = ['email'];
    private $only_string_fields = ['first_name','last_name','type'];
    private $only_number_fields = ['identity_card'];

}
