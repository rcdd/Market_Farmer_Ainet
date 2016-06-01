

<?php $__env->startSection('content'); ?>
<div class="container">
        <div class="row">
                <a href="/advertisement/new"><button class="btn btn-success">New advertisement</button></a>
        </div>
        <br/>
        <div class="row col-md-12">
                <?php foreach($advertisements as $advertisement): ?>
                    <div class="row col-md-4">
                        <div class="col-sm-6">
                            <img src="/images/ads/<?php echo e($advertisement->id); ?>" alt="Image Product" width="140" height="140" class="img-rounded"> </img> 
                        </div>

                        <div class="col-sm-6">

                            <label class="control-label" for="owner">Owner:</label><?php echo e($advertisement->owner_id); ?>


                            <br/>

                            <label class="control-label" for="name">Name:</label>
                            <?php echo e($advertisement->name); ?>


                            <br/>

                            <label class="control-label" for="price">Price:</label><?php echo e($advertisement->price_cents); ?>€

                            <br/>

                            <a href="/advertisement/destroy/<?php echo e($advertisement->id); ?>"><button class="btn btn-danger">Del</button></a> 
                            <a href="/advertisement/edit/<?php echo e($advertisement->id); ?>"><button class="btn btn-warning">Edit</button></a> 
                        </div>
                    </div>
               <?php endforeach; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>