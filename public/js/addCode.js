/*
 * saveType: 1->已经发表
 *           0->自动保存草稿
 *           2->手动保存草稿
 * 
 */

var gvid=-1;//全局vid
var isSaved=false;//全局变量，是否保存
var saveType=0;

$(document).ready(function(){
    KindEditor.ready(function(K) {
        var editor1 = K.create('textarea[name="content1"]', {
                cssPath : 'public/css/prettify.css',
                uploadJson : '../public/kd/upload_json.php',
                fileManagerJson : '../public/kd/file_manager_json.php',
                allowFileManager : true,
                afterCreate : function() {
                        var self = this;
                        K.ctrl(document, 13, function() {
                                self.sync();
                                K('form[name=example]')[0].submit();
                        });
                        K.ctrl(self.edit.doc, 13, function() {
                                self.sync();
                                K('form[name=example]')[0].submit();
                        });
                }
        });
        var timer;//计时器
        prettyPrint();
        timer=setInterval(function(){autoSave(gvid);}, 15000);
        
        $('#submit').click(function()
        {
            var opt = {ok:'ok'};
            opt['vid']=gvid;
            opt['saveType']='1';
            opt['click']=0;
            opt['cid']=$('#category').val();
            opt['title']=$('#title').val();
            opt['content']=editor1.html();
            $('#result').html("<img src=\"../public/images/loading.gif\" alt=\"loading\"> 正在提交请稍候...");

            $.ajax({
                url:'addCodeData',
                type:'POST',
                data:opt,
                dataType:'json',
                success:function(json){
                    //console.log(json);
                    if(json == '1')
                    {
                        $("#result").fadeIn(1000);
                        $('#result').text("代码发布成功");
                        $('#title').val("");
                        $('#content').val("");
                        clearTimeout(timer);  
                    }
                    else
                        $('#result').text("代码发布失败");
                    }
              });//ajax函数结束
              
              
         });
         
        function autoSave(vid){

            var opt = {ok:'ok'};
            opt['saveType']=saveType;
            opt['click']=0;
            opt['cid']=$('#category').val();          
            opt['title']=$('#title').val();
            opt['content']=editor1.html();
            opt['vid']=vid;
            $('#result').html("<img src=\"../public/images/loading.gif\" alt=\"loading\"> 正在自动保存...");

            $.ajax({
                url:'addCodeData',
                type:'POST',
                data:opt,
                dataType:'json',
                success:function(json){
                    //console.log(json);
                    //返回json=-1代表自动保存失败，json=$vid代表成功并且$vid表示插入的id
                    if(json != '-1')
                    {
                        $("#result").fadeIn(1000);
                        $('#result').text("已保存至草稿箱");
                        $("#result").fadeOut(2000);
                        gvid=json;
                    }
                    else
                        $('#result').text("保存草稿失败");
                    }
              });//ajax函数结束
        }
        
        
        
        $('#save').click(function()
        {
            var opt = {ok:'ok'};
            opt['vid']=gvid;
            opt['saveType']='2';
            opt['click']=0;
            opt['cid']=$('#category').val();
            opt['title']=$('#title').val();
            opt['content']=editor1.html();
            $('#result').html("<img src=\"../public/images/loading.gif\" alt=\"loading\"> 正在保存请稍候...");

            $.ajax({
                url:'addCodeData',
                type:'POST',
                data:opt,
                dataType:'json',
                success:function(json){
                    //console.log(json);
                    if(json != '-1')
                    {
                        $("#result").fadeIn(1000);
                        $('#result').text("保存草稿成功");
                        isSaved=true;
                        saveType=2;
                    }
                    else
                        $('#result').text("保存草稿失败");
                    }
              });//ajax函数结束
              
              
         });
    
        
});//kindeditor.ready函数结束

});

//离开页面时提示
$(window).on('beforeunload',function(){return'请确认你的草稿已经保存，离开后未保存的草稿将丢失！';});

//离开页面时销毁草稿
$(window).on('unload', function(){
    if(!isSaved)
    {
        $.ajax({
        url:'deleteDraft',
        type:'POST',
        async:false,
        data:'id='+gvid,
        dataType:'json',
        success:function(json){
            if(json == '1')
            {
                console.log("销毁草稿成功");
            }
            else
                console.log("销毁草稿失败");
            }
      });//ajax函数结束
    } 
});

String.prototype.replaceAll = function (findText, repText){
	var newRegExp = new RegExp(findText, 'gm');
	return this.replace(newRegExp, repText);
}





