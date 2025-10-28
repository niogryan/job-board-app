<header class="header">
    <div class="container">
        <h1 class="logo">JobBoard</h1>
        <nav class="nav-menu">
            <a href="/">Home</a>
            <a href="<?php echo e(route('viewform')); ?>">Post a Job</a>
            <a href="<?php echo e(route('viewadmin')); ?>">Admin
                <?php if($pending > 0): ?>
                    <span class="badge bg-danger"><?php echo e($pending); ?> </span>
                <?php endif; ?>
            </a>
        </nav>
    </div>
</header>
<?php /**PATH C:\Users\RyanN\OneDrive\Developer\job-board-app\resources\views/components/header.blade.php ENDPATH**/ ?>