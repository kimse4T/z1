{{--
HOW TO USE:
1. Create new file
2. Include: @include('crud::fields.flexi.upload_multiple', [...])
3. Define your label name (label)
4. Define your ID (gallery_id)

Note: Make sure your ID is valid. Example: PropertyGallery, property_gallery

For example:
@include('crud::fields.flexi.upload_multiple', [
    'label' => trans('flexi.properties.gallery'),
    'gallery_id' => 'PropertyGallery'
])
--}}


@push('crud_fields_styles')
    {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.css"> --}}
    <style>
        .custom-file-container {
            box-sizing: border-box;
            position: relative;
            display: block; }
        .custom-file-container__custom-file {
            box-sizing: border-box;
            position: relative;
            display: inline-block;
            width: 100%;
            height: calc(2.25rem + 2px);
            margin-bottom: 0;
            margin-top: 5px; }
            .custom-file-container__custom-file:hover {
            cursor: pointer; }
            .custom-file-container__custom-file__custom-file-input {
            box-sizing: border-box;
            min-width: 14rem;
            max-width: 100%;
            height: calc(2.25rem + 2px);
            margin: 0;
            opacity: 0; }
        .custom-file-container__custom-file__custom-file-input:focus ~ span {
            outline: 1px dotted #212121;
            outline: 5px auto -webkit-focus-ring-color; }
        .custom-file-container__custom-file__custom-file-control {
            box-sizing: border-box;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 5;
            height: calc(2.25rem + 2px);
            padding: .5rem .75rem;
            overflow: hidden;
            line-height: 1.5;
            color: #333;
            user-select: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c0c0af;
            border-radius: .25rem; }
        .custom-file-container__custom-file__custom-file-control__button {
            box-sizing: border-box;
            position: absolute;
            top: 0;
            right: 0;
            z-index: 6;
            display: block;
            height: calc(2.25rem + 2px);
            padding: .5rem .75rem;
            line-height: 1.25;
            color: #333;
            background-color: #EDEDE8;
            border-left: 1px solid #c0c0af;
            box-sizing: border-box; }
        .custom-file-container__image-preview {
            box-sizing: border-box;
            transition: all 0.2s ease;
            margin-top: 20px;
            margin-bottom: 40px;
            height: 120px;
            width: 100%;
            border-radius: 4px;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-color: #fff;
            overflow: scroll; }
        .custom-file-container__image-multi-preview {
            position: relative;
            box-sizing: border-box;
            transition: all 0.2s ease;
            border-radius: 6px;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            float: left;
            margin: 15px;
            width: 112px;
            height: 90px;
            box-shadow: 0 4px 10px 0 rgba(51, 51, 51, 0.25); }
        .custom-file-container__image-multi-preview__single-image-clear {
            left: -6px;
            background: #EDEDE8;
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            text-align: center;
            margin-top: -6px;
            box-shadow: 0 4px 10px 0 rgba(51, 51, 51, 0.25); }
        .custom-file-container__image-multi-preview__single-image-clear:hover {
            background: #cbcbbd;
            cursor: pointer; }
        .custom-file-container__image-multi-preview__single-image-clear__icon {
            color: #6a6a53;
            display: block;
            margin-top: -2px; }

        .custom-file-container {
            /* max-width: 400px; */
            margin: 0 auto;
        }
    </style>
@endpush
@php
    if (!isset($field['wrapperAttributes']) || !isset($field['wrapperAttributes']['data-init-function'])){
        $field['wrapperAttributes']['data-init-function'] = 'bpFieldInitUploadMultipleElement';
    }

    if (!isset($field['wrapperAttributes']) || !isset($field['wrapperAttributes']['data-field-name'])) {
        $field['wrapperAttributes']['data-field-name'] = $field['name'];
    }

@endphp

<!-- upload multiple input -->
<div @include('crud::fields.inc.wrapper_start') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

	{{-- Show the file name and a "Clear" button on EDIT form. --}}
	@if (isset($field['value']))
	@php
		if (is_string($field['value'])) {
			$values = json_decode($field['value'], true) ?? [];
		} else {
			$values = $field['value'];
		}
	@endphp
	@if (count($values))
    <div class="well well-sm existing-file">
    	@foreach($values as $key => $file_path)
    		<div class="file-preview">
    			@if (isset($field['temporary']))
		            <a target="_blank" href="{{ isset($field['disk'])?asset(\Storage::disk($field['disk'])->temporaryUrl($file_path, Carbon\Carbon::now()->addMinutes($field['temporary']))):asset($file_path) }}">{{ $file_path }}</a>
		        @else
		            <a target="_blank" href="{{ isset($field['disk'])?asset(\Storage::disk($field['disk'])->url($file_path)):asset($file_path) }}">{{ $file_path }}</a>
		        @endif
		    	<a href="#" class="btn btn-light btn-sm float-right file-clear-button" title="Clear file" data-filename="{{ $file_path }}"><i class="fa fa-remove"></i></a>
		    	<div class="clearfix"></div>
	    	</div>
    	@endforeach
    </div>
    @endif
    @endif
    {{-- Show the file picker on CREATE form. --}}
    <div class="custom-file-container mx-0 mt-3" data-upload-id="{{ $gallery_id }}">
        <label>{{ $label }} <a href="javascript:void(0)" class="custom-file-container__image-clear d-none" title="{{ trans('flexi.properties.clear_image') }}">&times;</a></label>
        <label class="custom-file-container__custom-file">
            <input name="{{ $field['name'] }}[]" type="hidden" value="">
            <div class="backstrap-file mt-2">
                <input
                    type="file"
                    name="{{ $field['name'] }}[]"
                    class="custom-file-container__custom-file__custom-file-input"
                    accept="*" multiple aria-label="Choose File"
                    value="@if (old(square_brackets_to_dots($field['name']))) old(square_brackets_to_dots($field['name'])) @elseif (isset($field['default'])) $field['default'] @endif"
                    @include('crud::fields.inc.attributes', ['default_class' =>  isset($field['value']) && $field['value']!=null?'file_input backstrap-file-input':'file_input backstrap-file-input'])
                    multiple
                >
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span class="custom-file-container__custom-file__custom-file-control"></span>
                <label class="backstrap-file-label" for="customFile"></label>
            </div>
        </label>
        <div class="custom-file-container__image-preview mb-0" id="sortable-container"></div>
    </div>
    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp
@push('crud_fields_scripts')
    <script>
        var presetFiles = [];
    </script>
@endpush

{{-- WHEN UPDATE THE GALLERY --}}
@if (isset($entry) && $entry)
    <div @include('crud::fields.inc.wrapper_start') >
        <label class="d-none">{!! $field['label'] !!}</label>
        @include('crud::fields.inc.translatable_icon')

        {{-- Show the file name and a "Clear" button on EDIT form. --}}
        @if (isset($field['value']))
        @php
            if (is_string($field['value'])) {
                $values = json_decode($field['value'], true) ?? [];
            } else {
                $values = $field['value'];
            }
        @endphp
        @if (count($values))
        <div class="well well-sm existing-file">
            @foreach($values as $key => $file_path)
                <div class="file-preview d-none">
                    @if (isset($field['temporary']))
                        <a target="_blank" href="{{ isset($field['disk'])?asset(\Storage::disk($field['disk'])->temporaryUrl($file_path, Carbon\Carbon::now()->addMinutes($field['temporary']))):asset($file_path) }}">{{ $file_path }}</a>
                    @else
                        <a target="_blank" href="{{ isset($field['disk'])?asset(\Storage::disk($field['disk'])->url($file_path)):asset($file_path) }}">{{ $file_path }}</a>
                    @endif
                    <a href="#" class="btn btn-light btn-sm float-right file-clear-button" title="Clear file" data-filename="{{ $file_path }}"><i class="fa fa-remove"></i></a>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        </div>
        @endif
        @endif
        {{-- Show the file picker on CREATE form. --}}
        <input name="{{ $field['name'] }}[]" type="hidden" value="">
        <div class="backstrap-file mt-2 d-none">
            <input
                type="file"
                name="{{ $field['name'] }}[]"
                value="@if (old(square_brackets_to_dots($field['name']))) old(square_brackets_to_dots($field['name'])) @elseif (isset($field['default'])) $field['default'] @endif"
                @include('crud::fields.inc.attributes', ['default_class' =>  isset($field['value']) && $field['value']!=null?'file_input backstrap-file-input':'file_input backstrap-file-input'])
                multiple
            >
            <label class="backstrap-file-label" for="customFile"></label>
        </div>

        {{-- HINT --}}
        @if (isset($field['hint']))
            <p class="help-block">{!! $field['hint'] !!}</p>
        @endif
    </div>


    @if ($entry->{$field['name']})
        @foreach($entry->{$field['name']} as $key => $image)
            @push('crud_fields_scripts')
                <script>
                    presetFiles.push('{{ asset($image) }}');
                </script>
            @endpush
        @endforeach
    @endif

@endif


@push('crud_fields_scripts')
    {{-- Gallery custom --}}
    <script src="https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.js"></script>
        <script>
            new FileUploadWithPreview('{{ $gallery_id }}',  {
                showDeleteButtonOnImages: true,
                presetFiles,
            });
            window.addEventListener('fileUploadWithPreview:imageDeleted', function(e) {
                var afterDeletedFiles = e.detail.cachedFileArray.map(value => value.name);
                var arr = [];
                var allFiles = presetFiles.map((value, index) => {
                    arr = value.split('/');
                    var ind = 2;
                    var path = '';
                    for (var i = (arr.length - ind); i > ind; i--) {
                        if (arr.length - ind > ind + 1) {
                            path = `/${path}`;
                        }
                        path = `${arr[i]}${path}`;
                    }
                    return {
                        path,
                        file: arr[arr.length - 1]
                    };
                });
                // console.log(afterDeletedFiles, allFiles);
                var files = allFiles.map(value => {
                    var { file } = value;
                    return file;
                });
                var paths = allFiles.map(value => {
                    var { path } = value;
                    return path;
                });
                // console.log(files, paths);

                // $(`input[data-filename=""]`)

                function arr_diff (a1, a2) {

                    var a = [], diff = [];

                    for (var i = 0; i < a1.length; i++) {
                        a[a1[i]] = true;
                    }

                    for (var i = 0; i < a2.length; i++) {
                        if (a[a2[i]]) {
                            delete a[a2[i]];
                        } else {
                            a2[i] = `${paths[i]}${a2[i]}`;
                            a[a2[i]] = true;
                            // console.log(a);
                        }
                    }

                    for (var k in a) {
                        diff.push(k);
                    }

                    return diff;
                }

                arr_diff(afterDeletedFiles, files).forEach(value => $(`a[data-filename="${value}"]`).click());

            });

                // $("#sortable-container").sortable({
                //     update: function(event, ui) {
                //         // Get the new token order
                //         let newTokenOrder = $(this).sortable('toArray', {attribute: 'data-upload-token'})

                //         // Init new array that we'll file with the correct order
                //         let sortedCachedFileArray = []

                //         // Loop through the newTokenOrder array and add each email in place as found
                //         for (let x = 0; x < newTokenOrder.length; x++) {
                //         let foundIndex = upload.cachedFileArray.map(image => image.token).indexOf(newTokenOrder[x])
                //         sortedCachedFileArray.push(upload.cachedFileArray[foundIndex])
                //         }

                //         // Replace the cachedFileArray with your new sortedCachedFileArray
                //         upload.replaceFiles(sortedCachedFileArray)
                //     }
                // });

                // Check the current status of the `cachedFileArray`
                $('#check-cachedFileArray').on('click', function() {
                // console.log(upload.cachedFileArray)
                })

                $(document).ready(function() {
                    // console.log($('.custom-file-container').prev());
                    $('.custom-file-container').prev().remove();
                    $('.custom-file-container').prev().addClass('d-none');
                    $('.custom-file-container__image-preview').css({"background-size": "contain", "background-color": "#edede8"});
                });

        </script>


        {{-- Gallery custom --}}
        <script>
        	function bpFieldInitUploadMultipleElement(element) {
        		var fieldName = element.attr('data-field-name');
        		var clearFileButton = element.find(".file-clear-button");
        		var fileInput = element.find("input[type=file]");
        		var inputLabel = element.find("label.backstrap-file-label");

		        clearFileButton.click(function(e) {
		        	e.preventDefault();
		        	var container = $(this).parent().parent();
		        	var parent = $(this).parent();
		        	// remove the filename and button
		        	parent.remove();
		        	// if the file container is empty, remove it
		        	if ($.trim(container.html())=='') {
		        		container.remove();
		        	}
		        	$("<input type='hidden' name='clear_"+fieldName+"[]' value='"+$(this).data('filename')+"'>").insertAfter(fileInput);
		        });

		        fileInput.change(function() {
	                inputLabel.html("Files selected. After save, they will show up above.");
		        	// remove the hidden input, so that the setXAttribute method is no longer triggered
		        	$(this).next("input[type=hidden]").remove();
		        });
        	}
        </script>
    @endpush
@endif
