@extends('layouts.tam')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">ลงเวลาการสอน</h1>
						<a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html"></a>
					</div>
                    <div class="col-12">
							<div class="card">
								<div class="card-header">
                                    <form action="{{route('attendance.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="teaching_id" value="{{request('teaching_id')}}"/>
                                        
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label class="form-label">การเข้าสอน</label><br><br>
                                                        <input type="radio" id="classattend" name="attend_data" value="Y">
                                                        <label for="classattend"> เข้าปฎิบัติการสอน</label><br>
                                                        <input type="radio" id="classattend2" name="attend_data" value="N">
                                                        <label for="classattend2"> ลา</label><br>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">หมายเหตุ</label><br>
                                                        <input type="text" class="form-control" id="" name="note" value="เข้าปฏิบัติการสอน">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-success">ส่งข้อมูล</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
@endsection



