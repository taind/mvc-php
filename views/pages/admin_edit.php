<h3>Edit page</h3>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?=$data['page']['id'] ?>" />
    <div class="form-group">
        <label for="alias">Alias</label>
        <input type="text" id="alias" name="alias" value="<?=$data['page']['alias'] ?>" class="form-control" >
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?=$data['page']['title'] ?>" class="form-control" >
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <input type="text" id="content" name="content" value="<?=$data['page']['content'] ?>" class="form-control" >
    </div>
    <div class="form-group">
        <label for="is_published">Publish?</label>
        <input type="checkbox" id="is_published" name="is_published" <?php if (($data['page']['is_published']) == 1){ echo "checked='checked'"; } ?> >
    </div>
    <input type="submit" class="btn-success">
</form>