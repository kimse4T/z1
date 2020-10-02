<div id="app">
<div class="modal fade" id="taskActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Task Activity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="bg-light p-2 rounded">
                            Task Activities Information
                        </div>
                    </div>
                </div>
                <div class="row form-group">

                    <div class="col-6">
                        @include('crud::fields.select2_from_array', [
                            "field" => [
                                'name'        => 'activity_type',
                                'label'       => "Activity Type",
                                'type'        => 'select2_from_array',
                                'options'     => [''=>'-',
                                                'Call to owner' => 'Call to owner',
                                                'Visit owner' => 'Visit owner',
                                                'On-Site verification' => 'On-Site verification',
                                                'Commission Agreement'=>'Commission Agreement',
                                                'Exclusive Agreement'=>'Exclusive Agreement'
                                            ],
                            ],
                        ])
                    </div>

                    <div class="col-6">
                        @include('crud::fields.select2_from_array', [
                            "field" => [
                                'name'        => 'status',
                                'label'       => "Status",
                                'type'        => 'select2_from_array',
                                'options'     => ['In Progress' => 'In Progress',
                                                'Done' => 'Done',
                                                'Cancel' => 'Cancel',
                                            ],
                            ],
                        ])
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
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
                    <div class="col-6">
                        @include('crud::fields.date_picker', [
                            "field" => [   // Text
                                'name'  => 'activity_date_time',
                                'label' => 'Activity Date Time',
                                'type'  => 'date_picker',
                            ],
                        ])
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="bg-light p-2 rounded">
                            Please Select Task Activities Related To
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        @include('crud::fields.select2', [
                            "field" => [  // Select2
                                'label'     => "Contact",
                                'type'      => 'select2',
                                'name'      => 'owner_id', // the db column for the foreign key

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
                    <div class="col">
                        @include('crud::fields.summernote', [
                            "field" => [
                                'name'  => 'description',
                                'label' => 'Description',
                                'type'  => 'summernote',
                            ]
                        ])
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col">
                        @include('crud::fields.multiple_upload_preview',[
                            "field" => [
                                'name'=> 'files',
                                'label'=> '',
                                'type'=> 'multiple_upload_preview'
                            ]
                        ])
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="buttonSubmitTaskActivity" data-dismiss="modal">Save Task</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>

</div>
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
        $('#buttonSubmitTaskActivity').on('click',function(){
            axios.post('{{ URL::to("/api/property/task")}}',{
                property_id:'{{$entry->id}}',
                type:$('select[name="activity_type"]').val(),
                status:$('select[name="status"]').val(),
                land_specialize:$('select[name="contact_id"]').val(),
                activity_date:$('input[name="activity_date_time"]').val(),
                owner:$('select[name="owner_id"]').val(),
                description:$('textarea[name="description"]').val(),
                files:$('input[name="files"]').val(),
            })
                .then(val => {
                    let tbody=`
                        <tr>
                            <td scope="col" class="align-top text-nowrap">`+val.data[0].type+`</td>
                            <td scope="col" class="align-top text-nowrap">`+val.data[0].date+`</td>
                            <td scope="col" class="align-top text-nowrap">`+val.data[0].status+`</td>
                            <td scope="col" class="align-top text-nowrap">`+val.data[1]+`</td>
                            <td scope="col" class="align-top text-nowrap">`+val.data[2]+`</td>
                        </tr>
                    `;
                    $('#task-activity-body').append(tbody);
            });
        });
    });
    </script>
@endpush
