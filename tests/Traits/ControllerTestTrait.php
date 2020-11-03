<?php

namespace Tests\Traits;

use App\User;

trait ControllerTestTrait{

    private $resUser,$response;

    public function setUp():void
    {
        parent::setUp();

        $this->loginAsDev();
    }

    /** @test */
    public function list()
    {
        $this->response = $this->get('/admin/'.$this->entity);

        $this->response->assertStatus(200);
    }

    /** @test */
    public function show()
    {
        $data = factory($this->model)->create();

        $this->response = $this->get('/admin/'.$this->entity.'/'.$data->id.'/show');

        $this->response->assertStatus(200);
    }

    /** @test */
    public function created()
    {
        $data = factory($this->model)->make();

        $this->response = $this->post('/admin/'.$this->entity,$data->toArray());

        $this->response->assertStatus(302);
    }

    /** @test */
    public function updated()
    {
        $data = factory($this->model)->create();

        $editData = factory($this->model)->make([
            'id'    => $data->id,
        ]);

        $this->response = $this->PUT('/admin/'.$this->entity.'/'.$data->id,$editData->toArray());

        $this->response->assertStatus(302);
    }

    /** @test */
    public function deleted()
    {
        $data = factory($this->model)->create();

        $this->response = $this->delete('/admin/'.$this->entity.'/'.$data->id);

        $this->response->assertStatus(200);
    }

    /** @test */
    public function create_or_update_with_not_null_fields()
    {
        if(!isset($this->not_null_fields))
        {
            $this->markTestSkipped($this->entity.' expect not having not-null field');
        }

        $null_data = Array();

        foreach($this->not_null_fields as $item)
        {
            $null_data[$item] = null;
        }

        //create

        $data = factory($this->model)->make($null_data)->toArray();

        $this->response = $this->post('/admin/'.$this->entity,$data);

        $this->response->assertSessionHasErrors($this->not_null_fields);

        //update

        $dataUpdate = factory($this->model)->create();

        $data['id'] = $dataUpdate->id;

        $this->response = $this->PUT('/admin/'.$this->entity.'/'.$dataUpdate->id,$data);

        $this->response->assertSessionHasErrors($this->not_null_fields);
    }

    /** @test */
    public function create_or_update_with_is_email_fields()
    {
        if(!isset($this->is_email_fields))
        {
            $this->markTestSkipped($this->entity.' expect not having email field');
        }

        $email_data = Array();

        //create

        foreach($this->is_email_fields as $item)
        {
            $email_data[$item] = 'notEmail';
        }

        $data = factory($this->model)->make($email_data)->toArray();

        $this->response = $this->post('/admin/'.$this->entity,$data);

        $this->response->assertSessionHasErrors($this->is_email_fields);

        //update

        $dataUpdate = factory($this->model)->create();

        $data['id'] = $dataUpdate->id;

        $this->response = $this->PUT('/admin/'.$this->entity.'/'.$dataUpdate->id,$data);

        $this->response->assertSessionHasErrors($this->is_email_fields);

    }

    /** @test */
    public function create_or_update_with_only_string_fields()
    {
        if(!isset($this->only_string_fields))
        {
            $this->markTestSkipped($this->entity.' expect not having only string field');
        }

        $only_string_data = Array();

        foreach($this->only_string_fields as $item)
        {
            $only_string_data[$item] = 123;
        }

        //create

        $data = factory($this->model)->make($only_string_data)->toArray();

        $this->response = $this->post('/admin/'.$this->entity,$data);

        $this->response->assertSessionHasErrors($this->only_string_fields);

        //update

        $dataUpdate = factory($this->model)->create();

        $data['id'] = $dataUpdate->id;

        $this->response = $this->PUT('/admin/'.$this->entity.'/'.$dataUpdate->id,$data);

        $this->response->assertSessionHasErrors($this->only_string_fields);
    }

    /** @test */
    public function create_or_update_with_only_number_fields()
    {
        if(!isset($this->only_number_fields))
        {
            $this->markTestSkipped($this->entity.' expect not having only number field');
        }

        $only_number_data = Array();

        foreach($this->only_number_fields as $item)
        {
            $only_number_data[$item] = 'notNumber';
        }

        //create

        $data = factory($this->model)->make($only_number_data)->toArray();

        $this->response = $this->post('/admin/'.$this->entity,$data);

        $this->response->assertSessionHasErrors($this->only_number_fields);

        //update

        $dataUpdate = factory($this->model)->create();

        $data['id'] = $dataUpdate->id;

        $this->response = $this->PUT('/admin/'.$this->entity.'/'.$dataUpdate->id,$data);

        $this->response->assertSessionHasErrors($this->only_number_fields);
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
