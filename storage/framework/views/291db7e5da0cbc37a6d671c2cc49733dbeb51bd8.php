<?php $__env->startSection('content'); ?>
    <h2>Instellingen</h2>
    <ul>
        <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <?php echo e($setting->getFriendlyName()); ?>: <?php echo e($setting->value); ?>

            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <h2>Informatie</h2>
    <ul>
        <li>Versie: 2.0 alpha 0</li>
    </ul>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>