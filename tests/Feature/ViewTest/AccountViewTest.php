<?php

namespace Tests\Feature\ViewTest;

use App\Models\Account;
use Tests\Traits\ViewTestTrait;
use Tests\TestCase;

class AccountViewTest extends TestCase
{
    use ViewTestTrait;

    // Route
    protected $routeList = 'account.index';
    protected $routeShow = 'account.show';

    // Model
    protected $model = Account::class;

    // View
    protected $viewList = 'crud::list';
    protected $viewShow = 'accounts.show';

    // Admin User
    protected $email = 'dev@dev.com';
    protected $password= '123456789';
}




