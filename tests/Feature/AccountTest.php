<?php

namespace Tests\Feature;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\ViewTrait;

class AccountTest extends TestCase
{
    use ViewTrait;

    private $resUser,$response;

    public function setUp():void
    {
        parent::setUp();

        $this->resUser = $this->post('/admin/login',[
            'email' => 'dev@dev.com',
            'password' => '123456789',
        ]);

    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function backpack_it_can_update_account()
    {

        $account = factory(Account::class)->create();

        $this->get('/admin/account/'.$account->id.'/edit')
             ->assertSee($account->name)
             ->assertSee($account->phone);

        $editaccount = factory(Account::class)->make();

        $this->response = $this->PUT('/admin/account/'.$account->id,$editaccount->toArray());

        dd($this->response);

        $this->response->assertRedirect('/admin/account');
    }
}
