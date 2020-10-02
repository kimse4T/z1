@extends(backpack_view('blank'))


@section('header')
	<section class="container-fluid d-print-none">
    	<a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
		<h2>
	        <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
	        <small>{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name !!}.</small>
	        @if ($crud->hasAccess('list'))
	          <small class=""><a href="{{ url($crud->route) }}" class="font-sm"><i class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
	        @endif
	    </h2>
    </section>
@endsection

@section('content')
<div id="property_show">
    <div class="row pt-2" >
        <div class="col-md-8 ">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5>Property Information</h5>
                        </div>
                        <div class="col-sm-4">
                            <label for="" class="float-lg-right float-sm-left">
                                <i class="font-weight-600">Status : </i>
                                <i style="color: orange;" id="status">@{{status}}</i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <div>Property ID : <span>{{$entry->id}}</span></div>
                            <div>Create Date : <span>{{\Carbon\Carbon::parse($entry->created_at)->format('d F Y')}}</span></div>
                        </div>
                        <div class="col-sm-4 text-right">Rating: <span>{{$entry->rating}}</span></div>
                    </div>
                    <div class="slider-preview-content mt-3">
                        <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel" style="background: #333;">
                            <div class="carousel-inner center">
                                @if(isset($entry->image))
                                    <div class="carousel-item active">
                                        <img style="height: 430px; margin: 0 auto;"
                                        class="d-block "  alt="First slide [800x400]"
                                        src="http://127.0.0.1:8000/{{$entry->image}}"
                                        data-holder-rendered="true">
                                    </div>
                                @endif
                                @if(isset($entry->image_left_side))
                                    <div class="carousel-item">
                                        <img style="height: 430px; margin: 0 auto;"
                                        class="d-block "  alt="Second slide [800x400]"
                                        src="http://127.0.0.1:8000/{{$entry->image_left_side}}"
                                        data-holder-rendered="true">
                                    </div>
                                @endif
                                @if(isset($entry->image_right_side))
                                    <div class="carousel-item">
                                        <img style="height: 430px; margin: 0 auto;"
                                        class="d-block"  alt="Third slide [800x400]"
                                        src="http://127.0.0.1:8000/{{$entry->image_right_side}}"
                                        data-holder-rendered="true">
                                    </div>
                                @endif
                                @if(isset($entry->image_back_side))
                                    <div class="carousel-item">
                                        <img style="height: 430px; margin: 0 auto;"
                                        class="d-block"  alt="Third slide [800x400]"
                                        src="http://127.0.0.1:8000/{{$entry->image_back_side}}"
                                        data-holder-rendered="true">
                                    </div>
                                @endif
                                @if(isset($entry->image_opposite))
                                    <div class="carousel-item">
                                        <img style="height: 430px; margin: 0 auto;"
                                        class="d-block"  alt="Third slide [800x400]"
                                        src="http://127.0.0.1:8000/{{$entry->image_opposite}}"
                                        data-holder-rendered="true">
                                    </div>
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-12 col-sm-8"><h4>{{$entry->current_use}}</h4></div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-sm-3">Total Size : <span>{{$entry->land_area}}</span></div>
                        {{-- {{dd($entry->propertyTitleDeed)}} --}}
                        <div class="col-sm-5 text-right">Title Deed Type :
                            @if(isset($entry->titledeeds))
                                @foreach ($entry->titledeeds as $key => $item)
                                    {{$item->title_deed_type}} <br>
                                @endforeach
                            @endif
                        </div>

                        {{-- <div class="col-sm-3">Title Deed Type : <span>{{PropertyTitleDeed::select('title_deed_type')->where('id',$entry->id)}}</span></div> --}}
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <i class="la la-map-marker"></i><span class="font-weight-bold">{{$entry->PropertyFullAddress}}</span>
                        </div>
                    </div>
                    <nav class="navbar navbar-light bg-light mt-3">
                        <div class="navbar-brand mb-0 font-weight-600">Location</div>
                    </nav>
                    <nav class="navbar navbar-light bg-light mt-3 mb-4">
                        <div class="navbar-brand mb-0 font-weight-600">Property Basic Information</div>
                    </nav>
                    <div class="row form-group">
                        <div class="col-sm-6">Record Type : <span>{{$entry->record_type}}</span></div>
                        <div class="col-sm-6">Tenure : <span>{{$entry->tenure_type}}</span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">Property Types : <span>{{$entry->type}}</span></div>
                        <div class="col-sm-6">Zoning : <span>{{$entry->zone_type}}</span></div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-6">Current Use : <span>{{$entry->current_use}}</span></div>
                        <div class="col-sm-6">Topography : <span>{{$entry->topography}}</span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6"><span></span></div>
                        <div class="col-sm-6">Shape : <span>{{$entry->land_shape_type}}</span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6"><span></span></div>
                        <div class="col-sm-6">Site Position : <span>{{$entry->site_position}}</span></div>
                    </div>
                    <nav class="navbar navbar-light bg-light mt-3">
                        <div class="navbar-brand font-weight-600">Property Dimension</div>
                    </nav>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap mt-3">
                        <tbody><tr>
                        <th class="th font-weight-600" scope="col"></th>
                        <th class="th font-weight-600" scope="col">Width</th>
                        <th class="th font-weight-600" scope="col">Length</th>
                        <th class="th font-weight-600" scope="col">Total Size</th>
                        </tr>
                        </tbody><tbody>
                        <tr>
                        <th class="th font-weight-600" scope="row">Land</th>
                        <td class="th font-weight-600">{{$entry->land_width}}</td>
                        <td class="th font-weight-600">{{$entry->land_height}}</td>
                        <td class="th font-weight-600">{{$entry->land_area}}</td>
                        </tr>
                        @if($entry->record_type!=='land')
                        @if(isset($entry->units))
                            @php
                                $index=1;
                            @endphp
                            @foreach ($entry->units as $item)
                            <tr>
                                <th class="th font-weight-600" scope="row">Building {{$index}}</th>
                                <td class="th font-weight-600">{{$item->width}}</td>
                                <td class="th font-weight-600">{{$item->length}}</td>
                                <td class="th font-weight-600">{{$item->area}}</td>
                                </tr>
                                @php
                                $index++;
                                @endphp
                            @endforeach
                        @endif
                        @endif

                        </tbody>
                        </table>
                    </div>
                    {{-- Title Deed Information --}}
                    <nav class="navbar navbar-light bg-light mt-3 mb-4">
                        <div class="navbar-brand mb-0 font-weight-600">Title Deed Information</div>
                    </nav>

                    @if(isset($entry->titledeeds))
                        @foreach ($entry->titledeeds as $key => $item)
                            <div class="card pt-2 pl-2">
                                <div class="row form-group">
                                    <div class="col-sm-6">Title Deed Type : <span>{{$item->title_deed_type}}</span></div>
                                    <div class="col-sm-6">Title Deed No. : <span>{{$item->title_deed_no}}</span></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-6">Issued Year : <span>{{$item->issued_year}}</span></div>
                                    <div class="col-sm-6">Parcel No. : <span>{{$item->parcel_no}}</span></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">Total Size By Title Deed : <span>{{$entry->land_area}}</span></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if($entry->record_type!=='land')
                    <nav class="navbar navbar-light bg-light mt-3 mb-4">
                        <div class="navbar-brand mb-0 font-weight-600">Building Information</div>
                    </nav>
                    @if(isset($entry->units))
                        @php
                            $index=1;
                        @endphp
                        @foreach ($entry->units as $item)
                        <div class="mb-3">
                            <div class="p-2 mt-3 border rounded">
                            <div class="row p-2">
                            <div class="col-12">
                            <p class="font-weight-600">Building {{$index}}</p>
                            </div>
                            <div class="form-group-sm col-sm-6 mb-2">
                            <div class="navbar p-2 font-weight-600 bg-light">
                            <span class="ml-2">Basic Information</span>
                            </div>
                            <div class="form-group-sm pt-2">
                            <label>Building Name : </label>{{$item->name}}<br>
                            <label>Current Use : </label><br>
                            <label>Style : </label>{{$item->style}}<br>
                            <label>Width : </label>{{$item->width}}<br>
                            <label>Length : </label>{{$item->length}}<br>
                            <label>Total Size : </label>{{$item->area}}<br>
                            <label>Gross Floor Area (GFA) : </label>{{$item->gross_floor_area}}<br>
                            <label>Net Floor Area : </label>{{$item->net_floor_area}}<br>
                            <label># of Bedroom : </label>{{$item->bedroom}}<br>
                            <label># of Bathroom : </label>{{$item->bathrooom}}<br>
                            <label># of Living Room : </label>{{$item->livingroom}}<br>
                            <label># of Dining Room : </label>{{$item->dinningroom}}<br>
                            <label># of Floor : </label>{{$item->floor}}<br>
                            <label># of Storey : </label>{{$item->stories}}
                            </div>
                            </div>
                            <div class="form-group-sm col-sm-6 mb-2">
                            <div class="p-2 font-weight-600 bg-light">
                            <span class="ml-2">Features</span>
                            </div>
                            <div class="form-group-sm pt-2">
                            <label>Car Parkings : </label>{{$item->car_parking}}<br>
                            <label>Motor Parkings : </label>{{$item->motor_parking}}<br>
                            <label>Swimming Pool : </label> {{$item->swimming_pool}}<br>
                            <label>Fitness Gym : </label>{{$item->fitness_gym}}<br>
                            <label>Lift : </label>{{$item->lift}}<br>
                            <label>Balcony : </label>{{$item->balcony}}<br>
                            <label>Kitchen : </label>{{$item->kitchen}}<br>
                            <label>Security Guard : </label> {{$item->security}}
                            <div class="mt-2 mb-2 p-2 font-weight-600 bg-light">
                            <span class="ml-2">Other</span>
                            </div>
                            <label>Cost Estimate : </label> {{$item->cost_estimate}}<br>
                            <label>Useful Life : </label>{{$item->useful_life}}<br>
                            <label>Effective age : </label>{{$item->effective_age}}<br>
                            <label>Completion Year : </label>{{$item->completion_year}}
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            @php
                            $index++;
                        @endphp
                        @endforeach
                    @endif
                    @endif

                    <nav class="navbar navbar-light bg-light mt-3">
                        <div class="navbar-brand font-weight-600">Price and Commission</div>
                    </nav>

                    <div class="table-responsive">
                        <table class="table table-bordered mt-3 text-nowrap text-center">
                        <tbody><tr>
                        <td class="text-center">Type</td>
                        <td colspan="2">Asking Price</td>
                        <td colspan="2">Negotiable Price</td>
                        <td colspan="2">Listing Price</td>
                        <td colspan="2">Sold/Rented</td>
                        <td>Commission</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td class="td">Total</td>
                        <td class="td">Per sqm</td>
                        <td class="td">Total</td>
                        <td class="td">Per sqm</td>
                        <td class="td">Total</td>
                        <td class="td">Per sqm</td>
                        <td class="td">Total</td>
                        <td class="td">Per sqm</td>
                        <td class="td">Total</td>
                        </tr>
                        <tr>
                        <td scope="row" width="10%">Sale</td>
                        <td class="td" width="10%" style="background:#b1e2f25c">@if(!isset($entry->sale_price_asking))-@else{{"$ ".number_format($entry->sale_price_asking, 2)}}@endif</td>
                        <td class="td" width="10%" style="background:#b1e2f25c">@if(!isset($entry->sale_price_asking_per_sqm))-@else{{"$ ".number_format($entry->sale_price_asking_per_sqm, 2)}}@endif</td>
                        <td class="td" width="10%" style="background:#b1e2f25c">@if(!isset($entry->sale_price))-@else{{"$ ".number_format($entry->sale_price, 2)}}@endif</td>
                        <td class="td" width="10%" style="background:#b1e2f25c">@if(!isset($entry->sale_price_per_sqm))-@else{{"$ ".number_format($entry->sale_price_per_sqm, 2)}}@endif</td>
                        <td class="td" width="10%" style="background:#b1e2f25c">@if(!isset($entry->sale_list_price))-@else{{"$ ".number_format($entry->sale_list_price, 2)}}@endif</td>
                        <td class="td" width="10%" style="background:#b1e2f25c">@if(!isset($entry->sale_list_price_per_sqm))-@else{{"$ ".number_format($entry->sale_list_price_per_sqm, 2)}}@endif</td>
                        <td class="td" width="10%" style="background:#b1e2f25c">@if(!isset($entry->sold_price))-@else{{"$ ".number_format($entry->sold_price, 2)}}@endif</td>
                        <td class="td" width="10%" style="background:#b1e2f25c">@if(!isset($entry->sold_price_per_sqm))-@else{{"$ ".number_format($entry->sold_price_per_sqm, 2)}}@endif</td>
                        <td class="td" width="10%" style="background:#b1e2f25c">@if(!isset($entry->sale_commission))-@else{{"$ ".number_format($entry->sale_commission, 2)}}@endif</td>
                        </tr>
                        <tr>
                        <td scope="row" width="10%">Rent</td>
                        <td class="td" style="background:#b1e2f25c">@if(!isset($entry->rent_price_asking))-@else{{"$ ".number_format($entry->rent_price_asking, 2)}}@endif</td>
                        <td class="td" style="background:#b1e2f25c">@if(!isset($entry->rent_price_asking_per_sqm))-@else{{"$ ".number_format($entry->rent_price_asking_per_sqm, 2)}}@endif</td>
                        <td class="td" style="background:#b1e2f25c">@if(!isset($entry->rent_price))-@else{{"$ ".number_format($entry->rent_price, 2)}}@endif</td>
                        <td class="td" style="background:#b1e2f25c">@if(!isset($entry->rent_price_per_sqm))-@else{{"$ ".number_format($entry->rent_price_per_sqm, 2)}}@endif</td>
                        <td class="td" style="background:#b1e2f25c">@if(!isset($entry->rent_list_price))-@else{{"$ ".number_format($entry->rent_list_price, 2)}}@endif</td>
                        <td class="td" style="background:#b1e2f25c">@if(!isset($entry->rent_list_price_per_sqm))-@else{{"$ ".number_format($entry->rent_list_price_per_sqm, 2)}}@endif</td>
                        <td class="td" style="background:#b1e2f25c">@if(!isset($entry->rented_price))-@else{{"$ ".number_format($entry->rented_price, 2)}}@endif</td>
                        <td class="td" style="background:#b1e2f25c">@if(!isset($entry->rented_price_per_sqm))-@else{{"$ ".number_format($entry->rented_price_per_sqm, 2)}}@endif</td>
                        <td class="td" style="background:#b1e2f25c">@if(!isset($entry->rental_cmmission))-@else{{"$ ".number_format($entry->rental_cmmission, 2)}}@endif</td>
                        </tr>
                        </tbody></table>
                    </div>

                    <div class="wrap-indication mb-4">
                        <nav class="navbar navbar-light bg-light mt-4">
                            <label for="" class="navbar-brand mb-0 h3 font-weight-600">Indication</label>
                        </nav>
                        @if($entry->is_appraisal!=1)
                        <div class="row mb-3" id="button-request-indication">
                            <div class="col-md-4 mt-3">
                                <button class="btn px-1 font-weight-600 border px-3 bg-indication" id="request_indication" @click="handleClick(2)" style="background-color: #f9e8cd91">Request Indication</button>
                            </div>
                        </div>
                        @endif
                        @if($entry->is_appraisal==1)
                        <div class="bg-indication mx-0 mt-3" style="background: #f9e8cd91" id="indication-info">
                            <nav class="navbar-secondary p-3" id="indication">
                            <div class="row ">
                            <div class="col-md-8">
                            <label class="font-weight-bold">Property Indicative {{$entry->type}}</label><br>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Instruction Date</div>
                            <div class="col-lg-8 col-6">: 22 September 2020</div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Instructor</div>
                            <div class="col-lg-8 col-6">: </div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Contact Detail</div>
                            <div class="col-lg-8 col-6">: @if(isset($entry->contact)){{$entry->contact->FullName}}@endif</div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6"></div>
                            <div class="col-lg-8 col-6 pl-4"> Tell :
                            <a href="tel:+85510290086" class="text-dark">
                                @if(isset($entry->contact)){{$entry->contact->phone}}@endif
                            </a>
                            </div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6"></div>
                            <div class="col-lg-8 col-6 pl-4">Email : @if(isset($entry->contact)){{$entry->contact->email}}@endif</div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Intended Use</div>
                            <div class="col-lg-8 col-6">: </div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Property Type</div>
                            <div class="col-lg-8 col-6">: {{$entry->type}}</div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Current Usage</div>
                            <div class="col-lg-8 col-6">: </div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Proprietor(s)</div>
                            <div class="col-lg-8 col-6">: </div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Address</div>
                            <div class="col-lg-8 col-6">: {{$entry->PropertyFullAddress}}</div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Site Coordinates</div>
                            <div class="col-lg-8 col-6">: </div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-lg-4 col-6">Indication Date</div>
                            <div class="col-lg-8 col-6">: </div>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <p class="font-weight-bold text-right">Indication No : 000578</p>
                            <img src="data:image/png;base64,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" class="float-right" alt="" style="max-width: 50%;">
                            </div>
                            </div>
                            </nav>
                            <div class="w-100 p-3">
                            <div class="table-responsive">
                            <table class="m-0 table table-bordered text-nowrap">
                            <tbody><tr class="text-center">
                            <th class="font-weight-600 bg-secondary">No.</th>
                            <th class="font-weight-600 bg-secondary" width="12.5%">Apportionment</th>
                            <th class="font-weight-600 bg-secondary" width="12.5%">Area (sq.m)</th>
                            <th class="font-weight-600 bg-secondary" width="12.5%">Min Rate</th>
                            <th class="font-weight-600 bg-secondary" width="12.5%">Max Rate</th>
                            <th class="font-weight-600 bg-secondary" width="12.5%">Min IV</th>
                            <th class="font-weight-600 bg-secondary" width="12.5%">Max IV</th>
                            <th class="font-weight-600 bg-secondary" width="12.5%">Estimated Value (rounded value)</th>
                            </tr>
                            <tr class="font-weight-600">
                            <td>1</td>
                            <td>Land</td>
                            <td>25.00</td>
                            <td>US$ 0.00</td>
                            <td>US$ 0.00</td>
                            <td>US$ 0.00</td>
                            <td>US$ 0.00</td>
                            <td>US$ 0.00</td>
                            </tr>
                            <tr class="font-weight-600">
                            <td>2</td>
                            <td>Building</td>
                            <td>25.00</td>
                            <td>US$ 0.00</td>
                            <td>US$ 0.00</td>
                            <td>US$ 0.00</td>
                            <td>US$ 0.00</td>
                            <td>US$ 0.00</td>
                            </tr>
                            <tr>
                            <td class="font-weight-600 text-right" colspan="5">Concluded Opinion of Indicative Value (IV) : </td>
                            <td class="font-weight-600">US$ 0.00</td>
                            <td class="font-weight-600">US$ 0.00</td>
                            <td class="font-weight-600">US$ 0.00</td>
                            </tr>
                            <tr>
                            <td class="font-weight-600 text-right" colspan="5">Forced Sale Value (FSV) @70% of IV : </td>
                            <td class="font-weight-600">US$ 0.00</td>
                            <td class="font-weight-600">US$ 0.00</td>
                            <td class="font-weight-600">US$ 0.00</td>
                            </tr>
                            <tr>
                            <td class="font-weight-600 text-right" colspan="5">Fire Insurance Value (FIV) : </td>
                            <td class="font-weight-600">US$ 0.00</td>
                            <td class="font-weight-600">US$ 0.00</td>
                            <td class="font-weight-600">US$ 0.00</td>
                            </tr>
                            </tbody></table>
                            </div>
                            </div>
                            <div class="indication-history w-100 p-3">
                            <label class="font-weight-bold">Indication History</label>
                            <div class="table-responsive">
                            <table class="m-0 table table-bordered text-nowrap">
                            <tbody>
                            <tr class="text-center">
                            <th class="font-weight-600 bg-secondary w-10">Indication No.</th>
                            <th class="font-weight-600 bg-secondary">Instruction Date</th>
                            <th class="font-weight-600 bg-secondary">Indication Date</th>
                            <th class="font-weight-600 bg-secondary">Status</th>
                            <th class="font-weight-600 bg-secondary">Download Report</th>
                            </tr>
                            </tbody>
                            </table>
                            </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <nav class="navbar navbar-light bg-light mt-3 mb-4">
                        <div class="navbar-brand mb-0 font-weight-600">Agreement Information</div>
                    </nav>
                    <div class="row form-group">
                        <div class="col-sm-6">Agreement Type : <span>{{$entry->agreement_type}}</span></div>
                        <div class="col-sm-6">Signed Date : <span>{{\Carbon\Carbon::parse($entry->agreement_sign_date)->format('d F Y')}}</span></div>
                    </div>
                    <div class="row from-group">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">Expired Date : <span>{{\Carbon\Carbon::parse($entry->agreement_expired_date)->format('d F Y')}}</span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <nav class="navbar navbar-light bg-light mt-3  p-1 pl-2">
                                <div class="navbar-brand mb-0 font-weight-bold">Owner Information</div>
                            </nav>
                        </div>
                        <div class="col-sm-6">
                            <nav class="navbar navbar-light bg-light mt-3 p-1 pl-2">
                                <div class="navbar-brand mb-0 font-weight-bold">Land Specialist</div>
                            </nav>
                        </div>
                    </div>
                    <div class="row form-group">
                    <div class="col-sm-6">- Full Name : <a href="/admin/contact/{{@$entry->owner->id}}/show"><span>{{@$entry->owner->full_name}}</span></a></div>
                        <div class="col-sm-6"> </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-6">- Mobile Phone : <span>{{@$entry->owner->phone}}</span></div>
                        <div class="col-sm-6"> </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">- Business Phone : <span>{{@$entry->owner->phone_2}}</span></div>
                        <div class="col-sm-6"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">- Contact Type : <span>{{@$entry->owner->type}}</span></div>
                        <div class="col-sm-6"></div>
                    </div>
                    <div>
                        <hr>
                    </div>


                    <div class="mnb-custom d-flex flex-wrap w-100 mb-3 bg-white">
                        <div class="d-flex justify-content-between flex-wrap w-100">
                        <ul class="nav" role="tabTitle">
                        <li class="nav-item">
                        <a class="nav-link" style="cursor: pointer;">
                        <i class="la la-home"></i>
                        More Info
                        </a>
                        </li>
                        </ul>

                        </div>
                        <div class=" w-100">
                        <div class="" id="MmIyNjY1N2YtNzY5Yi00ZjMyLWEwNTUtODhhMTliNmMyMWI50" role="tabpanel" aria-labelledby="Tasks">
                        <div class="card">
                        <div class="card-header with-border">
                        <h5 class="card-title">
                        Task Activities
                        </h5>
                        <div class="card-tools pull-right">
                        </div>
                        </div>

                        <div class="card-body" style="">
                        <div class="content-right-wrapper">
                        <div class="contact-information-content">
                        <div class="container pl-0">

                        <div class="row">
                        <div class="col-md-12 pr-0">

                        <div class="mx-0">
                        <div class="row">
                        <div class="col-lg-12">
                        <div class="table-responsive">
                         <table class="table border">
                        <thead class=" bg-light">
                        <tr class="text-primary">
                        <th scope="col" width="20%" class="align-top text-nowrap">Activity Type</th>
                        <th scope="col" width="25%" class="align-top text-nowrap">Activity Date Time </th>
                        <th scope="col" width="14%" class="align-top text-nowrap">Status</th>
                        <th scope="col" width="16%" class="align-top text-nowrap">Land Specialist</th>
                        <th scope="col" width="16%" class="align-top text-nowrap">Contact</th>

                        </tr>
                        </thead>
                        <tbody id="task-activity-body">
                            @if(isset($entry->tasks))
                                @foreach($entry->tasks as $task)
                                <tr>
                                    <td scope="col" class="align-top text-nowrap">{{$task->type}}</td>
                                    <td scope="col" class="align-top text-nowrap">{{$task->date}}</td>
                                    <td scope="col" class="align-top text-nowrap">{{$task->status}}</td>
                                    <td scope="col" class="align-top text-nowrap">{{$task->owner->FullName}}</td>
                                    <td scope="col" class="align-top text-nowrap">{{$task->contact->FullName}}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                        </table>
                        </div>
                        </div>
                        </div>
                        </div>

                        </div>

                        </div>

                        </div>
                        </div>
                        </div>
                        </div>

                        <div class="card-footer" style="">
                        <a href="" class="btn btn-primary text-white float-right mx-2"
                        id="add-task"
                        data-entry=""
                        data-action-form="show"
                        data-title="Task Activity"
                        data-toggle="modal"
                        data-target="#taskActivityModal">Add Task
                        </a>
                        </div>

                        </div>

                        <div class="modal fade" id="modalConfirmDeleteTaskActivity" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDeleteTaskActivityTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-body">
                        <div class="swal-icon swal-icon--warning">
                        <span class="swal-icon--warning__body">
                        <span class="swal-icon--warning__dot"></span>
                        </span>
                        </div>
                        <div class="text-center">
                        <div class="swal-title my-0">Warning</div>
                        <div class="swal-text mb-4">Are you sure you want to delete this task ?</div>
                        </div>
                        <div class="text-right">
                        <div class="swal-button-container">
                        <button class="swal-button swal-button--cancel bg-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="swal-button-container">
                        <button class="swal-button swal-button--delete bg-danger text-capitalize btnConfirmDeleteTaskActivity">Delete</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>

                    <div>
                        <hr>
                    </div>
                    <div>
                        <a href="/admin/property" class="btn btn-default btn-custom"><span class="la la-ban"></span> &nbsp;Back</a>
                    <button
                        v-bind:data-toggle="buttonStatus.toggle"
                        v-bind:data-target="buttonStatus.target"
                        type="submit"
                        data-id="1214"
                        class="btn btn-custom"
                        v-bind:class="buttonStatus.class"
                        @click="handleClick(1)"
                        id="submit_property_pending"
                        value="submit_property_pending"
                    >
                        @{{buttonStatus.text}}
                    </button>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($entry->listing()->orderBy('id','desc')->first()->id))
        <div class="col-md-4" id='listing-form'>
            <div class="card border-warning">
            <div class="card-header">
                @if($entry->listing()->orderBy('id','desc')->first()->status=="active")
                <h6 class="card-title">
                    <b>Current listing information</b>
                </h6>
                @else
                <h6 class="card-title">
                    <b>Last listing information</b>
                </h6>
                @endif
            </div>

            <div class="card-body" style="">
                <div class="content-right-wrapper p-2">
                    <div class="contact-information-content">
                        <input type="hidden" id="hidden_listing_id" value="188">
                        <div class="row listing_wrap">
                            <div class="col-6">
                                <span class="font-weight-600">Listing ID : <a href='/admin/listing/{{$entry->listing()->orderBy('id','desc')->first()->id}}/show'>{{(str_pad($entry->listing()->orderBy('id','desc')->first()->id, 6, 0, STR_PAD_LEFT))}}</a></span>

                            </div>
                            <div class="col-6">
                                <span class="font-weight-600">Status : </span>
                                <span>{{$entry->listing()->orderBy('id','desc')->first()->status}}</span>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span class="text-primary font-weight-600">Sale</span>
                                    @if(isset($entry->listing()->orderBy('id','desc')->first()->sale_list_price))
                                        <p><span class="text-primary text-break">{{"$ ".number_format($entry->listing()->orderBy('id','desc')->first()->sale_list_price, 2)}}</span></p>
                                    @else
                                        <p><span class="text-success text-break">-</span></p>
                                    @endif

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span class="text-success font-weight-600">Rent</span>
                                    @if(isset($entry->listing()->orderBy('id','desc')->first()->rent_list_price))
                                        <p><span class="text-primary text-break">{{"$ ".number_format($entry->listing()->orderBy('id','desc')->first()->rent_list_price, 2)}}</span></p>
                                    @else
                                        <p><span class="text-success text-break">-</span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span class="font-weight-600">Sale Commission</span>
                                    @if(isset($entry->listing()->orderBy('id','desc')->first()->sale_commission))
                                        <p><span class="text-primary text-break">{{"$ ".number_format($entry->listing()->orderBy('id','desc')->first()->sale_commission, 2)}}</span></p>
                                    @else
                                        <p><span class="text-success text-break">-</span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span class="font-weight-600">Rental Commission</span>
                                    @if(isset($entry->listing()->orderBy('id','desc')->first()->rental_commission))
                                        <p><span class="text-primary text-break">{{"$ ".number_format($entry->listing()->orderBy('id','desc')->first()->rental_commission, 2)}}</span></p>
                                    @else
                                        <p><span class="text-success text-break">-</span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span class="font-weight-600">Owner Name</span>
                                    <p>
                                        @if(isset($entry->owner->last_name))
                                            {{$entry->owner->first_name}} {{$entry->owner->last_name}}
                                        @else
                                            <span class="text-success text-break">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span class="font-weight-600">Land Specialist Name</span>
                                    <p>
                                        @if(isset($entry->contact->last_name))
                                            {{$entry->contact->first_name}} {{$entry->contact->last_name}}
                                        @else
                                            <span class="text-success text-break">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span class="font-weight-600">Sign Date</span>
                                    <p>8 September 2020</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span class="font-weight-600">Expired Date</span>
                                    <p>12 September 2020</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 mb-3">
                    <div class="owner-title pb-2">
                        <h6 class="font-weight-600 text-uppercase mb-0">Listing History</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered border-top m-0">
                            <thead>
                                <tr class="text-nowrap">
                                    <th scope="col" class="font-weight-600">No.</th>
                                    <th scope="col" class="font-weight-600">Listing ID</th>
                                    <th scope="col" class="font-weight-600">Listing sale price</th>
                                    <th scope="col" class="font-weight-600">Sold price</th>
                                    <th scope="col" class="font-weight-600">Listing Rental Price</th>
                                    <th scope="col" class="font-weight-600">Rented Price</th>
                                    <th scope="col" class="font-weight-600 text-nowrap">Owner Name</th>
                                    <th scope="col" class="font-weight-600 text-nowrap">Land Specialist Name</th>
                                    <th scope="col" class="font-weight-600 text-nowrap">Status</th>
                                    <th scope="col" class="font-weight-600">Transaction Date</th>
                                    <th scope="col" class="font-weight-600">Customer Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($entry->listing()->orderBy('id','desc')->get() as $item)
                                        @if($item->id!=$entry->listing()->orderBy('id','desc')->first()->id)

                                        <tr class="text-nowrap">
                                            <td scope="col" class="font-weight-600">{{$no}}</td>
                                            <td scope="col" class="font-weight-600"><a href='/admin/listing/{{$item->id}}/show'>{{(str_pad($item->id, 6, 0, STR_PAD_LEFT))}}</a></td>
                                            <td scope="col" class="font-weight-600" style="color: #7c69ef">@if(!isset($item->sale_price))-@else{{"$ ".number_format($item->sale_price, 2)}}@endif</td>
                                            <td scope="col" class="font-weight-600" style="color: #7c69ef">@if(!isset($item->sold_price))-@else{{"$ ".number_format($item->sold_price, 2)}}@endif</td>
                                            <td scope="col" class="font-weight-600" style="color: #7c69ef">@if(!isset($item->rental_price))-@else{{"$ ".number_format($item->rental_price, 2)}}@endif</td>
                                            <td scope="col" class="font-weight-600" style="color: #7c69ef">@if(!isset($item->rented_price))-@else{{"$ ".number_format($item->rented_price, 2)}}@endif</td>
                                            <td scope="col" class="font-weight-600 text-nowrap">
                                                @if(isset($item->owner->last_name))
                                                    {{$item->owner->FullName}}
                                                @endif
                                            </td>
                                            <td scope="col" class="font-weight-600 text-nowrap">
                                                @if(isset($item->contact->last_name))
                                                    {{$item->contact->FullName}}
                                                @endif
                                            </td>
                                            <td scope="col" class="font-weight-600 text-nowrap">{{$item->status}}</td>
                                            <td scope="col" class="font-weight-600">{{$item->sold_price_date}}</td>
                                            <td scope="col" class="font-weight-600">{{$item->customer_id}}</td>
                                        </tr>
                                        @php
                                            $no++;
                                        @endphp
                                        @endif
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="float-right">

                    <a href="#/"
                    class="btn btn-success btn-custom"
                    id="macf-call-modal-request-property-listing"
                    onclick="macfShowListingHistoryButtonModal.loadEntry(this)"
                    data-entry=""
                    data-action-form="show"
                    data-title=""
                    data-toggle="modal"
                    data-target="#exampleModal1">See All
                    </a>
                    </div>
            </div>

            </div>
        </div>
        @endif
    </div>

