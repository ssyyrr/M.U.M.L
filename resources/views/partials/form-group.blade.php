<div class="form-group row">
    <label for="{{ $name }}" class="col-md-4 col-form-label text-md-right">{{ $title }}</label>
    <span class="{{$span}} form-control-row"  aria-hidden="true" ></span>

            <div class="col-md-6">
            <input id="{{ $name }}" type="{{ $type }}"
                   class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}"
                   name="{{ $name }}"
                   data-inputmask="'{{$cat}}':'{{$alias}}'"  data-mask
                   value="{{ old($name, isset($value) ? $value : '') }}" {{ $required ? 'required' : ''}}>

                          @if ($errors->has($name))
                              <div class="invalid-feedback">
                               {{ $errors->first($name) }}
                              </div>
                           @endif
             </div>
</div>


