<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
        <div class="panel-heading">
            <div class="panel-title">New Product</div>
        </div>
        <div class="panel-body" >
            <form method="POST" action="/advertisement/save" class="form-horizontal" enctype="multipart/form-data" role="form">
                <?php echo csrf_field(); ?>

                <fieldset>
                    <!-- Text input-->
                    <input type="hidden" name="owner_id" value="<?php echo e(Auth::user()->id); ?>">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" placeholder="Product name" class="form-control input-md" required="">
 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="textarea" name="description"></textarea>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="trade_prefs">Trade Preferences</label>
                        <div class="col-md-9">
                            <input id="trade_prefs" name="trade_prefs" type="text" placeholder="Trade Preferences" class="form-control input-md" >
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-3 control-label" for="photo_path">Image</label>
                        <div class="col-md-9">
                            <input id="photo_path" name="photo_path" type="file" " class="" >
                        </div>
                    </div>


                    <div class="form-group">
                       <div class="row col-md-offset-3">
                            <label class="col-md-2 control-label" for="price_cents">Price in Cents</label>
                            <div class="col-md-3">
                                <input id="price_cents" name="price_cents" type="number" placeholder="Product price (cents)" class="form-control input-md" >
                            </div>
                            
                            <label class="col-md-2 control-label" for="quantity">Quantity</label>
                            <div class="col-md-3">
                                <input id="quantity" name="quantity" type="number" placeholder="Quantity" class="form-control input-md" >
                            </div>

                        </div>
                    </div>


                     <div class="form-group">
                       <div class="row col-md-offset-3">
                                <label class="col-md-2 control-label" for="available_on">Available On</label>
                            <div class="col-md-3"> 
                                <input id="available_on" name="available_on" type="date" class="form-control col-md-12" >  
                            </div>
                            
                                <label class="col-md-2 control-label" for="available_on">Available Until</label>
                            <div class="col-md-3"> 
                                <input id="available_until" name="available_until" type="date" class="form-control col-md-15" >
                            </div>
                        </div>
                      </div>

                    <!-- <div class="form-group">
                        <label class="col-md-3 control-label" for="imageurl">Image URL</label>
                        <div class="col-md-9">
                            <input id="imageurl" name="imageurl" type="text" placeholder="Image URL" class="form-control input-md" >
 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="file">File</label>
                        <div class="col-md-9">
                            <input id="file" name="file" class="input-file" type="file">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-9">
                            <button id="submit" name="submit" class="btn btn-primary">Insert</button>
                        </div>
                    </div>
 
                </fieldset>
 
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>