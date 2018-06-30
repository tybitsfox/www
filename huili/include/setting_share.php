<?php
		$st1=$_SESSION['CURR_USR'][2];
		$st2=strtoupper(substr($st1,1,1));
		$st=sprintf($SIG_HTML['LEFT_TOP1'],$st2,$st1);
		echo $st;
		echo "<div class='addmerchant'><a class='btn btn-text withfronticon' href='".$SIGNED_DEF['DASHBOARD'][1][0]."'><i class='icon-arrow_left'></i>".$SIGNED_DEF['DASHBOARD'][1][1]."</a></div>";
		echo "<ul class='list-unstyled list-nav'>\n";
$j=count($SIGNED_DEF['PROFILE']);
for($i=0;$i<$j;$i++)
{
	if(($i == 7) && ($_SESSION['CURR_USR'][0] > 100001))
		continue;
	$st=sprintf("<li><a href='%s'>%s<i class='%s'></i></a></li>\n",$SIGNED_DEF['PROFILE'][$i][0],$SIGNED_DEF['PROFILE'][$i][1],$SIGNED_DEF['PROFILE'][$i][2]);
	echo $st;
}
		echo $SIG_HTML['LEFT_TOP3'];
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>认证";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 认证</h2>\n";
		$st1=" <div class='block'>
    <div class='panel shadow'>
      <div class='body body-settings'>
        <div class='inner-narrow'>
            <div class='intro-block'>
                <h3>通过身份认证，进入我们的专家和服务团队</h3>
                <p>身份认证保证您的付出必有收获</p>
            </div>
            <form class='form form-horizontal form-boxed' method='post' action='/app/settings/developer'>
               <input type='hidden' value='f89b27a9-ad93-416f-bf2b-20005646fb68' name='authenticityToken' />
               <div class='form-group'>
                   <label>Token Name</label>
                   <div class='form-split'>
                       <input name='name' id='name' class='form-control inlined' placeholder='Name (to remember what token is for)' required/>
                       <button type='submit' class='btn btn-primary'>Create Token</button>
                   </div>
				   <div class='form-split'><br>
					<input type='file' name='file' id='file' class='inputfile' onchange='onchg(this)' accept='image/*' />
					<label for='file' class='btn btn-success'>选择文件</label><span id='vvvv'></span>
				   </div>
               </div>
            </form>
            <br/>
            <div class='intro-block intro-block-slim'>
                <a href='/app/settings/security'>View your personal access tokens</a>
            </div>
        </div>
    </div>
    </div>
  </div>";
		echo $st1;
echo "<style type='text/css'>
.inputfile1{opacity:0;}
.inputfile{
    width: 0.1px; 
    height: 0.1px; 
    opacity: 0; 
    overflow: hidden; 
    position: absolute; 
    z-index: -1;
}
</style>
<script>
function onchg(obj)
{
//	var newsrc=getObjectURL(obj.files[0]);
	var newsrc=obj.files[0];
	var a=document.getElementById('name');
	//a.innerHTML=newsrc.name;
	a.value=newsrc.name;
}
</script>
";		
		echo $SIG_HTML['RIGHT_TOP3'];
/*
$('.inputfile').on('change','input[type=file]',function(){
    var filePath=$(this).val();
    if(filePath.indexOf('jpg')!=-1 || filePath.indexOf('png')!=-1){
        $('#fileerrorTip').html('').hide();
        var arr=filePath.split('\\');
        var fileName=arr[arr.length-1];
        $('#showFileName').html(fileName);
    }else{
        $('#showFileName').html('');
        $('#fileerrorTip').html('您未上传文件，或者您上传文件类型有误！').show();
        return false 
    }
})

*/
?>
