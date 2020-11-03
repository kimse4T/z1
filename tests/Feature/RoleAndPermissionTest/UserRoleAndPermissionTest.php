<?php

namespace Tests\Feature\RoleAndPermissionTest;

use Tests\TestCase;
use Tests\Traits\RoleAndPermissionTrait;

class UserRoleAndPermissionTest extends TestCase
{
    use RoleAndPermissionTrait;

    private $role = 'User';
}
