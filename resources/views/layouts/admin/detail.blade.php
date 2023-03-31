@extends('layouts.tam')

@section('content')
<div class="row">
<h1 class="h3 mb-3">ตารางการสอน</h1>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
                    <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="d-none d-xl-table-cell">เซกชั่น</th>
                                    <th class="d-none d-xl-table-cell">เริ่มเรียน</th>
                                    <th class="d-none d-xl-table-cell">เลิกเรียน</th>
                                    <th class="d-none d-xl-table-cell">เวลาที่สอน(นาที)</th>
                                    <th class="d-none d-xl-table-cell">อาจารย์ประจำวิชา</th>
                                    <th class="d-none d-xl-table-cell">การปฎิบัติการสอน</th>
                                    <th class="d-none d-xl-table-cell">สถานะ</th>
                                </tr>
							</thead>
                            <tbody>
                                 @foreach ($admincourse->course->classes as $c)
                                <tr>
                                        <td>{{$c->title}}</td>
                                        @foreach($c->teaching as $t)
                                        <tr>
                                            <td></td>
                                            <td>{{$t->start_time}}</td>
                                            <td>{{$t->end_time}}</td>
                                            <td>{{$t->getDuration()}}</td>
                                            <td>{{$t->teacher->getName()}}</td>
                                            <td></td>
                                            <td class="d-none d-md-table-cell">
                                                @if($t->status == "N")
                                                    <span class="badge bg-danger">ไม่อนุมัติ</span>
                                                    <p><td class="d-none d-md-table-cell"></td></p>
                                                @elseif($t->status == "W")
                                                    <span class="badge bg-warning">รอดำเนินการ</span>
                                                    <p><td class="d-none d-md-table-cell"></td></p>
                                                @else
                                                    <span class="badge bg-success">อนุมัติ</span>
                                                    <p><td class="d-none d-md-table-cell">{{$t->approved_at}}</td></p>
                                                @endif
                                            </td>
                                            <td><a href="{{route('admincourse.create')}}" class="btn btn-primary btn-sm">ตรวจสอบ</a></td>
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
</div>

@endsection