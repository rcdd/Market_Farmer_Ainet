

<?php $__env->startSection('title', 'Adicionar novo utilizador'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="content">            
        
        <form action="/users/create" method="post" class="form-group">
             <?php echo $__env->make('partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
             <?php echo $__env->make('users.partials.add-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input
                    type="password" class="form-control"
                    name="password" id="inputPassword"
                    value=""/>
            </div>
            <div class="form-group">
                <label for="inputPasswordConfirmation">Password confirmation</label>
                <input
                    type="password" class="form-control"
                    name="password_confirmation" id="inputPasswordConfirmation"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="ok">Add</button>
                <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>