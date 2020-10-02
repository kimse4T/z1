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
                <i class="la la-suitcase"></i>Company Information
            </div>
            <div class="card-body">
              <div >
                <div class="text-center">
                <h3 class="profile-username text-center text-capitalize text-break p-5">{{$entry->name}}</h3>
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
                <strong><i class="la la-industry mr-1"></i></strong>
                <span class="text-dark text-break">{{$entry->industry}}</span>
                </li>
                <li class="list-group-item border-left-0 border-right-0">
                <strong><i class="la la-id-card mr-1"></i></strong>
                <span class="text-dark text-break">{{$entry->account_number}}</span>
                </li>
                <li class="list-group-item border-left-0 border-right-0">
                <strong><i class="la la-building mr-1"></i></strong>
                <span class="text-dark text-break">{{$entry->bank_branch}}</span>
                </li>
                <li class="list-group-item border-left-0 border-right-0">
                <strong><i class="la la-map mr-1"></i></strong>
                <span class="text-dark text-break">{{$entry->billing_address}}</span>
                </li>
                <li class="list-group-item border-left-0 border-right-0">
                <strong><i class="la la-calendar-day mr-1"></i></strong>
                <span class="text-dark text-break">{{\Carbon\Carbon::parse($entry->valid_until)->format('d F Y')}}</span>
                </li>
                <li class="list-group-item border-left-0 border-right-0">
                <strong><i class="la la-rss mr-1"></i></strong>
                <a href="{{$entry->website}}" target="_blank">{{$entry->website}}</a>
                </li>
                <li class="list-group-item border-left-0 border-right-0">
                <strong><i class="la la-star mr-1"></i></strong>
                <span class="text-dark text-break">{{$entry->rating}}</span>
                </li>
                </ul>
                <a href="/admin/account/{{$entry->id}}/edit" class="btn btn-primary btn-block"><b>Edit</b></a>
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
                        Account Information
                        </a>
                    </li>
                    <li class="nav-item" role="tablist">
                        <a class="nav-link btn-tab-change" data-toggle="tab" href="#MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh1" role="tab" data-type="List Employee" aria-selected="false">
                        List Employee
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
                                <h4 class="navbar navbar-light mt-3 pl-0">Account Information</h4>
                                <div class="row pl-0">
                                    <div class="col-md-6 pt-2">
                                        <label>Parent : <span>{{$entry->parent_id}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Phone : <a href="tel:+8557598661714" class="text-primary">{{$entry->phone}}</a></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Name : <span>{{$entry->name}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label> Email : <a href="mailto:pynif@mailinator.com" class="text-primary">{{$entry->email}}</a></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label> Industry : <span>{{$entry->industry}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label> Account Number : <span>{{$entry->account_number}}</span></label>
                                    </div>
                                        <div class="col-md-6 pt-2">
                                    <label> Bank branch : <span>{{$entry->bank_branch}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label> Billing Address : <span>{{$entry->billing_address}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label> Valid Until : <span>{{\Carbon\Carbon::parse($entry->valid_until)->format('d F Y')}}</span></label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label> Website : <a href="{{$entry->website}}" target="_blank" class="text-primary">{{$entry->website}}</a>
                                    </label>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label> Rating : <span>{{$entry->rating}}</span></label>
                                    </div>
                                    <div class="col-md-12 pt-2">
                                    <strong>Description</strong>
                                    <p class="text-dark text-break">{{$entry->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="tab-pane fade" id="MGNkYjg1MGUtODYzNC00OGIyLTgxZWYtZWM1NDNkMTEyZTNh1" role="tabpanel" aria-labelledby="List Employee">
        <div class="box box-box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">
        List Employee
        </h3>
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="la la-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="la la-times"></i></button>
        </div>
        </div>

        <div class="box-body" style="">
        <div class="container-fluid px-0">
        <table class="table table-inverse table-hover table-responsive-md">
        <thead class="thead-default">
        <tr>
        <th class="text-nowrap">Contact ID</th>
        <th class="text-nowrap">Profile</th>
        <th class="text-nowrap">Name</th>
        <th class="text-nowrap">Contact Type</th>
        <th class="text-nowrap">Position/Occupation</th>
        <th class="text-nowrap">Phone</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td class="align-middle">44</td>
        <td class="align-middle">
        <img src="https://testing.z1central.com/thumbnail/small/uploads/images/202007/b1742276b70647856bbf8a98e28071de.png" class="profile-user-img img-responsive rounded-circle" width="30px" height="30px" alt="User profile picture">
        </td>
        <td class="align-middle">Mr. te reaksmey</td>
        <td class="align-middle">Owner</td>
        <td class="align-middle"></td>
        <td class="align-middle">+855888088007</td>
        <td><a href="https://testing.z1central.com/admin/contact/44/show" class="text-decoration-none" target="_blank">
        <button type="button" class="btn btn-primary"><i class="la la-eye"></i></button>
        </a>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div>


        </div> </div>
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
