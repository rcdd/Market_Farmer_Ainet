<?php $__env->startSection('content'); ?>
<div class="container">
        <div class="row col-md-12">
            <div class="row col-md-8">
                <div class="col-sm-6">
                    <img src="<?php echo e(url('images/ads/' .$ads->id)); ?>" alt="Image Product" width="140" height="140" class="img-rounded"> </img> 
                </div>
                <div class="col-sm-6">
                    <p><label class="control-label" for="owner">Owner: </label> <?php echo e($ads->owner_id); ?> </p>

                    <p><label class="control-label" for="name">Name: </label> <?php echo e($ads->name); ?></p>

                    <p><label class="control-label" for="price">Open Price: </label> <?php echo e($ads->price_cents); ?>€ </p>

                    <p><label class="control-label" for="price">Minimal Price: </label> <?php echo e($ads->price_cents); ?>€ </p>
                   
                    <a href="/advertisement/bid/<?php echo e($ads->id); ?>"><button class="btn btn-primary">Bid</button></a> 
                    <a href="/advertisement/edit/<?php echo e($ads->id); ?>"><button class="btn btn-warning">Edit</button></a> 
                    <a href="/advertisement/destroy/<?php echo e($ads->id); ?>"><button class="btn btn-danger">Del</button></a> 

                </div>
            </div>
        </div>

            <?php if($errors->has('comment')): ?>
                <br />
                <span class="help-block">
                    <strong><?php echo e($errors->first('comment')); ?></strong>
                </span>
            <?php endif; ?>
        <div class="row col-md-12">
            <div class="row col-md-8">
                <h2>Comments</h2><hr>
            </div><br>
            <div class="row col-md-4">
                <button data-toggle="modal" data-target="#newComment" class="btn btn-info">
                        <i class="fa fa-commenting"></i> New comment
                </button>
            </div>
        </div>

            <div class="row col-md-12">
                    <?php if(count($comments) > 0): ?>
                        <?php foreach($comments as $comment): ?>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label" for="user">User: </label>
                                <?php echo e($comment->author); ?>

                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="date">Date: </label>
                                <?php echo e($comment->created_at); ?>

                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" for="user">Mensage: </label>
                                <?php echo e($comment->comment); ?>

                            </div>
                            <div class="col-md-2">
                                <button data-toggle="modal" data-target="#replayComment" class="btn btn-warning">
                                        <i class="fa fa-mail-reply"></i> Replay
                                </button>
                            </div>
                                <br /><hr>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        No comments.. Be the First :)
                    <?php endif; ?>

                
            </div>
</div>

<div id="newComment" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New Comment</h4>
          </div>
            <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/comment/new')); ?>">
                <?php echo $__env->make('comments.comment_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
        </div>
    </div>
</div>

<div id="replayComment" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Replay Comment</h4>
          </div>
            <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/comment/reply')); ?>">
                <?php echo $__env->make('comments.comment_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>