<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>CP-TAM</title>

	<link href="/assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<style>
		body {
  			font-family: "Prompt";
		}
	</style>
	
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="">
          <span class="align-middle">CP-TAM ระบบบริหารผู้ช่วยสอน</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						MENUS
					</li>
			@if(Auth::user()->isUser())
					<li class="sidebar-item ">
						<a class="sidebar-link" href="{{ route ('request.index')}}">
              <i class="align-middle" data-feather="edit"></i> <span class="align-middle">ยื่นคำร้องสมัครผู้ช่วยสอน</span>
            </a>
					</li>

					<li class="sidebar-item ">
						<a class="sidebar-link" href="{{route('tainfo.index')}}">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">ข้อมูลรายวิชาผู้ช่วยสอน</span>
            </a>

				<li class="sidebar-item ">
						<a class="sidebar-link" href="{{route('adbookbank.index')}}">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">อัพโหลดเอกสารเบิกจ่ายผู้ช่วยสอน</span>
            </a>


			
			@endif
					</li>
					
			@if(Auth::user()->isAdmin())
					<li class="sidebar-item ">
						<a class="sidebar-link" href="{{route('admin.index')}}">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">จัดการคำร้องผู้ช่วยสอน (Staff Only)</span>
            </a>
					<li class="sidebar-item ">
						<a class="sidebar-link" href="{{ route('admincourse.index') }}">
              	<i class="align-middle" data-feather="user"></i> <span class="align-middle">ข้อมูลผู้ช่วนสอน (Staff Only)</span>
           	</a>
	
			@endif
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="home"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="user-plus"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <span class="text-dark">{{Auth::user()->name}}</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> โปรไฟล์</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="javascript:;"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">ออกจากระบบ</a>
                                
                                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf

                    
                </form>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				@yield('content')
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://computing.kku.ac.th/" target="_blank"><strong>Collage of Compuing Khon Kaen Unversity</strong></a> <a class="text-muted" href="https://adminkit.io/" target="_blank"></a>&copy;
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="/assets/js/app.js"></script>

</body>

</html>