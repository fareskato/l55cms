<section class="content-header">

    <div class="col-lg-3">
        <h2>
            @if(isset($data_title))
                {{$data_title}}
            @else
                Dashboard
            @endif
        </h2>
    </div>
    {{-- Search form --}}
    @include('admin.partials.search')
    <div class="col-lg-3 pull-right">
     @include('admin.partials.topButtons')
    </div>
</section>
<div class="clearfix"></div>