<select class="select select-bordered text-lg focus-verde w-full">
  <option disabled selected>{{ $placeholder }}</option>
  @foreach ($options as $value => $text)
    <option value="{{ $value }}">{{ $text }}</option>
  @endforeach
</select>
