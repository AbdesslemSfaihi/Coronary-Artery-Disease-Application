<h2>Form Auto-Filled</h2>
<form>
    @foreach($numbers as $index => $value)
    <label>Field {{ $index + 1 }}</label>
    <input type="number" value="{{ $value }}">
    <br>
    @endforeach
</form>