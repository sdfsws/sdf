<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Add Flight</h1>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/flights/create.blade.php ENDPATH**/ ?>