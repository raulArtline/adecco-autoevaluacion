<select class="select select-bordered text-lg focus-verde">
    <option disabled selected>{{ $placeholder }}</option>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}">{{ $text }}</option>
    @endforeach
</select>
