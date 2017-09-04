@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <div class="">
                buttons will go here
            </div>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <h1>The admin dashboard main page</h1>

        </div>
    </div>
</div>
@endsection
