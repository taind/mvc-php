<div class="container-fluid well span6">
    <div class="row-fluid">
        <div class="span2" >
            <img src="https://secure.gravatar.com/avatar/de9b11d0f9c0569ba917393ed5e5b3ab?s=140&r=g&d=mm" class="img-circle">
        </div>

        <div class="span8">
            <h3><?=$data['userinfo']['username']?></h3>
            <h3><?=$data['userinfo']['username']?></h3>
            <h3><?=$data['userinfo']['email']?></h3>
        </div>

        <div class="span2">
            <div class="btn-group">
                <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                    Action
                    <span class="icon-cog icon-white"></span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#"><span class="icon-wrench"></span> Modify</a></li>
                    <li><a href="#"><span class="icon-trash"></span> Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>