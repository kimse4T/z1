@if(isset($entry) && $entry)
    @php
        $checkValue = old($field['name']) ?? $entry->{$field['name']};
        $fieldName  = $field['name'].'_button_checkbox';
        // if($field['name'] == "is_appraisal" && $entry->is_appraisal == 1)
        // $fieldName  = '';
    @endphp

    <div class="{{ $field['wrapper'] }}">
        <span class="{{$fieldName}}">
            <button type="button" class="btn btn-sm {{ $checkValue == 1 ? 'btn-primary active' : ''}}" data-color="primary"><i class="state-icon la la-check-circle"></i>{{$field['label']}}</button>
            <input type="checkbox" class="d-none"
            data-init-function="bpFieldInitCheckbox"
            @if (old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? false)
                 checked="checked"
            @endif
            @if (isset($field['attributes']))
                @foreach ($field['attributes'] as $attribute => $value)
                    {{ $attribute }}="{{ $value }}"
                @endforeach
            @endif
            id="{{ $field['name'] }}_checkbox">
            {{-- <input type="hidden" name="{{ $field['name'] }}" value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? 0 }}"> --}}
            <input type="hidden" name="{{ $field['name'] }}" value="{{  $checkValue ? 1 : 0 }}">
        </span>
    </div>
@else
    <div class="{{ $field['wrapper'] }}">

        <span class="{{$field['name']}}_button_checkbox">
            <button type="button" class="btn btn-sm" data-color="primary">{{$field['label']}}</button>
            <input type="checkbox" class="d-none" data-init-function="bpFieldInitCheckbox"
                @if (old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? false)
                    checked="checked"
                @endif
                id="{{ $field['name'] }}_checkbox">
            <input type="hidden" name="{{ $field['name'] }}" value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? 0 }}">
        </span>
    </div>
@endif

@push('crud_fields_scripts')

    <script type="text/javascript">
        $(function () {
            var name = '.{{ $field['name'] }}_button_checkbox';
            $(name).each(function () {
            // Settings
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'la la-check-circle'
                    },
                    off: {
                        icon: 'la la-circle'
                    }
                };

            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });

            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');

                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");

                // Set the button's icon
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);

                // Update the button's color
                if (isChecked) {
                    $button
                        .removeClass('btn-light')
                        .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-light');
                }
            }

            // Initialization
            function init() {

                updateDisplay();

                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }
            init();
            });
        });
    </script>
@endpush

{{-- Script check update value 1 or 0 --}}
@if ($crud->fieldTypeNotLoaded($field))

    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp
    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script>
            function bpFieldInitCheckbox(element) {
                var hidden_element = element.siblings('input[type=hidden]');
                // console.log(hidden_element);
                // make sure the value is a boolean (so it will pass validation)
                if (hidden_element.val() === '') hidden_element.val(0);

                // set the default checked/unchecked state
                // if the field has been loaded with javascript
                if (hidden_element.val() != 0) {
                  element.prop('checked', 'checked');
                } else {
                  element.prop('checked', false);
                }

                // when the checkbox is clicked
                // set the correct value on the hidden input
                element.change(function() {
                  if (element.is(":checked")) {
                    hidden_element.val(1);
                  } else {
                    hidden_element.val(0);
                  }
                })
            }
        </script>
    @endpush

@endif
