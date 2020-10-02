<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ListingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Property;
use App\Models\Listing;
use App\Listing as Liststore;
use PhpParser\Node\Expr\Cast\Array_;

use function GuzzleHttp\json_decode;

/**
 * Class ListingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ListingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Listing::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/listing');
        CRUD::setEntityNameStrings('listing', 'listings');
        $this->crud->setShowView('listings.show');
        $this->crud->setEditView('listings.edit');
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

        CRUD::removeButton('create');

        $this->crud->addColumn([
            'label' => 'Listing ID',
            'name'  => 'id'
        ]);

        $this->crud->addColumn([
            'label' => 'Property ID',
            'name'  => 'property_id'
        ]);

        $this->crud->addColumn([
            'label' => 'Sale',
            'name'  => 'is_sale',
            'type'  => 'check'
        ]);

        $this->crud->addColumn([
            'label' => 'Rent',
            'name'  => 'is_rent',
            'type'  => 'check'
        ]);

        $this->crud->addColumn([
            'label' => 'Status',
            'name'  => 'status'
        ]);

        $this->crud->addColumn([
            'name'      => 'owner_id',
            'label'     => 'Owner',
            'type'      => 'select',
            'entity'    => 'owner', // the method that defines the relationship in your Model
            'attribute' => 'FullName', // foreign key attribute that is shown to user
            'model'     => "App\Models\Contact",
        ]);

        $this->crud->addColumn([
            'name'      => 'contact_id',
            'label'     => 'Land Specialist',
            'type'      => 'select',
            'entity'    => 'contact', // the method that defines the relationship in your Model
            'attribute' => 'FullName', // foreign key attribute that is shown to user
            'model'     => "App\Models\Contact",
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
        CRUD::setValidation(ListingRequest::class);

        CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    protected function store($id)
    {
        $property = Property::find($id);
        $listing = new Liststore;
        $listing->property_id=$id;
        $listing->agreement_type=$property->agreement_type;
        //$listing->agreement_file=array();
        //$listing->agreement_file=array_merge($listing->agreement_file,$property->agreement_file);
        $listing->agreement_file=$property->agreement_file;
        $listing->sale_commission=$property->sale_commission;
        $listing->rental_commission=$property->rental_cmmission;
        $listing->contact_id=$property->contact_id;
        $listing->owner_id=$property->owner_id;
        $listing->account_id=$property->account_id;
        $listing->sale_list_price=$property->sale_list_price;
        $listing->sold_price=$property->sold_price;
        $listing->sold_price_date=$property->sold_price_date;
        $listing->rent_list_price=$property->rent_list_price;
        $listing->rented_price=$property->rented_price;
        $listing->rented_price_date=$property->rented_price_date;
        $listing->status='active';
        $listing->is_rent=$property->is_rent;
        $listing->is_sale=$property->is_sale;
        $listing->save();

        $property->listing_id=$listing->id;
        $property->save();

        return response()->json([
            'data'=>$listing,
            'message' => 'Listing created'
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        //$this->setupCreateOperation();
        CRUD::setValidation(ListingRequest::class);

        $this->crud->addField([   // CustomHTML
            'name'  => 'listing_script',
            'type'  => 'listing.listing_script',
        ]);

        $this->crud->addField([
            'name'  =>  'property_id',
            'label' =>  'Property ID',
            'type'  =>  'text',
            'attributes'    => [
                'disabled'  => 'disabled'
            ]
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'is_sale',
            'label' => 'For Sale',
            'type'  => 'checkbox_button',
            'wrapper'   => 'form-group col-md-3',

        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'is_rent',
            'label' => 'For Rent',
            'type'  => 'checkbox_button',
            'wrapper'   =>  'form-group col-md-3'
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'is_rsent',
            'type'  => 'hidden',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'is_raent',
            'type'  => 'hidden',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name'  => 'sale_list_price',
            'label' => 'Listing sale price',
            'type'  => 'text',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ],
        ]);

        $this->crud->addField([
            'name'  => 'rent_list_price',
            'label' => 'Listing rental price',
            'type'  => 'text',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'label'     => "Owner Name",
            'type'      => 'select2',
            'name'      => 'owner_id', // the db column for the foreign key

            // optional
            'entity'    => 'contact', // the method that defines the relationship in your Model
            'model'     => "App\Models\Contact", // foreign key model
            'attribute' => 'fullName', // foreign key attribute that is shown to user

                // also optional
            'options'   => (function ($query) {
                return $query->get();
            }),
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);


        $this->crud->addField([
            'label'     => "Land Specialist Name",
            'type'      => 'select2',
            'name'      => 'contact_id', // the db column for the foreign key

            // optional
            'entity'    => 'contact', // the method that defines the relationship in your Model
            'model'     => "App\Models\Contact", // foreign key model
            'attribute' => 'fullName', // foreign key attribute that is shown to user

                // also optional
                'options'   => (function ($query) {
                    return $query->get();
                }),
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name'  => 'sale_commission',
            'label' => 'Sale Commission',
            'type'  => 'text',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name'  => 'rental_commission',
            'label' => 'Rental Commission',
            'type'  => 'text',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name'  =>  'sign_date',
            'label' =>  'Sign Date',
            'type'  =>  'date_picker',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name'  =>  'expired_date',
            'label' =>  'Expired Date',
            'type'  =>  'date_picker',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'status',
            'label'       => "Sale Status",
            'type'        => 'select2_from_array',
            'options'     => ['active' => 'Active', 'inactive' => 'Inactive','sold' => 'Sold','rented'=>'Rented'],
            'default'     => 'active',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name'  =>  'reason',
            'label' =>  'Provide Reason Inactive',
            'type'  =>  'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-9'
            ]
        ]);

        $this->crud->addField([
            'name'  => 'sold_price',
            'label' => 'Sold Price',
            'type'  => 'number',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name'  => 'sold_price_date',
            'label' => 'Transaction Date',
            'type'  => 'date_picker',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name'  => 'rented_price',
            'label' => 'Rented Price',
            'type'  => 'number',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name'  => 'rented_price_date',
            'label' => 'Transaction Date',
            'type'  => 'date_picker',
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'label'     => "Customer Name",
            'type'      => 'select2',
            'name'      => 'customer_id', // the db column for the foreign key

            // optional
            'entity'    => 'contact', // the method that defines the relationship in your Model
            'model'     => "App\Models\Contact", // foreign key model
            'attribute' => 'fullName', // foreign key attribute that is shown to user

                // also optional
                'options'   => (function ($query) {
                    return $query->get();
                }),
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'label'     => "Sale Land Specialist Name",
            'type'      => 'select2',
            'name'      => 'sale_land_specialist_id', // the db column for the foreign key

            // optional
            'entity'    => 'contact', // the method that defines the relationship in your Model
            'model'     => "App\Models\Contact", // foreign key model
            'attribute' => 'fullName', // foreign key attribute that is shown to user

                // also optional
                'options'   => (function ($query) {
                    return $query->get();
                }),
            'wrapper'   =>  [
                'class' => 'form-group col-md-3'
            ]
        ]);


        $this->crud->addField([   // select2_from_array
            'name'        => 'agreement_type',
            'label'       => "Agreement Type",
            'type'        => 'select2_from_array',
            'options'     => ['property_listing_form' => 'Property Listing Form',
                              'commission_agreement' => 'Commission Agreement',
                              'exclusive_agreement' => 'Exclusive Agreement'
                            ],
            'default'     => 'property_listing_form',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ]);

        $this->crud->addField([
            'name' => "agreement_file",
            'type' => 'multiple_upload_preview',
            'label' => [trans('Upload Agreement File'), trans('(Each photo is limited within 2MB.)')],
            'upload' => true,
        ]);

        $this->crud->addField([   // Summernote
            'name'  => 'description',
            'label' => '',
            'type'  => 'summernote',
            // 'options' => [], // easily pass parameters to the summernote JS initialization
        ]);

    }
    public function update()
    {
        $status=Listing::find(request()->id)->status;
        if($status=="active"){
            $listing=Listing::where([
                ['id','=',request()->id],
                ['is_sale','=',request()->is_sale],
                ['is_rent','=',request()->is_rent],
                ['sale_list_price','=',request()->sale_list_price],
                ['owner_id','=',request()->owner_id],
                ['contact_id','=',request()->contact_id],
                ['sale_commission','=',request()->sale_commission],
                ['status','=',request()->status],
                ['agreement_type','=',request()->agreement_type],
                ['rent_list_price','=',request()->rent_list_price],
                ['rental_commission','=',request()->rental_commission],
                ['sold_price','=',request()->sold_price],
                ['sold_price_date','=',request()->sold_price_date],
                ['rented_price','=',request()->rented_price],
                ['rented_price_date','=',request()->rented_price_ddate],
                ['customer_id','=',request()->customer_id],
                ['sale_land_specialist_id','=',request()->sale_land_specialist_id],
            ])->first();
            if($listing==null){
                if(request()->status=='active'||request()->status=='inactive'){
                    $property=Property::find(Listing::find(request()->id)->property->id);
                    $property->is_sale=request()->is_sale;
                    $property->is_rent=request()->is_rent;
                    $property->sale_list_price=request()->sale_list_price;
                    $property->owner_id=request()->owner_id;
                    $property->contact_id=request()->contact_id;
                    $property->sale_commission=request()->sale_commission;
                    $property->status="Listing Pending";
                    $property->agreement_type=request()->agreement_type;
                    $property->rent_list_price=request()->rent_list_price;
                    $property->rental_cmmission=request()->rental_commission;
                    $property->save();

                    $listing=Listing::find(request()->id);
                    $listing->status='inactive';
                    $listing->is_close='1';
                    $listing->close_reason=request()->reason;
                    $listing->save();
                }else{
                    $property=Property::find(Listing::find(request()->id)->property->id);
                    $property->is_sale=request()->is_sale;
                    $property->is_rent=request()->is_rent;
                    $property->sale_list_price=request()->sale_list_price;
                    $property->owner_id=request()->owner_id;
                    $property->contact_id=request()->contact_id;
                    $property->sale_commission=request()->sale_commission;
                    $property->status="Property";
                    $property->agreement_type=request()->agreement_type;
                    $property->rent_list_price=request()->rent_list_price;
                    $property->rental_cmmission=request()->rental_commission;
                    $property->save();

                    $listing=Listing::find(request()->id);
                    $listing->status=request()->status;
                    if(request()->status=='sold'){
                        $listing->sold_price=request()->sold_price;
                        $listing->sold_price_date=request()->sold_price_date;
                    }else{
                        $listing->rented_price=request()->rented_price;
                        $listing->rented_price_date=request()->rented_price_date;
                    }
                    $listing->customer_id=request()->customer_id;
                    $listing->sale_land_specialist_id=request()->sale_land_specialist_id;
                    $listing->save();
                }
                \Alert::success(trans('backpack::crud.update_success'))->flash();
                return redirect('admin/listing');
            }else{
                return redirect('admin/listing');
            }
        }else{
            \Alert::add('error', 'You can not update this listing because it is not Active')->flash();
            return redirect('admin/listing');
        }

        // $respone = $this->traitUpdate();
        // return redirect('admin/listing');
    }
}
