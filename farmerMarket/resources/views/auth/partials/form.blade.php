                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label required">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label required">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label required">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label required">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('admin') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="admin"  @if (old('admin') == 'on' OR $user->admin == 1)  checked @endif > Administrator
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <!-- OPTIONAL INPUTS -->
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Location:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="location" value="{{ old('location', $user->location) }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('presentation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Presentation:</label>

                            <div class="col-md-6">
                                <textarea type="text" class="form-control" name="presentation">{{old('presentation',$user->presentation)}}</textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Photo:</label>

                            <div class="col-md-6">
                                <input type="file" class="" name="profile_photo" value="{{ old('profile_photo', $user->profile_photo) }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('profile_url') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Profile URL:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="profile_url" value="{{ old('profile_url', $user->profile_url) }}">
                            </div>
                        </div>


                        
