<?php

namespace Tests\Traits;

use App\User;
use Illuminate\Support\Facades\Hash;

trait TestTrait{

    private $response;

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

    function assertSuccessAndRedirect()
    {
        $this->response->assertStatus(302);
    }

    function assertSuccessCreated($data)
    {
        $this->response->assertStatus(302);
        $this->assertDatabaseHas($this->table,$data);
    }

    function assertSuccessUpdated($data)
    {
        $this->response->assertStatus(302);
        $this->assertDatabaseHas($this->table,$data);
    }

    function assertSuccessDeleted($data)
    {
        $this->response->assertStatus(200);
        $this->assertDatabaseMissing($this->table,$data);
    }

    function assertSuccessUpdate()
    {
        $this->response->assertStatus(302);
    }

    function assertErrorValidation($fields)
    {
        $this->response->assertStatus(302);
        $this->response->assertSessionHasErrors($fields);
    }

    function assertAccessDeny()
    {
        $this->response->assertStatus(403);
    }

    function loginAsDev()
    {
        $userLogin=$this->post('/admin/login',[
            'email' => $this->email,
            'password'  => $this->password,
        ]);

        return $userLogin;
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

    function getLastRecord($model)
    {
        return $model::orderBy('id','desc')->first();
    }

    function getAllRecord($model)
    {
        return $model::all();
    }


}
