<!-- resources/views/products/create.blade.php -->
@extends('master')
@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name">
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <textarea class="form-control" id="product_description" name="product_description"></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control categories" name="category[]" multiple="multiple">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach


            </select>
        </div>
        <div class="needsclick dropzone" id="document-dropzone">

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection


@section('scripts')
    <script>
        //select 2
        $(document).ready(function() {
            $('.categories').select2();
        });


        //dropzone imgaeupload

        var uploadedDocumentMap = {};
        Dropzone.options.documentDropzone = {
            url: '{{ route('products.storeMedia') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function(file) {
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                // Send AJAX request to delete the file from the backend
                $.ajax({
                    type: 'POST',
                    url: '{{ route('products.deleteMedia') }}', // Change this URL to your backend endpoint
                    data: {
                        _token: '{{ csrf_token() }}',
                        file_name: name // Pass the file name to identify the file to be deleted
                    },
                    success: function(response) {
                        // If the file was successfully deleted from the backend, remove its hidden input from the form
                        $('form').find('input[name="document[]"][value="' + name + '"]').remove();
                        // Now, remove the previewElement
                        file.previewElement.remove();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if necessary
                        console.error(error);
                    }
                });
            },
            init: function() {
                @if (isset($project) && $project->document)
                    var files = {!! json_encode($project->document) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">');
                    }
                @endif
            }
        };
    </script>
@endsection


{{-- documentaion link  
    
    https://laraveldaily.com/post/multiple-file-upload-with-dropzone-js-and-laravel-medialibrary-package
    --}}
