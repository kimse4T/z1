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
<div class="row pt-4">
    <div class="col-md-3 ">
        <div class="card">
            <div class="card-header">
                <i class="la la-user"></i>User Information
            </div>
            <div class="card-body">
              <div >
                <div class="text-center">
                <h3 class="profile-username text-center text-capitalize text-break p-5">PROFILE</h3>
                </div>
                <ul class="list-group pb-2">
                <li class="list-group-item border-left-0 border-right-0">
                <i class="nav-icon la la-phone mr-1"></i>
                <a href="tel::" class="text-break">{{$entry->phone}}</a>
                </li>
                <li class="list-group-item border-left-0 border-right-0">
                <i class="nav-icon la la-envelope mr-1"></i>
                <a class="text-dark text-break" href="mailto:pynif@mailinator.com">{{$entry->email}}</a>
                </li>
                <li class="list-group-item border-left-0 border-right-0">
                <strong><i class="la la-map-marker mr-1"></i></strong>
                <span class="text-dark text-break">{{$entry->address}}</span>
                </li>

                </ul>
                <a href="/admin/contact/{{$entry->id}}/edit" class="btn btn-primary btn-block"><b>Edit</b></a>
              </div>
            </div>
          </div>
    </div>
    <div class="col-md-9 pl-0">
        <div class="mnb-custom d-flex flex-wrap w-100 mb-3 bg-white">
            <div class="d-flex justify-content-between flex-wrap w-100">
                <ul class="nav" role="tabTitle">
                    <li class="nav-item">
                        <a class="nav-link" style="cursor: pointer;">
                        <i class="la la-home"></i>
                        Information
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="tablist">
                        <a class="nav-link btn-tab-change active" data-toggle="tab" href="#MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh0" role="tab" data-type="Account Information" aria-selected="true">
                        My Profile
                        </a>
                    </li>
                    <li class="nav-item" role="tablist">
                        <a class="nav-link btn-tab-change" data-toggle="tab" href="#MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh1" role="tab" data-type="List Employee" aria-selected="false">
                        My Tasks
                        </a>
                    </li>
                    <li class="nav-item" role="tablist">
                        <a class="nav-link btn-tab-change" data-toggle="tab" href="#MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh2" role="tab" data-type="List Employee" aria-selected="false">
                        Owner Property
                        </a>
                    </li>
                    <li class="nav-item" role="tablist">
                        <a class="nav-link btn-tab-change" data-toggle="tab" href="#MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh3" role="tab" data-type="List Employee" aria-selected="false">
                        Property
                        </a>
                    </li>
                    <li class="nav-item" role="tablist">
                        <a class="nav-link btn-tab-change" data-toggle="tab" href="#MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh4" role="tab" data-type="List Employee" aria-selected="false">
                        Listing
                        </a>
                    </li>
                </ul>
            </div>
        <div class="tab-content w-100">
            <div class="tab-pane fade active show" id="MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh0" role="tabpanel" aria-labelledby="Account Information">
                <div class="container-fluid px-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-content">
                                <h4 class="navbar navbar-light mt-3 pl-0">Contact Information</h4>
                                <div class="row pl-0">
                                    <div class="col-md-6 pt-2">
                                        <label>Name : <span>{{$entry->first_name}} {{$entry->last_name}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Contact Type : <span>{{$entry->type}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Phone : <a href="tel:{{$entry->phone}}" class="text-primary">{{$entry->phone}}</a></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Business Phone : <a href="tel:{{$entry->phone_2}}" class="text-primary">{{$entry->phone_2}}</a></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label> Email : <a href="mailto:{{$entry->email}}" class="text-primary">{{$entry->email}}</a></label>
                                    </div>
                                </div>
                                <h4 class="navbar navbar-light mt-3 pl-0">Personal Information</h4>
                                <div class="row pl-0">
                                    <div class="col-md-6 pt-2">
                                        <label>Working Field : <span>{{$entry->working_field}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Position/Occupation : <span>{{$entry->occupation}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Relationships : <span>{{$entry->relationship}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Identity Card Number : <span>{{$entry->identity_card}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label> Date of Birth : <span>{{\Carbon\Carbon::parse($entry->date_of_birth)->format('d F Y')}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Remark : <span>{{$entry->remark}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Identity Card Photos : <span>{{$entry->identify_card_image}}</span></label>
                                    </div>
                                </div>
                                <h4 class="navbar navbar-light mt-3 pl-0">Address</h4>
                                <div class="row pl-0">
                                    <div class="col-md-6 pt-2">
                                        <label>Address : <span>{{$entry->address}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>House No. : <span>{{$entry->house_no}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Street No. : <span>{{$entry->street_no}}</span></label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="tab-pane fade" id="MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh1" role="tabpanel" aria-labelledby="List Employee">
            <div class="box box-box box-primary">
                <div class="box-body" style="">
                    <div class="tab-pane fade active show" id="MzE1YjIxYjYtYjA5Yy00MzgwLTk3ZmQtNWNmMmZhNmQ1OGE41" role="tabpanel" aria-labelledby="My Tasks">
                        <div class="d-flex mb-3 justify-content-end">
                        <button type="button" id="macf-taskActivity-button" class="float-right macf-taskActivity-button btn btn-primary btn-sm macf-taskActivity-button"><i class="fa la la-plus fa-lg"></i>Add task
                        <!----></button>
                        </div>
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
                        <th scope="col" width="20%" class="align-top text-nowrap">Activity Date Time </th>
                        <th scope="col" width="12%" class="align-top text-nowrap">Status</th>
                        <th scope="col" width="20%" class="align-top text-nowrap">Land Specialist</th>
                        <th scope="col" width="19%" class="align-top text-nowrap">Customer Information</th>
                        <th scope="col" width="7%" class="align-top text-nowrap">
                        </th>
                        </tr>
                        </thead>
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

                        <div class="modal fade" id="modalConfirmDeleteTaskActivityContact" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDeleteTaskActivityContactTitle" aria-hidden="true">
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
                        <button class="swal-button swal-button--delete bg-danger text-capitalize btnConfirmDeleteTaskActivityContact">Delete</button>
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
        <div class="tab-pane fade" id="MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh2" role="tabpanel" aria-labelledby="List Employee">

        </div>
        <div class="tab-pane fade" id="MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh3" role="tabpanel" aria-labelledby="List Employee">

        </div>
        <div class="tab-pane fade" id="MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh4" role="tabpanel" aria-labelledby="List Employee">

        </div>
        </div>
        </div>
    </div>
    </div>
@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/show.css') }}">
@endsection

@section('after_scripts')
	<script src="{{ asset('packages/backpack/crud/js/crud.js') }}"></script>
	<script src="{{ asset('packages/backpack/crud/js/show.js') }}"></script>
@endsection
