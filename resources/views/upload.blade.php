<form action="{{ route('ocr.extract') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" required>
    <button type="submit">Extract Values</button>
</form>