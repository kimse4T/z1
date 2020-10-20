<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\Traits\LoginTrait;

class LoginAndRegisterTest extends TestCase
{
    use RefreshDatabase;
    use LoginTrait;

    protected $user;
    protected $password;

    public function setUp() :void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'password' => Hash::make($this->password='123456789'),
        ]);
    }

    /** @test */
    // public function it_can_register()
    // {
    //     $this->user = factory(User::class)->make([
    //         'password' => Hash::make($this->password='123456789'),
    //     ]);

    //     dd($this->password);

    //     $this->post('/admin/register',[
    //         'name'  => $this->user->name,
    //         'email' => $this->user->email,
    //         'password' => $this->password,
    //         'password_confirmation' => $this->password
    //     ]);

    //     $response = $this->post('/admin/login',[
    //         'email' => $this->user->email,
    //         'password' => $this->password,
    //     ]);

    //     $response->assertSee('Dashboard');
    // }

    /** @test */
    public function it_can_login()
    {
        $response = $this->post('/admin/login',[
            'email' => $this->user->email,
            'password' => $this->password,
        ]);

        $response->assertRedirect('/admin/dashboard');

        $response->assertStatus(302);

        $this->assertAuthenticatedAs($this->user);

    }

    /** @test */
    public function it_can_not_login_with_incorrect_email()
    {
        $response = $this->from('/admin/login')->post('/admin/login',[
            'email' => "invalid@email.com",
            'password' => $this->password,
        ]);

        $this->assertLoginFailed($response);
    }

    /** @test */
    public function it_can_not_login_with_incorrect_password()
    {
        $response = $this->from('/admin/login')->post('/admin/login',[
            'email' => $this->user->email,
            'password' => 'invalid-password',
        ]);

        $this->assertLoginFailed($response);
    }

    /** @test */
    public function it_can_not_login_with_incorrect_email_and_password()
    {
        $response = $this->from('/admin/login')->post('/admin/login',[
            'email' => 'invalide@email.com',
            'password' => 'invalid-password',
        ]);

        $this->assertLoginFailed($response);
    }

    /** @test */
    public function loggedin_user_can_not_see_login_form()
    {
        $response = $this->post('/admin/login',[
            'email' => $this->user->email,
            'password' => $this->password,
        ]);

        $this->get('/admin/login')
             ->assertRedirect('/home');
    }
}
