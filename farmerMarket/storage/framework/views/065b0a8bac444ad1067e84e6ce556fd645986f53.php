<?php $__env->startSection('title', 'Edit Profile'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel-body">
            		<form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/users/update/'.$id)); ?>"  enctype="multipart/form-data">
                  		<?php echo $__env->make('auth.partials.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  		<div class="form-group" >
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-check "></i>Update
                                </button>
                            </div>
                        </div>
                  	</form>
                </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>