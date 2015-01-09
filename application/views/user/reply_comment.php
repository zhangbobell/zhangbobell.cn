<div class="col-md-10">
    <form role="form" action="user/reply_comment_data" method="post">
        <div class="form-group col-sm-12 fix">
            <label class="col-sm-1 control-label">评论者：</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo $comment['author']; ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12 fix">
            <label class="col-sm-1 control-label">email：</label>
            <input type="hidden" name="id" value="<?php echo $comment['id']?>"/>
            <input type="hidden" name="articleId" value="<?php echo $comment['articleId']?>"/>
            <input class="col-sm-6" type="text" name="email" value="<?php echo $comment['email']?>" readonly>
        </div>
        <div class="form-group col-sm-12 fix">
            <label class="col-sm-1 control-label">原评论：</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo $comment['content']; ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12 fix">
            <label for="reply-content" class="col-sm-1">回复内容：</label>
            <textarea name="reply" class="col-sm-6" rows="3" id="reply-content">@<?php echo $comment['author']; ?></textarea>
        </div>
        <div class="form-group col-sm-7 fix">
            <button type="submit" class="btn btn-primary r">提交</button>
        </div>
    </form>
</div>