<tr id="userRow<?php echo e($client->id); ?>">
    <td id="id<?php echo e($client->id); ?>"><?php echo e($client->id); ?></td>
    <td id="client_name<?php echo e($client->id); ?>"><?php echo e($client->client_Name); ?></td>
    <td>
        <?php
            $user_type = auth()->user()->type;
            if($user_type == 'admin'){
        ?>
        <a class="btn btn-danger" data-client-type="<?php echo e($client->type); ?>" id="deleteClient"
           data-mokel-id="<?php echo e($client->id); ?>"><i
                class="fa fa-times fa fa-white"></i></a>
        <?php
            }
        ?>
    </td>
</tr>
<?php /**PATH C:\xampp\htdocs\my websites\NewT-E-S\resources\views/cases/mokel_item.blade.php ENDPATH**/ ?>