@extends('layouts.master')
@section('title')
    قائمة الغرف
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الغرف</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
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
                        <div class="col-sm-6">
                                <button class="btn btn-primary mt-2 " type="button" class="button x-small" data-toggle="modal"
                                        data-target="#modaldemo1">
                                    اضافة غرفة
                                </button>



                            <a href="reservedrooms" class="btn btn-success mt-2" type="button" class="button x-small">                                   الغرف المحجوزة
                            </a>


                            <a href="Unreservedrooms" class="btn btn-danger mt-2" >الغرف الغير محجوزة
                            </a>
                                <button class="btn btn-danger mt-2" type="button" class="button x-small" id="btn_delete_all">                                       حذف كل الغرف المختارة
                                </button>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>

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
                                            <td><input type="checkbox"  value="{{$Room->id}}" class="box1" ></td>
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

 
                                            <!-- row closed -->


                                            <div class="modal  fade" id="delete{{$Room->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">حذف الحجز للمريض</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <form action="{{route('room.destroy', 'test') }}" method="post">
                                                            {{ method_field('delete') }}
                                                            {{ csrf_field() }}
                                                        </div>


                                                        <div class="modal-body">
                                                            هل انت متاكد من عملية الحذف ؟
                                                            <input type="hidden" name="room_id" id="patient_id" value="{{$Room->id}}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="inputName" class="control-label"> ؤقم الغرفة</label>
                                                            

                                                            <input type="text" name="number_room" id="number_room" value="{{$Room->number_room}}">



                                                        
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="modal" id="modaldemo1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">اضافه غرفة</h6>
                                                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('room.store')}}" method="post">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> رقم الغرفة </label>
                                                        <input type="text" class="form-control" id="number_room" name="number_room" required>
                                                    </div>



                                                    <div class="col">
                                                        <label class="my-1 mr-2" >الأقسام</label>
                                                        <select name="section_id" class="form-control SlectBox">
                                                            <option value="" selected disabled>-- حدد القسم --</option>
                                                            @foreach($sections as $section)

                                                                <option value="{{$section->id}}">{{$section->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> عدد الأفراد</label>
                                                        <input type="text" class="form-control" id="count_user" name="count_user" required>
                                                    </div>

                                                  
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">الوصف</label>
                                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">تاكيد</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>






                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- حذف مجموعة صفوف -->
         <!--
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            حذف الغرف
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="#" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            هل تريد الحذف
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-danger">تأكد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
-->


<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            حذف الغرف
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            هل تريد الحذف
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-danger">تأكد</button>
                        </div>
                    </form>
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
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

    <script>
        function CheckAll(roomName, elem) {
            var elements = document.getElementsByClassName(roomName);
            var l = elements.length;
            if (elem.checked) {
                for (var i = 0; i < l; i++) {
                    elements[i].checked = true;
                }
            } else {
                for (var i = 0; i < l; i++) {
                    elements[i].checked = false;
                }
            }
        }
    </script>


    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('select[name="Provices_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('GetCity') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="City_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="City_id"]').append('<option selected disabled >....حدد المدينة...</option>');
                                $('select[name="City_id"]').append('<option value="' +
                                    key  + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>


    <script>
        $(document).ready(function() {
            $('select[name="City_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('GetHospital') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="hospital_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="hospital_id"]').append('<option value="' +
                                    key  + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>



@endsection
