<div class="d-none" data-init-function="bpFieldInitListingScript"></div>
@if ($crud->fieldTypeNotLoaded($field))
@php
$crud->markFieldTypeAsLoaded($field);
@endphp

@push('crud_fields_styles')

@endpush
@push('crud_fields_scripts')

    <script type="text/javascript">
     $(function(){
               let value=$("select[name='record_type']").val();
               if(value=="land"){
                  $('#building-title').hide();
                  $('#building').hide();
                  $('#btnAddBuilding').hide();
               }
               else if(value=="building"){
                $('#btnAddBuilding').hide();
               }
               $("select[name='record_type']").on('change',function(){
                    let value=$("select[name='record_type']").val();
                    if(value=="land_and_building"){
                        $('#building-title').show();
                        $('#building').show();
                        $('#btnAddBuilding').show();
                    }else if(value=="building"){
                        $('#building-title').show();
                        $('#building').show();
                        $('#btnAddBuilding').hide();
                    }else{
                        $('#building-title').hide();
                        $('#building').hide();
                        $('#btnAddBuilding').hide();
                    }
               });

               @if ($errors->has('title_deed_type'))
                    $('.title_deed_type').addClass('text-danger').append('<div class="invalid-feedback d-block">The title deed type field is required.</div>');
                @endif

        });


    </script>

@endpush
@endif
