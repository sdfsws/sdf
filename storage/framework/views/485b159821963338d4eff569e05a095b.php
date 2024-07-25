<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Clients</h2>
    <a href="<?php echo e(route('clients.create')); ?>" class="btn btn-primary mb-3">Add Client</a>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($client->name); ?></td>
                <td><?php echo e($client->email); ?></td>
                <td><?php echo e($client->phone); ?></td>
                <td>
                    <a href="<?php echo e(route('clients.edit', $client->id)); ?>" class="btn btn-warning">Edit</a>
                    <form action="<?php echo e(route('clients.destroy', $client->id)); ?>" method="POST" style="display:inline-block;">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/clients/index.blade.php ENDPATH**/ ?>