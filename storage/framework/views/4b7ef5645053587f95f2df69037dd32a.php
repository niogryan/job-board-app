

<?php $__env->startSection('content'); ?>
    <div class="job-list">
        <h2>Available Jobs</h2>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(!empty($jobs) || !empty($api_jobs)): ?>
            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="job-list-item mb-3">
                    <h5 class="mb-1"><?php echo e($job->title); ?></h5>
                    <small class="text-muted"><?php echo e($job->location); ?></small><br />
                    <small class="text-muted">source: <b>JobBoard</b></small>
                    <p class="mt-2 mb-1"><?php echo e(substr($job->description, 0, 300)); ?> . . .</p>
                    <a href="<?php echo e(route('viewfulldetails', ['src' => 'jobboard', 'id' => $job->id])); ?>"
                        class="btn btn-sm btn-primary mt-2" target="_Blank">View full
                        details </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $api_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="job-list-item mb-3">
                    <h5 class="mb-1"><?php echo e($job['name']); ?></h5>
                    <small class="text-muted"><?php echo e($job['office']); ?></small><br />
                    <small class="text-muted">source: <b>Personio</b> </small>
                    <p class="mt-2 mb-1">
                        <?php echo e(substr(strip_tags($job['jobDescriptions']['jobDescription'][0]['value']), 0, 300)); ?> . . .
                    </p>
                    <a href="<?php echo e(route('viewfulldetails', ['src' => 'personio', 'id' => $job['id']])); ?>"
                        class="btn btn-sm btn-primary mt-2" target="_Blank">View full details </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="alert alert-info text-center">
                No job post available at the moment.
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RyanN\OneDrive\Developer\job-board-app\resources\views/home.blade.php ENDPATH**/ ?>