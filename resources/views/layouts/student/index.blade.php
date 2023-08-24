@extends('layouts.tam')

@section('content')
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3">ข้อมูลรายวิชาผู้ช่วยสอน</h1>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                    <div class="row py-0">
									<div class="col-10">
									        <h5 class="card-title mb-0">รายการทั้งหมด</h5>
                                        </div>
                                    </div>
								</div>
								<div class="card-body">
                                <table class="table table-hover my-0">
									<thead>
										@php($i=1)
										<tr>
											<th>ลำดับ</th>
											<th class="d-none d-xl-table-cell">ปีการศึกษา</th>
											<th class="d-none d-xl-table-cell">รหัสนักศึกษา</th>
											<th class="d-none d-xl-table-cell">ชื่อ-นามสกุล</th>
                                            <th class="d-none d-md-table-cell">วิชาที่สอน</th>
                                            <th class="d-none d-md-table-cell">อาจารย์ประจำวิชา</th>
											<th class="d-none d-md-table-cell">กลุ่มที่สอน</th>
                                            <th></th>
										</tr>
									</thead>
									<tbody>
										@php($i=1)
										@foreach($tainfo as $ta)
										<tr>
											<td>{{$i++}}</td>
											<td class="d-none d-xl-table-cell">{{$ta->course->semester->year}}/{{$ta->course->semester->semester}}</td>
											<td class="d-none d-xl-table-cell">{{$ta->ta->student_id}}</td>
                                            <td class="d-none d-xl-table-cell">{{$ta->ta->name}}</td>
											<td class="d-none d-xl-table-cell">{{$ta->course->subject_id}} {{$ta->course->subject->name_th}}</td>
											<td class="d-none d-md-table-cell">{{$ta->course->teacher->position}}{{$ta->course->teacher->degree}} {{$ta->course->teacher->name}}</td>
											<td class="d-none d-xl-table-cell"><a href="{{route('showSubject', $ta->course->subject_id)}}"class="align-middle">{{$ta->course->subject_id}} {{$ta->course->subject->name_th}}</td>
											<td class="d-none d-md-table-cell"><a href="{{route('showTeacher', $ta->course->teacher->teacher_id)}}"class="align-middle">{{$ta->course->teacher->position}}{{$ta->course->teacher->degree}} {{$ta->course->teacher->name}}</a></td>
											<td><a href="{{route('tainfo.show', $ta->id)}}"class="align-middle">รายละเอียด</a></td>
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
