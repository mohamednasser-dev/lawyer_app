
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/prismjs/themes/prism.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(trans('site_lang.side_home')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"> <?php echo e(trans('site_lang.side_users')); ?></li>
        </ol>
    </nav>
    <div class="row" >
        <div class="col-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary card-title" id="addUserModal"><i
                            class="fa fa-plus"></i><?php echo e(trans('site_lang.home_add_user')); ?></a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="list_users">
                            <thead>
                            <tr>
                                <th class="hidden-xs center">#</th>
                                <th class="hidden-xs center"><?php echo e(trans('site_lang.users_username')); ?></th>
                                <th class="hidden-xs center"><?php echo e(trans('site_lang.users_email')); ?></th>
                                <th class="hidden-xs center"><?php echo e(trans('site_lang.users_type')); ?></th>
                                <th class="hidden-xs center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('users.users_item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="add_user_model" abindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
         class="modal fade">
        <div class="modal-dialog" abindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="user_modal_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="users" class="cmxform">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group<?php echo e($errors->has('name')?' has-error':''); ?>">
                                    <input type="text" name="name" class="form-control " id="name" required
                                           placeholder="<?php echo e(trans('site_lang.users_username')); ?>"
                                           value="<?php echo e(old('name')); ?>">
                                    <span class="text-danger" id="name_error"></span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group<?php echo e($errors->has('email')?' has-error':''); ?>">
                                    <input name="email" id="email" placeholder="<?php echo e(trans('site_lang.users_email')); ?>"
                                           required
                                           class="form-control"
                                           value="<?php echo e(old('email')); ?>"/>
                                    <span class="text-danger" id="email_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group<?php echo e($errors->has('password')?' has-error':''); ?>">
                                    <input type="password" name="password" id="password" class="form-control"
                                           required
                                           placeholder="<?php echo e(trans('site_lang.auth_password')); ?>"
                                           value="<?php echo e(old('password')); ?>">
                                    <span class="text-danger" id="password_error"></span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group<?php echo e($errors->has('phone')?' has-error':''); ?>">
                                    <input type="text" name="phone" id="phone" class="form-control"
                                           required
                                           placeholder="<?php echo e(trans('site_lang.phone')); ?>"
                                           value="<?php echo e(old('phone')); ?>">
                                    <span class="text-danger" id="phone_error"></span>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group<?php echo e($errors->has('address')?' has-error':''); ?>">
                                    <input type="text" name="address" id="address" class="form-control"
                                           required
                                           placeholder="<?php echo e(trans('site_lang.address')); ?>"
                                           value="<?php echo e(old('address')); ?>">
                                    <span class="text-danger" id="address_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group<?php echo e($errors->has('type')?' has-error':''); ?>">
                                    <select id="type" name="type" required
                                            class="form-control">
                                        <option value="" selected="selected">
                                            &nbsp;<?php echo e(trans('site_lang.selectType')); ?></option>
                                        <option value="admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                    <span class="text-danger" id=type_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group<?php echo e($errors->has('cat_id')?' has-error':''); ?>">
                                    <select id="form-field-select-3" class="form-control js-example-basic-single"
                                            name="cat_id">
                                        <option value="">
                                            &nbsp;<?php echo e(trans('site_lang.add_case_to_whom')); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value='<?php echo e($category->id); ?>'><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="text-danger" id="cat_id"></span>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">
                        <?php echo e(trans('site_lang.public_close_btn_text')); ?>

                    </button>
                    <input type="submit" class="btn btn-primary" id="add_user" name="add_user"
                           value="<?php echo e(trans('site_lang.public_add_btn_text')); ?>"/>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#addUserModal').click(function () {
                $('#user_modal_title').text("<?php echo e(trans('site_lang.users_add_new')); ?>");
                $('#add_user').val("<?php echo e(trans('site_lang.public_add_btn_text')); ?>");
                $('#password').css('display','block');
                $('#add_user_model').modal('show');
            });

            $('#add_user').click(function () {
                var form = $('#users').serialize();
                if ($('#add_user').val() == '<?php echo e(trans('site_lang.public_add_btn_text')); ?>') {
                    $.ajax({
                        url: "<?php echo e(route('users.store')); ?>",
                        dataType: 'json',
                        data: form,
                        type: 'post',
                        beforeSend: function () {

                            $('#name_error').empty();
                            $('#password_error').empty();
                            $('#email_error').empty();
                            $('#cat_id').empty();
                        }, success: function (data) {
                            // if (data.status == true) {
                            $('#list_users tbody').append(data.result);
                            $('#add_user_model').modal('hide');
                            toastr.success(data.msg);
                            $("#users").trigger('reset');
                        }, error: function (data_error, exception) {
                            if (exception == 'error') {
                                console.log(exception);
                                $('#name_error').html(data_error.responseJSON.errors.name);
                                $('#password_error').html(data_error.responseJSON.errors.password);
                                $('#email_error').html(data_error.responseJSON.errors.email);
                                $('#phone_error').html(data_error.responseJSON.errors.phone);
                                $('#address_error').html(data_error.responseJSON.errors.address);
                                $('#type_error').html(data_error.responseJSON.errors.type);
                                $('#cat_id').html(data_error.responseJSON.errors.cat_id);
                            }
                        }
                    });
                } else {
                    $.ajax({
                        url: "<?php echo e(route('users.update')); ?>",
                        dataType: 'json',
                        data: form,
                        type: 'post',
                        beforeSend: function () {
                            $('#name_error').empty();
                            $('#password_error').empty();
                            $('#email_error').empty();
                        }, success: function (data) {
                            console.log(data);
                            var data_id = data.result.id;
                            console.log(data_id);
                            $("#userId" + data.result.id).html(data.result.id);
                            $("#userName" + data.result.id).html(data.result.name);
                            $("#userEmail" + data.result.id).html(data.result.email);
                            $("#userType" + data.result.id).html(data.result.type);
                            toastr.success(data.msg);
                            $('#add_user_model').modal('hide');
                            $("#users").trigger('reset');
                        }, error: function (data_error, exception) {
                            if (exception == 'error') {
                                $('#name_error').html(data_error.responseJSON.errors.name);
                                $('#password_error').html(data_error.responseJSON.errors.password);
                                $('#email_error').html(data_error.responseJSON.errors.email);
                                $('#phone_error').html(data_error.responseJSON.errors.phone);
                                $('#address_error').html(data_error.responseJSON.errors.address);

                                $('#type_error').html(data_error.responseJSON.errors.type);
                            }
                        }
                    });
                }
            });
            $(document).on('click', '#editUser', function () {
                var id = $(this).data('user-id');

                $.ajax({
                    url: "/users/" + id + "/edit",
                    dataType: "json",
                    success: function (html) {
                        // $('#password').val(html.data.name).hide();
                        $('#password').css('display','none');

                        $('#name').val(html.data.name);
                        $('#email').val(html.data.email);
                        $('#phone').val(html.data.phone);
                        $('#address').val(html.data.address);
                        $('#type').val(html.data.type);
                        $('#form-field-select-3').val(html.data.cat_id);
                        $('#id').val(html.data.id);
                        if (html.data.type == "Admin") {
                            $('#form-field-select-1 option[value=Admin]').attr('selected', 'selected');
                        } else {
                            $('#form-field-select-1 option[value=User]').attr('selected', 'selected');
                        }
                        $('#user_modal_title').text("<?php echo e(trans('site_lang.users_edit_user')); ?>");
                        $('#add_user').val("<?php echo e(trans('site_lang.public_edit_btn_text')); ?>");
                        $('#add_user_model').modal('show');

                    }
                })
            });
            var user_id;

            $(document).on('click', '#deleteUser', function () {
                user_id = $(this).data('user-id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function () {
                $.ajax({
                    url: "users/destroy/" + user_id,
                    beforeSend: function () {
                        $('#ok_button').text('<?php echo e(trans('site_lang.public_continue_delete_modal_text')); ?>');
                    },
                    success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            if (data.status) {
                                $('#userRow' + user_id).remove();
                            }
                            toastr.error(data.msg);
                        }, 2000);
                    }
                })
            });
        });
        $(document).ready(function () {
            $(".modal").on("hidden.bs.modal", function () {
                $("#users").trigger('reset');
            });
        });
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dgmevmh7hnpa/public_html/tes/resources/views/users/users.blade.php ENDPATH**/ ?>