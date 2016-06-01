

<?php $__env->startSection('content'); ?>
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/admin/product/new"><button class="btn btn-success">New Product</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <td>Name</td>
                    <td>Price</td>
                    <td>File</td>
                    <td></td>
                    </thead>
                    <tbody>
                   <!-- foreach ($advertisements as $product)
                        <tr>
                            <td><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->price); ?>$</td>
                            <td><?php echo e($product->file->original_filename); ?></td>
                            <td><a href="/admin/product/destroy/<?php echo e($product->id); ?>"><button class="btn btn-danger">Del</button></a> </td>
                        </tr>
                   endforeach -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>