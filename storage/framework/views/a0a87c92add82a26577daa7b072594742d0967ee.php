<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(url('/assets/vendors/prismjs/themes/prism.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(trans('site_lang.side_home')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"> <?php echo e(trans('site_lang.side_Packages')); ?></li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-primary" id="addClientModal"><i class="fa fa-plus"></i><?php echo e(trans('site_lang.Add_package')); ?> </a> </div>

                </div>
                <div class="table-responsive">
                    <table id="package_tbl" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center"><?php echo e(trans('site_lang.packae_name')); ?></th>
                                <th class="center"><?php echo e(trans('site_lang.package_cost')); ?></th>
                                <th class="center"><?php echo e(trans('site_lang.package_duration')); ?></th>
                                <th class="center"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: PAGE -->
 
<div id="add_package_model"  role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                    <div class="modal-body">
                        <form method="post" id="packages" enctype="multipart/form-data">
                            <input type="hidden" id="token" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group<?php echo e($errors->has('name')?' has-error':''); ?>">
                                        <input type="text" name="name" class="form-control" id="name"
                                               placeholder="<?php echo e(trans('site_lang.packae_name')); ?>"
                                               value="<?php echo e(old('name')); ?>">
                                        <span class="text-danger" id="package_Name_error"></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group<?php echo e($errors->has('cost')?' has-error':''); ?>">

                                        <input name="cost" id="cost"
                                               placeholder="<?php echo e(trans('site_lang.package_cost')); ?>"
                                               class="form-control"
                                               value="<?php echo e(old('cost')); ?>"/>
                                        <span class="text-danger" id="package_cost_error"></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group<?php echo e($errors->has('duration')?' has-error':''); ?>">

                                        <input type="text" name="duration" id="duration"
                                               class="form-control"
                                               placeholder="<?php echo e(trans('site_lang.package_duration')); ?>"
                                               value="<?php echo e(old('duration')); ?>">
                                        <span class="text-danger" id="package_duration_error"></span>
                                    </div>
                                </div>



                            </div>
                            <div class="form-group right">
                                <button data-dismiss="modal" class="btn btn-default" type="button">
                                    <?php echo e(trans('site_lang.public_close_btn_text')); ?>

                                </button>
                                <input type="hidden" name="hidden_id" id="hidden_id"/>
                                <input type="submit" class="btn btn-primary" id="add_client" name="add_client"
                                       value="<?php echo e(trans('site_lang.public_add_btn_text')); ?>"/>
                            </div>
                        </form>

                    </div>

                </div>
                <!-- /.modal-content -->
            </div>


            <!-- /.modal-dialog -->
        </div>
        
        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">
                        <h4 align="center" style="margin:0;"><?php echo e(trans('site_lang.public_delete_modal_text')); ?></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="ok_button" id="ok_button"
                                class="btn btn-danger"><?php echo e(trans('site_lang.public_accept_btn_text')); ?></button>
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal"><?php echo e(trans('site_lang.public_close_btn_text')); ?></button>
                    </div>
                </div>
            </div>
        </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-plugin'); ?>
<script src="<?php echo e(url('/assets/vendors/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/clipboard/clipboard.min.js')); ?>"></script>
<script>
    var client_id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#package_tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(route('packages.index')); ?>",
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    className: 'center'
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'center'
                }, {
                    data: 'cost',
                    name: 'cost',
                    className: 'center'
                }, {
                    data: 'duration',
                    name: 'duration',
                    className: 'center'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    className: 'center'
                }
            ]
        });

        $('#addClientModal').click(function() {
            $('#modal_title').text("<?php echo e(trans('site_lang.Add_new_package')); ?>");
            $('#add_client').val("<?php echo e(trans('site_lang.public_add_btn_text')); ?>");
            $('#add_package_model').modal('show');
        });
        $('#packages').on('submit', function(event) {
            event.preventDefault();
            console.log($('#add_client').val());
            if ($('#add_client').val() == "<?php echo e(trans('site_lang.public_add_btn_text')); ?>") {
               
                $.ajax({
                    url: "<?php echo e(route('packages.store')); ?>",
                    method: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('#package_Name_error').empty();
                        $('#packae_cost_error').empty();
                        $('#package_duration_error').empty();

                    },
                    success: function(data) {
                        $('#add_package_model').modal('hide');
                        toastr.success(data.success);
                        $("#packages").trigger('reset');
                        $('#package_tbl').DataTable().ajax.reload();
                    },
                    error: function(data_error, exception) {
                        if (exception == 'error') {
                            $('#package_Name_error').html(data_error.responseJSON.errors.name);
                            $('#packae_cost_error').html(data_error.responseJSON.errors.cost);
                            $('#package_duration_error').html(data_error.responseJSON.errors.duration);

                        }
                    }
                });
            } else {
                $.ajax({
                    url: "<?php echo e(route('packages.update')); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('#package_Name_error').empty();
                        $('#packae_cost_error').empty();
                        $('#package_duration_error').empty();
                    },
                    success: function(data) {
                        $('#add_package_model').modal('hide');
                        toastr.success(data.success);
                        $("#packages").trigger('reset');
                        $('#package_tbl').DataTable().ajax.reload();
                    },
                    error: function(data_error, exception) {
                        if (exception == 'error') {
                            $('#package_Name_error').html(data_error.responseJSON.errors.name);
                            $('#packae_cost_error').html(data_error.responseJSON.errors.cost);
                            $('#package_duration_error').html(data_error.responseJSON.errors.duration);
                        }
                    }
                });
            }
        });

        $(document).on('click', '#editPackage', function() {
            var id = $(this).data('package-id');

            $.ajax({
                url: "/packages/" + id + "/edit",
                dataType: "json",
                success: function(html) {
                    $('#add_package_model').modal('show');
                    $('#name').val(html.data.name);
                    $('#cost').val(html.data.cost);
                    $('#duration').val(html.data.duration);
                    $('#id').val(html.data.id);
                    $('#modal_title').text("<?php echo e(trans('site_lang.package_edit_client_text')); ?>");
                    $('#add_client').val("<?php echo e(trans('site_lang.public_edit_btn_text')); ?>");


                }
            })
        });


        var client_id;

        $(document).on('click', '.btn-lg', function() {
            var id = $(this).data('moh-Id');
            $.ajax({
                url: "mohdareen/updateStatus/" + id,
                dataType: "json",
                success: function(html) {
                    $("#status" + html.result.moh_Id).html(html.result.status);
                    // var status = html.status;
                    if (html.status) {
                        $("#status" + html.result.moh_Id).removeClass("label label-danger");
                        $("#status" + html.result.moh_Id).addClass("label label-success");
                        toastr.success(html.msg);
                    } else {
                        $("#status" + html.result.moh_Id).removeClass("label label-success");
                        $("#status" + html.result.moh_Id).addClass("label label-danger");
                        toastr.error(html.msg);
                    }
                }
            })
        });


        $(document).on('click', '#deletePackage', function() {
            Package_id = $(this).data('package-id');
            $('#confirmModal').modal('show');
        });
        $('#ok_button').click(function() {
            $.ajax({
                url: "packages/destroy/" + Package_id,
                beforeSend: function() {
                    $('#ok_button').text("<?php echo e(trans('site_lang.public_continue_delete_modal_text ')); ?>");
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#package_tbl').DataTable().ajax.reload();
                    }, 100);
                }
            })
        });
        $(document).ready(function() {
            $(".modal").on("hidden.bs.modal", function() {
                $("#packages").trigger('reset');
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lawyer_app\resources\views/packages/package.blade.php ENDPATH**/ ?>