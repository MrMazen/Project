@extends('layouts.master')
@section('css')
@endsection
@section('title')
    الغرف الغير محجوزة

@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                <!-- start add room -->
                    @if(session()->has('add'))
                        <div class="alert alert-success">
                            <strong>{{session()->get('add')}}</strong>
                        </div>
                    @endif
                <!-- end add room -->


                    <!-- start edit room -->
                    @if(session()->has('edit'))
                        <div class="alert alert-success">
                            <strong>{{session()->get('edit')}}</strong>
                        </div>
                    @endif
                <!-- end edit room -->

                    <!-- start edit room -->
                    @if(session()->has('delete'))
                        <div class="alert alert-danger">
                            <strong>{{session()->get('delete')}}</strong>
                        </div>
                @endif
                <!-- end edit room -->

                    <div class="table-responsive">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                       style="text-align: center">
                                       <thead>
                                    <tr>

                                        <th class="border-bottom-0">#</th>

                                        <th class="border-bottom-0"> رقم الغرفة </th>
                                        <th class="border-bottom-0">القسم</th>
                                      

                                        <th class="border-bottom-0">عدد الأفراد</th>

                                        <th class="border-bottom-0">  الحالة</th>
                                        <th class="border-bottom-0">  الوصف</th>

                                        <th class="border-bottom-0">العمليات</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($Rooms as $Room)

                                    <tr>
                                            @php
                                                $i++;
                                            @endphp
                                            <td>{{$i}}</td>
                                            <td>{{$Room->number_room}}</td>
                                            <td> {{$Room->sections->name}}</td>
                                            <td>{{$Room->count_user}}</td>

                                            <td>
                                                @if($Room->value_status == 1)
                                                    <span class="text-success">{{$Room->status}}</span>

                                                @else  ($Room->value_status == 2)
                                                    <span class="text-danger">{{$Room->status}}</span>
                                                @endif

                                            </td>
                                            <td>{{$Room->description}}</td>
                                            <td>
                                                   


                                                    <a href="{{url('edit_room')}}/{{$Room->id}}" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                                                    class="fas fa-edit"></i>&nbsp;تعديل </a>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{$Room->id}}">
                                                        <i class="fa fa-trash"></i>حذف
                                                    </button>
                                            </td>
                                        </tr>


                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
