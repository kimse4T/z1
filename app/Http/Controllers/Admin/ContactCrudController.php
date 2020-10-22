<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Contact;
use App\Traits\PermissionTrait;

/**
 * Class ContactCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use PermissionTrait;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Contact::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contact');
        CRUD::setEntityNameStrings('contact', 'contacts');
        $this->crud->setCreateView('contacts.create');
        $this->crud->setEditView('contacts.edit');
        $this->crud->setShowView('contacts.show');
        if(request()->is_vip){
            $this->crud->addClause('where', 'is_vip', '=', '1');
        }
        $this->setPermission($this->crud,'contact');

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns


        $this->crud->addColumn([
            'name'      => 'id',
            'lable'     => 'Contact ID',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'label' => "Contact Name",
            'type' => "model_function",
            'function_name' => 'getFullNameAttribute',
        ]);

        $this->crud->addColumn([
            'name'      => 'phone',
            'lable'     => 'Mobile Phone',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'occupation',
            'lable'     => 'Position/Occupation',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'type',
            'label'     => 'Contact Type',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'account_id',
            'label'     => 'Account',
            'type'      => 'select',
            'entity'    => 'account', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\Account",
        ]);

        $this->crud->addColumn([
            'name'      => 'identity_card',
            'label'     => 'Identity Card Number',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'address',
            'label'     => 'Address',
            'type'      => 'text'
        ]);


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ContactRequest::class);

        // dd(request());
        //CRUD::setFromDb(); // fields

        $this->crud->addField([   // CustomHTML
            'name'  => 'separator',
            'type'  => 'custom_html',
            'value' => '<h4 class="mb-0 mt-4">Contact Information</h4>'
        ]);

        $this->crud->addField([
            'name'      => 'first_name',
            'label'     => 'First Name',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'last_name',
            'label'     => 'Last Name',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'salutation',
            'label'       => "Salutation",
            'type'        => 'select2_from_array',
            'options'     => ['mr.' => 'Mr.', 'ms.' => 'Ms.','mrs.' => 'Mrs.'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'type',
            'label'       => "Contact Type",
            'type'        => 'select2_from_array',
            'options'     => ['owner' => 'Owner', 'agent' => 'Agent','brokery' => 'Brokery','buyer' => 'Buyer'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'phone',
            'label'     => 'Mobile Phone',
            'type'      => 'phone',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'phone_2',
            'label'     => 'Business Phone',
            'type'      => 'phone',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'email',
            'label'     => 'Email',
            'type'      => 'email',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_nested
            'name'      => 'account_id',
            'label'     => "Account",
            'type'      => 'select',
            'entity'    => 'account', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user

            'model'     => "App\Models\Account",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'is_vip',
            'label' => 'VIP Contact',
            'type'  => 'checkbox_button',
            'wrapper'   => 'form-group col-md-6 col-6',

        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'separator2',
            'type'  => 'custom_html',
            'value' => '<h4 class="mb-0 mt-4">Personal Information</h4>'
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'working_field',
            'label'       => "Working Field",
            'type'        => 'select2_from_array',
            'options'     => [
                'advertising_and_media' => 'Advertising and Media/Entertainment',
                'agriculture_and_fisher' => 'Agriculture and Fishery',
                'engineering' => 'Engineering',
                'other' => 'Other'
            ],
            'allows_null' => false,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'occupation',
            'label'       => "Position/Occupation",
            'type'        => 'select2_from_array',
            'options'     => [
                'manager' => 'Manager',
            ],
            'allows_null' => false,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'relationship',
            'label'       => "Relationship",
            'type'        => 'select2_from_array',
            'options'     => [
                'single' => 'Single',
                'married'=> 'Married',
            ],
            'allows_null' => false,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'identity_card',
            'label'     => 'Identity Card Number',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'date_of_birth',
            'label'     => 'Date of Birth',
            'type'      => 'date_picker',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'remark',
            'label'     => 'Remark',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        // $this->crud->addField([
        //     'name'      => 'identify_card_image',
        //     'label'     => 'Identity card photos (Each photo is limited within 2MB.)',
        //     'type'      => 'property_gallery',

        // ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'Address',
            'type'  => 'custom_html',
            'value' => '<h4 class="mb-0 mt-4">Address</h4>'
        ]);

        $this->crud->addField([
            'name'      => 'address',
            'label'     => 'Address',
            'type'      => 'text',

        ]);

        $this->crud->addField([
            'name'      => 'house_no',
            'label'     => 'House No.',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'street_no',
            'label'     => 'Street No./Name',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'Location',
            'type'  => 'custom_html',
            'value' => '<h4 clLass="mb-0 mt-4">Location Map</h4>'
        ]);

        $this->crud->addField([
            'name'      => 'latitude',
            'label'     => 'Latitude',
            'type'      => 'hidden',
        ]);

        $this->crud->addField([
            'name'      => 'longitude',
            'label'     => 'Longitude',
            'type'      => 'hidden',
        ]);

        // $this->crud->addField([
        //     'name'      => 'map',
        //     'label'     => 'Google Map',
        //     'type'      => 'googlemap',
        //     'fake'      => true,
        // ]);






        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {

        $response = $this->traitStore();

        return $response;
    }



    public function contact(ContactRequest $request) {
        $term = $request->input('term');
        $options = Contact::where('first_name', 'like', '%'.$term.'%')->get()->pluck('first_name', 'id');
        return $options;
      }

}
