<?php

namespace Tests\Traits;

use App\User;

trait RawControllerTestTrait{

    private $resUser,$response;

    public function setUp():void
    {
        parent::setUp();

        $this->loginAsDev();
    }

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

    function loginAsDev()
    {
        $userLogin=$this->post('/admin/login',[
            'email' => 'dev@dev.com',
            'password'  => '123456789',
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
