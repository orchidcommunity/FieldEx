@component('platform::partials.fields.group',get_defined_vars())
    <input hidden name="{{$attributes['name']}}" value="{{$attributes['novalue']}}">
    <div class="checkbox {{$class or ''}}">
        <label class="i-checks">
        {{-- dd($attributes) --}}

            <input value="{{$attributes['yesvalue']}}" @include('platform::partials.fields.attributes', ['attributes' => $attributes])
                    @if(isset($attributes['value']) && $attributes['value']) checked @endif
            >
            <i></i> {{$placeholder or ''}}
        </label>
    </div>
@endcomponent
