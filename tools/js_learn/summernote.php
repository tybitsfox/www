<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>
<link rel="stylesheet" href="http://localhost/css/ffiin.css">
<script src="http://localhost/css/jquery.js"></script>
<script src="http://localhost/css/bootstrap.js"></script>

<link rel="stylesheet" href="http://localhost/css/summernote.css">
<script src="http://localhost/css/summernote.js"></script>
</head>
<body>
<h5>hello world!!</h5>
<h6>hello world!!</h6>

<div id='vvv' class='modal in' aria-hidden='false' tabindex=-1 style='display:block;padding-right: 13px;'>
	<div class='modal-dialog'>
		  <div id='summernote'><p>Hello Summernote</p></div>
		  <div><a href='javascript:;' onclick='aaa();'>保存</a></div>
	</div>
</div>
<div id='showaa'></div>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote({
		height:"400px",
		disableDragAndDrop:true,
		callbacks: {onImageUpload: function(files) {sendFile(files[0]);}}		
		});
    });
function sendFile(file)
{
    data = new FormData();
    data.append("file", file);
    $.ajax({
        data: data,
        type: "POST",
        url: "/tools/js_learn/summ_support.php",
        cache: false,
        contentType: false, //'multipart/form-data',
        processData: false,
        success: function(url) {
                $('#summernote').summernote('editor.insertImage', url);
        }
    });	
}
function aaa()
{
	var st=$("#summernote").summernote('code');
	$("#summernote").summernote('destroy');
	$("#vvv").hide();
	document.getElementById('showaa').innerHTML=st;
}
  </script>
</body>
</html>
