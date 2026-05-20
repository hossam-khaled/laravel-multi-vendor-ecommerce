@props(['name', 'value' => '','label'=> false ])


<textarea {{ $attributes->class([ 'form-control', 'is-invalid' => $errors->has($name) ]) }}
     id="basic-default-{{ $name }}" 
     name="{{ $name }}" rows="5" 
     placeholder="John Doe">{{ $slot }}</textarea>
    @if ($label)
        <label for="basic-default-{{ $name }}">{{ $label }}</label>
    @endif
    

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror