<!-- field_type_name -->

@include('crud::fields.inc.wrapper_start')

@if (isset($entry->units))
    @foreach ($entry->units as $item)

    <div id="building">
        <div class="card building-info">
            <div class="col-md-12 building-wrapper hidden-building-form mt-3">
                    <div class="building-content z-depth-1-half rounded p-3 mb-3">
                        <div class="row">
                            <div class="d-flex justify-content-between col-md-12">
                                <div class="title-left">
                                    <h5 class="building-title">{!! $field['label'] !!} <span class="building-id"></span></h5>
                                </div>
                                <div class="button-right">
                                    <button type="button" class="close remove-building" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                        <nav class="navbar navbar-light bg-light mt-3">
                                        <span class="navbar-brand mb-0 h4">Basic Information</span>
                                        </nav>
                                        </div>



                                        <div class="hidden">
                                         <input type="hidden" name="unit_id[]" value="{{$item->id}}" class="form-control">
                                        </div>

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_name[]",
                                            "label" => 'Building Name',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->name,
                                        ]])

                                        @include('crud::fields.select2_from_array', [
                                            "field" => [
                                            "name" => "unit_style[]",
                                            "label" => 'Style',
                                            "type"=> "select2_from_array",
                                            'options'     => ['-','modern' => 'Modern','classic' => 'Classic'],
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'default' => $item->style,

                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_width[]",
                                            "label" => 'Width',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->width,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_length[]",
                                            "label" => 'Length',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->length,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_total_size[]",
                                            "label" => 'Total Size',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->area,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_gross_floor_area[]",
                                            "label" => 'Gross Floor Area (GFA)',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12']
                                            ,
                                            'value' => $item->gross_floor_area,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_net_floor_area[]",
                                            "label" => 'Net Floor Area',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->net_floor_area,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_bedroom[]",
                                            "label" => '# of Bedroom',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->bedroom,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_bathroom[]",
                                            "label" => '# of Bathroom',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->bathroom,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_livingroom[]",
                                            "label" => '# of Living Room',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->livingroom,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_dinningroom[]",
                                            "label" => '# of Dinning Room',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->dinningroom,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_floor[]",
                                            "label" => '# of Floor',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->floor,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_storey[]",
                                            "label" => '# of Storey',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->stories,
                                        ]])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                        <nav class="navbar navbar-light bg-light mt-3">
                                        <span class="navbar-brand mb-0 h4">Features</span>
                                        </nav>
                                        </div>

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_car_parking[]",
                                            "label" => 'Car Parking',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->car_parking,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_motor_parking[]",
                                            "label" => 'Motor Parking',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->motor_parking,
                                        ]])

                                        @include('crud::fields.checkbox', [
                                            "field" => [
                                            "name" => "unit_swimming_pool[]",
                                            "label" => 'Swimming Pool',
                                            "type"=> "checkbox",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->swimming_pool,
                                        ]])

                                        @include('crud::fields.checkbox', [
                                            "field" => [
                                            "name" => "unit_fitness_gym[]",
                                            "label" => 'Fitness Gym',
                                            "type"=> "checkbox",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->fitness_gym,
                                        ]])

                                        @include('crud::fields.checkbox', [
                                            "field" => [
                                            "name" => "unit_lift[]",
                                            "label" => 'Lift',
                                            "type"=> "checkbox",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->lift,
                                        ]])

                                        @include('crud::fields.checkbox', [
                                            "field" => [
                                            "name" => "unit_balcony[]",
                                            "label" => 'Balcony',
                                            "type"=> "checkbox",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->balcony,
                                        ]])

                                        @include('crud::fields.checkbox', [
                                            "field" => [
                                            "name" => "unit_kitchen[]",
                                            "label" => 'Kitchen',
                                            "type"=> "checkbox",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->kitchen,
                                        ]])

                                        @include('crud::fields.checkbox', [
                                            "field" => [
                                            "name" => "unit_security[]",
                                            "label" => 'Security Guard',
                                            "type"=> "checkbox",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->security,
                                        ]])

                                        <div class="form-group col-md-12">
                                        <nav class="navbar navbar-light bg-light mt-3">
                                        <span class="navbar-brand mb-0 h4">Other</span>
                                        </nav>
                                        </div>

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_cost_estimates[]",
                                            "label" => 'Cost Estimates',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->cost_estimate,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_useful_life[]",
                                            "label" => 'Useful Life',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->useful_life,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_effective_age[]",
                                            "label" => 'Effective Age',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->effective_age,
                                        ]])

                                        @include('crud::fields.text', [
                                            "field" => [
                                            "name" => "unit_completion_year[]",
                                            "label" => 'Completion Year',
                                            "type"=> "text",
                                            'wrapper' => ['class' => 'form-group col-md-12'],
                                            'value' => $item->completion_year,
                                        ]])

                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endforeach

