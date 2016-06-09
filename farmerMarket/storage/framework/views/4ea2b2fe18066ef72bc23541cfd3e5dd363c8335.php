<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
                    You are logged in!
    </div>
    <div class="row">
                <a href="/advertisement/new"><button class="btn btn-success">New advertisement</button></a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>