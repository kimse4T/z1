<?php

namespace Tests\Feature\RoleAndPermissionTest;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Property;
use App\PropertyTitleDeed;
use App\Unit;
use Tests\TestCase;
use Tests\Traits\RoleAndPermissionTrait;
use App\User;
use Backpack\PermissionManager\app\Models\Role as ModelsRole;
use Backpack\PermissionManager\app\Models\Permission;

class EditorRoleAndPermissionTest extends TestCase
{
    use RoleAndPermissionTrait;

    private $response,$user;

    public function setUp():void
    {
        parent::setUp();

        $this->loginAs('editor');
    }

    // WHAT EDITOR SEE WHEN LOGIN //

    /** @test */
    public function what_editor_can_see()
    {
        $this->response=$this->get('/admin/dashboard');

        $this->assertViewSee(['Dashboard','Properties','Contacts']);

        $this->assertViewNotSee(['Authentication']);
    }

    // WHAT EDITOR ROLE USER CAN NOT DO //

    // User

    /** @test */
    public function editor_can_not_list_user()
    {
        $this->get('/admin/user')
             ->assertStatus(403);
    }

    // /** @test */
    // public function editor_can_not_create_user()
    // {
    //     $user = factory(User::class)->make();

    //     $this->post('/admin/user',$user->toArray())
    //          ->assertStatus(403);
    // }

    /** @test */
    public function editor_can_not_update_user()
    {
        $user = factory(User::class)->create();

        $editUser = factory(User::class)->make(['id'=>$user->id]);

        $this->put('/admin/user/'.$user->id,$editUser->toArray())
             ->assertStatus(403);
    }

    /** @test */
    public function editor_can_not_delete_user()
    {
        $user = factory(User::class)->create();

        $this->delete('/admin/user/'.$user->id)
             ->assertStatus(403);
    }

    // Role

    /** @test */
    public function editor_can_not_list_role()
    {
        $this->get('/admin/role')
             ->assertStatus(403);
    }

    /** @test */
    public function editor_can_not_create_role()
    {
        $role = ['name'=>\Str::random(4)];

        $this->post('/admin/role',$role)
             ->assertStatus(403);
    }

    /** @test */
    public function editor_can_not_update_role()
    {
        $role = ModelsRole::create(["name"=>\Str::random(4)]);

        $this->put('/admin/role/'.$role->id,["name"  => \Str::random(4)])
             ->assertStatus(403);
    }

    /** @test */
    public function editor_can_not_delete_role()
    {
        $role = ModelsRole::create(["name"=>\Str::random(4)]);

        $this->delete('/admin/role/'.$role->id)
             ->assertStatus(403);
    }

    // Permission

    /** @test */
    public function editor_can_not_list_permission()
    {
        $this->get('/admin/permission')
             ->assertStatus(403);
    }

    /** @test */
    public function editor_can_not_create_permission()
    {
        $permission = ['name'=>\Str::random(8)];

        $this->post('/admin/permission',$permission)
             ->assertStatus(403);
    }

    /** @test */
    public function editor_can_not_update_permission()
    {
        $permission = Permission::create(["name"=>\Str::random(4)]);

        $this->put('/admin/permission/'.$permission->id,["name"  => \Str::random(4)])
             ->assertStatus(403);
    }

    /** @test */
    public function editor_can_not_delete_permission()
    {
        $permission = Permission::create(["name"=>\Str::random(4)]);

        $this->delete('/admin/permission/'.$permission->id)
             ->assertStatus(403);
    }

    // WHAT USER ROLE USER CAN DO //

    // Contact

    /** @test */
    public function editor_can_list_contact()
    {
        $this->get('/admin/contact')
             ->assertStatus(200)
             ->assertViewIs('crud::list');
    }

