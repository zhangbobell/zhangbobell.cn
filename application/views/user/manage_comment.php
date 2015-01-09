<div class="col-md-10">
    <table class="table table-bordered table-striped">
        <tr>
            <th>id</th>
            <th>更新时间</th>
            <th>文章标题</th>
            <th>作者</th>
            <th>Email</th>
            <th>个人主页</th>
            <th>留言内容</th>
            <th colspan="2">操作</th>
        </tr>
        <?php foreach($comment_list as $key => $row):?>
            <tr data-i="<?php echo $key; ?>">
                <?php foreach($row as $k => $v):?>
                    <?php if ($k == 'title'):?>
                        <td data-i="<?php echo $k; ?>"><a href="code/detail/<?php echo $v; ?>" target="_blank"><?php echo $v; ?></a></td>
                    <?php else:?>
                        <td data-i="<?php echo $k; ?>"><?php echo $v; ?></td>
                    <?php endif;?>
                <?php endforeach;?>
                <td><a href="user/reply_comment/?id=<?php echo $row['id']?>">回复</a></td>
                <td><a href="user/delete_comment/?id=<?php echo $row['id']?>">删除</a></td>
            </tr>
        <?php endforeach;?>
    </table>
</div>