@else

@php
    $unit_name=old('unit_name');
    $unit_widths = old('unit_width');
    $unit_lengths = old('unit_length');
    $unit_stories = old('unit_storey');
    $unit_useful_lifes = old('unit_useful_life');
    $unit_effective_ages = old('unit_effective_age');
    $unit_completion_years = old('unit_completion_year');
    $unit_bedrooms = old('unit_bedroom');
    $unit_bathrooms = old('unit_bathroom');
    $unit_livingrooms = old('unit_livingroom');
    $unit_diningrooms = old('unit_dinningroom');
    $unit_car_parkings = old('unit_car_parking');
    $unit_motor_parkings = old('unit_motor_parking');
    $unit_building_types = old('unit_building_type');
    $unit_design_appeal_types = old('unit_design_appeal_type');
    $unit_quality_types = old('unit_quality_type');
    $unit_roofing_types = old('unit_roofing_type');
    $unit_gross_floor_areas = old('unit_gross_floor_area');
    $unit_net_floor_areas = old('unit_net_floor_area');
    $unit_main_walls = old('unit_main_walls');
    $unit_ceilings = old('unit_ceiling');
    $unit_flooring_materials = old('unit_flooring_materials');
    $unit_window_frames = old('unit_window_frames');
    $unit_other_facilities = old('unit_other_facilities');
    $unit_floor_plans = old('unit_floor_plan');
    $unit_rent_income_per_month_if_anys = old('unit_rent_income_per_month_if_any');
    $unit_kitchens = old('unit_kitchen');
    $unit_balconies = old('unit_balcony');
    $unit_swimming_pools = old('unit_swimming_pool');
    $unit_securities = old('unit_security');
    $unit_fitness_gyms = old('unit_fitness_gym');
    $unit_lifts = old('unit_lift');
    $unit_floors = old('unit_floor');
    $unit_current_use = old('unit_current_use');
    $unit_styles = old('unit_style');
    $unit_total_size = old('unit_total_size');
    $unit_cost_estimates = old('unit_cost_estimates');
@endphp

