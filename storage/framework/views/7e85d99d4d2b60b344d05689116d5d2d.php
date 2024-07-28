<!-- resources/views/flights/search.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2>Search Results</h2>

    <?php if($flights->isEmpty()): ?>
        <p>No flights found for your search criteria.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Departure</th>
                    <th>Destination</th>
                    <th>Departure Time</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($flight->name); ?></td>
                    <td><?php echo e($flight->departure); ?></td>
                    <td><?php echo e($flight->destination); ?></td>
                    <td><?php echo e($flight->departure_time); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="<?php echo e(url('/')); ?>" class="btn btn-secondary">Back to Search</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/flights/search.blade.php ENDPATH**/ ?>