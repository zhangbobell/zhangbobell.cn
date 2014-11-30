<div class="col-md-10" id="main-block">
    <form name="example" method="post" action="addCodeData">
        标题：<input type="text" placeholder="请输入标题" width="10" class="mt10 mb10" name="title" id="title"/><br />
        分类：<select id="category">
            <?php foreach($category as $v):?>
                <option value="<?php echo $v->id?>"><?php echo $v->name?></option>
            <?php endforeach;?>
        </select><br />
        内容：<br />
        <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain"></script>
        <br />
        <input type="button" name="button" id="submit" value="提交内容" />
        <input type="hidden" id="revise-id" value="<?php echo $id ? $id : '0'; ?>"/>
        <div id="result"></div>
    </form>
</div>