@if($unit_name!=null)
    @for($i=0;$i<count($unit_name);$i++)
        <div id="building">
            <div class="card building-info">
                <div class="col-md-12 building-wrapper hidden-building-form mt-3">
                        <div class="building-content z-depth-1-half rounded p-3 mb-3">
                            <div class="row">
                                <div class="d-flex justify-content-between col-md-12">
                                    <div class="title-left">
                                        <h5 class="building-title">{!! $field['label'] !!} <span class="building-id"></span></h5>
                                    </div>
                                    <div class="button-right">
                                        <button type="button" class="close remove-building" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <nav class="navbar navbar-light bg-light mt-3">
                                            <span class="navbar-brand mb-0 h4">Basic Information</span>
                                            </nav>
                                            </div>



                                            <div class="hidden">
                                            <input type="hidden" name="unit_id[]" value="" class="form-control">
                                            </div>

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_name[]",
                                                "label" => 'Building Name',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_name[$i],
                                            ]])

                                            @include('crud::fields.select2_from_array', [
                                                "field" => [
                                                "name" => "unit_style[]",
                                                "label" => 'Style',
                                                "type"=> "select2_from_array",
                                                'options'     => ['-','modern' => 'Modern','classic' => 'Classic'],
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'default' => $unit_styles[$i],

                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_width[]",
                                                "label" => 'Width',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_widths[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_length[]",
                                                "label" => 'Length',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_lengths[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_total_size[]",
                                                "label" => 'Total Size',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_total_size[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_gross_floor_area[]",
                                                "label" => 'Gross Floor Area (GFA)',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12']
                                                ,
                                                'value' => $unit_gross_floor_areas[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_net_floor_area[]",
                                                "label" => 'Net Floor Area',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_net_floor_areas[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_bedroom[]",
                                                "label" => '# of Bedroom',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_bedrooms[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_bathroom[]",
                                                "label" => '# of Bathroom',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_bathrooms[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_livingroom[]",
                                                "label" => '# of Living Room',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_livingrooms[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_dinningroom[]",
                                                "label" => '# of Dinning Room',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_diningrooms[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_floor[]",
                                                "label" => '# of Floor',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_floors[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_storey[]",
                                                "label" => '# of Storey',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_stories[$i],
                                            ]])
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <nav class="navbar navbar-light bg-light mt-3">
                                            <span class="navbar-brand mb-0 h4">Features</span>
                                            </nav>
                                            </div>

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_car_parking[]",
                                                "label" => 'Car Parking',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_car_parkings[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_motor_parking[]",
                                                "label" => 'Motor Parking',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_motor_parkings[$i],
                                            ]])

                                            @include('crud::fields.checkbox', [
                                                "field" => [
                                                "name" => "unit_swimming_pool[]",
                                                "label" => 'Swimming Pool',
                                                "type"=> "checkbox",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_swimming_pools[$i],
                                            ]])

                                            @include('crud::fields.checkbox', [
                                                "field" => [
                                                "name" => "unit_fitness_gym[]",
                                                "label" => 'Fitness Gym',
                                                "type"=> "checkbox",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_fitness_gyms[$i],
                                            ]])

                                            @include('crud::fields.checkbox', [
                                                "field" => [
                                                "name" => "unit_lift[]",
                                                "label" => 'Lift',
                                                "type"=> "checkbox",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_lifts[$i],
                                            ]])

                                            @include('crud::fields.checkbox', [
                                                "field" => [
                                                "name" => "unit_balcony[]",
                                                "label" => 'Balcony',
                                                "type"=> "checkbox",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_balconies[$i],
                                            ]])

                                            @include('crud::fields.checkbox', [
                                                "field" => [
                                                "name" => "unit_kitchen[]",
                                                "label" => 'Kitchen',
                                                "type"=> "checkbox",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_kitchens[$i],
                                            ]])

                                            @include('crud::fields.checkbox', [
                                                "field" => [
                                                "name" => "unit_security[]",
                                                "label" => 'Security Guard',
                                                "type"=> "checkbox",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_securities[$i],
                                            ]])

                                            <div class="form-group col-md-12">
                                            <nav class="navbar navbar-light bg-light mt-3">
                                            <span class="navbar-brand mb-0 h4">Other</span>
                                            </nav>
                                            </div>

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_cost_estimates[]",
                                                "label" => 'Cost Estimates',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_cost_estimates[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_useful_life[]",
                                                "label" => 'Useful Life',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_useful_lifes[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_effective_age[]",
                                                "label" => 'Effective Age',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_effective_ages[$i],
                                            ]])

                                            @include('crud::fields.text', [
                                                "field" => [
                                                "name" => "unit_completion_year[]",
                                                "label" => 'Completion Year',
                                                "type"=> "text",
                                                'wrapper' => ['class' => 'form-group col-md-12'],
                                                'value' => $unit_completion_years[$i],
                                            ]])

                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    @endfor
@else
<div id="building">
    <div class="card building-info">
        <div class="col-md-12 building-wrapper hidden-building-form mt-3">
                <div class="building-content z-depth-1-half rounded p-3 mb-3">
                    <div class="row">
                        <div class="d-flex justify-content-between col-md-12">
                            <div class="title-left">
                                <h5 class="building-title">{!! $field['label'] !!} <span class="building-id"></span></h5>
                            </div>
                            <div class="button-right">
                                <button type="button" class="close remove-building" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                    <nav class="navbar navbar-light bg-light mt-3">
                                    <span class="navbar-brand mb-0 h4">Basic Information</span>
                                    </nav>
                                    </div>



                                    <div class="hidden">
                                    <input type="hidden" name="hidden_id[]" value="" class="form-control">
                                    </div>


                                    {{-- <div class="form-group col-sm-12" element="div"> <label>Parents Project</label>
                                    <select name="unit_project_building[]" class="form-control remove-value">
                                    <option value="">-</option>
                                    <option value="Borey Peng Hout">Borey Peng Hout</option>
                                    <option value="Borey Leng Navatra">Borey Leng Navatra</option>
                                    </select>
                                    </div>


                                    <div class="form-group col-md-12" element="div"> <label>Project Name</label>
                                    <input type="text" name="unit_project_name[]" value="" class="form-control">
                                    </div> --}}

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Building Name</label>
                                    <input type="text" name="unit_name[]" value="" class="form-control">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_name[]",
                                        "label" => 'Building Name',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])


                                    {{-- <div class="form-group col-sm-12" element="div"> <label>Current Use</label>
                                    <select name="unit_current_use[]" class="form-control remove-value"><option value="" selected="">-</option></select>
                                    </div>  --}}



                                    {{-- <div class="form-group col-sm-12" element="div"> <label>Style</label>
                                    <select name="unit_style[]" class="form-control remove-value">
                                    <option value="">-</option>
                                    <option value="Modern">Modern</option>
                                    <option value="Classic">Classic</option>
                                    </select>
                                    </div> --}}

                                    @include('crud::fields.select2_from_array', [
                                        "field" => [
                                        "name" => "unit_style[]",
                                        "label" => 'Style',
                                        "type"=> "select2_from_array",
                                        'options'     => ['-','modern' => 'Modern','classic' => 'Classic'],
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])


                                    {{-- <div class="form-group col-md-12" element="div"> <label>Width</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_width[]" value="" class="unit_width form-control form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_width[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_width[]",
                                        "label" => 'Width',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])


                                    {{-- <div class="form-group col-md-12" element="div"> <label>Length</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_length[]" value="" class="unit_length form-control form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_length[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_length[]",
                                        "label" => 'Length',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Total Size</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_area[]" value="" class="unit_area form-control form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_area[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_total_size[]",
                                        "label" => 'Total Size',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Gross Floor Area (GFA)</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_gross_floor_area[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_gross_floor_area[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_gross_floor_area[]",
                                        "label" => 'Gross Floor Area (GFA)',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Net Floor Area</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_net_floor_area[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_net_floor_area[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_net_floor_area[]",
                                        "label" => 'Net Floor Area',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label># of Bedroom</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_bedroom[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_bedroom[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_bedroom[]",
                                        "label" => '# of Bedroom',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label># of Bathroom</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_bathroom[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_bathroom[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_bathroom[]",
                                        "label" => '# of Bathroom',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label># of Living Room</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_livingroom[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_livingroom[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_livingroom[]",
                                        "label" => '# of Living Room',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])


                                    {{-- <div class="form-group col-md-12" element="div"> <label># of Dining Room</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_diningroom[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_diningroom[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_dinningroom[]",
                                        "label" => '# of Dinning Room',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label># of Floor</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_floor[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_floor[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_floor[]",
                                        "label" => '# of Floor',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label># of Storey</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_stories[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_stories[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_storey[]",
                                        "label" => '# of Storey',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                    <nav class="navbar navbar-light bg-light mt-3">
                                    <span class="navbar-brand mb-0 h4">Features</span>
                                    </nav>
                                    </div>

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Car Parkings</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_car_parking[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_car_parking[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_car_parking[]",
                                        "label" => 'Car Parking',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Motor Parkings</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_motor_parking[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_motor_parking[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_motor_parking[]",
                                        "label" => 'Motor Parking',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <div class="checkbox">
                                    <input type="hidden" name="unit_swimming_pool[]" value="">
                                    <input type="checkbox" class="p-checkbox-custom">
                                    <label class="form-check-label font-weight-normal p-label-custom">Swimming Pool</label>
                                    </div>
                                    </div> --}}

                                    @include('crud::fields.checkbox', [
                                        "field" => [
                                        "name" => "unit_swimming_pool[]",
                                        "label" => 'Swimming Pool',
                                        "type"=> "checkbox",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <div class="checkbox">
                                    <input type="hidden" name="unit_fitness_gym[]" value="">
                                    <input type="checkbox" class="p-checkbox-custom">
                                    <label class="form-check-label font-weight-normal p-label-custom">Fitness Gym</label>
                                    </div>
                                    </div> --}}

                                    @include('crud::fields.checkbox', [
                                        "field" => [
                                        "name" => "unit_fitness_gym[]",
                                        "label" => 'Fitness Gym',
                                        "type"=> "checkbox",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <div class="checkbox">
                                    <input type="hidden" name="unit_lift[]" value="">
                                    <input type="checkbox" class="p-checkbox-custom">
                                    <label class="form-check-label font-weight-normal p-label-custom">Lift</label>
                                    </div>
                                    </div> --}}

                                    @include('crud::fields.checkbox', [
                                        "field" => [
                                        "name" => "unit_lift[]",
                                        "label" => 'Lift',
                                        "type"=> "checkbox",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <div class="checkbox">
                                    <input type="hidden" name="unit_balcony[]" value="">
                                    <input type="checkbox" class="p-checkbox-custom">
                                    <label class="form-check-label font-weight-normal p-label-custom">Balcony</label>
                                    </div>
                                    </div> --}}

                                    @include('crud::fields.checkbox', [
                                        "field" => [
                                        "name" => "unit_balcony[]",
                                        "label" => 'Balcony',
                                        "type"=> "checkbox",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <div class="checkbox">
                                    <input type="hidden" name="unit_kitchen[]" value="">
                                    <input type="checkbox" class="p-checkbox-custom">
                                    <label class="form-check-label font-weight-normal p-label-custom">Kitchen</label>
                                    </div>
                                    </div> --}}

                                    @include('crud::fields.checkbox', [
                                        "field" => [
                                        "name" => "unit_kitchen[]",
                                        "label" => 'Kitchen',
                                        "type"=> "checkbox",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])


                                    {{-- <div class="form-group col-md-12" element="div"> <div class="checkbox">
                                    <input type="hidden" name="unit_security[]" value="">
                                    <input type="checkbox" class="p-checkbox-custom">
                                    <label class="form-check-label font-weight-normal p-label-custom">Security Guard</label>
                                    </div>
                                    </div> --}}

                                    @include('crud::fields.checkbox', [
                                        "field" => [
                                        "name" => "unit_security[]",
                                        "label" => 'Security Guard',
                                        "type"=> "checkbox",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    <div class="form-group col-md-12">
                                    <nav class="navbar navbar-light bg-light mt-3">
                                    <span class="navbar-brand mb-0 h4">Other</span>
                                    </nav>
                                    </div>

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Cost Estimates</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_cost_estimate[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_cost_estimate[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_cost_estimates[]",
                                        "label" => 'Cost Estimates',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Useful Life</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_useful_life[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_useful_life[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_useful_life[]",
                                        "label" => 'Useful Life',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Effective age</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;numeral&quot;:true,&quot;numeralThousandsGroupStyle&quot;:&quot;thousand&quot;}" data-set-value-name="unit_effective_age[]" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_effective_age[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_effective_age[]",
                                        "label" => 'Effective Age',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                    {{-- <div class="form-group col-md-12" element="div"> <label>Completion Year</label>
                                    <input type="text" data-init-function="bpFieldInitFlexiNumberFormat" data-options="{&quot;date&quot;:true,&quot;datePattern&quot;:[&quot;Y&quot;]}" data-set-value-name="unit_completion_year[]" list="number-6e854ad5-71bc-4016-8909-04a50592296f" value="" class=" form-control flexi-number-format" data-initialized="true">
                                    <input type="hidden" name="unit_completion_year[]" value="">
                                    </div> --}}

                                    @include('crud::fields.text', [
                                        "field" => [
                                        "name" => "unit_completion_year[]",
                                        "label" => 'Completion Year',
                                        "type"=> "text",
                                        'wrapper' => ['class' => 'form-group col-md-12']
                                    ]])

                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endif
@endif
<button id="btnAddBuilding" class="btn btn-primary my-3" type="button"><span class="ladda-label"><i class="la la-plus"></i></span> Add Building</button>
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
           $('#btnAddBuilding').click(function(){
               $('.building-info:last').clone(true).appendTo('#building');
                $('.building-info:last input[type=hidden]').attr('value','');
                $('.building-info:last .building-id').text(index);
           });


           $('.remove-building').click(function(){
               if($('.building-info').length>1){
                $(this).closest(".building-info").remove();
               }

           });
        });
    </script>
    @endpush
@endif
