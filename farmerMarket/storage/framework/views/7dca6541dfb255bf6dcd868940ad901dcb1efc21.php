<?php $__env->startSection('title', 'Listagem de utilizadores'); ?>

<?php $__env->startSection('content'); ?>

<?php if(count($users)): ?>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Email</th>
            <th>Fullname</th>
            <th>Created At</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?php echo e($user->email); ?></td>
            <td><?php echo e($user->name); ?></td>
            <td><?php echo e($user->created_at); ?></td>
            <td><?php echo e($user->admin ? "Admin" : "Regular"); ?></td>
            <td>
                    <a class="btn btn-xs btn-primary" href="<?php echo e(url('/users/edit/' . $user->id)); ?>">Edit</a> 
                    <?php if($user->admin): ?>
                        <a class="btn btn-xs btn-warning" href="<?php echo e(url('/users/revokeAdmin/' . $user->id)); ?>">Revoke Admin</a> 
                    <?php else: ?>
                        <a class="btn btn-xs btn-warning" href="<?php echo e(url('/users/becomeAdmin/' . $user->id)); ?>">Become Admin</a> 
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->id != $user->id): ?>
                        <?php if($user->blocked): ?>
                            <a class="btn btn-xs btn-warning" href="<?php echo e(url('/users/unblocked/' . $user->id)); ?>">Unblock</a> 
                        <?php else: ?>
                           <a class="btn btn-xs btn-warning" href="<?php echo e(url('/users/blocked/' . $user->id)); ?>">Block</a> 
                        <?php endif; ?>
                    <a href="<?php echo e(url('/users/delete/' . $user->id)); ?>">
                        <button class="btn btn-xs btn-danger" onclick="return confirm('Are you sure in delete this user?');">Delete</button>
                    </a>
                    <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php else: ?>
    <h2>No users found</h2>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>