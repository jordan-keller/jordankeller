<div class="flex flex-col mb-4">
    <p class="text-text font-medium my-2">
        <?php echo e($post->getDate()->format('F j, Y')); ?>

    </p>

    <h2 class="text-3xl mt-0">
        <a
            href="<?php echo e($post->getUrl()); ?>"
            title="Read more - <?php echo e($post->title); ?>"
            class="text-link font-extrabold"
        ><?php echo e($post->title); ?></a>
    </h2>

    <p class="mb-4 mt-0"><?php echo $post->description; ?></p>

    <a
        href="<?php echo e($post->getUrl()); ?>"
        title="Read more - <?php echo e($post->title); ?>"
        class="uppercase font-normal tracking-wide mb-4 font-sans text-xs opacity-50 tracking-widest"
    >Read <span class="tracking-tighter">>></span></a>
</div><?php /**PATH /Users/Jordan/Herd/jordankeller/source/_components/post-preview-inline.blade.php ENDPATH**/ ?>