@php
$field['wrapper'] = $field['wrapper'] ?? $field['wrapperAttributes'] ?? [];
$field['wrapper']['class'] = $field['wrapper']['class'] ?? "form-group col-sm-12";
@endphp
@include('crud::fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
<select name="{!! $field['name'] !!}" class="form-control remove-value">
<option value="">-</option>
@foreach ($options as $key => $values)
<option value="{{ $values }}" {{ isset($value) && $values == $value ? 'selected' : '' }}>{{ $values }}</option>
@endforeach
</select>
@include('crud::fields.inc.wrapper_end')
