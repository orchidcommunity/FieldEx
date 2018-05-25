@component('platform::partials.fields.group',get_defined_vars())
    <select id="{{$id}}" @include('platform::partials.fields.attributes', ['attributes' => $attributes])>
    </select>
@endcomponent



@push('stylesheets')
    <script>
        document.addEventListener('turbolinks:load', function () {
            $('#{{$id}}').select2({
                theme: "bootstrap",
                ajax: {
                    type: "POST",
                    cache: true,
                    delay: 250,
                    url: function (params) {
                        return '{{route('platform.systems.widget',Base64Url\Base64Url::encode($handler))}}';
                    },
                    dataType: 'json'
                },
                selectOnClose: false,
                tags: true,
                placeholder: '{{$placeholder or ''}}'
            });
            
           $.notInArray = function(test,array) { return $.inArray(test, array) == -1; };
           
           @if(!is_null($value))
            var dataid=[];
            
            @foreach(explode(",",$value) as $tag)
                
                axios.post('{{route('platform.systems.widget',[
                        'widget' => Base64Url\Base64Url::encode($handler),
                        'key'    => $tag
                    ])}}').then(function (response) {

                        var selected = response.data;
                        selected = selected[Object.keys(selected)[0]];
                        dataid.push(selected.id);
                        
                        var optionids =[];
                        $('#{{$id}}').children("option").each(function() {
                           optionids.push(parseInt($(this).val()));
                        });
                        if($.notInArray(selected.id, optionids)) {
                        
                        $('#{{$id}}')
                            .append(new Option(selected.text, selected.id, true, true))
                            .trigger('change');
                        }  
                });   
            @endforeach
            @endif
        });

        
    </script>
@endpush
