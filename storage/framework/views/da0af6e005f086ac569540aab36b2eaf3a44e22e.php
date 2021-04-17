<tr id="userRow<?php echo e($user->id); ?>">
    <td class="py-1 center">
        <p id="userId<?php echo e($user->id); ?>"><?php echo e($user->id); ?></p>
    </td>
    <td class="hidden-xs center"><p id="userName<?php echo e($user->id); ?>"><?php echo e($user->name); ?></p></td>
    <td class="hidden-xs center"><p id="userEmail<?php echo e($user->id); ?>"><?php echo e($user->email); ?></p></td>
    <td class="hidden-xs center"><p id="userType<?php echo e($user->id); ?>"><?php echo e($user->type); ?></p></td>
    <td>
        <div class="example">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <a class="btn btn-outline-primary" data-user-id="<?php echo e($user->id); ?>" id="editUser">
                <?php echo e(trans('site_lang.public_edit_btn_text')); ?>

            </a>
            <a class="btn btn-outline-danger" data-user-id="<?php echo e($user->id); ?>" id="deleteUser">
                <?php echo e(trans('site_lang.public_delete_text')); ?>

            </a>

            <a href="<?php echo e(url('permission/'.$user->id.'/edit')); ?>" class="btn btn-outline-warning"
            ><?php echo e(trans('site_lang.permission')); ?></a>
        </div>
    </td>
</tr>
<?php /**PATH C:\xampp\htdocs\NewT-E-S\resources\views/users/users_item.blade.php ENDPATH**/ ?>