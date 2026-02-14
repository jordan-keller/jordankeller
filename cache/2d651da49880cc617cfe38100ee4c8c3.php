<?php $__env->startSection('body'); ?>
    <div x-init="
        $nextTick(() => {
            filterPosts(theme);
            showHero(theme);
        });
    ">
    
    
    <?php $__currentLoopData = $page->themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $themeKey => $themeConfig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="hero-section mb-12 hidden" data-theme-hero="<?php echo e($themeKey); ?>">
            <?php if(isset($themeConfig['hero'])): ?>
                <span class="offset-x-10">
                <h1 class="text-7xl font-bold mb-2"><?php echo e($themeConfig['hero']['heading']); ?></h1>
                <h2 class="text-3xl opacity-80"><?php echo e($themeConfig['hero']['subheading']); ?></h2>
                </span>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    
<?php $__currentLoopData = $posts->where('featured', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featuredPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="post-item w-full mb-6" 
         data-categories="<?php echo e($featuredPost->categories ? implode(',', $featuredPost->categories) : ''); ?>">
        
        <?php if($featuredPost->cover_image): ?>
            
            <div class="flex gap-6">
                <img src="<?php echo e($featuredPost->cover_image); ?>" alt="<?php echo e($featuredPost->title); ?> cover image" 
                     class="w-1/3 h-fit object-cover border-[var(--text)]/30 border-2">
                
                <div class="w-2/3">
                    <p class="text-text opacity-60 font-medium my-2">
                        <?php echo e($featuredPost->getDate()->format('F j, Y')); ?>

                    </p>

                    <h2 class="text-3xl mt-0">
                        <a href="<?php echo e($featuredPost->getUrl()); ?>" title="Read <?php echo e($featuredPost->title); ?>" class="text-link font-extrabold">
                            <?php echo e($featuredPost->title); ?>

                        </a>
                    </h2>

                    <p class="mt-0 mb-4"><?php echo $featuredPost->getExcerpt(); ?></p>

                    <div class="grid grid-cols-2 gap-4 w-full">
                        <span class="w-1/2">
                            <a href="<?php echo e($featuredPost->getUrl()); ?>" title="Read - <?php echo e($featuredPost->title); ?>" 
                               class="uppercase tracking-widest font-sans text-xs opacity-50 mb-4">
                                <?php echo e(ceil(str_word_count(strip_tags($featuredPost->getContent())) / 200)); ?> min read
                            </a>
                        </span>
                        <span class="text-right">
                            <a href="<?php echo e($featuredPost->getUrl()); ?>" title="Read - <?php echo e($featuredPost->title); ?>" 
                               class="uppercase tracking-wide mb-4 font-sans text-xs font-light tracking-widest">
                                Read <span class="tracking-tighter">>></span>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        <?php else: ?>
            
            <p class="text-text opacity-60 font-medium my-2">
                <?php echo e($featuredPost->getDate()->format('F j, Y')); ?>

            </p>

            <h2 class="text-3xl mt-0">
                <a href="<?php echo e($featuredPost->getUrl()); ?>" title="Read <?php echo e($featuredPost->title); ?>" class="text-link font-extrabold">
                    <?php echo e($featuredPost->title); ?>

                </a>
            </h2>

            <p class="mt-0 mb-4"><?php echo $featuredPost->getExcerpt(); ?></p>

            <div class="grid grid-cols-2 gap-4 w-full">
                <span class="w-1/2">
                    <a href="<?php echo e($featuredPost->getUrl()); ?>" title="Read - <?php echo e($featuredPost->title); ?>" 
                       class="uppercase tracking-widest font-sans text-xs opacity-50 mb-4">
                        <?php echo e(ceil(str_word_count(strip_tags($featuredPost->getContent())) / 200)); ?> min read
                    </a>
                </span>
                <span class="text-right">
                    <a href="<?php echo e($featuredPost->getUrl()); ?>" title="Read - <?php echo e($featuredPost->title); ?>" 
                       class="uppercase tracking-wide mb-4 font-sans text-xs font-light tracking-widest">
                        Read <span class="tracking-tighter">>></span>
                    </a>
                </span>
            </div>
        <?php endif; ?>
    </div>

    <?php if(! $loop->last): ?>
        <hr class="border-b my-6 post-separator">
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo $__env->make('_components.newsletter-signup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php $__currentLoopData = $posts->where('featured', false)->take(6)->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="post-row flex flex-col md:flex-row md:-mx-6">
            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="post-item w-full md:w-1/2 md:mx-6" 
                     data-categories="<?php echo e($post->categories ? implode(',', $post->categories) : ''); ?>">
                    <?php echo $__env->make('_components.post-preview-inline', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <?php if(! $loop->last): ?>
                    <hr class="block md:hidden w-full border-b mt-2 mb-6">
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if(! $loop->last): ?>
            <hr class="w-full border-b mt-2 mb-6 post-separator">
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div> 
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/Jordan/Herd/jordankeller/source/index.blade.php ENDPATH**/ ?>