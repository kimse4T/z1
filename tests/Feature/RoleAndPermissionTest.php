<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\Traits\ViewTrait;
use Tests\TestCase;
use App\User;

class RoleAndPermissionTest extends TestCase
{
    use ViewTrait;

    private $response;

    /** @test */
    public function what_user_role_user_can_see()
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole('User');

        $userLogin=$this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $this->response=$this->get('/admin/dashboard');

        $this->assertViewSee(['Dashboard','Properties']);

        $this->assertViewNotSee(['Contacts','Authentication']);
    }

    /** @test */
    public function what_user_role_developer_can_see()
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole('Developer');

        $this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $this->response=$this->get('/admin/dashboard');

        $this->assertViewSee(['Dashboard','Properties','Contacts','Authentication']);
    }

    /** @test */
    public function what_user_role_manager_can_see()
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole('Manager');

        $this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $this->response=$this->get('/admin/dashboard');

        $this->assertViewSee(['Dashboard','Properties','Contacts']);

        $this->assertViewNotSee(['Authentication']);
    }

    /** @test */
    public function user_role_user_can_not_list_contact()
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole('user');

        $this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $this->response=$this->get('/admin/contact');

        $this->response->assertStatus(403);
    }

    /** @test */
    public function user_role_user_can_not_show_contact()
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole('user');

        $this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $contact = factory(Contact::class)->create();

        $this->response=$this->get('/admin/contact/'.$contact->id.'/show');

        $this->response->assertStatus(403);
    }

    /** @test */
    public function user_role_user_can_not_create_contact()
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole('user');

        $this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $contact = factory(Contact::class)->make();

        $this->response=$this->post('/admin/contact',$contact->toArray());

        $this->response->assertStatus(403);
    }

    /** @test */
    public function user_role_user_can_not_update_contact()
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole('User');

        $this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $contact = factory(Contact::class)->create();

        $editContact = factory(Contact::class)->make();

        $this->response=$this->put('/admin/contact/'.$contact->id,$editContact->toArray());

        $this->response->assertStatus(403);
    }

    /** @test */
    public function user_role_user_can_not_delete_contact()
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole('user');

        $this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $contact = factory(Contact::class)->create();

        $this->response=$this->delete('/admin/contact/'.$contact->id);

        $this->response->assertStatus(403);
    }


}
