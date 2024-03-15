<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- icon  -->
	<link rel="icon" href="{{asset('Application/public/images/settings/websiteIconName'.$settingsAllData->websiteIcon)}}" type=""/>
	
	<link href="{{URL::to('/')}}/Application/public/admin/assets//plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{URL::to('/')}}/Application/public/admin/assets//plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{URL::to('/')}}/Application/public/admin/assets//plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{URL::to('/')}}/Application/public/admin/assets//plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
	<link href="{{URL::to('/')}}/Application/public/admin/assets//css/pace.min.css" rel="stylesheet"/>
	<script src="{{URL::to('/')}}/Application/public/admin/assets//js/pace.min.js"></script>
	<link href="{{URL::to('/')}}/Application/public/admin/assets//css/bootstrap.min.css" rel="stylesheet">
	<link href="{{URL::to('/')}}/Application/public/admin/assets//css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{URL::to('/')}}/Application/public/admin/assets//css/app.css" rel="stylesheet">
	<link href="{{URL::to('/')}}/Application/public/admin/assets//css/icons.css" rel="stylesheet">
	<link rel="stylesheet" href="{{URL::to('/')}}/Application/public/admin/assets//css/dark-theme.css"/>
	<link rel="stylesheet" href="{{URL::to('/')}}/Application/public/admin/assets//css/semi-dark.css"/>
	<link rel="stylesheet" href="{{URL::to('/')}}/Application/public/admin/assets//css/header-colors.css"/>
	
	<!-- title  -->
	<title>@yield('title')</title>

	<!-- TyniMCE Editor link for offline  -->
	<script src="{{URL::to('/')}}/Application/public/tinymce/tinymce.min.js"></script>

	<!-- fontawesome 6.4.2  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<div class="wrapper">
		<!--sidebar wrapper -->
        @include('layouts.sidebar')
		<!--end sidebar wrapper -->
		<!--start header -->
        @include('layouts.topbar')
		<!--end header -->
		<!--start page wrapper -->
        @yield('content')
		<!--end page wrapper -->
		<!--start overlay-->
		 <div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		  <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
        @include('layouts.footer')
	</div>

	<!-- Bootstrap JS -->
	<script src="{{URL::to('/')}}/Application/public/admin/assets//js/bootstrap.bundle.min.js"></script>
	<script src="{{URL::to('/')}}/Application/public/admin/assets//js/jquery.min.js"></script>
	<script src="{{URL::to('/')}}/Application/public/admin/assets//plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{URL::to('/')}}/Application/public/admin/assets//plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{URL::to('/')}}/Application/public/admin/assets//plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{URL::to('/')}}/Application/public/admin/assets//plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{URL::to('/')}}/Application/public/admin/assets//plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{URL::to('/')}}/Application/public/admin/assets//plugins/chartjs/js/chart.js"></script>
	<script src="{{URL::to('/')}}/Application/public/admin/assets//js/index.js"></script>
	<script src="{{URL::to('/')}}/Application/public/admin/assets//js/app.js"></script>
	<script> new PerfectScrollbar(".app-container")</script>

	<!-- tyniMCE Editor -->
	<script>
      	tinymce.init({
      	    selector: 'textarea#tinyMceFull-1',
      	    height: 300,
      	    menubar: true,
      	    relative_urls : false,
      	    remove_script_host : false,
      	    convert_urls : false,
      	    plugins: 'textcolor print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
      	    imagetools_cors_hosts: ['picsum.photos'],
      	    menubar: 'file edit view insert format tools table help',
      	    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | forecolor backcolor',
      	    toolbar_sticky: true,
      	    autosave_ask_before_unload: true,
      	    autosave_interval: '30s',
      	    autosave_prefix: '{path}{query}-{id}-',
      	    autosave_restore_when_empty: false,
      	    autosave_retention: '2m',
      	    image_advtab: true,
      	    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      	});
  	</script>

	<!-- tyniMCE Editor -->
	<script>
      	tinymce.init({
      	    selector: 'textarea#tinyMceFull-2',
      	    height: 300,
      	    menubar: true,
      	    relative_urls : false,
      	    remove_script_host : false,
      	    convert_urls : false,
      	    plugins: 'textcolor print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
      	    imagetools_cors_hosts: ['picsum.photos'],
      	    menubar: 'file edit view insert format tools table help',
      	    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | forecolor backcolor',
      	    toolbar_sticky: true,
      	    autosave_ask_before_unload: true,
      	    autosave_interval: '30s',
      	    autosave_prefix: '{path}{query}-{id}-',
      	    autosave_restore_when_empty: false,
      	    autosave_retention: '2m',
      	    image_advtab: true,
      	    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      	});
  	</script>

	<!-- tyniMCE Editor -->
	<script>
      	tinymce.init({
      	    selector: 'textarea#tinyMceFull-3',
      	    height: 300,
      	    menubar: true,
      	    relative_urls : false,
      	    remove_script_host : false,
      	    convert_urls : false,
      	    plugins: 'textcolor print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
      	    imagetools_cors_hosts: ['picsum.photos'],
      	    menubar: 'file edit view insert format tools table help',
      	    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | forecolor backcolor',
      	    toolbar_sticky: true,
      	    autosave_ask_before_unload: true,
      	    autosave_interval: '30s',
      	    autosave_prefix: '{path}{query}-{id}-',
      	    autosave_restore_when_empty: false,
      	    autosave_retention: '2m',
      	    image_advtab: true,
      	    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      	});
  	</script>

	<!-- order menu  -->
	<script>
		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
			acc[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
					panel.style.maxHeight = null;
				} else {
					panel.style.maxHeight = panel.scrollHeight + "px";
				} 
			});
		}
	</script>

</body>
</html>