@extends('layouts.tam')

@section('content')
<main class="content">
				<div class="container-fluid p-0">
				<div class="card">
					<div class="card-header">
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">เพิ่มข้อมูลการเบิกจ่ายผู้ช่วยสอน</h1>
						<a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html"></a>
					</div>
					
					<form action="" method="POST" enctype="multipart/form-data">
						@csrf
						<br>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
										<label for="book_id">เลขที่บัญชีธนาคาร:</label>
                                            <input type="text" id="bookbank_id" name="bookbank_id" placeholder="กรุณากรอกเลขที่บัญชี"><br><br>
										<label for="book_name">ชื่อบัญชีธนาคาร:</label>
                                            <input type="text" id="bookbank_name" name="bookbank_name" placeholder="กรุณากรอกชื่อบัญชี"><br><br>
										<label for="bank_name">ธนาคาร:</label>
                                            <input type="text" id="bank_name" name="bank_name" placeholder="กรุณากรอกธนาคาร"><br>
								<br>
								<label for="filename" style="color:red">อัพโหลดหลักฐานการเบิกจ่าย (*เฉพาะไฟล์ PDF เท่านั้น* )</label>
										<br>
											<input type="file" name="filename">
								</div>
								<br>
								<div class="col-1">
                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                </div>
							</div>
						</div>	
					</form>			
				</div>
		
@endsection