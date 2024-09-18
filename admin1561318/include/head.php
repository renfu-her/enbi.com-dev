<!DOCTYPE html>
<html>
<head>
<title>ENBI</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet" media="screen" />
<link href="css/thin-admin.css" rel="stylesheet" media="screen" />
<link href="css/font-awesome.css" rel="stylesheet" media="screen" />
<link href="style/style.css" rel="stylesheet" />
<link href="style/dashboard.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="style/jquery.jqplot.min.css" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
<script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script> 
<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script> 
<script type="text/javascript" src="javascript/jquery.jqplot.min.js"></script> 
<script type="text/javascript" src="javascript/jqplot.highlighter.min.js"></script> 
<script type="text/javascript" src="javascript/jqplot.dateAxisRenderer.min.js"></script> 
<script type="text/javascript" src="javascript/jqplot.logAxisRenderer.min.js"></script> 
<script type="text/javascript" src="javascript/jqplot.canvasTextRenderer.min.js"></script> 
<script type="text/javascript" src="javascript/jqplot.canvasAxisTickRenderer.min.js"></script> 

<script type="text/javascript" src="javascript/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="javascript/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="javascript/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="javascript/jqplot.pointLabels.min.js"></script>

<script>
$(function(){

	$('.fancybox').fancybox({
        // minHeight : '85%',
        // autoSize :false,
		helpers     : { 
       		overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
    	}
	});

  $('.menuBanner').click(function(){
    if($('.sub-menu').is(':hidden')){
      $('.sub-menu').slideDown(300);
      $('.icon-angle-left').addClass('icon-angle-down').removeClass('icon-angle-left');
    }else{
      $('.sub-menu').slideUp(300,function(){
        $('.sub-menu').removeClass('opened');
      });
      $('.icon-angle-down').addClass('icon-angle-left').removeClass('icon-angle-down');
    }
  });


});
</script>