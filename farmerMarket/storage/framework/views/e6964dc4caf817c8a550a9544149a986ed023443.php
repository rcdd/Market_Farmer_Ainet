                        <?php echo e(csrf_field()); ?>

                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label required">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="<?php echo e(old('name', $user->name)); ?>">

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label required">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="<?php echo e(old('email', $user->email)); ?>">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label required">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label required">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr>
                        <!-- OPTIONAL INPUTS -->
                        <div class="form-group<?php echo e($errors->has('location') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label">Location:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="location" value="<?php echo e(old('location', $user->location)); ?>">
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('presentation') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label">Presentation:</label>

                            <div class="col-md-6">
                                <textarea type="text" class="form-control" name="presentation"><?php echo e(old('presentation',$user->presentation)); ?></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Photo:</label>
                            <div class="col-md-6">
                                <input type="file" class="" name="profile_photo" value="<?php echo e(old('profile_photo', $user->profile_photo)); ?>">
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('profile_url') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label">Profile URL:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="profile_url" value="<?php echo e(old('profile_url', $user->profile_url)); ?>">
                            </div>
                        </div>


                        
