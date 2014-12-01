<div class="auto mt20 w700 pl50 m-list">
    <?php if(!isset($list)||$list===NULL)die("没有代码"); ?>
    <?php foreach ($list as $key=> $item):?>
        <ul class="codeList">
            <span><?php echo $key?></span>
            <?php foreach ($item as $v):?>
            <li><a href="<?php echo base_url();?>code/detail/<?php echo urlencode($v->title); ?>"><?php echo $v->title; ?></a></li>
            <?php endforeach;?>
        </ul>
    <?php endforeach;?>

    <div class="pagination"><?php echo $pagination;?><div class="fix"></div></div>
</div>


