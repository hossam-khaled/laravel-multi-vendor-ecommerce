@props(['name', 'type' => 'text', 'value' => ''])

<input type="{{$type}}" @class(['form-control', 'is-invalid' => $errors->has($name)]) name="{{ $name }}"
    value="{{ old($name, $value) }}" id="basic-default-fullname" placeholder="John Doe" />
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror