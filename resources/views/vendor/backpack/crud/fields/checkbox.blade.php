<!-- checkbox field -->

@include('crud::fields.inc.wrapper_start')
@include('crud::fields.inc.translatable_icon')
<div class="checkbox">
<input type="hidden" name="{{ $field['name'] }}" value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? 0 }}">
<input type="checkbox"
class="p-checkbox-custom"
{{-- data-init-function="bpFieldInitCheckbox" --}}

@if (old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? false)
checked="checked"
@endif

{{-- @if (isset($field['attributes']))
@foreach ($field['attributes'] as $attribute => $value)
{{ $attribute }}="{{ $value }}"
@endforeach
@endif --}}
>
<label class="form-check-label font-weight-normal p-label-custom">{!! $field['label'] !!}</label>

{{-- HINT --}}
@if (isset($field['hint']))
<p class="help-block">{!! $field['hint'] !!}</p>
@endif
</div>
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
@php
$crud->markFieldTypeAsLoaded($field);
@endphp
{{-- FIELD JS - will be loaded in the after_scripts section --}}
@push('crud_fields_scripts')
<script>
$(function () {
$(document).on('click', '.p-label-custom', function () {
$checkbox = $(this).prev()

if ($checkbox.is(':checked')) {
$checkbox.prop('checked', false).change();
} else {
$checkbox.prop('checked', 'checked').change();
}
})

$(document).on('change', '.p-checkbox-custom', function () {
// console.log(2)
$checkboxHidden = $(this).prev()

if ($(this).is(':checked')) {
$checkboxHidden.val(1);
} else {
$checkboxHidden.val(0);
}
})
})
// function bpFieldInitCheckbox(element) {
// var hidden_element = element.siblings('input[type=hidden]');
// var id = 'checkbox_'+Math.floor(Math.random() * 1000000);

// // make sure the value is a boolean (so it will pass validation)
// if (hidden_element.val() === '') hidden_element.val(0);

// // set unique IDs so that labels are correlated with inputs
// // element.attr('id', id);
// // element.siblings('label').attr('for', id);

// // set the default checked/unchecked state
// // if the field has been loaded with javascript
// if (hidden_element.val() != 0) {
// element.prop('checked', 'checked');
// } else {
// element.prop('checked', false);
// }

// $(element).on('change', function() {
// $elemSib = $(this).siblings('input[type=hidden]');
// if ($(this).is(":checked")) {
// $elemSib.val(1);
// } else {
// $elemSib.val(0);
// }
// })

// // when the checkbox is clicked
// // set the correct value on the hidden input
// // element.change(function() {
// // if (element.is(":checked")) {
// // hidden_element.val(1);
// // } else {
// // hidden_element.val(0);
// // }
// // })
// }
</script>
@endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
