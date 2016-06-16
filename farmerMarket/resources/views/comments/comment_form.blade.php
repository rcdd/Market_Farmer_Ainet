    {{ csrf_field() }}
    <div class="container">
        <div class="col-sm-5 col-md-6">
            <input type="hidden" name="advertisement_id" value="{{ $ads->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <label for="comment">Comment:</label>
            <textarea class="form-control" rows="5" name="comment" id="comment">{{ old('comment', "") }}</textarea>
            <br/>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-comments"></i>Send
            </button>
        </div>
    </div>

</form>