@props(['name', 'options' => [], 'label' => false, 'checked' => null])

<select {{ $attributes->class(['form-select', 'is-invalid' => $errors->has($name)]) }} id="Select-{{$name}}"
    name="{{$name}}" aria-label="Default select parent">
    <option selected="selected" disabled>Open this select {{$label}}</option>
    @foreach ($options as $value => $text)
        <option @if (old($name, $checked) == $value) selected="selected" @endif value="{{ $value }}">{{ $text }}
        </option>
    @endforeach
</select>
@if (!$label)
    <label for="Select-{{$name}}">{{ $label }}</label>
@endif