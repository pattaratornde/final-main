@extends('layouts.tam')

@section('content')
<main class="content">
				<div class="container-fluid p-0">
				<div class="card">
					<div class="card-header">
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">แบบฟอร์มแก้ไขข้อมูลการสมัครผู้ช่วยสอน</h1>
						<a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html"></a>
					</div>
					<form action="{{ route('request.update',$req->request_id) }}" method="POST">
						{{method_field('PATCH')}}
						{{csrf_field()}}
						<br>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
										<label for="course_id">รายวิชาที่ต้องการสมัคร :</label>
                                    		<select class="form-control mb-0" name="course_id">
                                        		@if ($courses->count())
                                            		@foreach($courses as $course)
													<div class="card-body">
                                                			<option defult-value="{{ $course->course_id }}" >{{$course->subject->subject_id}}  {{$course->subject->name_en}}</option>
														@foreach($otherCourses as $otherCourse)
															<option value="{{ $otherCourse->course_id }}">{{ $otherCourse->subject->subject_id }} {{ $otherCourse->subject->name_en }}</option>
														@endforeach
													</div>   
                                            		@endforeach
                                        		@endif
											</select>
											<br>
								<label for="course_id">ตารางเรียนนักศึกษา :</label>
								<a href="{{ route('download', ['filename' => $req->fileupload->filename]) }}">Download PDF</a>
								</div>
								
								<div class="col-1">
                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                    </div>
							</div>
						</div>	
					</form>			
				</div>
		
@endsection