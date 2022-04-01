@extends('layouts.master')
@section('title')
    الأقسام
@stop
@section('css')
    @toastr_css
    link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"  >الأقسام</h4>
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


                                <!-- start add provices -->
                                    @if(session()->has('add'))
                                        <div class="alert alert-success">
                                            <strong>{{session()->get('add')}}</strong>
                                        </div>
                                    @endif
                                <!-- end add provices -->

                                    <!-- start edit provices -->
                                    @if(session()->has('edit'))
                                        <div class="alert alert-success">
                                            <strong>{{session()->get('edit')}}</strong>
                                        </div>
                                    @endif
                                <!-- end edit provices -->


                                    <!-- start edit provices -->
                                    @if(session()->has('delete'))
                                        <div class="alert alert-danger">
                                            <strong>{{session()->get('delete')}}</strong>
                                        </div>
                                @endif
                                <!-- end edit provices -->







                                <div class="table-responsive">
                                    <div class="col-sm-6">
                                       
                                        <button class="btn btn-primary mb-1" type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                                          اضافة قسم
                                        </button>
                                        
                                    </div>
                                    <table class="table text-md-nowrap" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">#</th>
                                            <th class="wd-15p border-bottom-0"> اسم  القسم</th>
                                            <th class="wd-20p border-bottom-0">الوسف</th>
                                            <th class="wd-15p border-bottom-0">التحكم</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($sections as $section)
                                            <tr>
                                            <?php $i++; ?>

                                        <td>{{$i}}</td>
                                        <td><a href="#">{{$section->name}}</a> </td>
                                        <td>{{$section->description}}</td>
                                        <td>

                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{$section->id}}"
                                                    ><i class=" fa fa-edit " > </i>تعديل</button>
                                          

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{$section->id}}">
                                                <i class="fa fa-trash"></i>حذف</button>
                                        </td>
                                            </tr>

                                            

                                            </div>
                                            <!-- row closed -->

                                             <!-- Edit_modal_provices -->s
                                            <div class="modal fade" id="edit{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                  تعديل القسم
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <form action="{{ route('sections.update','test') }}" method="POST">
                                                                {{method_field('patch')}}
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input id="id" type="hidden" name="id" class="form-control" value="{{$section->id}}">
                                                                        <label for="Name" class="mr-sm-2">اسم القسم
                                                                            :</label>
                                                                        <input id="Name" type="text" name="name" class="form-control" value="{{$section->name}}">
                                                                    </div>
                                                                    <br><br>
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlTextarea1">الوصف
                                                                            :</label>
                                                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                                                                  rows="3">{{$section->description}}</textarea>
                                                                    </div>
                                                                    <br><br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">الغاء</button>
                                                                    <button type="submit" class="btn btn-success">تعديل</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End_Edit_provices -->


                                            </div>
                                            <!-- row closed -->



                                                 <!-- Delete_modal_section -->s
                                                     <div class="modal fade" id="delete{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                حذف القسم
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <form action="{{ route('sections.update','test') }}" method="POST">
                                                                {{method_field('DELETE')}}
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input id="id" type="hidden" name="id" class="form-control" value="{{$section->id}}">
                                                                        <h4>هل تريد حدف القسم</h4>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">الغاء</button>
                                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End_Delete_provices -->


                                            </div>
                                            <!-- row closed -->
                                            <!-- row closed -->
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>








                    <!-- add_modal_provices -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                        اضافة قسم جديدة
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- add_form -->
                                    <form action="{{ route('sections.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم القسم</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">الوصف</label>
                                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                            </div>



                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-success">اضافة</button>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- End_modal_provices -->


                </div>
                <!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    @jquery
    @toastr_js
    @toastr_render
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

@endsection
