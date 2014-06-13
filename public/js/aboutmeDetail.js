/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var nameOk=false;
var emailOk=false;
//对网址不是必须的
var urlOk=true;
var commentOk=false;
var passedImg="<img src=\"../public/images/check_alt_p.png\">";
var xPassedImg="<img src=\"../public/images/x_alt_p.png\">";

$(document).ready(function(){
    
    
    getComment();
 
    //对昵称的验证
    $('#name').focus(function(){
        $('.nameInfo').html("（必填）");
    });
    
    $('#name').blur(function(){
        var name = $('#name').val().trim();
        if(name==="zhangbobell" || name==="bell" || name==="张博" ||name==="" || name==="zhangbobell.cn")
        {
            nameOk=false;
            $('.nameInfo').html(xPassedImg);
        }
        else
        {
            nameOk=true;
            $('.nameInfo').html(passedImg); 
        }
    });
    
    
    //对电子邮件的验证
    $('#email').focus(function(){
        $('.emailInfo').html("（必填，不会被公开）");
    });
    
    $('#email').blur(function(){
        
        var temp = $('#email').val().trim();   
        if(!validateEmail(temp))
        {
            emailOk=false;
            $('.emailInfo').html(xPassedImg);
        }
        else
        {  
            emailOk=true;
            $('.emailInfo').html(passedImg);
        }   
    });
    
    //对网址的验证
    $('#url').focus(function(){
        $('.urlInfo').html("");
    });
    
    $('#url').blur(function(){
        
        var strUrl=$('#url').val().trim();
        if (!validateUrl(strUrl))
        {
            if(strUrl!="")
            {
                urlOk=false;
                $('.urlInfo').html(xPassedImg);
            }
        }
        else
        {
            urlOk=true;
            $('.urlInfo').html(passedImg);
        }
    });
    
    //对评论内容的验证
    $('#comment').focus(function(){
        $('.commentInfo').html("");
    });
    
    $('#comment').blur(function(){
        var comment=$('#comment').val().trim();
        if(comment==="")
        {
            commentOk=false;
            $('.commentInfo').html(xPassedImg);
        }
        else
        {
            commentOk=true;
            $('.commentInfo').html(passedImg);
        }
    });
    
    //提交按钮click事件
    $('#submitComment').click(function(){
        
        if(!nameOk)
        {
            $('.nameInfo').html(xPassedImg);
            $.prompt("请留下您的大名！", {
                position: { container: '#name', x: 250, y: 0, width: 200, arrow: 'lt' }
            });
            return;
        }
        if(!emailOk)
        {
            $('.emailInfo').html(xPassedImg);
            $.prompt("请留下您的邮箱！", {
                position: { container: '#email', x: 250, y: 0, width: 200, arrow: 'lt' }
            });
            return;
        }
        if(!urlOk)
        {
            $('.urlInfo').html(xPassedImg);
            $.prompt("请检查您的网址哦！", {
                position: { container: '#url', x: 250, y: 0, width: 200, arrow: 'lt' }
            });
            return;
        }
        if(!commentOk)
        {
            $('.commentInfo').html(xPassedImg);
            $.prompt("请写下您的评论", {
                position: { container: '#comment', x: 360, y: 0, width: 200, arrow: 'lt' }
            });
            return;
        }
        
        //怎样通过数组的方式给ajax函数传参？ --June 12th, 2014
        /*var comment =  new Array();
        comment['id']=$('#aid').val();
        comment['author']=$('#name').val().trim();
        comment['email']=$('#email').val().trim();
        comment['url']=$('#url').val().trim();
        comment['comment']=$('#comment').val().trim();*/
        
        $.ajax({
            url:'addCommentData',
            type:'POST',
            data:{
                'aid':$('#aid').val(),
                'author':$('#name').val().trim(),
                'email':$('#email').val().trim(),
                'url':$('#url').val().trim(),
                'comment':$('#comment').val().trim()
            },
            dataType:'json',
            success:function(json){
                //console.log(json);
                if(json == '1')
                {
                    getComment();
                    $('#name').val("");
                    $('#email').val("");
                    $('#url').val("");
                    $('#comment').val("");
                    $.prompt("评论发表成功！", {
                        position: { container: '.commentList', x: 200, y: 60, width: 200 }
                    });
                }
                else
                    $.prompt("评论发表失败！");
                }
       });// End Ajax 
    });
    
});

String.prototype.trim=function()
{
    return this.replace(/(^\s*)|(\s*$)/g, "");
};


/*
 * function: validateEmail
 * @param {string} temp
 * @returns {true: passed validation; false: do not pass validation}
 */
function validateEmail(temp)
{
    var myreg = /^\w+([-\.]\w+)*@\w+([\.-]\w+)*\.\w{2,4}$/;      
    if(!myreg.test(temp))
    {
        return false;
    }
    return true;
}


/*
 * function: validateUrl
 * @param {string} temp
 * @returns {true: passed validation; false: do not pass validation}
 */
function validateUrl(temp)
{
    var strRegex = "^((https|http|ftp|rtsp|mms)?://)" 
         + "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?" //ftp的user@ 
         + "(([0-9]{1,3}\.){3}[0-9]{1,3}" // IP形式的URL- 199.194.52.184 
         + "|" // 允许IP和DOMAIN（域名）
         + "([0-9a-z_!~*'()-]+\.)*" // 域名- www. 
         + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\." // 二级域名 
         + "[a-z]{2,6})" // first level domain- .com or .museum 
         + "(:[0-9]{1,4})?" // 端口- :80 
         + "((/?)|" // a slash isn't required if there is no file name 
         + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$"; 
        var re=new RegExp(strRegex); 
         
    if (!re.test(temp))
    {
        return false;
    }
    return true;
}

function getComment()
{
    $.ajax({
            url:'getCommentData',
            type:'POST',
            data:{
                'aid':$('#aid').val()
            },
            dataType:'json',
            success:function(json){
                
                $('.commentNum').html('评论（'+ json.length +'）');
                
                var html="";
                for(var i=0; i<json.length; i++)
                {
                    html+='<li><div class="commentAuthor">';
                    if(json[i]['url']!=="")
                    {
                        html+='<a class="author" href="http://'+ json[i]['url'] +'" target="_blank">'+ json[i]['author'] +'</a>';
                    }
                    else
                    {
                        html+='<span class="author">'+json[i]['author']+'</span>';
                    }
                        
                    html+='&nbsp;&nbsp;在&nbsp;'+ json[i]['updatetime'] +'&nbsp;说:</div>\n\
                    <div class="commentContent">\n\
                        '+ json[i]['content'] +'\n\
                    <div class="commentInteraction"><a class="reply" href="#this" onclick="reply(\''+json[i]['author']+'\'); return true;">回复</a></div></li>';
                }
                
                if(json.length===0)
                    html="本文暂无评论，期待您的评论！";              
                $('.commentList').html(html);
                
                }
       });// End Ajax
    return 0;
}

function reply(author)
{
    $('#comment').val('@'+author+' ');
    $('html, body').animate({
        scrollTop: $(".commentForm").offset().top
    }, 1000);
    
    var t=$('#comment').val();
    $("#comment").val("").focus().val(t);
    return false;
}