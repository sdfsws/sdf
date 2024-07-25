<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <p><?php echo e(__('You are logged in!')); ?></p>

                    <!-- Flight Booking Form Component -->
                    <?php if (isset($component)) { $__componentOriginale3ed20ecdb39042471cb441f4ea8d506 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3ed20ecdb39042471cb441f4ea8d506 = $attributes; } ?>
<?php $component = App\View\Components\FlightForm::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flight-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FlightForm::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3ed20ecdb39042471cb441f4ea8d506)): ?>
<?php $attributes = $__attributesOriginale3ed20ecdb39042471cb441f4ea8d506; ?>
<?php unset($__attributesOriginale3ed20ecdb39042471cb441f4ea8d506); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3ed20ecdb39042471cb441f4ea8d506)): ?>
<?php $component = $__componentOriginale3ed20ecdb39042471cb441f4ea8d506; ?>
<?php unset($__componentOriginale3ed20ecdb39042471cb441f4ea8d506); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/home.blade.php ENDPATH**/ ?>