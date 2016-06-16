{!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" placeholder="Product name" class="form-control input-md" required="" value="{{ old('name', $ads->name) }}">
 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="textarea" name="description">{{ old('description', $ads->description) }}</textarea>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="trade_prefs">Trade Preferences</label>
                        <div class="col-md-9">
                            <input id="trade_prefs" name="trade_prefs" type="text" placeholder="Trade Preferences" class="form-control input-md" value="{{ old('trade_prefs', $ads->trade_prefs) }}">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-3 control-label" for="photo_path">Image</label>
                        <div class="col-md-9">
                            <input id="photo_path" name="photo_path" type="file" " class="">
                        </div>
                    </div>


                    <div class="form-group">
                       <div class="row col-md-offset-3">
                            <label class="col-md-2 control-label" for="price_cents">Price</label>
                            <div class="col-md-3">
                                <input id="price_cents" name="price_cents" min="0" step="0.01" type="number" placeholder="Price" class="form-control input-md"  value="{{ old('price_cents', $ads->price_cents) }}">
                            </div>
                            
                            <label class="col-md-2 control-label" for="quantity">Quantity</label>
                            <div class="col-md-3">
                                <input id="quantity" name="quantity" type="number" min="0" placeholder="Quantity" class="form-control input-md"  value="{{ old('quantity', $ads->quantity) }}">
                            </div>

                        </div>
                    </div>


                     <div class="form-group">
                       <div class="row col-md-offset-2">
                                <label class="col-md-3 control-label" for="available_on">Available On</label>
                            <div class="col-md-3"> 
                                <input id="available_on" name="available_on" type="date" class="form-control col-md-12"  value="{{ old('available_on', $ads->available_on) }}">  
                            </div>
                            
                                <label class="col-md-2 control-label" for="available_until">Available Until</label>
                            <div class="col-md-3"> 
                                <input id="available_until" name="available_until" type="date" class="form-control col-md-15"  value="{{ old('available_until', $ads->available_until) }}">
                            </div>
                        </div>
                      </div>
 
                </fieldset>