    /** @test */
    public function editor_can_show_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->get('/admin/contact/'.$contact->id.'/show')
             ->assertStatus(200)
             ->assertViewIs('contacts.show');
    }

    /** @test */
    public function editor_can_create_contact()
    {
        $contact = factory(Contact::class)->make();

        $this->post('/admin/contact',$contact->toArray())
             ->assertStatus(302);
    }

    /** @test */
    public function editor_can_update_contact()
    {
        $contact = factory(Contact::class)->create();

        $editContact = factory(Contact::class)->make(['id'=>$contact->id]);

        $this->put('/admin/contact/'.$contact->id,$editContact->toArray())
             ->assertStatus(302);
    }

    /** @test */
    public function editor_can_delete_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->delete('/admin/contact/'.$contact->id)
             ->assertStatus(200);
    }

    // Account

    /** @test */
    public function editor_can_list_account()
    {
        $this->get('/admin/account')
             ->assertStatus(200)
             ->assertViewIs('crud::list');
    }

    /** @test */
    public function editor_can_show_account()
    {
        $account = factory(Account::class)->create();

        $this->get('/admin/account/'.$account->id.'/show')
             ->assertStatus(200)
             ->assertViewIs('accounts.show');
    }

    /** @test */
    public function editor_can_create_account()
    {
        $account = factory(Account::class)->make();

        $this->post('admin/account',$account->toArray())
             ->assertStatus(302);
    }

    /** @test */
    public function editor_can_update_account()
    {
        $account = factory(Account::class)->create();

        $editAccount = factory(Account::class)->make(['id'=>$account->id]);

        $this->put('/admin/account/'.$account->id,$editAccount->toArray())
             ->assertStatus(302);
    }

    /** @test */
    public function editor_can_delete_account()
    {
        $account = factory(Account::class)->create();

        $this->delete('/admin/account/'.$account->id)
             ->assertStatus(200);
    }

    // Property

    /** @test */
    public function editor_can_list_property()
    {
        $this->get('/admin/property')
             ->assertStatus(200)
             ->assertViewIs('crud::list');
    }

    /** @test */
    public function editor_can_show_property()
    {
        $property = factory(Property::class)->create();

        $this->get('/admin/property/'.$property->id.'/show')
             ->assertStatus(200)
             ->assertViewIs('properties.show');
    }

    /** @test */
    public function editor_can_create_property()
    {
        $property = $this->createProperty();

        $this->assertDatabaseHas('properties', [
            'address' => $property['address'],
            'land_width' =>$property['land_width'],
            'land_length' => $property['land_length']
        ]);
    }

    /** @test */
    public function editor_can_update_property()
    {
        $property = $this->createProperty();
        $id = Property::latest()->first()->id;
        $unit_id=[Unit::latest()->first()->id];
        $titledeed_id = PropertyTitleDeed::latest()->first()->id;

        $property = factory(Property::class)->make()->toArray();
        $titledeed = factory(PropertyTitleDeed::class)->make();
        $unit = factory(Unit::class)->make()->toArray();

        $titledeed = $titledeed->toArray();
        $titledeed['id'] = $titledeed_id;
        $titledeed['title_deed_image']=null;

        $titledeed = json_encode([$titledeed]);
        $property['propertyTitleDeedRepeatable']=$titledeed;
        $property = array_merge($property,$unit);

        $property['id']=$id;
        $property['unit_id']=$unit_id;

        $this->put('/admin/property/'.$id,$property)
             ->assertStatus(302);
    }

    /** @test */
    public function editor_can_delete_property()
    {
        $property = $this->createProperty();
        $id = Property::latest()->first()->id;

        $this->delete('/admin/property/'.$id)
             ->assertStatus(200);
    }








    public function createProperty()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed = factory(PropertyTitleDeed::class)->make();
        $unit = factory(Unit::class)->make()->toArray();

        $titledeed = json_encode([$titledeed->toArray()]);
        $property['propertyTitleDeedRepeatable']=$titledeed;
        $property = array_merge($property,$unit);

        $this->post('/admin/property',$property);

        return $property;
    }
}
