<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PropertyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Contact;
use App\Models\Property;
use App\Repositories\PropertyTitleDeedRepository;
use App\Repositories\UnitRepository;
use GuzzleHttp\Psr7\Request;
use Prologue\Alerts\Facades\Alert;

/**
 * Class PropertyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PropertyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    protected $propertyTitleDeedRepo;
    protected $unitRepo;

    public function setup()
    {
        CRUD::setModel(\App\Models\Property::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/property');
        CRUD::setEntityNameStrings('property', 'properties');
        $this->crud->setCreateView('properties.create');
        $this->crud->setEditView('properties.edit');
        $this->crud->setShowView('properties.show');
        $this->propertyTitleDeedRepo = resolve(PropertyTitleDeedRepository::class);
        $this->unitRepo = resolve(UnitRepository::class);

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
            'name'  => 'id',
            'label' => 'Property ID',
            'type'  => 'text'
        ]);

        $this->crud->addColumn([
            'name'      => 'image', // The db column name
            'label'     => 'Image', // Table column heading
            'type'      => 'image',
            //'prefix' => 'public/properties/img/front',
            // image from a different disk (like s3 bucket)
            // 'disk'   => 'disk-name',
            // optional width/height if 25px is not ok with you
            // 'height' => '30px',
            // 'width'  => '30px',
        ],);

        $this->crud->addColumn([
            'name'  => 'type',
            'label' => 'Type',
            'type'  => 'text'
        ]);

        $this->crud->addColumn([
            'name'  => 'status',
            'label' => 'Status',
            'type'  => 'text'
        ]);

        $this->crud->addColumn([
            'name'  => 'is_sale',
            'label' => 'Sale',
            'type'  => 'check'
        ]);

        $this->crud->addColumn([
            'name'  => 'is_rent',
            'label' => 'Rent',
            'type'  => 'check'
        ]);

        $this->crud->addColumn([
            'name'  => 'is_appraisal',
            'label' => 'Indication',
            'type'  => 'check'
        ]);

        $this->crud->addColumn([
            'name'  => 'is_sale',
            'label' => 'Sale',
            'type'  => 'check'
        ]);

        $this->crud->addColumn([
            'name'  => 'PropertyFullAddress',
            'label' => 'Address',
            'type'  => 'text'
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


        //add filter

        $this->crud->addFilter([
            'name'  => 'type',
            'type'  => 'text',
            'label' => 'Type'
        ],false, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'type', 'LIKE' , $value);
        });

        $this->crud->addFilter([
        'name'        => 'contact_id',
        'type'        => 'select2_ajax',
        'label'       => 'Land Specialize',
        'placeholder' => 'Pick a Land Specialize'
        ],
        url('admin/contact/ajax-contact'), // the ajax route
        function($value) { // if the filter is active
            if(!empty($value)){
                $this->crud->addClause('where', 'contact_id' ,'LIKE', $value);
            }
        });
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


        CRUD::setValidation(PropertyRequest::class);

        //CRUD::setFromDb(); // fields



        $this->crud->addField([   // CustomHTML
            'name'  => 'property_script',
            'type'  => 'property.property_script',
        ]);


        $this->crud->addField([   // CustomHTML
            'name'  => 'separator',
            'type'  => 'custom_html',
            'value' => '<h4 class="border-bottom pb-2 mb-0">Property Information</h4>'
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'is_sale',
            'label' => 'For Sale',
            'type'  => 'checkbox_button',
            'wrapper'   => 'form-group col-md-6 col-6',
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'is_rent',
            'label' => 'For Rent',
            'type'  => 'checkbox_button',
            'wrapper'   =>  'form-group col-md-6 col-6'
        ]);

        $this->crud->addField([
            'label'=>'Owner',
            'type' => "relationship",
            'name' => 'owner', // the method on your model that defines the relationship
            'entity' => 'contact',
            'attribute' => 'first_name',
            'wrapperAttributes' => [
                'class'      => 'form-group col-md-6 col-6'
            ],
            'inline_create' => [ // specify the entity in singular
                'entity' => 'contact', // the entity in singular
                'modal_class' => 'modal-dialog modal-md', // use modal-sm, modal-lg to change width
                'modal_route' => route('contact-inline-create'), // InlineCreate::getInlineCreateModal()
                'create_route' =>  route('contact-inline-create-save'), // InlineCreate::storeInlineCreate()
            ],

        ]);

        $this->crud->addField([
            'label'=>'Land Specialist',
            'type' => "relationship",
            'name' => 'contact_id', // the method on your model that defines the relationship
            'placeholder'=> "Select a account",
            'attribute' => "FullName",
            'wrapperAttributes' => [
                'class'      => 'form-group col-md-6 col-6'
            ]]
        );

        $this->crud->addField([   // CustomHTML
            'name'  => 'Upload',
            'type'  => 'custom_html',
            'value' => ' <nav class="navbar navbar-light bg-light d-block mt-3">
            <label class="navbar-brand mb-0 h4 font-weight-normal mr-0 ">Upload Property Photo</label>
            <label class="h6 mb-0 font-weight-normal label-custom">(Each photo is limited within 2MB.)</label>
            </nav>
            '
        ]);

        $this->crud->addField([
            'name'  => 'image',
            'label' => 'Front Side',
            'type'  => 'image',
            'wrapperAttributes' => [
                'class'      => 'form-group col-md-2 col-6 bp-image-full-preview'
            ],
            'default'=>'/properties/img/photo-front.jpg',
            'aspect_ratio' => 1,
        ]);


        $this->crud->addField([
            'name'  => 'image_left_side',
            'label' => 'Left Side',
            'type'  => 'image',
            'wrapperAttributes' => [
                'class'      => 'form-group col-md-2 col-6 bp-image-full-preview'
            ],
            'default'=>'/properties/img/photo-left.jpg'
        ]);

        $this->crud->addField([
            'name'  => 'image_right_side',
            'label' => 'Right Side',
            'type'  => 'image',
            'wrapperAttributes' => [
                'class'      => 'form-group col-md-2 col-6 bp-image-full-preview'
            ],
            'default'=>'/properties/img/photo-right.jpg'
        ]);

        $this->crud->addField([
            'name'  => 'image_back_side',
            'label' => 'Back Side',
            'type'  => 'image',
            'wrapperAttributes' => [
                'class'      => 'form-group col-md-2 col-6 bp-image-full-preview'
            ],
            'default'=>'/properties/img/photo-back.jpg'
        ]);

        $this->crud->addField([
            'name'  => 'image_opposite',
            'label' => 'Opposite',
            'type'  => 'image',
            'wrapperAttributes' => [
                'class'      => 'form-group col-md-2 col-6 bp-image-full-preview'
            ],
            'default'=>'/properties/img/photo-opposite.jpg'
        ]);

        // $this->crud->addField([
        //     'name'  => 'gallery',
        //     'label' => 'Gallery (Each photo is limited within 2MB.)',
        //     'type'  => 'multiple_upload_preview',
        // ]);

        $this->crud->addField([
            'name' => "gallery",
            'type' => 'multiple_upload_preview',
            'label' => [trans('Gallery'), trans('Each photo is limited within 2MB.')],
            //'upload' => true,
        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'address_info',
            'type'  => 'custom_html',
            'value' => ' <nav class="navbar navbar-light bg-light d-block mt-3">
            <label class="navbar-brand mb-0 h4 font-weight-normal mr-0 ">Address</label>
            </nav>
            '
        ]);

        $this->crud->addField([
            'name'  => 'address',
            'type'  => 'address',
            'label' => 'Address',
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'street_no',
            'label' => 'Street No./Name',
            'type'  => 'text',
            'wrapper'   => [
                'class'      => 'form-group col-md-6 col-6'
            ],

        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'house_no',
            'label' => 'House No.',
            'type'  => 'text',
            'wrapper'   => [
                'class'      => 'form-group col-md-6 col-6'
            ],
        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'property_basic_info',
            'type'  => 'custom_html',
            'value' => ' <nav class="navbar navbar-light bg-light d-block mt-3">
            <label class="navbar-brand mb-0 h4 font-weight-normal mr-0 ">Property Basic Information</label>
            </nav>
            '
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'record_type',
            'label'       => "Record Type",
            'type'        => 'select2_from_array',
            'options'     => ['land' => 'Land', 'building' => 'Building','land_and_building' => 'Land and Building'],
            'default'     => request()->record_type,
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'type',
            'label'       => "Property Type",
            'type'        => 'select2_from_array',
            'options'     => ['residential' => 'Residential property', 'commercial' => 'Commercail Property','industrial' => 'Industrial Property','specialized' => 'Specialized Property','mixed' => 'Mixed Use'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'current_use',
            'label'       => "Current Use",
            'type'        => 'select2_from_array',
            'options'     => [],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'data_source',
            'label'       => "Data Source",
            'type'        => 'select2_from_array',
            'options'     => ['owner' => 'Owner','agent' => 'Agent','brokery' => 'Brokery','buyer' => 'Buyer'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'land_width',
            'label' => 'Width',
            'type'  => 'text',
            'wrapper'   => [
                'class'      => 'form-group col-md-6 col-6'
            ],
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'land_length',
            'label' => 'Length',
            'type'  => 'text',
            'wrapper'   => [
                'class'      => 'form-group col-md-6 col-6'
            ],
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'land_area',
            'label' => 'Total Size',
            'type'  => 'text',
            'wrapper'   => [
                'class'      => 'form-group col-md-6 col-6'
            ],
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'tenure_type',
            'label'       => "Tenure",
            'type'        => 'select2_from_array',
            'options'     => ['freehold' => 'FreeHold','leasehold' => 'LeaseHold'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'zone_type',
            'label'       => "Zoning",
            'type'        => 'select2_from_array',
            'options'     => ['residentail' => 'Residential','industrial' => 'Industrial','commercial' => 'Residential/Commercial','agricultural' => 'Agricultural','agricultural/residential' => 'Agricultural/Residential'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'view',
            'label'       => "View",
            'type'        => 'select2_from_array',
            'options'     => ['north' => 'North','east' => 'East','west' => 'West','south'=>'South'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'topography',
            'label'       => "Topography",
            'type'        => 'select2_from_array',
            'options'     => ['level' => 'Level','unlevelled' => 'Unlevelled','unfilled' => 'Unfilled'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'shape',
            'label'       => "Shape",
            'type'        => 'select2_from_array',
            'options'     => ['rectangle' => 'Rectangle','square' => 'Square','l-shape' => 'L-Shape','triangle' => 'Triangle','irregular' => 'Irregular'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'a',
            'type'        => 'hidden',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'b',
            'label'       => "Site Position",
            'type'        => 'select2_from_array',
            'options'     => ['corner_lot' => 'Corner Lot','intermediate_lot' => 'Intermediate Lot','end-lot' => 'End Lot'],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);



        $this->crud->addField([   // CustomHTML
            'name'  => 'title_deed_info',
            'type'  => 'custom_html',
            'value' => ' <nav class="navbar navbar-light bg-light d-block mt-3">
            <label class="navbar-brand mb-0 h4 font-weight-normal mr-0 ">Title Deed Information</label>
            </nav>
            '
        ]);

        $this->crud->addField([   // repeatable
            'name'  => 'propertyTitleDeedRepeatable',
            'label' => 'Title Deed',
            'type'  => 'repeatable',
            'fields' => [
                [
                    'name'      => 'id',
                    'type'      => 'hidden',
                    'label'     =>'ID',
                ],
                [
                    'name'        => 'title_deed_type',
                    'label'       => "Title Deed Type",
                    'type'        => 'select2_from_array',
                    'options'     => [
                                      'hard_lmap' => 'Hard (LMAP)',
                                      'hard_sporadic_registration' => 'Hard (Sporadic Registration)',
                                      'letter_of_possession_transfer' => 'Letter of Possession Transfer',
                                      'strata_title' => 'Strata Title',
                                      'sale_and_purchase_agreement' => 'Sale and Purchase Agreement',
                                      'long_term_lease' => 'Long-Term lease',
                                      'soft_title_unspecified' => 'Soft Title (unspecified)',
                                      'hard_title_unspecified' => 'Hard Title (unspecified)'
                                    ],
                    'allows_null' => true,
                    'wrapper' => [
                        'class' => 'form-group col-md-6 title_deed_type',
                    ]
                ],
                [
                    'name'    => 'title_deed_no',
                    'type'    => 'text',
                    'label'   => 'Title Deed No.',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
                [
                    'name'    => 'issued_year',
                    'type'    => 'text',
                    'label'   => 'Issued Year',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
                [
                    'name'    => 'parcel_no',
                    'type'    => 'text',
                    'label'   => 'Parcel No.',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
                [
                    'name'    => 'total_size_by_title_deed',
                    'type'    => 'text',
                    'label'   => 'Total Size By Title Deed',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
                [   // Hidden
                    'name'  => 'hidden',
                    'type'  => 'hidden',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
                [
                    'name'  => 'title_deed_image',
                    'label' => 'Upload Title Deed Photos',
                    'type'  => 'image',
                    'wrapperAttributes' => [
                        'class'      => 'form-group col-md-3 col-6 bp-image-full-preview'
                    ],
                    'default'=>'/properties/img/default.png',
                ]

            ],

            // optional
            'new_item_label'  => 'New Item', // customize the text of the button
        ],);



        $this->crud->addField([   // CustomHTML
            'name'  => 'building_info',
            'type'  => 'custom_html',
            'value' => '<div id="building-title"> <nav class="navbar navbar-light bg-light d-block mt-3">
            <label class="navbar-brand mb-0 h4 font-weight-normal mr-0 ">Building Information</label>
            </nav></div>
            '
        ]);
        $this->crud->addField([
            'name' => 'test',
            'type' => 'create_building',
            'label'=> 'Building',
            'wrapper'   => ['class'=>'col-md-12'],
        ]);



        $this->crud->addField([   // CustomHTML
            'name'  => 'Indication',
            'type'  => 'custom_html',
            'value' => ' <nav class="navbar navbar-light bg-light d-block mt-3">
            <label class="navbar-brand mb-0 h4 font-weight-normal mr-0 ">Indication</label>
            </nav>
            '
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'is_appraisal',
            'label' => 'Request Indication',
            'type'  => 'checkbox_button',
            'wrapper'   => 'form-group col-md-6 col-6',

        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'price_and_commission',
            'type'  => 'custom_html',
            'value' => ' <nav class="navbar navbar-light bg-light d-block mt-3">
            <label class="navbar-brand mb-0 h4 font-weight-normal mr-0 ">Price and Commission</label>
            </nav>
            '
        ]);

        $this->crud->addField([
            'name'  => 'priceCommission',
            'type'  =>  'price_and_commission'
        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'agreement_info',
            'type'  => 'custom_html',
            'value' => ' <nav class="navbar navbar-light bg-light d-block mt-3">
            <label class="navbar-brand mb-0 h4 font-weight-normal mr-0 ">Agreement information</label>
            </nav>
            '
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'agreement_type',
            'label'       => "Agreement Type",
            'type'        => 'select2_from_array',
            'options'     => ['property_listing_form' => 'Property Listing Form',
                              'commission_agreement' => 'Commission Agreement',
                              'exclusive_agreement' => 'Exclusive Agreement'
                            ],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'agreement_sign_date',
            'label'       => "Sign Date",
            'type'        => 'date_picker',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // Hidden
            'name'  => 'hidden',
            'type'  => 'hidden',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        $this->crud->addField([   // select2_from_array
            'name'        => 'agreement_expired_date',
            'label'       => "Expired Date",
            'type'        => 'date_picker',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        // $this->crud->addField([
        //     'name'  => 'agreement_file',
        //     'label' => [trans('Upload Agreement File'), trans('Each file is limited within 2MB.')],
        //     'type'  => 'multiple_upload_preview',
        // ]);

        $this->crud->addField([
            'name' => "agreement_file",
            'type' => 'multiple_upload_preview',
            'label' => [trans('Upload Agreement File'), trans('Each photo is limited within 2MB.')],
            'upload' => true,
        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'addition_info',
            'type'  => 'custom_html',
            'value' => ' <nav class="navbar navbar-light bg-light d-block mt-3">
            <label class="navbar-brand mb-0 h4 font-weight-normal mr-0 ">Additional information</label>
            </nav>
            '
        ]);

        $this->crud->addField([   // Summernote
            'name'  => 'description',
            'type'  => 'summernote',
            // 'options' => [], // easily pass parameters to the summernote JS initialization
        ]);

        $this->crud->addField([
            'name'  =>  'status',
            'type'  =>  'hidden',
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

    protected function fetchContact()
    {
        return $this->fetch(Contact::class);
    }

    public function priceAndCommission()
    {
        $this->crud->addField(['type' => 'hidden', 'name' => 'sale_price_asking']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'sale_asking_price_per_sqm']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'sale_price']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'sale_price_per_sqm']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'sale_list_price']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'sale_listing_price_per_sqm']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'sold_price']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'sold_price_per_sqm']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'sale_commission']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'rent_price_asking']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'rent_asking_price_per_sqm']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'rent_price']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'rent_price_per_sqm']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'rent_list_price']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'rent_listing_price_per_sqm']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'rented_price']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'rented_price_per_sqm']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'rental_commission']);
    }

    public function update()
    {
        //dd(request());
        $status=Property::find(request()->id)->status;
        if($status=='Listing'){
            \Alert::add('error', 'You can not update this Property because it is in Listing')->flash();
            return redirect('admin/property');
        }else{
            if($status!="Draft"&& request()->is_appraisal=="0"){
                \Alert::add('error', 'Request Indication Need!')->flash();
                return redirect('admin/property');
            }else{
                $this->priceAndCommission();
                $respone = $this->traitUpdate();
                $unit_id=array();
                foreach($this->crud->entry->units as $index ){
                    array_push($unit_id,$index->id);
                }
                $title_deed_id=array();
                foreach($this->crud->entry->titledeeds as $index ){
                    array_push($title_deed_id,$index->id);
                }
                $this->unitRepo->update(request(),$unit_id);
                $this->propertyTitleDeedRepo->update(request(),$title_deed_id,$this->crud->entry->id);
                return $respone;
            }
        }
    }

    public function store()
    {
        dd(request());
        $this->priceAndCommission();
        $respone = $this->traitStore();
        $pro=Property::find($this->crud->entry->id);
        $pro->status='Draft';
        $pro->save();
        $this->propertyTitleDeedRepo->create(request(),$this->crud->entry->id);
        $this->unitRepo->create(request(),$this->crud->entry->id);
        return $respone;
    }

    public function updateStatus($id){
        $update_property=Property::find($id);
        $status=$update_property->status;
        if($status=="Draft"){
            $update_property->status="Property Pending";
        }else if($status=="Property Pending"){
            $update_property->status="Property";
        }else if($status=="Property"){
            $update_property->status="Listing Pending";
        }else{
            $update_property->status="Listing";
        }
        $update_property->save();
        return response()->json([
            'status' => $update_property->status
        ]);
    }

    public function updateIndication ($id)
    {
        $update_property=Property::find($id);
        $update_property->is_appraisal=1;
        $update_property->save();
        return response()->json([
            'message' => 'Property is Appraisal'
        ]);
    }

    public function UpdatePropertyListing()
    {
        $propertylisting = Property::find(request()->id);
        $propertylisting->is_rent=request()->is_rent;
        $propertylisting->is_sale=request()->is_sale;
        $propertylisting->sale_list_price=request()->sale_list_price;
        $propertylisting->rent_list_price=request()->rent_list_price;
        $propertylisting->owner_id=request()->owner_id;
        $propertylisting->contact_id=request()->contact_id;
        $propertylisting->sale_commission=request()->sale_commission;
        $propertylisting->rental_cmmission=request()->rental_commission;
        $propertylisting->agreement_type=request()->agreement_type;
        $propertylisting->agreement_sign_date=request()->agreement_sign_date;
        $propertylisting->agreement_expired_date=request()->agreement_expired_date;
        $propertylisting->agreement_file=request()->agreement_file;
        $propertylisting->description=request()->description;
        $propertylisting->save();
        return redirect('/admin/property/'.request()->id.'/show');
    }

}
