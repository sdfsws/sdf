<div>
<!-- resources/views/components/flight-form.blade.php -->
<form action="<?php echo e(route('flights.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="departure">Departure</label>
        <input type="text" class="form-control" id="departure" name="departure" required>
    </div>
    <div class="form-group">
        <label for="destination">Destination</label>
        <input type="text" class="form-control" id="destination" name="destination" required>
    </div>
    <div class="form-group">
        <label for="departure_time">Departure Time</label>
        <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Flight</button>
</form>
</div>
<?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/components/flight-form.blade.php ENDPATH**/ ?>