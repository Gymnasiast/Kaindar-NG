<?php $__env->startSection('content'); ?>
    <h2><?php echo e($title); ?></h2>
    Huidig saldo: <?php echo e(\App\Util::amountToEuro($currentBalance)); ?>


    <?php $lastYear = 0; ?>
    <?php if(count($balances) > 0): ?>
        <?php $__currentLoopData = $balances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($balance->year != $lastYear): ?>
                <?php if($lastYear != 0): ?>
                </table>
                <?php endif; ?>

                <h3><?php echo e($balance->year); ?></h3>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Maand</th>
                        <th>Cashflow</th>
                        <th>Nieuw saldo</th>
                    </tr>

                <?php $lastYear = $balance->year; ?>

            <?php endif; ?>

                    <tr>
                        <td><?php echo e(\App\Util::monthNumberToFriendly($balance->month)); ?></td>
                        <td><?php echo e(\App\Util::amountToEuro($balance->cashflow)); ?></td>
                        <td><?php echo e(\App\Util::amountToEuro($currentBalance)); ?></td>
                        <?php $currentBalance -= $balance->cashflow; ?>
                    </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>