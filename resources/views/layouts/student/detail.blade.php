@extends('layouts.tam')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">รายละเอียด</h1>
    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">

                    <div class="row py-0">
                        <h4>ชื่อวิชา : {{$tadetail->course->subject->name_en}} ({{$tadetail->course->subject->name_th}})</h4>
                        <h4>ปีการศึกษา : {{$tadetail->course->semester->year}}</h4>
                        <h4>รหัสประจำวิชา : {{$tadetail->course->subject->subject_id}}</h4>
                        <h4>อาจารย์ประจำวิชา : {{$tadetail->course->teacher->position}}{{$tadetail->course->teacher->degree}}  {{$tadetail->course->teacher->name}}</h4>
                        <h4>ชื่อผู้ช่วยสอน : {{$tadetail->ta->name}}</h4>
                        <h4>หน่วยกิต : {{$tadetail->course->subject->credit}} หน่วยกิต</h4>
                        <a href="{{route('export')}}"class="btn btn-success">ดาวน์โหลดเอกสารสรุปภาระงาน</a>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="row">
<h1 class="h3 mb-3">ตารางการสอน</h1>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
                    <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="d-none d-xl-table-cell">กลุ่ม</th>
                                    <th class="d-none d-xl-table-cell">เริ่มเรียน</th>
                                    <th class="d-none d-xl-table-cell">เลิกเรียน</th>
                                    <th class="d-none d-xl-table-cell">เวลาที่สอน(นาที)</th>
                                    <th class="d-none d-xl-table-cell">อาจารย์ประจำวิชา</th>
                                    <th class="d-none d-xl-table-cell">การปฎิบัติการสอน</th>
                                    <th class="d-none d-xl-table-cell">สถานะ</th>
                                </tr>
							</thead>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">กลุ่ม 1</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">กลุ่ม 2</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">กลุ่ม 3</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <tbody>
                                 @foreach ($tadetail->course->classes as $c)
                                <tr>
                                        <td>{{$c->title}}</td>
                                        @foreach($c->teaching as $t)
                                        <tr>
                                            <td></td>
                                            <td>{{$t->start_time}}</td>
                                            <td>{{$t->end_time}}</td>
                                            <td>{{$t->getDuration()}}</td>
                                            <td>{{$t->teacher->getName()}}</td>
                                            <td class="d-none d-md-table-cell">
                                                @if($t->attend_data == "Y")
                                                    <span class="badge bg-danger">เข้าปฎิบัติการสอน</span>
                                                    <p><td class="d-none d-md-table-cell"></td></p>
                                                @elseif($t->attend_data == "N")
                                                    <span class="badge bg-danger">ไม่ได้เข้าปฎิบัติการสอน</span>
                                                    <p><td class="d-none d-md-table-cell"></td></p>
                                                @else
                                                    <span class="badge bg-danger">ไม่พบการลงเวลา</span>
                                                    <p><td class="d-none d-md-table-cell"></td></p>
                                                @endif
                                            <td class="d-none d-md-table-cell">
                                                @if($t->status == "N")
                                                    <span class="badge bg-danger">ไม่อนุมัติ</span>
                                                @elseif($t->status == "W")
                                                    <span class="badge bg-warning">รอดำเนินการ</span>
                                                @else
                                                    <span class="badge bg-success">อนุมัติ</span>
                                                @endif
                                            </td>
                                            <td><a href="{{route('attendance.create')}}?teaching_id={{$t->teaching_id}}"class="btn btn-primary btn-sm">ลงเวลา</a></td>
                                        </tr>
                                        @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
</div>
@endsection

