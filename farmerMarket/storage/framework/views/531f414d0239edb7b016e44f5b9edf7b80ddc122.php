<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
<div class="form-group">
    <label for="name">Name</label>
    <input
        type="text" class="form-control"
        name="name" id="name"
        placeholder="Name" value="" />
</div>
<div class="form-group">
    <label for="inputType">Type</label>
    <select name="user_type" id="inputType" class="form-control">
        <option disabled selected> -- select an option -- </option>
        <option value="0" >Administrator</option>
        <option value="1" >Publisher</option>
        <option value="2" >Client</option>
    </select>
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input
        type="email" class="form-control"
        name="email" id="inputEmail"
        placeholder="Email address" value=""/>
</div>
