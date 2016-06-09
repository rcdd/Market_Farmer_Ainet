<?php $__env->startSection('content'); ?>
<div class="container">


        <div class="row col-md-12">
            <div class="row col-md-8">
                <div class="col-sm-6">
                    <img src="<?php echo e(url('images/ads/' .$ads->id)); ?>" alt="Image Product" width="300" height="200" class="img"> </img> 
                </div>
                <div class="col-sm-6">
                    <p><label class="control-label" for="owner">Owner: </label> <?php echo e($ads->user->name); ?> </p>

                    <p><label class="control-label" for="name">Name: </label> <?php echo e($ads->name); ?></p>

                    <p><label class="control-label" for="name">Description: </label> <?php echo e($ads->description); ?></p>

                    <p><label class="control-label" for="name">Quantity: </label> <?php echo e($ads->quantity); ?></p>

                    <p><label class="control-label" for="name">Trade Prefs: </label> <?php echo e($ads->trade_prefs); ?></p>

                    <p><label class="control-label" for="price">Open Price: </label> <?php echo e($ads->price_cents); ?>€ </p>

                    <p><label class="control-label" for="price">Minimal Price: </label> <?php echo e($ads->price_cents); ?>€ </p>

                    <p><label class="control-label" for="name">Available Until: </label> <?php echo e($ads->available_until); ?></p>
                   

                    <a href="/advertisement/bid/<?php echo e($ads->id); ?>"><button class="btn btn-primary">Bid</button></a>
                    <?php if(Auth::user()->id == $ads->user->id || Auth::user()->admin): ?>
                    <a href="/advertisement/edit/<?php echo e($ads->id); ?>"><button class="btn btn-warning">Edit</button></a> 
                    <a href="/advertisement/destroy/<?php echo e($ads->id); ?>" onclick="return confirm('Are you sure?')"><button class="btn btn-danger">Del</button></a> 
                    <?php endif; ?>

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
            <div class="row col-md-12">
                <?php echo $__env->make('comments.comments_view', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>


</div>
<script type="text/javascript">
    $("button.replay").click(function(){
        $id = $(this).data('id');
        $("#parent_id").val($id);
    });
</script>

<?php $__env->stopSection(); ?>


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
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/comment/new')); ?>">
            <input type="hidden" class="form-control" id="parent_id" name="parent_id" value="" />
                <?php echo $__env->make('comments.comment_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>