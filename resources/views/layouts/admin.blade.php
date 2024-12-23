<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Wowy Dashboard</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin')}}/imgs/theme/favico.svg">
    <!-- Template CSS -->
    <link href="{{asset('admin')}}/css/main.css" rel="stylesheet" type="text/css" />
    <!-- extra CSS -->
    <link rel="stylesheet" href="{{ asset('admin/extra') }}/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="{{ asset('admin/extra') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin/extra') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin/extra') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="screen-overlay"></div>
    @include('layouts.admin_partition.navbar')
    @include('layouts.admin_partition.sidebar')
    @yield('admin_content')
    <script src="{{asset('admin')}}/js/vendors/jquery-3.5.1.min.js"></script>
    <script src="{{asset('admin')}}/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="{{asset('admin')}}/js/vendors/select2.min.js"></script>
    <script src="{{asset('admin')}}/js/vendors/perfect-scrollbar.js"></script>
    <script src="{{asset('admin')}}/js/vendors/jquery.fullscreen.min.js"></script>
    <script src="{{asset('admin')}}/js/vendors/chart.js"></script>
    <!-- Main Script -->
    <script src="{{asset('admin')}}/js/main.js" type="text/javascript"></script>
    <script src="{{asset('admin')}}/js/custom-chart.js" type="text/javascript"></script>
    <!-- extra CSS -->
    <script src="{{ asset('admin/extra') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="{{ asset('admin/extra') }}/dist/js/adminlte.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ asset('admin/extra') }}/dist/js/demo.js"></script>
    <script src="{{ asset('admin/extra/dist/js/pages/dashboard2.js') }}"></script>
    <script src="{{ asset('admin/extra/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <script>
        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                    title: "Are you Want to delete?",
                    text: "Once Delete, This will be Permanently Delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                        swal("Safe Data!");
                    }
                });
        });
    </script>
    {{-- before  logout showing alert message --}}
    <script>
        $(document).on("click", "#logout", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                    title: "Are you Want to logout?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                        swal("Not Logout!");
                    }
                });
        });
    </script>

    <script src="{{ asset('admin/extra') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            $('.textarea').summernote()
        })
    </script>
    <script src="{{ asset('admin/extra') }}/plugins/print_this/printThis.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-2:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>