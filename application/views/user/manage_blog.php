<div class="col-md-10">
    <table class="table table-bordered table-striped">
        <tr>
            <th>id</th>
            <th>更新时间</th>
            <th>点击量</th>
            <th>类别</th>
            <th>标题</th>
            <th colspan="2">操作</th>
        </tr>
        <?php foreach($article_list as $key => $row):?>
            <tr data-i="<?php echo $key; ?>">
                <?php foreach($row as $k => $v):?>
                    <?php if ($k == 'title'):?>
                        <td data-i="<?php echo $k; ?>"><a href="code/detail/<?php echo $v; ?>" target="_blank"><?php echo $v; ?></a></td>
                    <?php else:?>
                        <td data-i="<?php echo $k; ?>"><?php echo $v; ?></td>
                    <?php endif;?>
                <?php endforeach;?>
                    <td><a href="user/add_article/?id=<?php echo $row['id']?>">修改</a></td>
                    <td><a href="user/delete_article/?id=<?php echo $row['id']?>">删除</a></td>
            </tr>
        <?php endforeach;?>
    </table>
</div>

