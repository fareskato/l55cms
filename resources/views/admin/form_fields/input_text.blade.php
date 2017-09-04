<div class="form-group @if ($errors->has($field['name'])) has-error @endif">
    <label for="{{$field['id']}}" class="col-sm-2 control-label">{{$field['label']}}</label>
    <div class="col-sm-10">
        @if ($errors->has($field['name']))
            <div class="text-danger">{{ $errors->first($field['name']) }}</div>
        @endif
        <input name="{{$field['name']}}" type="text" class="form-control" id="{{$field['id']}}" placeholder="{{$field['placeholder']}}" @if($field['required']== 'required') required @endif  value="@if($field['value']){{$field['value']}}@endif">
    </div>
</div>