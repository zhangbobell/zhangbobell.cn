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
        prettyPrint();
        
        $('#submit').click(function()
        {
            var opt = {ok:'ok'};;
            opt['title']=$('#title').val();
            opt['content']=editor1.html();

            $.ajax({
                url:'addCodeData',
                type:'POST',
                data:opt,
                dataType:'json',
                success:function(json){
                    //console.log(json);
                    if(json == '1')
                    {
                        $('#result').text("代码发布成功");
                        $("#result").fadeOut(3000);
                        $('#title').val("");
                        $('#content').val("");
                    }
                    else
                        $('#result').text("代码发布失败");
                    }
              });//ajax函数结束
         });
});



    /*$('#submit').click(function()
    {
        var opt = {ok:'ok'};
        $("form > input:eq(0), form > textarea ").each(function(){
                     opt[this.name] = this.value;
        });
        
        var htmlspecialchars ={ "&":"&amp;", "<":"&lt;", ">":"&gt;", '"':"&quot;", "'":"&acute;","[\[]code]":"<pre class=\"prettyprint linenums\">", "[\[]\/code]":"</pre>"};
        $.each(htmlspecialchars, function(k,v){
            opt.title = opt.title.replaceAll(k, v);
            opt.content = opt.content.replaceAll(k, v);
        })
        
        $.ajax({
	    url:'addCodeData',
            type:'POST',
            data:opt,
            dataType:'json',
            success:function(json){
                if(json == '1')
                {
                    $('#result').text("代码发布成功");
                    $("#result").fadeOut(3000);
                    $('#title').val("");
                    $('#content').val("");
                }
                else
                    $('#result').text("代码发布失败");
                }
	  });//ajax函数结束
    });*/
    
});

String.prototype.replaceAll = function (findText, repText){
	var newRegExp = new RegExp(findText, 'gm');
	return this.replace(newRegExp, repText);
}


