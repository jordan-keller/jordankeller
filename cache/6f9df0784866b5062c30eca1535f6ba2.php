<?php $__env->startSection('body'); ?>
    <h1 class="mb-4">About</h1>

   <img src="/assets/img/about.jpg" class="h-120 w-full object-cover mix-blend-luminosity mb-8" alt="A photo of Jordan Keller, the author of this site.">

   <div class="text-xl whitespace-pre-wrap">

I’m Jordan Keller. I’m a writer, producer, and multimedia artist. 

I explore why and how things work. I write about cinematic storytelling, songwriting, technology, creativity,and any subject that interests me. 

I publish for people (not algorithms), so that you might explore with me.

<b>Email:</b> <a href="mailto:hi@jordan-keller.com">hi@jordan-keller.com</a>
</div>


    <template x-if="theme === 'a human'">
        <?php echo $__env->make('_about.human', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </template>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('_layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/Jordan/Herd/jordankeller/cache/0c03648ae7a11f4b527b2390082f8e2dd6f35111.blade.php ENDPATH**/ ?>