@extends('layouts.master')
@section('title')
    تعديل الغرفة 
@stop
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">تعديل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> الغرفة </span>
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
                            <div class="card-body" >

                                <form action="{{ route('room.update','test') }}" method="post">
                                    {{method_field('patch')}}
                                    @csrf
                                    {{-- 1 --}}

                                    <div class="row" >

                                        <div class="col">
                                        <input type="hidden" name="room_id" value="{{$room->id}}">
                                            <label for="inputName" class="control-label">رقم الغرفة</label>
                                            <input type="text" class="form-control" id="name" name="number_room" value="{{$room->number_room}}"
                                                   title="يرجي اسم يالمريض" required>
                                        </div>

                                      

                                    </div>


                                    {{-- 2 --}}

                                    <div class="row">

                                        <div class="col">
                                            <label class="my-1 mr-2" >الأقسام</label>
                                            <select name="section_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                                                    onchange="console.log('change is firing')">
                                                <option value="{{$room->sections->id}}" selected disabled>{{$room->sections->name}}</option>
                                                @foreach($sections as $section)

                                                    <option value="{{$section->id}}">{{$section->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                       
                                           
                                        <div class="col">
                                            <label for="inputName" class="control-label"> عدد الأفراد</label>
                                            <input type="text" class="form-control" id="name_room" name="count_user" value="{{$room->count_user}}"
                                                   title="عدد الأفراد" required>
                                        </div>
                                     
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <label for="exampleTextarea">ملاحظات</label>
                                            <textarea class="form-control" id="exampleTextarea" name="description" rows="3">{{$room->description}}</textarea>
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



    <script>
        $(document).ready(function() {
            $('select[name="provices"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('getcity') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="city"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="city"]').append('<option selected disabled >....حدد المدينة...</option>');
                                $('select[name="city"]').append('<option value="' +
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
            $('select[name="city"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('get_hospital') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Hospital"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="Hospital"]').append('<option selected disabled >....حدد المستشفي...</option>');
                                $('select[name="Hospital"]').append('<option value="' +
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
