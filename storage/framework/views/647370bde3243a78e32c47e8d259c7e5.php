<!-- resources/views/flights/edit.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Flight</h1>

    <!-- Display success message if exists -->
    <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('flights.update', $flight->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group mb-3">
            <label for="name" class="form-label">Flight Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $flight->name)); ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="departure" class="form-label">Departure</label>
            <input type="text" class="form-control" id="departure" name="departure" value="<?php echo e(old('departure', $flight->departure)); ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="destination" class="form-label">Destination</label>
            <input type="text" class="form-control" id="destination" name="destination" value="<?php echo e(old('destination', $flight->destination)); ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="departure_time" class="form-label">Departure Time</label>
            <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" value="<?php echo e(old('departure_time', \Carbon\Carbon::parse($flight->departure_time)->format('Y-m-d\TH:i'))); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Flight</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/flights/edit.blade.php ENDPATH**/ ?>