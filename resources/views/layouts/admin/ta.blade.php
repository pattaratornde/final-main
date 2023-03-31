@extends('layouts.tam')

@section('content')
@if(Auth::user()->isAdmin())
<div class="container-fluid p-0">

					<h1 class="h3 mb-3">จัดการคำร้องผู้ช่วยสอน</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                    <div class="row py-0">
                                        <div class="col-10">
									        <h5 class="card-title mb-0">รายการทั้งหมด</h5>
                                        </div>
										<br>
										<div class="search_box pull-right">
        									<form class="" method="get" action="/searchTa/search">
          										<input type="text" placeholder="ค้นหา" name="search" />
											</form>
										</div>
                                    </div>
								</div>
								<div class="card-body">
                                <table class="table table-hover my-1">
									<thead>
										<tr>
											<th>ลำดับ</th>
											<th class="d-none d-xl-table-cell">รหัสนักศึกษา</th>
											<th class="d-none d-xl-table-cell">ชื่อ-นามสกุล</th>
                                            <th class="d-none d-md-table-cell">รายวิชาที่สมัคร</th>
                                            <th class="d-none d-md-table-cell">วันเวลาที่สมัคร</th>
											<th class="d-none d-md-table-cell">สถานะ</th>
											<th class="d-none d-md-table-cell">วันเวลาที่อนุมัติ</th>
											<th class="d-none d-md-table-cell">รายละเอียด</th>

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
											<td><a href="{{route('admin.edit',$req->request_id)}}"  class="btn btn-primary">แก้ไข</a>
											<form  method="post" action="{{ route('delete', $req) }}">
											@csrf
												<input name="_method" type="hidden" value="DELETE">
												<button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>ลบ</button>
											</form>
                                            <td></td>
										</tr>
                                        @endforeach
									</tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
					<script type="text/javascript">
					
						$('.show_confirm').click(function(event) {
							var form =  $(this).closest("form");
							var name = $(this).data("name");
							event.preventDefault();
							swal({
								title: `ต้องการลบข้อมูลหรือไม่?`,
								text: "หากลบข้อมูลแล้ว จะไม่สามารถกู้คืนข้อมูลได้.",
								icon: "warning",
								buttons: true,
								dangerMode: true,
							})
							.then((willDelete) => {
								if (willDelete) {
								form.submit();
								}
							});
						});
  
					</script>
				</div>
@endsection
@endif