<?php

namespace Tests\Traits;

use Tests\Traits\TestTrait;

trait ViewTestTrait{

    use TestTrait;

    public function setUp():void
    {
        parent::setUp();
        $this->loginAsDev();
    }

    //Run Test

    /** @test */
    public function user_can_list_all_items()
    {
        $this->response = $this->get(route($this->routeList));
        $this->assertViewList($this->viewList);
    }

    /** @test */
    public function user_can_show_item_detail()
    {
        $lastItem = $this->getLastRecord($this->model);

        $this->response = $this->get(route($this->routeShow,['id'=>$lastItem->id]));
        $this->assertViewShow($this->viewShow);
    }

    /** @test */
    public function user_can_show_all_items_detail()
    {
        $allItems = $this->getAllRecord($this->model)->toArray();

        foreach($allItems as $item)
        {
            $this->response = $this->get(route($this->routeShow,['id'=>$item['id']]));
            $this->assertViewShow($this->viewShow);
        }
    }

    /** @test */
    public function user_can_not_show_not_exist_item()
    {
        $lastItem = $this->getLastRecord($this->model);
        $notExistItem = $lastItem->id + 1;

        $this->response = $this->get(route($this->routeShow,['id'=>$notExistItem]));
        $this->assertViewNotFound();
    }
}

