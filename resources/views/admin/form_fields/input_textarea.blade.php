<div class="form-group @if ($errors->has($field['name'])) has-error @endif">
    <label for="{{$field['id']}}" class="col-sm-2 control-label">{{$field['label']}}</label>
    <div class="col-sm-10">
        @if ($errors->has($field['name']))
            <div class="bg-danger">{{ $errors->first($field['name']) }}</div>
        @endif
        <textarea name="{{$field['name']}}"  class="form-control" id="{{$field['id']}}" rows="5" placeholder="{{$field['placeholder']}}" @if($field['required']== 'required') required @endif>@if($field['value']){{$field['value']}}@endif</textarea>
    </div>
</div>