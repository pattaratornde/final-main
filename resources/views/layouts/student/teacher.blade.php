@extends('layouts.tam')

@section('content')
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3">ข้อมูลอาจารย์</h1>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                    <div class="row py-0">
									<div class="col-10">
                                        <div class="row py-0">
                                            <h4>ชื่ออาจารย์ : {{$teach->position}}{{$teach->degree}}  {{$teach->name}}</h4>
                                        </div>
                                    </div>
								</div>
								<div class="card-body">
								<table class="table table-hover my-0">
									<thead>
										@php($i=1)
										<tr>
											<th>ลำดับ</th>
											<th class="d-none d-xl-table-cell">รายวิชาที่สอน</th>
										</tr>
									</thead>
									<tbody>
										@php($i=1)
										@foreach($courseteach as $ta)
										<tr>
											<td>{{$i++}}</td>
											<td class="d-none d-xl-table-cell">{{$ta->subject->name_en}} ({{$ta->subject->subject_id}})</td>
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
