@extends('layouts.admin')
@section('content')
    @php(define('DS', DIRECTORY_SEPARATOR)){{-- General form for all entities --}}
<div class="col-md-8 col-md-offset-2">

    <form action="{{$form['action']}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="box-body">
            @foreach($form['fields'] as $field)
                @if($field['type'] == 'text')
                    @include('admin.form_fields.input_text')
                @endif
                @if($field['type'] == 'textarea')
                    @include('admin.form_fields.input_textarea')
                @endif
                @if($field['type'] == 'file')
                    @include('admin.form_fields.input_file')
                @endif

            @endforeach
                <div class="col-md-12" style="padding: 0">
                    <button type="submit" name="{{$form['save_button']['name']}}" class="btn btn-block bg-navy">{{$form['save_button']['value']}}</button>
                </div>
        </div>
    </form>
</div>

@endsection