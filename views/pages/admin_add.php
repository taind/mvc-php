<h3>Add book</h3>
<?php
if((Session::get('error'))){
    foreach (Session::get('error') as $da){
        echo $da."<br>";
    }
    Session::set('error', null);
}else if(Session::get('success')){
    echo Session::get('success');
    Session::set('success', null);
}
?>
<form method="POST" action="">
    <input type="hidden" name="id" value="" />
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="" class="form-control" >
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" id="author" name="author" value="" class="form-control" >
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" id="price" name="price" value="" class="form-control">
    </div>
    <div class="form-group">
        <label for="price">Description</label>
        <input type="text" id="description" name="description" value="" class="form-control">
    </div>
    <input type="submit" class="btn-success">
</form>