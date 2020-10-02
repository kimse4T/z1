<!-- text input -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    @if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if(isset($field['prefix'])) <div class="input-group-prepend"><span class="input-group-text">{!! $field['prefix'] !!}</span></div> @endif
        <input
            type="text"
            name="{{ $field['name'] }}"
            id="{{ $field['name'] }}"
            value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
            @include('crud::fields.inc.attributes')
        >
        @if(isset($field['suffix'])) <div class="input-group-append"><span class="input-group-text">{!! $field['suffix'] !!}</span></div> @endif
    @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')


{{-- FIELD EXTRA CSS  --}}
{{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
        <link rel="stylesheet" href="{{ asset('assets/libraries/intl-tel-input/css/intlTelInput.min.css') }}">
        <style>.intl-tel-input{width: 100%;}</style>
    @endpush


{{-- FIELD EXTRA JS --}}
{{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <script src="{{ asset('assets/libraries/intl-tel-input/js/intlTelInput.min.js') }}"></script>
<script>
    $(function () {
        var input = 'input_'+ '{{ $field['name'] }}'
        var iti = 'iti_'+ '{{ $field['name'] }}'
        var myHandle = 'myHandle_'+ '{{ $field['name'] }}'

        input = document.querySelector("#{{ $field['name'] }}");
             iti = intlTelInput(input, {
                preferredCountries: ['kh'],
                autoFormat: false,
                // formatOnInit:true,
                formatOnDisplay: false,
                customPlaceholder: function () {
                    return 'Phone';
                },
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@15.0.2/build/js/utils.js",
            })

            // window.iti = iti;

            myHandle = function ()  { $('#{{ $field['name'] }}').val(iti.getNumber()); }

            input.addEventListener("countrychange", function() {
                window[myHandle]();
            });

            input.addEventListener('change', myHandle);
            input.addEventListener('keyup', myHandle);

    });
</script>
    @endpush


{{-- Note: you can use @if ($crud->checkIfFieldIsFirstOfItsType($field, $fields)) to only load some CSS/JS once, even though there are multiple instances of it --}}
