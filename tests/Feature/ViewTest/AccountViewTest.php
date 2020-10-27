<?php

namespace Tests\Feature\ViewTest;

use App\Models\Account;
use Tests\Traits\ViewTestTrait;
use Tests\TestCase;

class AccountViewTest extends TestCase
{
    use ViewTestTrait;

    protected $routeList = 'account.index';
    protected $routeShow = 'account.show';
    protected $modelName = Account::class;
    protected $viewList = 'crud::list';
    protected $viewShow = 'accounts.show';
    protected $email = 'dev@dev.com';
    protected $password= '123456789';
}
