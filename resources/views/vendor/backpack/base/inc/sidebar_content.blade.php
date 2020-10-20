<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
@if(backpack_user()->hasRole('Developer')||backpack_user()->hasRole('Manager'))
<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href='#'><i class="nav-icon la la-user"></i> Contacts</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact') }}'><i class="nav-icon la la-user"></i> Contact Lists</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact?is_vip=1') }}'><i class="nav-icon la la-user"></i>VIP Contact Lists</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('account') }}'><i class="nav-icon la la-building"></i> Accounts</a></li>
    </ul>
</li>
@endif
@if(backpack_user()->hasRole('User')||backpack_user()->hasRole('Manager')||backpack_user()->hasRole('Developer'))
<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href='#'><i class="nav-icon la la-home"></i> Properties</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('property') }}'><i class="nav-icon la la-list-alt"></i> Property Lists</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('listing') }}'><i class="nav-icon la la-list-alt"></i> Listing Lists</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('property/create?record_type=land') }}'><i class="nav-icon la la-plus-square"></i> Add New Land</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('property/create?record_type=building') }}'><i class="nav-icon la la-plus-square"></i> Add New Building</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('property/create?record_type=land_and_building') }}'><i class="nav-icon la la-plus-square"></i> Add New Land and Building</a></li>
    </ul>
</li>
@endif

@if(backpack_user()->hasRole('Developer'))
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
	<ul class="nav-dropdown-items">
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
	</ul>
</li>

@endif

