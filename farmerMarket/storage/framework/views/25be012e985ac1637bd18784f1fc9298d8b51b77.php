

<?php $__env->startSection('title', 'Editar utilizadores'); ?>

<?php $__env->startSection('content'); ?>
        <div class="container">
            <div class="content">            
                
                <form action="users-edit.php" method="post" class="form-group">
                    <input type="hidden" name="user_id" value="<?php echo e($id); ?>" />
                    <div class="form-group">
                        <?php echo $__env->make('users.partials.add-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <button type="submit" class="btn btn-primary" name="ok">Save</button>
                        <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>