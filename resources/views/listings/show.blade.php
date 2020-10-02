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
                <div class="card-body">

                    <div class="slider-preview-content mt-3">
                        <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel" style="background: #333;">
                            <div class="carousel-inner center">
                                @if(isset($entry->property->image))
                                    <div class="carousel-item active"><img style="height: 430px; margin: 0 auto;"  class="d-block "  alt="First slide [800x400]" src="http://127.0.0.1:8000/{{$entry->property->image}}" data-holder-rendered="true"></div>
                                @endif
                                @if(isset($entry->property->image_left_side))
                                    <div class="carousel-item"><img style="height: 430px; margin: 0 auto;" class="d-block "  alt="Second slide [800x400]" src="http://127.0.0.1:8000/{{$entry->property->image_left_side}}" data-holder-rendered="true"></div>
                                @endif
                                @if(isset($entry->property->image_right_side))
                                    <div class="carousel-item"><img style="height: 430px; margin: 0 auto;" class="d-block"  alt="Third slide [800x400]" src="http://127.0.0.1:8000/{{$entry->property->image_right_side}}" data-holder-rendered="true"></div>
                                @endif
                                @if(isset($entry->property->image_back_side))
                                    <div class="carousel-item"><img style="height: 430px; margin: 0 auto;" class="d-block"  alt="Third slide [800x400]" src="http://127.0.0.1:8000/{{$entry->property->image_back_side}}" data-holder-rendered="true"></div>
                                @endif
                                @if(isset($entry->property->image_opposite))
                                    <div class="carousel-item"><img style="height: 430px; margin: 0 auto;" class="d-block"  alt="Third slide [800x400]" src="http://127.0.0.1:8000/{{$entry->property->image_opposite}}" data-holder-rendered="true"></div>
                                @endif
                            </div><a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
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
                        <tr>
                        <th class="th font-weight-600" scope="row">Building 1</th>
                        <td class="th font-weight-600">{{$entry->building_width}}</td>
                        <td class="th font-weight-600">{{$entry->building_length}}</td>
                        <td class="th font-weight-600">{{$entry->building_area}}</td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                    {{-- Title Deed Information --}}
                    <nav class="navbar navbar-light bg-light mt-3 mb-4">
                        <div class="navbar-brand mb-0 font-weight-600">Title Deed Information</div>
                    </nav>

                    @if(isset($entry->property->titledeeds))
                        @foreach ($entry->property->titledeeds as $key => $item)
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
                                    <div class="col-sm-6">Total Size By Title Deed : <span>{{$entry->property->land_area}}</span></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if($entry->property->record_type!=='land')
                    <nav class="navbar navbar-light bg-light mt-3 mb-4">
                        <div class="navbar-brand mb-0 font-weight-600">Building Information</div>
                    </nav>
                    @if(isset($entry->property->units))
                        @php
                            $index=1;
                        @endphp
                        @foreach ($entry->property->units as $item)
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

                    <div class="wrap-indication mb-4">
                        <nav class="navbar navbar-light bg-light mt-4">
                        <label for="" class="navbar-brand mb-0 h3 font-weight-600">Indication</label>
                        </nav>
                        <div class="row mb-3">
                        <div class="col-md-4 mt-3">
                        <button class="btn px-1 font-weight-600 border px-3 bg-indication" id="request_indication" style="background-color: #f9e8cd91">Request Indication</button>
                        </div>
                        </div>
                        <div class="row">
                        </div>
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
                        <div class="col-sm-6">- Full Name : <span>{{@$entry->owner->full_name}}</span></div>
                        <div class="col-sm-6"> - Full Name : <span>{{@$entry->contact->first_name}}</span></div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-6">- Mobile Phone : <span>{{@$entry->owner->phone}}</span></div>
                        <div class="col-sm-6"> - Mobile Phone : <span>{{@$entry->contact->phone}}</span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">- Business Phone : <span>{{@$entry->owner->phone_2}}</span></div>
                        <div class="col-sm-6"> - Business Phone : <span>{{@$entry->contact->phone_2}}</span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">- Contact Type : <span>{{@$entry->owner->type}}</span></div>
                        <div class="col-sm-6"> - Contact Type : <span>{{@$entry->contact->type}}</span></div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div>
                        <a href="/admin/listing" class="btn btn-default btn-custom"><span class="la la-ban"></span> &nbsp;Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h5 class="card-title">
                        Listing History
                    </h5>
                </div>

                <div class="card-body" style="">
                    <div class="p-2 mb-3">
                        <div class="owner-title pb-2">
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

                                    @if(isset($entry->property->listing[0]))
                                            @php
                                                $no=1;
                                            @endphp
                                        @foreach ($entry->property->listing()->orderBy('id','desc')->get() as $item)
                                            @if($item->id<$entry->id)

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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="float-right">
                    <button type="button" id="macf-showListingHistory-button" data-action-form="show" class="btn btn-success btn-custom d-none macf-showListingHistory-button"><i class="fa "></i>Request Listing
                    <!----></button>
                    <a href="#/" class="btn btn-success btn-custom" id="macf-call-modal-request-property-listing" onclick="macfShowListingHistoryButtonModal.loadEntry(this)" data-entry="" data-action-form="show" data-title="" data-toggle="modal" data-target="#exampleModal">See All
                    </a>
                    </div>
                </div>


                </div>
        </div>
    </div>
</div>
@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 90%;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Listing History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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

                    @if(isset($entry->property->listing[0]))
                            @php
                                $no=1;
                            @endphp
                        @foreach ($entry->property->listing()->orderBy('id','desc')->get() as $item)
                            @if($item->id<$entry->id)

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
                    @endif
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@include('components.modal')


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/show.css') }}">
@endsection

@section('after_scripts')
@endsection
