<h2>
    @foreach($data_top_buttons as $top_button)
        <a href="{{$top_button['url']}}" class="btn btn-md btn-{{$top_button['class']}}">{{$top_button['value']}}</a>
    @endforeach
</h2>
