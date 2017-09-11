@extends('layouts.admin')
@section('content')
    @php(define('DS', DIRECTORY_SEPARATOR)){{-- General form for all entities --}}
<div class="col-md-10 col-md-offset-1">

    <form action="{{$form['action']}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        {{-- if is edit form make form method PATCH --}}
        @if($form['is_edit'] === true)
            {!! method_field('patch') !!}
        @endif
        {{-- Token field for security --}}
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
                @if($field['type'] == 'select')
                    @include('admin.form_fields.input_select')
                @endif
            @endforeach
                <div class="col-md-12" style="padding: 0">
                    <button type="submit" name="{{$form['save_button']['name']}}" class="btn btn-block bg-navy">{{$form['save_button']['value']}}</button>
                </div>
        </div>
    </form>
</div>

@endsection