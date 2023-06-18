<!DOCTYPE html>
<html>

<head>
    <title>Preview</title>
</head>

<body>
    <h1>Preview</h1>

    <img src="{{ $image->encode('data-url') }}" alt="Preview Image">

    <form action="{{ route('remove-background') }}" method="POST">
        @csrf
        <input type="hidden" name="image" value="{{ $image->encode('data-url') }}">
        <button type="submit">Remove Background</button>
    </form>
</body>

</html>
