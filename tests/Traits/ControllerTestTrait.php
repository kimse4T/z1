<?php

namespace Tests\Traits;

use App\User;
use Tests\Traits\TestTrait;

trait ControllerTestTrait{

    use TestTrait;

    public function setUp():void
    {
        parent::setUp();
        $this->loginAsDev();
    }

    /** @test */
    public function list()
    {
        $this->response = $this->get(route($this->routeList));
        $this->assertViewList($this->viewList);
    }

    /** @test */
    public function show()
    {
        $data = $this->createModel();

        $this->response = $this->get(route($this->routeShow,$data['id']));
        $this->assertViewShow($this->viewShow);
    }

    /** @test */
    public function created()
    {
        $data = $this->makeModel();

        $this->response = $this->post(route($this->routeStore,$data));
        $this->assertSuccessCreated($data);
    }

    /** @test */
    public function updated()
    {
        $data = $this->createModel();
        $editData = $this->makeModel(['id' => $data['id']]);

        $this->response = $this->PUT(route($this->routeUpdate,$data['id']),$editData);
        $this->assertSuccessUpdated($editData);
    }

    /** @test */
    public function deleted()
    {
        $data = $this->createModel();
        $this->assertDatabaseHas($this->table,$data);

        $this->response = $this->delete(route($this->routeDelete,$data['id']));
        $this->assertSuccessDeleted($data);
    }

    /** @test */
    public function create_or_update_with_not_null_fields()
    {
        if(!isset($this->not_null_fields))
        {
            $this->markTestSkipped($this->table.' expect not having not-null field');
        }

        $null_data = Array();

        foreach($this->not_null_fields as $item)
        {
            $null_data[$item] = null;
        }

        //create
        $data = $this->makeModel($null_data);

        $this->response = $this->post(route($this->routeStore,$data));
        $this->assertErrorValidation($this->not_null_fields);

        //update
        $dataUpdate = $this->createModel();
        $data['id'] = $dataUpdate['id'];

        $this->response = $this->PUT(route($this->routeUpdate,$dataUpdate['id']),$data);
        $this->assertErrorValidation($this->not_null_fields);
    }

    /** @test */
    public function create_or_update_with_is_email_fields()
    {
        if(!isset($this->is_email_fields))
        {
            $this->markTestSkipped($this->table.' expect not having email field');
        }

        $email_data = Array();

        // Field as String

        foreach($this->is_email_fields as $item)
        {
            $email_data[$item] = 'notEmail';
        }

        //create
        $data = $this->makeModel($email_data);

        $this->response = $this->post(route($this->routeStore,$data));
        $this->assertErrorValidation($this->is_email_fields);

        //update
        $dataUpdate = $this->createModel();
        $data['id'] = $dataUpdate['id'];

        $this->response = $this->PUT(route($this->routeUpdate,$dataUpdate['id']),$data);
        $this->assertErrorValidation($this->is_email_fields);

        // Field as Number

        foreach($this->is_email_fields as $item)
        {
            $email_data[$item] = 123;
        }

        //create
        $data = $this->makeModel($email_data);

        $this->response = $this->post(route($this->routeStore,$data));
        $this->assertErrorValidation($this->is_email_fields);

        //update
        $dataUpdate = $this->createModel();
        $data['id'] = $dataUpdate['id'];

        $this->response = $this->PUT(route($this->routeUpdate,$dataUpdate['id']),$data);
        $this->assertErrorValidation($this->is_email_fields);

        // Field as Email

        foreach($this->is_email_fields as $item)
        {
            $email_data[$item] = 'email@email.email';
        }

        //create
        $data = $this->makeModel($email_data);

        $this->response = $this->post(route($this->routeStore,$data));
        $this->assertSuccessCreated($data);

        //update
        $dataUpdate = $this->createModel();
        $data['id'] = $dataUpdate['id'];

        $this->response = $this->PUT(route($this->routeUpdate,$dataUpdate['id']),$data);
        $this->assertSuccessUpdated($data);
    }

    /** @test */
    public function create_or_update_with_only_string_fields()
    {
        if(!isset($this->only_string_fields))
        {
            $this->markTestSkipped($this->table.' expect not having only string field');
        }

        $only_string_data = Array();

        // Field as Number

        foreach($this->only_string_fields as $item)
        {
            $only_string_data[$item] = 123;
        }

        //create
        $data = $this->makeModel($only_string_data);

        $this->response = $this->post(route($this->routeStore,$data));
        $this->assertErrorValidation($this->only_string_fields);

        //update
        $dataUpdate = $this->createModel();
        $data['id'] = $dataUpdate['id'];

        $this->response = $this->PUT(route($this->routeUpdate,$dataUpdate['id']),$data);
        $this->assertErrorValidation($this->only_string_fields);

        // Field as String

        foreach($this->only_string_fields as $item)
        {
            $only_string_data[$item] = "string";
        }

        //create
        $data = $this->makeModel($only_string_data);

        $this->response = $this->post(route($this->routeStore,$data));
        $this->assertSuccessCreated($data);

        //update
        $dataUpdate = $this->createModel();
        $data['id'] = $dataUpdate['id'];

        $this->response = $this->PUT(route($this->routeUpdate,$dataUpdate['id']),$data);
        $this->assertSuccessCreated($data);
    }

    /** @test */
    public function create_or_update_with_only_number_fields()
    {
        if(!isset($this->only_number_fields))
        {
            $this->markTestSkipped($this->table.' expect not having only number field');
        }

        $only_number_data = Array();

        // Field as String

        foreach($this->only_number_fields as $item)
        {
            $only_number_data[$item] = 'notNumber';
        }

        //create
        $data = $this->makeModel($only_number_data);

        $this->response = $this->post(route($this->routeStore,$data));
        $this->assertErrorValidation($this->only_number_fields);

        //update
        $dataUpdate = $this->createModel();
        $data['id'] = $dataUpdate['id'];

        $this->response = $this->PUT(route($this->routeUpdate,$dataUpdate['id']),$data);
        $this->assertErrorValidation($this->only_number_fields);

        // Field as Number

        foreach($this->only_number_fields as $item)
        {
            $only_number_data[$item] = 123456789;
        }

        //create
        $data = $this->makeModel($only_number_data);

        $this->response = $this->post(route($this->routeStore,$data));
        $this->assertSuccessCreated($data);

        //update
        $dataUpdate = $this->createModel();
        $data['id'] = $dataUpdate['id'];

        $this->response = $this->PUT(route($this->routeUpdate,$dataUpdate['id']),$data);
        $this->assertSuccessCreated($data);
    }

    function makeModel($fields=null)
    {
        if($fields == null)
        {
            $fields = [];
        }
        $data = factory($this->model)->make($fields)->toArray();

        return $data;
    }

    function createModel()
    {
        $data = $this->makeModel();

        $this->post(route($this->routeStore,$data));

        $id = $this->getLastRecord($this->model)->id;

        $data['id'] = $id;

        return $data;
    }
}
