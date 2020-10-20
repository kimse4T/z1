<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Contact;
use App\User;

class ContactApiTest extends TestCase
{
     use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

     public function setUp():void
     {
         parent::setUp();

         //use as user that has login for access all api route
         //can use without withHeader('Authorization',$this->token)
         $user = factory(User::class)->create();
         $this->actingAs($user, 'api');
     }

    /**
     * @test
     */
    public function test_create_contact()
    {
        $contact = factory(Contact::class)->make()->toArray();

        //dd($contact);

        $this->response = $this->json(
            'POST',
            '/api/contacts', $contact
        );

        $this->assertApiResponse($contact);
    }


    /** @test */
    function it_can_not_create_contact_with_null_first_name()
    {
        $contact = factory(Contact::class)->make(
            ["first_name"  => null]
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["first_name"]);
    }

    /** @test */
    function it_can_not_create_contact_with_numberOrSpecialCharacter_first_name()
    {
        $contact = factory(Contact::class)->make(
            ["first_name"  => 13,-2]
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["first_name"]);
    }

    /** @test */
    function it_can_not_create_contact_with_lessThan2Character_first_name()
    {
        $contact = factory(Contact::class)->make(
            ["first_name"  => 'J']
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["first_name"]);
    }

    /** @test */
    function it_can_not_create_contact_with_greaterThan30Character_first_name()
    {
        $contact = factory(Contact::class)->make(
            ["first_name"  => 'qwertyuiopasdfghjkluruurrqwertyuiosdfghjklxcvbnmdfghjklertyui']
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["first_name"]);
    }



    /** @test */
    function it_can_not_create_contact_with_null_last_name()
    {
        $contact = factory(Contact::class)->make(
            ["last_name"  => null]
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["last_name"]);
    }

    /** @test */
    function it_can_not_create_contact_with_numberOrSpecialCharacter_last_name()
    {
        $contact = factory(Contact::class)->make(
            ["last_name"  => 13,-2]
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["last_name"]);
    }

    /** @test */
    function it_can_not_create_contact_with_lessThan2Character_last_name()
    {
        $contact = factory(Contact::class)->make(
            ["last_name"  => 'K']
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["last_name"]);
    }

    /** @test */
    function it_can_not_create_contact_with_greaterThan30Character_last_name()
    {
        $contact = factory(Contact::class)->make(
            ["last_name"  => 'qwertyuiopasdfghjkluruurrqwertyuiosdfghjklxcvbnmdfghjklertyui']
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["last_name"]);
    }

    /** @test */
    function it_can_not_create_contact_with_invalid_salutation()
    {
        $contact = factory(Contact::class)->make(
            ["salutation"  => null]
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["salutation"]);
    }

    /** @test */
    function it_can_not_create_contact_with_invalid_type()
    {
        $contact = factory(Contact::class)->make(
            ["type"  => null]
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["type"]);
    }

    /** @test */
    function it_can_not_create_contact_with_numberOrSpecialCharacter_type()
    {
        $contact = factory(Contact::class)->make(
            ["type"  => 12,-4]
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["type"]);
    }

    /** @test */
    function it_can_not_create_contact_with_null_phone()
    {
        $contact = factory(Contact::class)->make(
            ["phone"  => null]
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["phone"]);
    }

    /** @test */
    function it_can_not_create_contact_with_notNumber_phone()
    {
        $contact = factory(Contact::class)->make(
            ["phone"  => 'ABCD']
        );

        $this->response = $this->json(
            'POST',
            '/api/contacts',$contact->toArray()
        );

        $this->assertErrorValidation(["phone"]);
    }


    /**
     * @test
     */
    public function test_read_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/contacts/'.$contact->id
        );

        $this->assertApiResponse($contact->toArray());
    }

    /**
     * @test
     */
    public function test_update_contact()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,
            $editedContact
        );

        $this->assertApiResponse($editedContact);
    }


    /** @test */
    function can_not_update_contact_with_null_first_name()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make([
            'first_name'  =>  null
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,$editedContact
        );

        $this->assertErrorValidation(['first_name']);
    }


    /** @test */
    function can_not_update_contact_with_numberOrSpecialCharacter_first_name()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make([
            'first_name'  =>  12,-3
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,$editedContact
        );

        $this->assertErrorValidation(['first_name']);
    }

    /** @test */
    function can_not_update_contact_with_lessThan2Character_first_name()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make([
            'first_name'  =>  'L'
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,$editedContact
        );

        $this->assertErrorValidation(['first_name']);
    }

    /** @test */
    function can_not_update_contact_with_greaterThan30Character_first_name()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make([
            'first_name'  =>  'Lqwertyuiopasdfghjklzxcvbnmqwertyuiopsdfghjklxcvbnmdf'
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,$editedContact
        );

        $this->assertErrorValidation(['first_name']);
    }

    /** @test */
    function can_not_update_contact_with_invalid_salutation()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make([
            'salutation'  =>  null
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,$editedContact
        );

        $this->assertErrorValidation(['salutation']);
    }

    /** @test */
    function can_not_update_contact_with_null_type()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make([
            'type'  =>  null
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,$editedContact
        );

        $this->assertErrorValidation(['type']);
    }

    /** @test */
    function can_not_update_contact_with_numberOrSpecialCharacter_type()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make([
            'type'  =>  12,-3
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,$editedContact
        );

        $this->assertErrorValidation(['type']);
    }

    /** @test */
    function can_not_update_contact_with_null_phone()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make([
            'phone'  =>  null
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,$editedContact
        );

        $this->assertErrorValidation(['phone']);
    }

    /** @test */
    function can_not_update_contact_with_notNumber_phone()
    {
        $contact = factory(Contact::class)->create();
        $editedContact = factory(Contact::class)->make([
            'phone'  =>  'ABC'
        ])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contacts/'.$contact->id,$editedContact
        );

        $this->assertErrorValidation(['phone']);
    }

    /**
     * @test
     */
    public function test_delete_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contacts/'.$contact->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contacts/'.$contact->id
        );

        $this->response->assertStatus(404);
    }
}
