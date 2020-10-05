<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Account;

class AccountApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware;

    /**
     * @test
     */
    public function test_create_account()
    {

        $account = factory(Account::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/accounts', $account
        );

        $this->assertApiResponse($account);
    }

    /**
     * @test
     */

    public function it_can_not_create_account_with_invalid_account_name()
    {
        $account = factory(Account::class)->make(
            ["name"  => null,]
        );

        $this->response = $this->json(
            'POST',
            '/api/accounts',$account->toArray()
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors("name");
    }

    /**
     * @test
     */

    public function it_can_not_create_account_with_invalid_email()
    {
        $account = factory(Account::class)->make(
            ["email"  => null,]
        );

        $this->response = $this->json(
            'POST',
            '/api/accounts',$account->toArray()
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors("email");
    }

    /**
     * @test
     */

    public function it_can_not_create_account_with_invalid_phone()
    {
        $account = factory(Account::class)->make(
            ["phone"  => null,]
        );

        $this->response = $this->json(
            'POST',
            '/api/accounts',$account->toArray()
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors("phone");
    }

    /**
     * @test
     */

    public function it_can_not_create_account_with_invalid_industry()
    {
        $account = factory(Account::class)->make(
            ["industry"  => null,]
        );

        $this->response = $this->json(
            'POST',
            '/api/accounts',$account->toArray()
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors("industry");
    }

    /**
     * @test
     */



    /**
     * @test
     */
    public function test_read_account()
    {
        $account = factory(Account::class)->create();
        // dd($account)
;        $this->response = $this->json(
            'GET',
            '/api/accounts/'.$account->id
        );

        $this->assertApiResponse($account->toArray());
    }

    /**
     * @test
     */
    public function test_update_account()
    {
        $account = factory(Account::class)->create();
        $editedAccount = factory(Account::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/accounts/'.$account->id,
            $editedAccount
        );

        $this->assertApiResponse($editedAccount);
    }

    /** @test */
    function can_not_update_account_with_invalid_name()
    {
        $account = factory(Account::class)->create();
        $editedAccount = factory(Account::class)->make([
            'name'  =>  null
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/accounts/'.$account->id,
            $editedAccount
        );

        $this->assertErrorValidation(['name']);
    }

    /** @test */
    function can_not_update_account_with_invalid_email()
    {
        $account = factory(Account::class)->create();
        $editedAccount = factory(Account::class)->make([
            'email'  =>  null
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/accounts/'.$account->id,$editedAccount
        );

        $this->assertErrorValidation(['email']);
    }

    /** @test */
    function can_not_update_account_with_invalid_phone()
    {
        $account = factory(Account::class)->create();
        $editedAccount = factory(Account::class)->make([
            'phone'  =>  null
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/accounts/'.$account->id,$editedAccount
        );

        $this->assertErrorValidation(['phone']);
    }

    /** @test */
    function can_not_update_account_with_invalid_industry()
    {
        $account = factory(Account::class)->create();
        $editedAccount = factory(Account::class)->make([
            'industry'  =>  null
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/accounts/'.$account->id,$editedAccount
        );

        $this->assertErrorValidation(['industry']);
    }



    /**
     * @test
     */
    public function test_delete_account()
    {
        $account = factory(Account::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/accounts/'.$account->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/accounts/'.$account->id
        );

        $this->response->assertStatus(404);
    }
}