</div>
@endsection
@include('components.task_activity_modal')
@include('components.listing_history_modal')
@include('components.modal')




@section('after_styles')
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/show.css') }}">
@endsection

@section('after_scripts')
	<script src="{{ asset('packages/backpack/crud/js/crud.js') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/show.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>

            $(function () {
                if($('#status').text()=="Listing"){
                    $('#submit_property_pending').hide();
                }

                $('#add-task').on('click',function(){
                    $('div.model-backdrop').remove();
                });

            });

            new Vue({
                el: '#property_show',
                data: {
                    status: '{{$entry->status}}',
                    indication: '{{$entry->is_appraisal}}',
                },
                computed: {
                    buttonStatus: function() {
                        return this.status == 'Draft' ? {
                            class: "btn-primary",
                            text: "Request Property"
                        } : (
                            this.status == 'Property Pending' ?{
                                class: "btn-success",
                                text:  "Approve Property"
                            }:(
                                this.status == 'Property' ?{
                                    class: "btn-primary",
                                    text: "Request Listing",
                                    toggle:"modal",
                                    target:"#exampleModal",
                                }:{
                                        class: "btn-success",
                                        text: "Approve Listing",
                                    }
                                )
                            )
                        ;
                    }
                },
                methods:{
                    handleClick: function(e){
                        if(e==1){
                            if(this.indication=="1"){
                            if(this.status=="Listing Pending"){
                            axios.post('{{URL::to("/api/listing/create")}}/{{$entry->id}}').then(val=>{
                            });
                            }

                            if(this.status!='Property'){
                                axios.put('{{ URL::to("/api/property/status") }}/{{$entry->id}}')
                                .then(val => {
                                this.status=val.data.status;
                                if(this.status!="Listing Pending"){
                                        new Noty({
                                            type: "success",
                                            text: 'Property stasus has change successfully!',
                                        }).show();
                                }
                                if(this.status=="Listing"){
                                        $('#submit_property_pending').hide();
                                        $('#listing-form').show();
                                    }
                                });
                            }else{
                                $('#buttonSubmit').on('click',function(){
                                    console.log('hello');
                                    axios.put('{{ URL::to("/api/property/status") }}/{{$entry->id}}')
                                    .then(val => {
                                    this.status=val.data.status;
                                    // if(this.status!="Listing Pending"){
                                    //         new Noty({
                                    //             type: "success",
                                    //             text: 'Property stasus has change successfully!',
                                    //         }).show();
                                    // }
                                    if(this.status=="Listing"){
                                            $('#submit_property_pending').hide();
                                        }
                                    });
                                });
                            }
                            }else{
                                new Noty({
                                    type: "error",
                                    text: 'Please Request Indication!',
                                }).show();
                            }
                        }
                        if(e==2){
                            axios.put('{{ URL::to("/api/property/indication") }}/{{$entry->id}}')
                                    .then(val => {
                                        location.reload();
                                    });
                        }

                    }

                },
                created: async function(){

                }
            });



            function initializeFieldsWithJavascript(container) {
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

            jQuery('document').ready(function($){

                // trigger the javascript for all fields that have their js defined in a separate method
                initializeFieldsWithJavascript('body');
            });

        </script>
@endsection
