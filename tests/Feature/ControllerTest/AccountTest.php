<?php

namespace Tests\Feature\ControllerTest;

use App\Models\Account;
use Tests\TestCase;
use Tests\Traits\ControllerTestTrait;

class AccountTest extends TestCase
{
    use ControllerTestTrait;

    // User Dev
    private $email = 'dev@dev.com';
    private $password = '123456789';

    // Table and Model
    private $entity = 'account';
    private $model = Account::class;

    // Expect fields
    private $not_null_fields = ['name','email','phone','industry'];
    private $is_email_fields = ['email'];
    private $only_number_fields = ['phone'];
}
