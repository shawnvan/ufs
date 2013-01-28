<style type="text/css">

#ErrorPageView{
	background-color:#f6f6f6;
	background-repeat:no-repeat;
	background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#f6f6f6), color-stop(100px, #ffffff), to(#f6f6f6));
	background-image:-webkit-linear-gradient(#f6f6f6, #fff 100px, #f6f6f6);
	background-image:-moz-linear-gradient(top, #f6f6f6, #fff 100px, #f6f6f6);
	background-image:-ms-linear-gradient(#f6f6f6, #fff 100px, #f6f6f6);
	background-image:-o-linear-gradient(#f6f6f6, #fff 100px, #f6f6f6);
	background-image:linear-gradient(#f6f6f6, #fff 100px, #f6f6f6);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6f6f6', endColorstr='#f6f6f6', GradientType=0);
	-webkit-box-shadow:0 0 12px 5px rgba(153, 153, 153, 0.3);
	-moz-box-shadow:0 0 12px 5px rgba(153, 153, 153, 0.3);
	-o-box-shadow:0 0 12px 5px rgba(153, 153, 153, 0.3);
	-ms-box-shadow:0 0 12px 5px rgba(153, 153, 153, 0.3);
	box-shadow:0 0 12px 5px rgba(153, 153, 153, 0.3);
	-webkit-border-radius:5px;-moz-border-radius:5px;
	-ms-border-radius:5px;-o-border-radius:5px;
	border-radius:5px;font-size:12px;
	line-height:140%;
	background:#fff;
	width:960px;
	padding:20px;
	color: #545454;
	margin:40px auto;}
#ErrorPageView a{
	background:#262877;padding:1px 4px;
	-webkit-border-radius:2px;
	-moz-border-radius:2px;
	-ms-border-radius:2px;
	-o-border-radius:2px;
	border-radius:2px;
	color:#fff;
	}
#UFSLogo {
background: url(<?php echo Yii::app()->themeManager->baseUrl . "/ufs/images/logo2.png";?>) no-repeat;
width: 325px;
height: 110px;
margin-bottom: 20px;
}
#ErrorPageView a:hover{color:#fff !important;text-decoration:underline}
#ErrorPageView div{margin:10px 0px;}
</style>

<div id="ErrorPageView" class="PageView"><div id="ErrorView"><!-- Start of themes/default/templates/ErrorView.xhtml -->
  <div id="UFSLogo" class=""></div>
<p>An error has occurred. Please click <a href="<?php echo Yii::app()->createUrl('home');?>">here</a> to continue to the home page. If the error persists please contact your administrator.</p>
<div><?php echo CHtml::encode($message); ?>
<?php 
$errorTitle = Yii::t('app','Error {code}',array('{code}'=>$code));
$this->pageTitle=Yii::app()->name . ' - ' . $errorTitle;

echo $errorTitle; ?>
</div>
<!-- End of themes/default/templates/ErrorView.xhtml --></div></div>