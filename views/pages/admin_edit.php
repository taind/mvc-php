<h3>Add page</h3>
<form method="POST" action="">
    <input type="hidden" name="id" value="" />
    <div class="form-group">
        <label for="alias">Alias</label>
        <input type="text" id="alias" name="alias" value="" placeholder="hi" class="form-control" >
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="" class="form-control" >
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <input type="text" id="content" name="content" value="" class="form-control" >
    </div>
    <div class="form-group">
        <label for="is_published">Publish?</label>
        <input type="checkbox" id="is_published" name="is_published" checked="checked">
    </div>
    <input type="submit" class="btn-success">
</form>