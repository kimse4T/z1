<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\Hash;
use App\User;

trait ViewTestTrait{

    public function setUp():void
    {
        parent::setUp();

        $this->loginAsDev();
    }

    // Assign value

    protected $response;


    //Run Test

    /** @test */
    public function user_can_list_entity()
    {
        $this->response = $this->get(route($this->routeList));
        $this->assertViewList($this->viewList);
    }

    /** @test */
    public function user_can_show_entity_detail()
    {
        $lastEntity = $this->getLastRecord($this->modelName);

        $this->response = $this->get(route($this->routeShow,['id'=>$lastEntity->id]));

        $this->assertViewShow($this->viewShow);
    }

    /** @test */
    public function user_can_show_all_entity_details()
    {
        $allEntities = $this->getAllRecord($this->modelName);

        $allEntities = $allEntities->toArray();

        foreach($allEntities as $entity)
        {
            $this->response = $this->get(route($this->routeShow,['id'=>$entity['id']]));

            $this->assertViewShow($this->viewShow);
        }
    }

    /** @test */
    public function user_can_not_show_not_exist_entity()
    {
        $lastEntity = $this->getLastRecord($this->modelName);

        $notExistEntity = $lastEntity->id + 1;

        $this->response = $this->get(route($this->routeShow,['id'=>$notExistEntity]));

        $this->assertViewNotFound();
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

    function loginAsDev()
    {
        $userLogin=$this->post('/admin/login',[
            'email' => $this->email,
            'password'  => $this->password,
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

