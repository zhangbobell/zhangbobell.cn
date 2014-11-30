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
                content: ue.getContent()
            };

            $('#result').html("<img src=\"public/images/loading.gif\" alt=\"loading\"> 正在提交请稍候...");
            $.ajax({
                url:'user/add_article',
                type:'POST',
                data:opt,
                dataType:'json',
                success:function(json){
                    if(json == '1')
                    {
                        $("#result").fadeIn(1000);
                        $('#result').text("代码发布成功");
                        $('#title').val("");
                        $('#content').val("");
                    }
                    else
                        $('#result').text("代码发布失败");
                }
            });//ajax函数结束
        })

    });
});


String.prototype.replaceAll = function (findText, repText){
	var newRegExp = new RegExp(findText, 'gm');
	return this.replace(newRegExp, repText);
}





