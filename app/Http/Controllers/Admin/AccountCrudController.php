<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AccountRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AccountCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AccountCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Account::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/account');
        CRUD::setEntityNameStrings('account', 'accounts');
        $this->crud->setCreateView('accounts.create');
        $this->crud->setEditView('accounts.edit');
        $this->crud->setShowView('accounts.show');
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
            'label'     => 'Account ID',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'name',
            'label'     => 'Name',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'account_number',
            'label'     => 'Account Number',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'parent_id',
            'label'     => 'Parent',
            'type'      => 'text'
        ]);


        $this->crud->addColumn([
            'name'      => 'email',
            'label'     => 'Email',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'phone',
            'label'     => 'Phone',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'industry',
            'label'     => 'Industry',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'bank_branch',
            'label'     => 'Bank Branch',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'billing_address',
            'label'     => 'Billing Address',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'valid_until',
            'label'     => 'Valid Until',
            'type'      => 'date',
            'format'    => 'MM/YYYY'
        ]);

        $this->crud->addColumn([
            'name'      => 'website',
            'label'     => 'Website',
            'type'      => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'rating',
            'label'     => 'Rating',
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
        CRUD::setValidation(AccountRequest::class);

        //CRUD::setFromDb(); // fields

        $this->crud->addField([   // select2_nested
            'name'      => 'parent_id',
            'label'     => "Parent",
            'type'      => 'select',
            'entity'    => 'parent', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user

            'model'     => "App\Models\Account",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'name',
            'label'     => 'Account Name',
            'type'      => 'text',
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

        $this->crud->addField([
            'name'      => 'phone',
            'label'     => 'Phone',
            'type'      => 'phone',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'industry',
            'label'     => 'Industry',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'account_number',
            'label'     => 'Account Number',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'bank_branch',
            'label'     => 'Bank Branch',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'billing_address',
            'label'     => 'Billing Address',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'address',
            'label'     => 'Address',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'valid_until',
            'label'     => 'Valid Until',
            'type'      => 'date_picker',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'website',
            'label'     => 'Website',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'      => 'rating',
            'label'     => 'Rating',
            'type'      => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);
        $this->crud->addField([
            'name'  => 'description',
            'label' => 'Description',
            'type'  => 'textarea'
        ]);

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

    protected function setupShowOperation()
    {
        // by default the Show operation will try to show all columns in the db table,
        // but we can easily take over, and have full control of what columns are shown,
        // by changing this config for the Show operation
        $this->crud->set('show.setFromDb', false);


    }
}
