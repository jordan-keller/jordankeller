<?php $__env->startSection('body'); ?>
    <h1><?php echo e($page->title); ?></h1>

    <div class="text-2xl border-b border-blue-200 mb-6 pb-10">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php $__currentLoopData = $page->posts($posts); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('_components.post-preview-inline', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php if(! $loop->last): ?>
            <hr class="w-full border-b mt-2 mb-6">
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo $__env->make('_components.newsletter-signup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/Jordan/Herd/jordankeller/source/_layouts/category.blade.php ENDPATH**/ ?>