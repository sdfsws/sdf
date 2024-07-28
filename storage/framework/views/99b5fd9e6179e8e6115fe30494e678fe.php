<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>
<body>
    <div id="app">
        <?php if (isset($component)) { $__componentOriginal8636f53a0f82ea5b5b096f929a6c52ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8636f53a0f82ea5b5b096f929a6c52ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8636f53a0f82ea5b5b096f929a6c52ba)): ?>
<?php $attributes = $__attributesOriginal8636f53a0f82ea5b5b096f929a6c52ba; ?>
<?php unset($__attributesOriginal8636f53a0f82ea5b5b096f929a6c52ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8636f53a0f82ea5b5b096f929a6c52ba)): ?>
<?php $component = $__componentOriginal8636f53a0f82ea5b5b096f929a6c52ba; ?>
<?php unset($__componentOriginal8636f53a0f82ea5b5b096f929a6c52ba); ?>
<?php endif; ?>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/layouts/app.blade.php ENDPATH**/ ?>