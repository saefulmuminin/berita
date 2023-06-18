<html>

<head>
    <title>Remove Background</title>
</head>

<body>
    <h1>Remove Background</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('remove-background') }}" enctype="multipart/form-data">
        @csrf
        <div id="image-preview">
            @if ($previewImageUrl)
                <img src="{{ asset($previewImageUrl) }}" alt="Preview Image" id="preview-image">
            @endif
        </div>

        <input type="file" name="image" id="image-input">
        <button type="submit">Remove Background</button>
    </form>
    <div id="processed-image">
        @if ($processedImageUrl)
            <img src="{{ asset($processedImageUrl) }}" alt="Processed Image">
            <a href="{{ asset($processedImageUrl) }}" download>Download Processed Image</a>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image-input").change(function() {
            readURL(this);
        });
    </script>
</body>

</html>
