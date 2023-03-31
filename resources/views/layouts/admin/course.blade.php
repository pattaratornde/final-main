@extends('layouts.tam')

@section('content')
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3">ข้อมูลผู้ช่วยสอน</h1>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
								<h5 class="card-title mb-0">รายการทั้งหมด</h5>
                                    <div class="row py-0">
                                    </div>
								</div>
								<div class="card-body">
                                <table class="table table-hover my-0">
									<thead>
										<tr>
											<div class="search_box pull-right">
              									<form class="" method="get" action="/searchTa/search">
													<input type="text" placeholder="ป้อนข้อมูลเพื่อค้นหา" name="search" />
													<button type="submit" class="btn btn-success">ค้นหา</button>
												</form>
											</div>
											<th>ลำดับ</th>
											<th class="d-none d-xl-table-cell">รหัสนักศึกษา</th>
											<th class="d-none d-xl-table-cell">ชื่อ-นามสกุล</th>
											<th class="d-none d-xl-table-cell">วิชาที่สอน</th>
											<th class="d-none d-xl-table-cell">อาจารย์ประจำวิชา</th>
											
                                            <th></th>
										</tr>
									</thead>
									<tbody>
									@php($i=1)
                                    @foreach ($admincourse as $course)
                                        <tr>
											<td>{{$i++}}</td>
											<td>{{ $course->ta->student_id}}</td>
											<td>{{ $course->ta->name}}</td>
                                            <td>{{ $course->course->subject->subject_id }} | {{ $course->course->subject->name_th }} | {{ $course->course->subject->name_en }}  </td>
                                            <td>{{ $course->course->teacher->position}}{{$course->course->teacher->degree}}  {{$course->course->teacher->name}}</td>
                                    
                                        </tr>
                                    @endforeach
									
									</tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection