<!-- field_type_name -->

@include('crud::fields.inc.wrapper_start')
<div class="table-responsive mb-3">
    <table class="table border mb-0">
    <thead class="thead">
    <tr>
    <th class="border text-center" scope="col"></th>
    <th class="border text-center" colspan="2" scope="col">Asking Price</th>
    <th class="border text-center" colspan="2">Negotiable Price</th>
    <th class="border text-center" colspan="2">Listing Price</th>
    <th class="border text-center" colspan="2">Sold/Rented</th>
    <th class="border text-center">Commission</th>
    </tr>
    <tr>
    <th class="border text-center" scope="col" width="10%"></th>
    <th class="border text-center" scope="col" width="10%">Total</th>
    <th class="border text-center text-nowrap" scope="col" width="10%">Per sqm</th>
    <th class="border text-center" scope="col" width="10%">Total</th>
    <th class="border text-center text-nowrap" scope="col" width="10%">Per sqm</th>
    <th class="border text-center" scope="col" width="10%">Total</th>
    <th class="border text-center text-nowrap" scope="col" width="10%">Per sqm</th>
    <th class="border text-center" scope="col" width="10%">Total</th>
    <th class="border text-center text-nowrap" scope="col" width="10%">Per sqm</th>
    <th class="border text-center" scope="col" width="10%">Total</th>
    </tr>
    </thead>
    <tbody>
    <tr class="input-field">
    <th class="border text-center p-1 align-middle" scope="row">Sale</th>
    <td class="border text-center p-0">

    {{-- <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="sale_price_asking" value="" id="sale_price_asking" class="price_and_commission form-control flexi-number-format" autocomplete="off" data-initialized="true">
    <input type="hidden" name="sale_price_asking" value=""> --}}

    @include('crud::fields.textcus', [
        "field" => [
        "name" => "sale_price_asking",
        "type"=> "textcus",
        "value" => $entry->sale_price_asking ?? '',
        "wrapper"=>[
            'class'=>'col-md-12',
            'style' => 'padding:0;'
        ]
    ]])


    </td>
    <td class="border text-center p-0">

    @include('crud::fields.textcus', [
        "field" => [
        "name" => "sale_price_asking_per_sqm",
        "type"=> "textcus",
        "value" => $entry->sale_price_asking_per_sqm ?? '',
        "wrapper"=>[
            'class'=>'col-md-12',
            'style' => 'padding:0;'
        ]
    ]])

    </td>
    <td class="border text-center p-0">

    @include('crud::fields.textcus', [
        "field" => [
        "name" => "sale_price",
        "type"=> "textcus",
        "value" => $entry->sale_price ?? '',
        "wrapper"=>[
            'class'=>'col-md-12',
            'style' => 'padding:0;'
        ]
    ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "sale_price_per_sqm",
            "type"=> "textcus",
            "value" => $entry->sale_price_per_sqm ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
        "field" => [
        "name" => "sale_list_price",
        "type"=> "textcus",
        "value" => $entry->sale_list_price ?? '',
        "wrapper"=>[
            'class'=>'col-md-12',
            'style' => 'padding:0;'
        ]
    ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "sale_list_price_per_sqm",
            "type"=> "textcus",
            "value" => $entry->sale_price_per_sqm ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "sold_price",
            "type"=> "textcus",
            "value" => $entry->sold_price ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "sold_price_per_sqm",
            "type"=> "textcus",
            "value" => $entry->sold_price_per_sqm ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "sale_commission",
            "type"=> "textcus",
            "value" => $entry->sale_commission ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    </tr>
    <tr>
    <th class="border text-center p-1 align-middle" scope="row">Rent</th>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "rent_price_asking",
            "type"=> "textcus",
            "value" => $entry->rent_price_asking ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "rent_price_asking_per_sqm",
            "type"=> "textcus",
            "value" => $entry->rent_price_asking_per_sqm ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "rent_price",
            "type"=> "textcus",
            "value" => $entry->rent_price ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "rent_price_per_sqm",
            "type"=> "textcus",
            "value" => $entry->rent_price_per_sqm ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "rent_list_price",
            "type"=> "textcus",
            "value" => $entry->rent_list_price ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "rent_list_price_per_sqm",
            "type"=> "textcus",
            "value" => $entry->rent_list_price_per_sqm ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "rented_price",
            "type"=> "textcus",
            "value" => $entry->rented_price ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "rented_price_per_sqm",
            "type"=> "textcus",
            "value" => $entry->rented_price_per_sqm ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    <td class="border text-center p-0">

        @include('crud::fields.textcus', [
            "field" => [
            "name" => "rental_cmmission",
            "type"=> "textcus",
            "value" => $entry->rental_cmmission ?? '',
            "wrapper"=>[
                'class'=>'col-md-12',
                'style' => 'padding:0;'
            ]
        ]])

    </td>
    </tr>
    </tbody>
    </table>
    </div>
@include('crud::fields.inc.wrapper_end')

@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- no styles -->
    @endpush

    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}
    @push('crud_fields_scripts')
    <script type="text/javascript">
        $(function () {

        });
    </script>
    @endpush
@endif
