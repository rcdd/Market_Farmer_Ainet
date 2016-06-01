

<?php $__env->startSection('content'); ?>
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/advertisement/new"><button class="btn btn-success">New advertisement</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <td>Owner</td>
                    <td>Name</td>
                    <td>Price</td>
                    <td></td>
                    </thead>
                    <tbody>
                    <?php foreach($advertisements as $advertisement): ?>
                        <tr>
                            <td><?php echo e($advertisement->owner_id); ?></td>
                            <td><?php echo e($advertisement->name); ?></td>
                            <td><?php echo e($advertisement->price_cents); ?>€</td>
                            <td><a href="/advertisement/destroy/<?php echo e($advertisement->id); ?>"><button class="btn btn-danger">Del</button></a> </td>
                        </tr>
                   <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>