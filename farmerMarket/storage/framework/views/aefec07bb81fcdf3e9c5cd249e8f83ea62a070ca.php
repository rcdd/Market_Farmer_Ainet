<?php if(count($errors)): ?>
	<div class="alert alert-danger">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <ul>
	    <?php foreach($errors->all() as $field => $message): ?>
	        <?php echo e($message); ?>

	    <?php endforeach; ?>
	    </ul>
	</div>
<?php endif; ?>
