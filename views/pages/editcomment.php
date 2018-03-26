Edit your comment:
<form action="" method="post">
    <label for="comment">Type it your way:</label><br>
    <input type="text" name="comment" class="comment" id="comment" value="">
    <input type="hidden" name="book_id" class="book_id" id="book_id" value="<?=$data['page']['id']?>">
    <input type="submit" class="btn btn-success" name="submit">
</form>