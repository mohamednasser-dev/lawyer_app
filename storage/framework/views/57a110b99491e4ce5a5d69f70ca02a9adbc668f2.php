<tr>
    <td><?php echo e($clients->client_Name); ?></td>
    <td><?php echo e($khesm->client_Name); ?></td>
    <td><?php echo e($result->cases->invetation_num); ?></td>
    <td><?php echo e($result->cases->circle_num); ?></td>
    <td><?php echo e($result->cases->inventation_type); ?></td>
    <td><?php echo e($result->cases->court); ?></td>
    <td><?php echo e($result->session_date); ?></td>
    <?php if($result->printnotes ==null): ?>
        <td>----</td>
    <?php else: ?>
        <td><?php echo e($result->printnotes->note); ?></td>
    <?php endif; ?>
</tr>
<?php /**PATH C:\xampp\htdocs\NewT-E-S\resources\views/Reports/reports_daily_item.blade.php ENDPATH**/ ?>