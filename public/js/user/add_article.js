/*
 * saveType: 1->已经发表
 *           0->自动保存草稿
 *           2->手动保存草稿
 * 
 */

var gvid=-1;//全局vid
var isSaved=false;//全局变量，是否保存
var saveType=0;//保存类型

$(document).ready(function(){

    var ue = UE.getEditor('container', {
        autoHeight: false,
        initialFrameHeight: 420
    });

    ue.ready(function() {

        $('#submit').on('click', function(){

            var opt = {
                saveType: '1',
                click: 0,
                cid: $('#category').val(),
                title: $('#title').val(),
                summary: ue.getContentTxt().substr(0, 300),
                content: ue.getContent(),
                reviseId: $('#revise-id').val()
            };

            $('#main-block').append('<div class="ajax-loading"><img src=\"public/images/loading.gif\" alt=\"loading\"></div>')
            $.ajax({
                url:'user/add_article_data',
                type:'POST',
                data:opt,
                dataType:'json',
                success:function(json){
                    if(json == '1') {
                        setTimeout(function(){
                            $('#main-block').html('<p class="bg-success">文章发表成功</p>')
                        }, 2000);
                    } else {
                        setTimeout(function(){
                            $('#main-block').html('<p class="bg-danger">文章发表失败</p>')
                        }, 2000);
                    }
                }
            });//ajax函数结束
        })

        if ($('#revise-id').val() != '0') {
            $.ajax({
                url:'user/get_revise_article_data',
                type:'POST',
                data:'id=' + $('#revise-id').val(),
                dataType:'json',
                success:function(d){
                    var data = d;
                    $('#title').val(data.title);
                    $('#category option[value="' + data.cid + '"]').attr('selected', true);
                    ue.setContent(data.content);
                }
            });//ajax函数结束
        }

    });


});


String.prototype.replaceAll = function (findText, repText){
	var newRegExp = new RegExp(findText, 'gm');
	return this.replace(newRegExp, repText);
}





