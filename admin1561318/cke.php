<?php 
if($_POST){
    echo '<pre>';

    // print_r($_POST);
    // echo $_POST['d'];
    echo strip_magic_slashes($_POST['d']);
    exit;
}

function strip_magic_slashes($str) {    return get_magic_quotes_gpc() ? stripslashes($str) : $str; }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CKEditor Sample</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
	<script src="js/ckeditor/ckeditor.js"></script>
    <script type='text/javascript'>
    window.onload = function()
    {
        CKEDITOR.replace( 'editor1',{
        filebrowserBrowseUrl: 'upload/browse.php'});

        $('.save').click(function(){
            var data = CKEDITOR.instances.editor1.getData();
            $.ajax({
                    type: "POST",
                    url: 'cke.php',
                    data: 'd='+data,
                    error: function(xhr) {
                        $('#loading').fadeOut();
                        alert('網路錯誤');
                    },
                    success: function (data, status, xhr) {

                    }
            });
        });
                        
    }
    </script>
</head>
<body id="main">

    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
        <textarea name="info" id="editor1"></textarea>
        <input type="button" class="save" value="儲存" />
    </form>

</body>
</html>
