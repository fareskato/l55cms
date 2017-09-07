<div class="form-group @if ($errors->has($field['name'])) has-error @endif">
    <label for="{{$field['id']}}" class="col-sm-2 control-label">{{$field['label']}}</label>
    <div class="col-sm-10">
        @if ($errors->has($field['name']))
            <div class="bg-danger">{{ $errors->first($field['name']) }}</div>
        @endif
        <select name="{{$field['name']}}" class="form-control" id="{{$field['id']}}" @if($field['required']== 'required') required @endif>
            @foreach($field['options'] as $option)
                <option
                        {{$field['object_id']}}
                        value="{{$option->id}}"
                        @if($field['object_id'] == $option->id )
                        selected
                        @endif
                >{{$option->name}}</option>
            @endforeach
        </select>
    </div>
</div>