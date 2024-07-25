<!-- resources/views/components/user-menu.blade.php -->
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <?php echo e(Auth::user()->name); ?>

    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="<?php echo e(route('home')); ?>">Dashboard</a>
        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <?php echo e(__('Logout')); ?>

        </a>

        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    </div>
</li>
<?php /**PATH E:\laragon-6.0.0\www\sdf\resources\views/components/user-menu.blade.php ENDPATH**/ ?>