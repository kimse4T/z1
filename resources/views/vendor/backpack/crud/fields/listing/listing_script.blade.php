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
        let isSale=$("input[name='is_sale']").val();
        let isRent=$("input[name='is_rent']").val();
        let sale_price = $("input[name='sale_list_price']").val();
        let sale_commission = $("input[name='sale_commission']").val();
        let rent_price = $("input[name='rent_list_price']").val();
        let rent_commission = $("input[name='rental_commission']").val();

        if(isSale=='0'){
            $("input[name='sale_list_price']").prop( "disabled", true );
            $("input[name='sale_commission']").prop( "disabled", true );
        }
        if(isRent=='0'){
            $("input[name='rent_list_price']").prop( "disabled", true );
            $("input[name='rental_commission']").prop( "disabled", true );
        }

        $(".is_rent_button_checkbox button").on('click',function(e){
            let isRent=$("input[name='is_rent']").val();

            if(isRent=='1'){
                $("input[name='rent_list_price']").prop( "disabled", true );
                $("input[name='rental_commission']").prop( "disabled", true );
                $("input[name='rent_list_price']").val('');
                $("input[name='rental_commission']").val('');
            }else{
                $("input[name='rent_list_price']").prop( "disabled", false );
                $("input[name='rental_commission']").prop( "disabled", false );
                $("input[name='rent_list_price']").val(rent_price);
                $("input[name='rental_commission']").val(rent_commission);
            }
        });

        $(".is_sale_button_checkbox button").on('click',function(e){
            let isSale=$("input[name='is_sale']").val();

            if(isSale=='1'){
                $("input[name='sale_list_price']").prop( "disabled", true );
                $("input[name='sale_commission']").prop( "disabled", true );
                $("input[name='sale_list_price']").val('');
                $("input[name='sale_commission']").val('');

            }else{
                $("input[name='sale_list_price']").prop( "disabled", false );
                $("input[name='sale_commission']").prop( "disabled", false );
                $("input[name='sale_list_price']").val(sale_price);
                $("input[name='sale_commission']").val(sale_commission);
            }
        });

            //    let value=$("select[name='record_type']").val();
            //    if(value=="land"){
            //       $('#building-title').hide();
            //       $('#building').hide();
            //       $('#btnAddBuilding').hide();
            //    }
            //    else if(value=="building"){
            //     $('#btnAddBuilding').hide();
            //    }
            //    $("select[name='record_type']").on('change',function(){
            //         let value=$("select[name='record_type']").val();
            //         if(value=="land_and_building"){
            //             $('#building-title').show();
            //             $('#building').show();
            //             $('#btnAddBuilding').show();
            //         }else if(value=="building"){
            //             $('#building-title').show();
            //             $('#building').show();
            //             $('#btnAddBuilding').hide();
            //         }else{
            //             $('#building-title').hide();
            //             $('#building').hide();
            //             $('#btnAddBuilding').hide();
            //         }
            //    });

            function showField(value){
                if(value=='active'){
                    $('input[name="reason"]').closest('div').hide();
                    $('input[name="sold_price"]').closest('div').hide();
                    $('input[name="sold_price_date"]').closest('div').hide();
                    $('input[name="rented_price"]').closest('div').hide();
                    $('input[name="rented_price_date"]').closest('div').hide();
                    $('select[name="customer_id"]').closest('div').hide();
                    $('select[name="sale_land_specialist_id"]').closest('div').hide();
                }else if(value=='inactive'){
                    $('input[name="reason"]').closest('div').show();
                    $('input[name="sold_price"]').closest('div').hide();
                    $('input[name="sold_price_date"]').closest('div').hide();
                    $('input[name="rented_price"]').closest('div').hide();
                    $('input[name="rented_price_date"]').closest('div').hide();
                    $('select[name="customer_id"]').closest('div').hide();
                    $('select[name="sale_land_specialist_id"]').closest('div').hide();
                }else if(value=='sold'){
                    $('input[name="reason"]').closest('div').hide();
                    $('input[name="sold_price"]').closest('div').show();
                    $('input[name="sold_price_date"]').closest('div').show();
                    $('input[name="rented_price"]').closest('div').hide();
                    $('input[name="rented_price_date"]').closest('div').hide();
                    $('select[name="customer_id"]').closest('div').show();
                    $('select[name="sale_land_specialist_id"]').closest('div').show();
                }else{
                    $('input[name="reason"]').closest('div').hide();
                    $('input[name="sold_price"]').closest('div').hide();
                    $('input[name="sold_price_date"]').closest('div').hide();
                    $('input[name="rented_price"]').closest('div').show();
                    $('input[name="rented_price_date"]').closest('div').show();
                    $('select[name="customer_id"]').closest('div').show();
                    $('select[name="sale_land_specialist_id"]').closest('div').show();
                }
            }

            showField($('select[name="status"]').val());

            $('select[name="status"]').on('change',function(){
                showField(this.value);
            });
        });

    </script>
@endpush
@endif
