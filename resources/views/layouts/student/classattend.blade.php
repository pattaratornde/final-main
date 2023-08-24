@extends('layouts.tam')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">บันทึกข้อมูลการช่วยสอน</h1>
						<a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html"></a>
					</div>
                    <div class="col-12">
							<div class="card">
								<div class="card-header">
                                    <h4>{{$course->subject->subject_id}} {{$course->subject->name_en}} </h4>
                                </div>
                                <div class="card-body">
                                <form action="{{route('classattend.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="ta_id" value="{{request('ta_id')}}"/>
                                        <input type="hidden" name="id" value="{{request('id')}}"/>
									<div class="mb-3">
										<label class="form-label">วันที่</label>
										<input class="form-control" type="datetime-local" name="start_work">
									</div>
									<div class="mb-3">
                                        <label for="class_type_id">ประเภทรายวิชาที่ปฏิบัติงาน</label>
                                            <select class="form-control" id="class_type_id" name="class_type_id">
                                                <option value="L">บรรยาย</option>
                                                <option value="B">ปฎิบัติการ</option>
                                            </select>
									</div>
									<div class="mb-3">
										<label class="form-label">รายละเอียดการปฏิบัติงาน</label>
										<textarea type="text" class="form-control" name="aact_detail"></textarea>
									</div>
                                    <div class="mb-3">
                                    <div class="row">
                                        <label for="class_type_id">ระยะเวลาการปฏิบัติงาน</label>
                                            <div class="col-md-6">
                                                <label for="duration_hours">ชั่วโมง</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="duration_hours" name="duration_hours" value="2">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="duration_minutes">นาที</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="duration_minutes" name="duration_minutes" value="0">
                                                </div>
                                            </div>
                                        </div>
									</div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success">บันทึก</button>
									</div>
                                </form>
								</div>
                            </div>
                    </div>
                </div>
@endsection



