<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
        <div class="panel-body row col-md-10" >
            <form method="POST" action="/advertisement/save" class="form-horizontal" enctype="multipart/form-data" role="form">
                <?php echo $__env->make('advertisements.partials.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                
                <div class="form-group">
                    <label class="col-md-3 control-label" for="submit"></label>
                    <div class="col-md-9">
                        <button id="submit" name="submit" class="btn btn-primary">Insert</button>
                    </div>
                </div>
            </form>
        </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>