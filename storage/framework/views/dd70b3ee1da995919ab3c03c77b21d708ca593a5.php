<?php $__env->startSection('content'); ?>
    <h2>Mutaties per rekening</h2>
    <table class="table table-striped table-bordered">
        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(count($account->getActiveYears() > 0)): ?>
            <tr>
                <td><b><a href="/rekening/<?php echo e($account->id); ?>/<?php echo e($defaultYear); ?>"><?php echo e($account->title); ?></a></b></td><td><a href="/rekening/<?php echo e($account->id); ?>">alles</a></td>
                <?php $__currentLoopData = $account->getActiveYears('DESC'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><a href="/rekening/<?php echo e($account->id); ?>/<?php echo e($year); ?>"><?php echo e($year); ?></a></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <h2>Maandsaldi per rekening</h2>
    <ul>
        <li><a href="/balances">Alle rekeningen</a></li>
        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="/balances/<?php echo e($account->id); ?>"><?php echo e($account->title); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>