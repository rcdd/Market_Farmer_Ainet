<?php $__env->startSection('title', 'Listagem de utilizadores'); ?>

<?php $__env->startSection('content'); ?>
<a class="btn btn-primary" href="/users/create">Add user</a>

<a class="btn btn-warning" href="logout.php">Logout</a></div>
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
            <td><?php echo e($user->type); ?></td>
            <td>
                    <a class="btn btn-xs btn-primary" href="/users/edit/<?php echo e($user->id); ?>">Edit</a> 
                
                <form action="users-delete.php" method="post" class="inline">
                    <input type="hidden" name="user_id" value="<?php echo e($user->user_id); ?>">
                    <div class="form-group">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure in delete this user?');">Delete</button>
                    </div>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php else: ?>
    <h2>No users found</h2>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>