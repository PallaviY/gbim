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
                    <h4 class="page-title">
                        <ol class="breadcrumb ms-auto">
                            <li><a href="<?php echo base_url().'user' ?>" class="fw-normal">Dashboard</a></li>
                        </ol></h4>
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
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning print-error-msg">
                            </div>
                        <form class="form-horizontal form-material" id="edit_form">
                            <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token') ?>" />
                            <input type="hidden" name="user_id" id="token" value="<?php echo $user->id ?>" />
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Full Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input name="first_name" value="<?php echo $user->first_name ?>" type="text" placeholder="First Name"
                                           class="form-control p-0 border-0"> </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Last Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input name="last_name" value="<?php echo $user->last_name ?>" type="text" placeholder="Last Name"
                                           class="form-control p-0 border-0"> </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 p-0">Email</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input name="email" type="email" value="<?php echo $user->email ?>" placeholder="johnathan@admin.com"
                                           class="form-control p-0 border-0" name="example-email"
                                           id="example-email">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Password</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input name="password" type="password" value="<?php echo $user->password ?>" value="" class="form-control p-0 border-0">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Phone Number</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input value="<?php echo $user->phone_number ?>" name="phone_number" type="text" placeholder="First Name"
                                           class="form-control p-0 border-0"> 
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Select Country</label>

                                <div class="col-sm-12 border-bottom">
                                    <select name="role_type" class="form-select shadow-none p-0 border-0 form-control-line">
                                        <?php if(!empty($user_roles)) {?>
                                        <?php foreach($user_roles as $roles) {?>
                                        <option value="<?php echo $roles->id?>"><?php echo $roles->role?> <?php ($roles->id == $user->role_type) ? 'selected' : '' ?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">Update</button>
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
            $(".print-error-msg").css('display', 'none');
            $(document).ready(function () {
                var token = '<?php echo $this->session->userdata('token') ?>';

                $(document).on('submit', '#edit_form', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "<?php echo base_url() . 'user/update' ?>",
                        method: "POST",
                       // data: {token: token, form_data: form_data},
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function (resp)
                        {
                            if (resp.error)
                            {
                                $(".print-error-msg").html(resp.error);
                                $(".print-error-msg").css('display', 'block');
                            } else if (resp.success) {
                                $(".print-error-msg").html(resp.success);
                                $(".print-error-msg").css('display', 'block');
                            }
                        }
                    })
                });

            });
        </script>
