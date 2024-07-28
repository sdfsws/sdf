<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Flights</h1>
    <a href="<?php echo e(route('flights.create')); ?>" class="btn btn-primary">Add Flight</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Destination</th>
                <th>Departure Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($flight->name); ?></td>
                <td><?php echo e($flight->destination); ?></td>
                <td><?php echo e($flight->departure_time); ?></td>
                <td>
                    <a href="<?php echo e(route('flights.edit', $flight->id)); ?>" class="btn btn-warning">Edit</a>
                    <form action="<?php echo e(route('flights.destroy', $flight->id)); ?>" method="POST" style="display:inline-block;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/flights/index.blade.php ENDPATH**/ ?>