<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\Hash;
use App\User;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Property;
use App\PropertyTitleDeed;
use App\Unit;
use Tests\TestCase;
use Backpack\PermissionManager\app\Models\Role as ModelsRole;
use Backpack\PermissionManager\app\Models\Permission;

trait RoleAndPermissionTrait{

    function assertViewSee($keys=[])
    {
        foreach ($keys as $key)
        {
            $this->response->assertSee($key);
        }
    }

    function assertViewNotSee($keys=[])
    {
        foreach ($keys as $key)
        {
            $this->response->assertDontSee($key);
        }
    }

    function assertViewList($view)
    {
        $this->response->assertStatus(200)
                       ->assertViewIs($view);
    }

    function assertViewShow($view)
    {
        $this->response->assertStatus(200)
                       ->assertViewIs($view);
    }

    function assertViewNotFound()
    {
        $this->response->assertStatus(404);
    }

    function loginAs($role)
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole($role);

        $userLogin=$this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        return $userLogin;
    }
}

