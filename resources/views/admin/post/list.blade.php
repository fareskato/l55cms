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
                        <td class=""><img src="{{public_path('/'). $images_path . $data_thumbnail .DS. $item['image']}}"></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>
                            @if($item->status == 0)
                                <span class="label label-warning">Pending</span>
                            @endif
                            @if($item->status == 1)
                                <span class="label label-success">Published</span>
                            @endif
                        </td>
                        <td>
                            @foreach($action_buttons as $action_button)
                                @php($action_link = $action_button['type'] . DS . $item->id . DS . $action_button['name'])
                                    @if(isset($action_button['not_link']) and $action_button['not_link'] === true )
                                        @php($action_link = '')
                                    @endif
                                    <a href="{{$action_link}}"
                                       @if($action_button['name'] == 'delete')onclick="return confirm('Are you sure you want to delete this item?');" @endif>
                                        <i class="fa fa-{{$action_button['class']}}"aria-hidden="true">
                                            @if(isset($action_button['value']) and $action_button['value'] != '' )
                                                {{$action_button['value']}}
                                            @endif
                                        </i>
                                    </a>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan=100%><h2 class="text-center">Woops ! there is no {{$data_entity}}</h2></td>
                    </tr>
                @endif
                </tbody>
        </table>
        {{-- Pagination --}}
    {{$data_list->links()}}
@endsection