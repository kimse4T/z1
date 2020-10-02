<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Listing Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/admin/update/propertylisting" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="font-weight-600">Property ID</label>
                        <div class="bg-light p-2 rounded">
                            <span class="ml-2">{{(str_pad($entry->id, 6, 0, STR_PAD_LEFT))}} : {{$entry->type}}</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group">

                    <div class="col-3">
                        @include('crud::fields.checkbox_button', [
                            "field" => [
                                'name'  => 'is_sale',
                                'label' => 'For Sale',
                                'type'  => 'checkbox_button',
                                'value' =>  $entry->is_sale,
                                'wrapper' => ''

                            ],
                        ])
                    </div>
                    <div class="col-3">
                        @include('crud::fields.checkbox_button', [
                            "field" => [   // Checkbox
                                'name'  => 'is_rent',
                                'label' => 'For Rent',
                                'type'  => 'checkbox_button',
                                'value' =>  $entry->is_rent,
                                'wrapper' => ''
                            ],
                        ])
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        @include('crud::fields.text', [
                            "field" => [   // Text
                                'name'  => 'sale_list_price',
                                'label' => '<b>Listing sale price</b>',
                                'type'  => 'text',
                            ],
                        ])
                    </div>
                    <div class="col-3">
                        @include('crud::fields.text', [
                            "field" => [   // Text
                                'name'  => 'rent_price',
                                'label' => '<b>Listing Rental Price</b>',
                                'type'  => 'text',
                            ],
                        ])
                    </div>
                    <div class="col-3">
                        @include('crud::fields.select2', [
                            "field" => [  // Select2
                                'label'     => "Owner Name <span class='text-danger'>*</span>",
                                'type'      => 'select2',
                                'name'      => 'owner_id', // the db column for the foreign key

                                // optional
                                'entity'    => 'contact', // the method that defines the relationship in your Model
                                'model'     => "App\Models\Contact", // foreign key model
                                'attribute' => 'fullName', // foreign key attribute that is shown to user
                                'default'   => $entry->owner_id, // set the default value of the select2

                                    // also optional
                                    'options'   => (function ($query) {
                                        return $query->get();
                                    }),
                            ],
                        ])
                    </div>
                    <div class="col-3">
                        @include('crud::fields.select2', [
                            "field" => [  // Select2
                                'label'     => "Land Specialist Name <span class='text-danger'>*</span>",
                                'type'      => 'select2',
                                'name'      => 'contact_id', // the db column for the foreign key

                                // optional
                                'entity'    => 'contact', // the method that defines the relationship in your Model
                                'model'     => "App\Models\Contact", // foreign key model
                                'attribute' => 'fullName', // foreign key attribute that is shown to user
                                'default'   => $entry->contact_id, // set the default value of the select2

                                    // also optional
                                    'options'   => (function ($query) {
                                        return $query->get();
                                    }),
                            ],
                        ])
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        @include('crud::fields.text', [
                            "field" => [   // Text
                                'name'  => 'sale_commission',
                                'label' => '<b>Sale Commission</b>',
                                'type'  => 'text',
                            ],
                        ])
                    </div>
                    <div class="col-3">
                        @include('crud::fields.text', [
                            "field" => [   // Text
                                'name'  => 'rental_commission',
                                'label' => '<b>Rental Commission</b>',
                                'type'  => 'text',
                            ],
                        ])
                    </div>
                    <div class="col-3">
                        @include('crud::fields.date', [
                            "field" => [   // DateTime
                                'name'  => 'agreement_sign_date',
                                'label' => 'Sign Date',
                                'type'  => 'date',

                                // optional:
                                'datetime_picker_options' => [
                                    'format' => 'DD/MM/YYYY HH:mm',
                                    'language' => 'en'
                                ],
                                'allows_null' => true,
                                'default' => $entry->agreement_sign_date,
                            ],
                        ])
                    </div>
                    <div class="col-3">
                        @include('crud::fields.date', [
                            "field" => [   // DateTime
                                'name'  => 'agreement_expired_date',
                                'label' => 'Sign Date',
                                'type'  => 'date',

                                // optional:
                                'datetime_picker_options' => [
                                    'format' => 'DD/MM/YYYY HH:mm',
                                    'language' => 'en'
                                ],
                                'allows_null' => true,
                                'default' => $entry->agreement_expired_date,
                            ],
                        ])
                    </div>
                    <div class="col-3">
                        @include('crud::fields.hidden', [
                            "field" => [
                                'name'  => 'id',
                                'type'  => 'hidden',
                                'value' =>  $entry->id,
                            ],
                        ])
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        @include('crud::fields.select2_from_array', [
                            "field" => [   // select2_from_array
                                'name'        => 'agreement_type',
                                'label'       => "Agreement Type",
                                'type'        => 'select2_from_array',
                                'options'     => [
                                    ''=>'-','property listing form' => 'Property Listing Form',
                                    'commission' => 'Commission',
                                    'exclusive'=>'L-Exclusive'
                                ],
                                'allows_null' => true,
                                'default'     => $entry->agreement_type,
                                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
                            ],
                        ])
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        @include('crud::fields.multiple_upload_preview',[
                            "field" => [
                                'name'=> 'agreement_file',
                                'label'=> '',
                                'type'=> 'multiple_upload_preview'
                            ]
                        ])
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        @include('crud::fields.summernote', [
                            "field" => [
                                'name'  => 'description',
                                'label' => 'Additional Information',
                                'type'  => 'summernote',
                            ]
                        ])
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="buttonSubmit">Update and Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</form>
</div>

@push('after_styles')
@stack('crud_fields_styles')
    <style>
    </style>
@endpush

@push('after_scripts')
    @stack('crud_fields_scripts')
    <script type="text/javascript">
    $(function() {
        $('.select2-selection').addClass('border-selection');
        $('.select2-container').addClass('w-100');

        $("#buttonSubmit").on('click',function(){
            new Noty({
                type: "success",
                text: 'Property stasus has change successfully!',
            }).show();
        });

        $('.is_sale_button_checkbox button').on('click',function(){
            if($('.is_sale_button_checkbox button').attr('class')=='btn btn-sm btn-primary active'){
                $('.is_sale_button_checkbox input[type="hidden"]').attr('value','1')
            }else{
                $('.is_sale_button_checkbox input[type="hidden"]').attr('value','0')
            }
        })

        $('.is_rent_button_checkbox button').on('click',function(){
            if($('.is_rent_button_checkbox button').attr('class')=='btn btn-sm btn-primary active'){
                $('.is_rent_button_checkbox input[type="hidden"]').attr('value','1')
            }else{
                $('.is_rent_button_checkbox input[type="hidden"]').attr('value','0')
            }
        })

    });

    if (typeof rmInitializeFieldsWithJavascript != 'function') {
        // Clone backpack initFunction
        function rmInitializeFieldsWithJavascript(container) {
            var selector;
            if (container instanceof jQuery) {
                selector = container;
            } else {
                selector = $(container);
            }
            selector.find("[data-init-function]").not("[data-initialized=true]").each(function () {
                var element = $(this);
                var functionName = element.data('init-function');

                if (typeof window[functionName] === "function") {
                window[functionName](element);

                // mark the element as initialized, so that its function is never called again
                element.attr('data-initialized', 'true');
                }
            });
        }
    }
    </script>
@endpush
