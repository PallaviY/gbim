<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">


    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="<?php echo base_url().'logout' ?>" class="fw-normal">Logout</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url().'user' ?>">Home</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">List</h3>
                        <p class="text-muted"><a href="<?php echo base_url() . 'user/add' ?>"><code>Create New User</code></a></p>
                        <div class="table-responsive">
                            <table class="table text-nowrap" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">First Name</th>
                                        <th class="border-top-0">Last Name</th>
                                        <th class="border-top-0">Username</th>
                                        <th class="border-top-0">Role</th>
                                        <th class="border-top-0">Created At</th>
                                        <th class="border-top-0">Update At</th>
                                        <th class="border-top-0">Action</th>
                                        <th class="border-top-0"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_data">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">First Name</th>
                                        <th class="border-top-0">Last Name</th>
                                        <th class="border-top-0">Username</th>
                                        <th class="border-top-0">Role</th>
                                        <th class="border-top-0">Created At</th>
                                        <th class="border-top-0">Update At</th>
                                        <th class="border-top-0">Action</th>
                                        <th class="border-top-0"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <script type="text/javascript" language="javascript" >
            $(document).ready(function () {

                $('#dataTable').hide();
                var token = '<?php echo $this->session->userdata('token') ?>';
                fetch_data();
                function fetch_data()
                {
                    $('#tbl_data').html('');
                    $.ajax({
                        url: "<?php echo base_url() . 'user/list' ?>",
                        method: "POST",
                        data: {token: token},
                        dataType: "json",
                        success: function (resp)
                        {
                            if (resp.error)
                            {
                                $(".print-error-msg").html(resp.error);
                                $(".print-error-msg").css('display', 'block');
                            } else if (resp.success) {
                                // console.log(resp.data);
                                // Setup - add a text input to each footer cell
                                $('#dataTable tfoot th').each(function () {
                                    var title = $(this).text();
                                    $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                                });
                                $('#tbl_data').html(resp.data);
//                                $('#dataTable').DataTable().ajax.reload();
                                $('#dataTable').DataTable({
                                    "lengthChange": false,
                                    initComplete: function () {
                                        // Apply the search
                                        this.api().columns().every(function () {
                                            var that = this;

                                            $('input', this.footer()).on('keyup change clear', function () {
                                                if (that.search() !== this.value) {
                                                    that
                                                            .search(this.value)
                                                            .draw();
                                                }
                                            });
                                        });
                                    }
                                });
                                $('#dataTable').show();
//                                $.each(resp.data, function (key, value) {
//                                    td = '<tr>';
//                                    td += '<td>' + value.id + '</td>';
//                                    td += '<td>' + value.first_name + '</td>';
//                                    td += '<td>' + value.last_name + '</td>';
//                                    td += '<td>' + value.email + '</td>';
//                                    td += '<td>' + value.role + '</td>';
//                                    td += '<td><a href="<?php echo base_url() ?>user/edit/'+value.id+'"><button type="button" class="btn btn-warning btn-xs edit" name="edit" id="' + value.id + '">Edit</button></a></td>';
//                                    td += '<td><button type="button" class="btn btn-danger btn-xs delete" name="delete" id="' + value.id + '">Delete</button></td>';
//                                    td += '</tr>';
//                                    $('#tbl_data').append(td);
//                                });


                            }
                        }
                    })
                }


                $(document).on('click', '.delete', function () {

                    var user_id = $(this).attr('id');
                    if (confirm("Are you sure you want to delete this?"))
                    {
                        $.ajax({
                            url: "<?php echo base_url(); ?>user/delete",
                            method: "POST",
                            data: {user_id: user_id, token: token},
                            dataType: "json",
                            success: function (resp)
                            {
                                if (resp.success)
                                {
                                    $(".print-error-msg").html(resp.success);
                                    $(".print-error-msg").css('display', 'block');
                                    location.reload();
                                }
                            }
                        })
                    }
                });

                $(document).on('click', '.edit', function () {

                    var user_id = $(this).attr('id');
                    $.ajax({
                        url: "<?php echo base_url(); ?>user/edit",
                        method: "POST",
                        data: {user_id: user_id, token: token},
                        dataType: "json",
                        success: function (resp)
                        {
                            if (resp.success)
                            {
                                $(".print-error-msg").html(resp.success);
                                $(".print-error-msg").css('display', 'block');
                            }
                        }
                    })
                });

            });
        </script>