@props(['name', 'type' => 'text', 'value' => '','label'=> false ])


<input type="{{$type}}"  name="{{ $name }}" 
    {{ $attributes->class([ 'form-control', 'is-invalid' => $errors->has($name) ]) }}
    value="{{ old($name, $value) }}" 
    id="basic-default-{{ $name }}" placeholder="John Doe" 
    />
    @if ($label)
        <label for="basic-default-{{ $name }}">{{ $label }}</label>
    @endif
    

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror