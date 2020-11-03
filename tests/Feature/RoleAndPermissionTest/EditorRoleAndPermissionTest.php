<?php

namespace Tests\Feature\RoleAndPermissionTest;

use Tests\TestCase;
use Tests\Traits\RoleAndPermissionTrait;

class EditorRoleAndPermissionTest extends TestCase
{
    use RoleAndPermissionTrait;

    private $role = 'Editor';
}
