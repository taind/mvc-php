<h3>Edit book</h3>
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
<div class="row">
    <div class="col-sm-6">
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$data['bookinfo']['id']?>" />
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?=$data['bookinfo']['title']?>" class="form-control" >
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" value="<?=$data['bookinfo']['author']?>" class="form-control" >
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" value="<?=$data['bookinfo']['price']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Description</label>
                <input type="text" id="description" name="description" value="<?=$data['bookinfo']['description']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="image">Book image</label>
                <input type="file" name="image" id="image">
            </div>
            <input type="submit" class="btn btn-success">
        </form>
    </div>
    <div class="col-sm-6">
        <strong>Book image</strong>
            <img class="img-responsive" src="data:<?=$data['bookinfo']['img_mime']?>;base64,<?=$data['bookinfo']['img_b64']?>">
    </div>
</div>