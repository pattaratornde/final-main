@extends('layouts.tam')

@section('content')
<main class="content">
				<div class="container-fluid p-0">
					<div class="card">
					<div class="card-header">
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">แบบฟอร์มการสมัครเป็นผู้ช่วยสอน</h1>
						<a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html"></a>
					</div>
					<form action="{{ route('request.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
										<label for="course_id">รายวิชาที่ต้องการสมัคร :</label>
                                    		<select class="form-control mb-0" name="course_id">
												<option value="">---กรุณาเลือกรายวิชาที่ต้องการสมัคร---</option>
                                        		@if ($courses->count())
                                            		@foreach($courses as $course)
													<div class="card-body">
                                                		<option value="{{ $course->course_id }}">{{$course->subject->subject_id}} | {{$course->subject->name_en}}</option>
													</div>   
                                            		@endforeach
                                        		@endif
											</select>
										</label>
										<br>
									<label for="course_id" style="color:red">อัพโหลดตารางเรียน (*เฉพาะไฟล์ PDF เท่านั้น* )</label>
										<br>
											<input type="file" name="filename">
								</div>
							</div>
						</div>
						<br>
							<div class="col-2">
                                <button type="submit" class="btn btn-success">บันทึก</button>
                            </div>
					</form>			
				</div>


							
@endsection