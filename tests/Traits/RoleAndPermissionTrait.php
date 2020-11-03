<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Property;
use App\PropertyTitleDeed;
use App\Unit;
use Backpack\PermissionManager\app\Models\Role as ModelsRole;
use Backpack\PermissionManager\app\Models\Permission;

trait RoleAndPermissionTrait{

    private $response,$user;

    public function setUp():void
    {
        parent::setUp();

        $this->loginAs($this->role);
    }

    /** @test */
    public function what_user_can_see()
    {
        $this->response=$this->get('/admin/dashboard');

        if(backpack_user()->hasRole('User'))
        {
            $this->assertViewSee(['Dashboard','Properties']);

            $this->assertViewNotSee(['Contacts','Authentication']);
        }
        elseif(backpack_user()->hasRole('Editor'))
        {
            $this->assertViewSee(['Dashboard','Properties','Contacts']);

            $this->assertViewNotSee(['Authentication']);
        }
        else
        {
            $this->assertViewSee(['Dashboard','Properties','Contacts','Authentication']);
        }
    }

    // contact

    /** @test */
    public function list_contact()
    {
        $this->response = $this->get('/admin/contact');

        if(backpack_user()->hasPermissionTo('list contact'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function show_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->response = $this->get('/admin/contact/'.$contact->id.'/show');

        if(backpack_user()->hasPermissionTo('show contact'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function create_contact()
    {
        $contact = factory(Contact::class)->make();

        $this->response = $this->post('/admin/contact',$contact->toArray());

        if(backpack_user()->hasPermissionTo('add contact'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function update_contact()
    {
        $contact = factory(Contact::class)->create();

        $editContact = factory(Contact::class)->make(['id'=>$contact->id]);

        $this->response = $this->put('/admin/contact/'.$contact->id,$editContact->toArray());

        if(backpack_user()->hasPermissionTo('update contact'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function delete_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->response = $this->delete('/admin/contact/'.$contact->id);

        if(backpack_user()->hasPermissionTo('delete contact'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    // Account

    /** @test */
    public function list_account()
    {
        $this->response = $this->get('/admin/account');

        if(backpack_user()->hasPermissionTo('list account'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function show_account()
    {
        $account = factory(Account::class)->create();

        $this->response = $this->get('/admin/account/'.$account->id.'/show');

        if(backpack_user()->hasPermissionTo('show account'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function create_account()
    {
        $account = factory(Account::class)->make();

        $this->response = $this->post('admin/account',$account->toArray());

        if(backpack_user()->hasPermissionTo('add account'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function update_account()
    {
        $account = factory(Account::class)->create();

        $editAccount = factory(Account::class)->make(['id'=>$account->id]);

        $this->response = $this->put('/admin/account/'.$account->id,$editAccount->toArray());

        if(backpack_user()->hasPermissionTo('update account'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function delete_account()
    {
        $account = factory(Account::class)->create();

        $this->response = $this->delete('/admin/account/'.$account->id);

        if(backpack_user()->hasPermissionTo('delete account'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    // Property

    /** @test */
    public function list_property()
    {
        $this->response = $this->get('/admin/property');

        if(backpack_user()->hasPermissionTo('list property'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function show_property()
    {
        $property = Property::latest()->first();

        $this->response = $this->get('/admin/property/'.$property->id.'/show');

        if(backpack_user()->hasPermissionTo('show property'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function create_property()
    {
        $this->response = $this->createProperty();

        if(backpack_user()->hasPermissionTo('add property'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function update_property()
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

        $this->response = $this->put('/admin/property/'.$id,$property);

        if(backpack_user()->hasPermissionTo('update property'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function delete_property()
    {
        $property = $this->createProperty();
        $id = Property::latest()->first()->id;

        $this->response = $this->delete('/admin/property/'.$id);

        if(backpack_user()->hasPermissionTo('delete property'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    // User

    /** @test */
    public function list_user()
    {
        $this->response = $this->get('/admin/user');

        if(backpack_user()->hasPermissionTo('list user'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    // public function user_can_not_create_user()
    // {
    //     $user = factory(User::class)->make();

    //     $this->post('/admin/user',$user->toArray())
    //          ->assertStatus(403);
    // }

    /** @test */
    public function update_user()
    {
        $user = factory(User::class)->create();

        $editUser = factory(User::class)->make(['id'=>$user->id]);

        $this->response = $this->put('/admin/user/'.$user->id,$editUser->toArray());

        if(backpack_user()->hasPermissionTo('update user'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function delete_user()
    {
        $user = factory(User::class)->create();

        $this->response = $this->delete('/admin/user/'.$user->id);

        if(backpack_user()->hasPermissionTo('delete user'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    // Role

    /** @test */
    public function list_role()
    {
        $this->response = $this->get('/admin/role');

        if(backpack_user()->hasPermissionTo('list role'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function create_role()
    {
        $role = ['name'=>\Str::random(4)];

        $this->response = $this->post('/admin/role',$role);

        if(backpack_user()->hasPermissionTo('add role'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function update_role()
    {
        $role = ModelsRole::create(["name"=>\Str::random(4)]);

        $this->response = $this->put('/admin/role/'.$role->id,["name"  => \Str::random(4),'id' => $role->id]);

        if(backpack_user()->hasPermissionTo('update role'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function delete_role()
    {
        $role = ModelsRole::create(["name"=>\Str::random(4)]);

        $this->response = $this->delete('/admin/role/'.$role->id);

        if(backpack_user()->hasPermissionTo('delete role'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    // Permission

    /** @test */
    public function list_permission()
    {
        $this->response = $this->get('/admin/permission');

        if(backpack_user()->hasPermissionTo('list permission'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function create_permission()
    {
        $permission = ['name'=>\Str::random(8)];

        $this->response = $this->post('/admin/permission',$permission);

        if(backpack_user()->hasPermissionTo('add permission'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function update_permission()
    {
        $permission = Permission::create(["name"=>\Str::random(4)]);

        $this->response = $this->put('/admin/permission/'.$permission->id,["name"  => \Str::random(4),'id' => $permission->id]);

        if(backpack_user()->hasPermissionTo('update permission'))
        {
            $this->response->assertStatus(302);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    /** @test */
    public function delete_permission()
    {
        $permission = Permission::create(["name"=>\Str::random(4)]);

        $this->response = $this->delete('/admin/permission/'.$permission->id);

        if(backpack_user()->hasPermissionTo('delete permission'))
        {
            $this->response->assertStatus(200);
        }
        else
        {
            $this->response->assertStatus(403);
        }
    }

    public function createProperty()
    {
        $property = factory(Property::class)->make()->toArray();
        $titledeed = factory(PropertyTitleDeed::class)->make();
        $unit = factory(Unit::class)->make()->toArray();

        $titledeed = json_encode([$titledeed->toArray()]);
        $property['propertyTitleDeedRepeatable']=$titledeed;
        $property = array_merge($property,$unit);

        return $this->post('/admin/property',$property);
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

    function loginAs($role)
    {
        $user = factory(User::class)->create(
            ['password' => Hash::make('123456789')]
        )->assignRole($role);

        $userLogin=$this->post('/admin/login',[
            'email' => $user->email,
            'password' => '123456789',
        ]);

        return $userLogin;
    }
}

