@extends('layouts.tam')

@section('content')
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3">ข้อมูลวิชา</h1>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                    <div class="row py-0">
									<div class="col-10">
                                        <div class="row py-0">
                                            <h4>รหัสวิชา : {{$subject->subject_id}}</h4>
                                            <h4>ชื่อวิชา : {{$subject->name_en}} ({{$subject->name_th}})</h4>
                                            <h4>จำนวนหน่วยกิต : {{$subject->credit}} หน่วยกิต</h4>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection
