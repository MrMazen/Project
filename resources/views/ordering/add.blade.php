@extends('layouts.master')
@section('title')
    اضافه غرفة
@stop
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">حجز غرفة جديدة</h4>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="card">
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


                            <!-- start add Patient -->
                                @if(session()->has('add'))
                                    <div class="alert alert-success">
                                        <strong>{{session()->get('add')}}</strong>
                                    </div>
                                @endif
                            <!-- end add Patient -->

                                <!-- start edit Patient -->
                                @if(session()->has('edit'))
                                    <div class="alert alert-success">
                                        <strong>{{session()->get('edit')}}</strong>
                                    </div>
                                @endif
                            <!-- end edit Patient -->


                                <!-- start edit Patient -->
                                @if(session()->has('delete'))
                                    <div class="alert alert-danger">
                                        <strong>{{session()->get('delete')}}</strong>
                                    </div>
                            @endif
                            <!-- end edit Patient -->
                                <form action="{{route('order.store')}}" method="post"  autocomplete="off">
                                    {{ csrf_field() }}

                                    {{-- 1 --}}

                                    <div class="row">

                                        <div class="col">
                                            <label for="inputName" class="control-label">اسم العميل</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   title="يرجي ادخال اسم العميل" required>
                                        </div>

                                        <div class="col">
                                            <label  class="control-label">رقم الموبايل</label>
                                            <input type="text" class="form-control" id="age" name="number_phone"
                                                   required>
                                        </div>

                                        <div class="col">
                                            <label for="inputName" class="control-label">الديانه </label>
                                            <select name="gander" class="form-control SlectBox">
                                                <!--placeholder-->
                                                <option value="" selected disabled>حدد النوع</option>
                                                <option value='ذكر'>`ذكر`</option>
                                                <option value='أنثى'>أنثى</option>
                                            </select>
                                        </div>


                                    </div>


                                    {{-- 2 --}}
                                    <div class="row">
                                    <div class="col">
                                        <label class="my-1 mr-2" >الأقسام</label>
                                        <select name="section_id" class="form-control SlectBox"
                                                onchange="console.log($(this).val())">
                                            <option value="" selected disabled>-- حدد القسم --</option>
                                            @foreach($sections as $section)

                                                <option value="{{$section->id}}">{{$section->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">

                                        <label class="my-1 mr-2" for="inlineForCustomSelectPref">رقم الغرفة</label>
                                        <select id="ciRoom_idty" name="Room_id" class="form-control"
                                                onchange="console.log($(this).val())">

                                        </select>

                                    </div>

                                    <div class="col">

<label class="my-1 mr-2" for="inlineForCustomSelectPref">عدد الأفراد </label>
<select id="city" name="count_user" class="form-control"
        onchange="console.log($(this).val())">

</select>

</div>

</div>
                                    {{-- 3 --}}

                                    <div class="row">
                                    <div class="col">
                                            <label> تاريخ بداية الحجز </label>
                                            <input class="form-control fc-datepicker" name="start_date" placeholder="YYYY-MM-DD"
                                                   type="text" value="{{date('Y-m-d')}}" required>
                                        </div>

                                        <div class="col">
                                            <label>  تاريخ نهاية الحجز </label>
                                            <input class="form-control fc-datepicker" name="end_date" placeholder="YYYY-MM-DD"
                                                   type="text" value="{{date('Y-m-d')}}" required>
                                        </div>

                                    </div>
                                    {{-- 4 --}}


                                    <div class="row">
                                        <div class="col">
                                            <label for="exampleTextarea">ملاحظات</label>
                                            <textarea class="form-control" id="exampleTextarea" name="description" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                        <div class="row">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                                    </div>

                                    </div>
                                </form>
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


    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>


    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>



    <script>
        $(document).ready(function() {
            $('select[name="section_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                     url: "{{ URL::to('getcity') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Room_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="Room_id"]').append('<option selected disabled >....حدد الغرفة...</option>');
                                $('select[name="Room_id"]').append('<option value="' +
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
            $('select[name="Room_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                     url: "{{ URL::to('get_hospital') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="count_user"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="count_user"]').append('<option value="' +
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
            $('select[name="number_room"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('get_hospital') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('div[name="count_user"]').append('<input value="' +
                                    key  + '">' + value );
                            
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
            $('select[name="Hospital"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('get_rooms') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="room"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="room"]').append('<option value="' +
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
