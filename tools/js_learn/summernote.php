<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>
<link rel="stylesheet" href="http://localhost:8008/css/ffiin.css">
<script src="http://localhost:8008/css/jquery.js"></script>
<script src="http://localhost:8008/css/bootstrap.js"></script>

<link rel="stylesheet" href="http://localhost:8008/css/summernote.css">
<script src="http://localhost:8008/css/summernote.js"></script>
  <!-- 
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>   -->
</head>
<body>
<h5>hello world!!</h5>
<h6>hello world!!</h6>

<div class='modal in' aria-hidden='false' tabindex=-1 style='display:block;padding-right: 13px;'>
	<div class='modal-dialog'>
		  <div id='summernote'><p>Hello Summernote</p></div>
	</div>
</div>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['insert', ['picture']],
    ['misc', ['fullscreen', 'codeview']]
  ]		
		});
    });
  </script>
</body>
</html>
