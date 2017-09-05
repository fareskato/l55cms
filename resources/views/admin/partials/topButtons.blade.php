<h2>
    @if(isset($data_top_buttons) && count($data_top_buttons) > 0)
        @foreach($data_top_buttons as $top_button)
            <a href="{{$top_button['url']}}" class="btn btn-md btn-{{$top_button['class']}}">{{$top_button['value']}}</a>
        @endforeach
    @endif
</h2>
