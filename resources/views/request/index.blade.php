@extends('layouts.tam')

@section('content')
<div class="container-fluid p-0">

					<h1 class="h3 mb-3">ข้อมูลการสมัครเป็นผู้ช่วยสอน</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                    <div class="row py-0">
                                        <div class="col-10">
									        <h5 class="card-title mb-0">รายการทั้งหมด</h5>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ route('request.create') }}" class="btn btn-info">ยื่นใบสมัคร</a>
                                        </div>
                                    </div>
								</div>
								<div class="card-body">
                                <table class="table table-hover my-10">
									<thead>
										<tr>
											<th>ลำดับ</th>
											<th class="d-none d-xl-table-cell">รหัสนักศึกษา</th>
											<th class="d-none d-xl-table-cell">ชื่อ-นามสกุล</th>
                                            <th class="d-none d-md-table-cell">รายวิชาที่สมัคร</th>
                                            <th class="d-none d-md-table-cell">วันเวลาที่สมัคร</th>
											<th class="d-none d-md-table-cell">สถานะ</th>
											<th class="d-none d-md-table-cell">วันที่อนุมัติ</th>
											<th class="d-none d-md-table-cell">ความคิดเห็น</th>
                                            <th></th>
										</tr>
									</thead>
									<tbody>
										@php($i=1)
                                        @foreach($reqs as $req)
										<tr>
											<td>{{$i++}}</td>
											<td class="d-none d-xl-table-cell">{{$req->student_user->student_id}}</td>
                                            <td class="d-none d-xl-table-cell">{{$req->student_user->name}}</td>
											<td class="d-none d-xl-table-cell">{{$req->course->subject_id}} {{$req->course->subject->name_th}}</td>
											<td class="d-none d-md-table-cell">{{$req->created_at}}</td>
											<td class="d-none d-md-table-cell">
											@if($req->status == "N")
												<span class="badge bg-danger">ไม่อนุมัติ</span>
												<p><td class="d-none d-md-table-cell"></td></p>
											@elseif($req->status == "W")
												<span class="badge bg-warning">รอดำเนินการ</span>
												<p><td class="d-none d-md-table-cell"></td></p>
											@else
												<span class="badge bg-success">อนุมัติ</span>
												<p><td class="d-none d-md-table-cell">{{$req->approved_at}}</td></p>
											@endif
											</td>
											<th class="d-none d-md-table-cell">{{$req->comment}}</th>

											@if(Auth::user()->isAdmin())
											<td><a href="{{route('request.edit',$req->request_id)}}"  class="btn btn-warning">แก้ไข</a></td>
											<td><a href="{{route('request.destroy',$req->request_id)}}" class="btn btn-danger">ลบ</a></td>
											@elseif($req->status == "W")
											<td><a href="{{route('request.edit',$req->request_id)}}"  class="btn btn-warning">แก้ไข</a> <a href="{{route('request.destroy',$req->request_id)}}" class="btn btn-danger">ลบ</a></td>
											@endif
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