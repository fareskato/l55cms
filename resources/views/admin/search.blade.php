@extends('layouts.admin')
@section('content')
    @php(define('DS', DIRECTORY_SEPARATOR))
        <table id="" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
                @foreach($data_fields as $data_field)
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                        aria-label="Rendering engine: activate to sort column ascending">{{$data_field}}</th>
                @endforeach
                <th>{{$data_actions}}</th>
            </tr>
            </thead>
                <tbody>
                @if(count($data_list) > 0)
                    @foreach($data_list as $item)
                    <tr role="row" class="">
                        @foreach($data_fields as $field)
                            @if($field == 'image')
                                <td class=""><img src="{{public_path('/'). $images_path . $data_thumbnail .DS. $item[$field]}}">
                                </td>
                            @endif
                            @if($field != 'image')
                                 <td class="">
                                     @if($field == 'updated_at' )
                                        {{$item->updated_at->diffForHumans()}}
                                     @elseif($field != 'updated_at' )
                                        {{$item[$field]}}
                                     @endif
                                 </td>
                            @endif
                        @endforeach
                        <td>
                            @foreach($action_buttons as $action_button)
                                @php($action_link = route($action_button['route'], $item->id))
                                    @if(isset($action_button['not_link']) and $action_button['not_link'] === true )
                                        @php($action_link = '')
                                    @endif
                                    <a href="{{$action_link}}"
                                       @if($action_button['name'] == 'delete')onclick="return confirm('Are you sure you want to delete this item?');" @endif>
                                        <i class="fa fa-{{$action_button['class']}}"aria-hidden="true"></i>
                                    </a>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan=100%><h2 class="text-center">Woops ! no {{$data_entity}} found :( please search again </h2></td>
                    </tr>
                @endif
                </tbody>

        </table>




@endsection