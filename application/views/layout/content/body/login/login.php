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
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="card">
                    <div class="card-body">
                            <div class="alert alert-warning print-error-msg">
                            </div>
                        <form id="login_form" class="form-horizontal form-material">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Username</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" name="email" value="<?php echo set_value('username'); ?>" placeholder="Email"
                                           class="form-control p-0 border-0" required="required"> </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Password</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="password" value="<?php echo set_value('password'); ?>" name="password" value="password" class="form-control p-0 border-0" required="required">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">Login</button>
                                </div>
                            </div>
                        </form>
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
            $(".print-error-msg").css('display','none');
            $(document).ready(function () {

                $(document).on('submit', '#login_form', function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: "<?php echo base_url() . 'login/process' ?>",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function (resp)
                        {
                            if(resp.error)
                            {
                                $(".print-error-msg").html(resp.error);
                                $(".print-error-msg").css('display','block');
                            } else if(resp.success) {
                                $(".print-error-msg").css('display','none');
                                window.location.href = '<?php echo base_url() ?>'+resp.goto;
                            }
                        }
                    })
                });
            });
        </script>