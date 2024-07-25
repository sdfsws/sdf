<!-- resources/views/welcome.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2>Welcome to Flight Booking</h2>

    <!-- Search Form -->
    <form action="<?php echo e(route('flights.search')); ?>" method="GET" class="mb-4">
        <div class="mb-3">
            <label for="departure" class="form-label">Departure</label>
            <input type="text" class="form-control" id="departure" name="departure" required>
        </div>
        <div class="mb-3">
            <label for="destination" class="form-label">Destination</label>
            <input type="text" class="form-control" id="destination" name="destination" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-primary">Search Flights</button>
    </form>

    <a href="<?php echo e(route('flights.index')); ?>" class="btn btn-secondary">View All Flights</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/welcome.blade.php ENDPATH**/ ?>