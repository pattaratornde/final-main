@extends('layouts.tam')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">รายละเอียด</h1>
    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">

                    <div class="row py-0">
                        <h4>ชื่อวิชา : {{$tadetail->course->subject->subject_id}} {{$tadetail->course->subject->name_en}} </h4>
                        <h4>ปีการศึกษา : {{$tadetail->course->semester->semester}} / {{$tadetail->course->semester->year}}</h4>
                        <h4>อาจารย์ประจำวิชา : {{$tadetail->course->teacher->position}}{{$tadetail->course->teacher->degree}}  {{$tadetail->course->teacher->name}}</h4>
                        <h4>ชื่อผู้ช่วยสอน : {{$tadetail->ta->name}}</h4>
                        <h4>หน่วยกิต : {{$tadetail->course->subject->credit}} หน่วยกิต</h4>
                    </div>
                </div>
        </div>
    </div>
</div>

<h1 class="h3 mb-3">ตารางการสอน</h1>
		<div class="col-12">
			<div class="card">
				<div class="card-header">

                        <a href="{{route('classattend.create')}}?course_id={{$tadetail->course->course_id}}&id={{$tadetail->id}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> ลงเวลา</a>
                        <a href="{{route('export',$tadetail->id)}}"class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> ดาวน์โหลดเอกสารสรุปภาระงาน</a>
                        <a href="{{route('exportattendace',$tadetail->id)}}"class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> ดาวน์โหลดเอกสาร</a><br><br>

                        <div class="mb-3">
                        <form id="monthForm" action="{{ route('export', $tadetail->id) }}" method="GET">
                            @csrf
                            <label class="form-label" for="monthSelect">เลือกเดือนที่ต้องการดาวน์โหลด:</label><br>
                            <select name="m" id="monthSelect" class="form-control">
                                @foreach($monthlyData as $month)
                                    @php
                                        $monthNumber = $month->month;
                                        $monthName = date('F', mktime(0, 0, 0, $monthNumber, 1));
                                    @endphp
                                    <option value="{{ $monthNumber }}">{{ $monthName }}</option>
                                @endforeach
                            </select><br>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-download" aria-hidden="true"></i> ดาวน์โหลด
                            </button>
                        </form>
                        </div>

                        <div class="card-body">
                            <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="d-none d-xl-table-cell">กลุ่ม</th>
                                    <th class="d-none d-xl-table-cell">เริ่มเรียน</th>
                                    <th class="d-none d-xl-table-cell">เลิกเรียน</th>
                                    <th class="d-none d-xl-table-cell">เวลาที่สอน(นาที)</th>
                                    <th class="d-none d-xl-table-cell">อาจารย์ประจำวิชา</th>
                                    <th class="d-none d-xl-table-cell">การปฎิบัติงาน</th>
                                    <th class="d-none d-xl-table-cell">รายละเอียด</th>
                                </tr>
							</thead>

                            <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <tbody>
                                 @foreach ($tadetail->course->classes as $c)
                                <tr>
                                        <td>{{$c->title}}</td>
                                        @foreach($c->teaching as $t)
                                        <tr>
                                            <td></td>
                                            <td>{{$t->start_time}} </td>
                                            <td>{{$t->end_time}}</td>
                                            <td>{{$t->getDuration()}}</td>
                                            <td>{{$t->teacher->getName()}}</td>
                                            
                                            <td class="d-none d-md-table-cell">
                                                @if($t->attendanceTa()->where('ta_id',$tadetail->ta_id)->first()!= null)
                                                    <span class="badge bg-success">เข้าปฎิบัติการสอน</span>
                                                    
                                                    <p><td class="d-none d-md-table-cell"></td></p>
                                                    
                                                @else
                                                    <span class="badge bg-danger">ไม่ได้เข้าปฎิบัติการสอน</span>
                                                    
                                                    <td><a href="{{route('attendance.create')}}?teaching_id={{$t->teaching_id}}"class="btn btn-primary btn-sm">ลงเวลา</a></td>
                                                    <p><td class="d-none d-md-table-cell"></td></p>
                                                @endif
                                                
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

