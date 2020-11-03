private $response,$user;

    public function setUp():void
    {
        parent::setUp();

        $this->loginAs('User');
    }

    // WHAT USER SEE WHEN LOGIN //

    /** @test */
    public function what_user_can_see()
    {
        $this->response=$this->get('/admin/dashboard');

        $this->assertViewSee(['Dashboard','Properties']);

        $this->assertViewNotSee(['Contacts','Authentication']);
    }

    // WHAT USER ROLE USER CAN NOT DO //

    // contact

    /** @test */
    public function user_can_not_list_contact()
    {
        $this->get('/admin/contact')
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_show_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->get('/admin/contact/'.$contact->id.'/show')
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_create_contact()
    {
        $contact = factory(Contact::class)->make();

        $this->post('/admin/contact',$contact->toArray())
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_update_contact()
    {
        $contact = factory(Contact::class)->create();

        $editContact = factory(Contact::class)->make(['id'=>$contact->id]);

        $this->put('/admin/contact/'.$contact->id,$editContact->toArray())

             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_delete_contact()
    {
        $contact = factory(Contact::class)->create();

        $this->delete('/admin/contact/'.$contact->id)
             ->assertStatus(403);
    }

    // Account

    /** @test */
    public function user_can_not_list_account()
    {
        $this->get('/admin/account')

             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_show_account()
    {
        $account = factory(Account::class)->create();

        $this->get('/admin/account/'.$account->id.'/show')
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_create_account()
    {
        $account = factory(Account::class)->make();

        $this->post('admin/account',$account->toArray())
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_update_account()
    {
        $account = factory(Account::class)->create();

        $editAccount = factory(Account::class)->make(['id'=>$account->id]);

        $this->put('/admin/account/'.$account->id,$editAccount->toArray())
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_delete_account()
    {
        $account = factory(Account::class)->create();

        $this->delete('/admin/account/'.$account->id)
             ->assertStatus(403);
    }

    // User

    /** @test */
    public function user_can_not_list_user()
    {
        $this->get('/admin/user')
             ->assertStatus(403);
    }

    /** @test */
    // public function user_can_not_create_user()
    // {
    //     $user = factory(User::class)->make();

    //     $this->post('/admin/user',$user->toArray())
    //          ->assertStatus(403);
    // }

    /** @test */
    public function user_can_not_update_user()
    {
        $user = factory(User::class)->create();

        $editUser = factory(User::class)->make(['id'=>$user->id]);

        $this->put('/admin/user/'.$user->id,$editUser->toArray())
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_delete_user()
    {
        $user = factory(User::class)->create();

        $this->delete('/admin/user/'.$user->id)
             ->assertStatus(403);
    }

    // Role

    /** @test */
    public function user_can_not_list_role()
    {
        $this->get('/admin/role')
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_create_role()
    {
        $role = ['name'=>\Str::random(4)];

        $this->post('/admin/role',$role)
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_update_role()
    {
        $role = ModelsRole::create(["name"=>\Str::random(4)]);

        $this->put('/admin/role/'.$role->id,["name"  => \Str::random(4)])
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_delete_role()
    {
        $role = ModelsRole::create(["name"=>\Str::random(4)]);

        $this->delete('/admin/role/'.$role->id)
             ->assertStatus(403);
    }

    // Permission

    /** @test */
    public function user_can_not_list_permission()
    {
        $this->get('/admin/permission')
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_create_permission()
    {
        $permission = ['name'=>\Str::random(8)];

        $this->post('/admin/permission',$permission)
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_update_permission()
    {
        $permission = Permission::create(["name"=>\Str::random(4)]);

        $this->put('/admin/permission/'.$permission->id,["name"  => \Str::random(4)])
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_delete_permission()
    {
        $permission = Permission::create(["name"=>\Str::random(4)]);

        $this->delete('/admin/permission/'.$permission->id)
             ->assertStatus(403);
    }

    // WHAT USER ROLE USER CAN DO //

    /** @test */
    public function user_can_list_property()
    {
        $this->get('/admin/property')
             ->assertStatus(200)
             ->assertViewIs('crud::list');
    }

    /** @test */
    public function user_can_show_property()
    {
        $property = factory(Property::class)->create();

        $this->get('/admin/property/'.$property->id.'/show')
             ->assertStatus(200)
             ->assertViewIs('properties.show');
    }

    /** @test */
    public function user_can_create_property()
    {
        $property = $this->createProperty();

        $this->assertDatabaseHas('properties', [
            'address' => $property['address'],
            'land_width' =>$property['land_width'],
            'land_length' => $property['land_length']
        ]);
    }

    /** @test */
    public function user_can_update_property()
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
    public function user_can_delete_property()
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

