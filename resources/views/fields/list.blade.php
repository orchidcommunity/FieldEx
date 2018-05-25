<div class="form-group{{ $errors->has($oldName) ? ' has-error' : '' }} input-sort">
    <label>{{$title}}</label>

    <ul id="sortable-{{$slug}}" class="container-fluid dd-list">
        @isset($value)
            @foreach($value as $key => $val)
                <li class="ui-state-default form-group row">
                    <span onclick="return false;" class="btn btn-link col-1 pull"><i class="icon-menu"></i></span>
                    <input type="text" class="form-control col-10" name="{{$attributes['name']}}[]" value="{{$val}}">
                    <button class="btn btn-link col-1 remove"
                            onclick="removeitem{{$slug}}(this)"><i class="icon-trash"></i></button>
                </li>
            @endforeach
        @else
            <li class="ui-state-default form-group row">
                <span onclick="return false;" class="btn btn-link col-1 pull"><i class="icon-menu"></i></span>
                <input type="text" class="form-control col-10" name="{{$attributes['name']}}[]">
                <button class="btn btn-link col-1 remove"
                        onclick="removeitem{{$slug}}(this)"><i class="icon-trash"></i></button>
            </li>
        @endisset
    </ul>
    <div class="button-group text-center">
        <button onclick="newitem{{$slug}}()" class="btn btn-sm alert-info">new</button>
    </div>
</div>
@if($hr ?? true)
    <div class="line line-dashed b-b line-lg"></div>
@endif
<style>
    .input-sort .form-control {
        width: 83.33333333%;
    }
</style>
@push('scripts')
    <script>
        function newitem{{$slug}}() {
            event.preventDefault();
            let item = '<li class="ui-state-default form-group row">\n' +
                '            <span onclick="return false;" class="btn btn-link col-1 pull"><i class="icon-menu"></i></span>\n' +
                '            <input type="text" class="form-control col-10" name="" value="">\n' +
                '            <button class="btn btn-link col-1 remove" onclick="removeitem{{$slug}}(this)"><i class="icon-trash"></i></button>\n' +
                '        </li>';
            $('#sortable-{{$slug}}').append(item);
            $("#sortable-{{$slug}} li").each(function (li) {
                $(this).find('input').attr({'name': '{{$attributes["name"]}}[]'})
            })
        }
        function removeitem{{$slug}}(item) {
            event.preventDefault();
            $(item).parent().remove();
            $("#sortable-{{$slug}} li").each(function (li) {
                $(this).find('input').attr({'name': '{{$attributes["name"]}}[]'})
            })
        }
        document.addEventListener('turbolinks:load', function () {
            $("#sortable-{{$slug}}").sortable({
                placeholder: "ui-sortable-placeholder",
                axis: "y",
                update: function (event, ui) {
                    $("#sortable-{{$slug}} li").each(function (li) {
                        $(this).find('input').attr({'name': '{{$attributes["name"]}}[]'})
                    })
                }
            });
        });
    </script>
@endpush