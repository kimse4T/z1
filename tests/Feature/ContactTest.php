<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Location;
use Tests\Traits\ViewTrait;

class ContactTest extends TestCase
{
    // use ViewTrait;

    private $resUser,$response;

    public function setUp():void
    {
        parent::setUp();

        $this->resUser = $this->post('/admin/login',[
            'email' => 'dev@dev.com',
            'password' => '123456789',
        ]);

    }

    /** @test */
    public function guest_can_not_create_contact()
    {
        $this->post('/admin/logout');

        $this->get('admin/contact')
            ->assertRedirect('admin/login');

        $this->post('admin/contact')
            ->assertRedirect('admin/login');
    }

    /** @test */
    public function list_all_contacts()
    {
        $this->response = $this->get('/admin/contact');

        $this->response->assertSuccessful();

        // side bar
        $this->assertViewSee(['Dashboard','Contacts','Contact Lists','VIP Contact Lists','Accounts','Properties']);

        // body
        $this->assertViewSee(['Add contact']);
    }

    /** @test */
    public function show_contact_by_id()
    {
        $contact = factory(Contact::class)->create();

        $this->response = $this->get('/admin/contact/'.$contact->id.'/show');

        $this->response->assertViewIs('contacts.show');
    }

    /** @test */
    public function show_view_create_contact()
    {
        $this->response = $this->get('/admin/contact/create')
            ->assertViewIs('contacts.create');
    }

    /** @test */
    public function backpack_it_can_create_contact()
    {
        $contact = factory(Contact::class)->make();

        $this->response = $this->post('/admin/contact',$contact->toArray());

        $this->response->assertRedirect('/admin/contact');

        $this->get($this->response->headers->get('Location'))
             ->assertSee($contact->last_name)
             ->assertSee($contact->first_name)
             ->assertSee($contact->phone);

        $this->assertDatabaseHas('contacts', [
            'type' => $contact->type,
            'last_name' => $contact->last_name,
            'first_name' => $contact->first_name,
            'phone' => $contact->phone,
            'salutation' => $contact->salutation,
        ]);

    }

    /** @test */
    public function backpack_it_can_not_create_contact_with_invalid_type()
    {
        $contact = factory(Contact::class)->make(['type'=>""]);

        $this->response = $this->post('/admin/contact',$contact->toArray());

        $this->response->assertSessionHasErrors('type');
    }

    /** @test */
    public function backpack_it_can_not_create_contact_with_invalid_first_name()
    {
        $contact = factory(Contact::class)->make(['first_name'=>""]);

        $this->response = $this->post('/admin/contact',$contact->toArray());

        $this->response->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function backpack_it_can_not_create_contact_with_invalid_last_name()
    {
        $contact = factory(Contact::class)->make(['last_name'=>""]);

        $this->response = $this->post('/admin/contact',$contact->toArray());

        $this->response->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function backpack_it_can_not_create_contact_with_invalid_phone()
    {
        $contact = factory(Contact::class)->make(['phone'=>""]);

        $this->response = $this->post('/admin/contact',$contact->toArray());

        $this->response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function backpack_it_can_not_create_contact_with_invalid_email()
    {
        $contact = factory(Contact::class)->make(['email'=>"123"]);

        $this->response = $this->post('/admin/contact',$contact->toArray());

        $this->response->assertSessionHasErrors('email');
    }

    /** @test */
    public function backpack_it_can_not_create_contact_with_invalid_identity_card()
    {
        $contact = factory(Contact::class)->make(['identity_card'=>"letter"]);

        $this->response = $this->post('/admin/contact',$contact->toArray());

        $this->response->assertSessionHasErrors('identity_card');
    }

    /** @test */
    public function backpack_it_can_update_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->get('/admin/contact/'.$contact->id.'/edit')
             ->assertSee($contact->first_name)
             ->assertSee($contact->last_name)
             ->assertSee($contact->phone);

        $editcontact = factory(Contact::class)->make([
            'id'    => $contact->id,
        ]);

        $this->response = $this->PUT('/admin/contact/'.$contact->id,$editcontact->toArray());

        $this->response->assertRedirect('/admin/contact');
    }

    /** @test */
    public function backpack_it_can_delete_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
        ]);

        $this->delete('/admin/contact/'.$contact->id);

        $this->assertDatabaseMissing('contacts', [
            'id' => $contact->id,
        ]);
    }


}
