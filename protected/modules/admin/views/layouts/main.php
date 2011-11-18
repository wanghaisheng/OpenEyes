<?php
/*
_____________________________________________________________________________
(C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
(C) OpenEyes Foundation, 2011
This file is part of OpenEyes.
OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
_____________________________________________________________________________
http://www.openeyes.org.uk   info@openeyes.org.uk
--
*/

?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Open Eyes - <?php echo Yii::t('strings','Admin')?></title>
  <meta name="viewport" content="width=device-width">

  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.ico"/>
  <link rel="stylesheet" href="/css/style.css">
  <script src="/js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

  <div id="container">
	<div id="header" class="clearfix">

		<div id="brand" class="ir"><h1>OpenEyes</h1></div>
		
		<div id="user_panel" class="inAdmin">
			<div class="clearfix">
				<div id="user_id">
					<?php echo Yii::t('strings','Hi')?> <strong>Bob Andrews</strong>&nbsp;<a href="#" class="small">(<?php echo Yii::t('strings','not you')?>?)</a>
				</div>
				
				<ul id="user_nav">

					<li><a href="/">OpenEyes Home</a></li>
					<li><a href="/site/logout" class="logout"><?php echo Yii::t('strings','Logout')?></a></li>
				</ul>
			</div>
		</div> <!-- #user_panel -->
	</div> <!-- #header -->
	
	<div id="content" class="adminMode">

		<h2 class="admin"><?php echo Yii::t('strings','ADMIN')?></h2>
		<div id="mainmenu" class="fullBox" style="background:#ccc;">

		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>Yii::t('strings','Home'), 'url'=>array('/site/index')),
				array('label'=>Yii::t('strings','Users'), 'url'=>array('/admin/adminUser/index')),
				array('label'=>Yii::t('strings','Firms'), 'url'=>array('/admin/adminFirm/index')),
				array('label'=>Yii::t('strings','Global phrases'), 'url'=>array('/admin/adminPhrase/index')),
				array('label'=>Yii::t('strings','Phrases by specialty'), 'url'=>array('/admin/adminPhraseBySpecialty/index')),
				array('label'=>Yii::t('strings','Phrases by firm'), 'url'=>array('/admin/adminPhraseByFirm/index')),
				array('label'=>Yii::t('strings','Letter Templates'), 'url'=>array('/admin/adminLetterTemplate/index')),
//				array('label'=>'Ophthalmic Disorders', 'url'=>array('/admin/adminCommonOphthalmicDisorder/index')),
//				array('label'=>'Systemic Disorders', 'url'=>array('/admin/adminCommonSystemicDisorder/index')),
// Removed because the typical admin shouldn't be able to alter site_element_types. Surely they are the domain of the sysadmin?
//				array('label'=>'Site Element Types', 'url'=>array('/admin/adminSiteElementType')),
				array('label'=>Yii::t('strings','Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('strings','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
		</div>	<!-- #mainmenu -->
		
		<div class="whiteBox"> <!-- REPLACEs <div id="content"> in current HTML structure (already have a "content" id) -->

		<div id="sidebar">
			<div id="yw2" class="portlet">
				<div class="portlet-content">

                <?php
                        $this->beginWidget('zii.widgets.CPortlet', array(
                                'title'=>Yii::t('strings','Operations'),
                        ));
                        $this->widget('zii.widgets.CMenu', array(
                                'items'=>$this->menu,
                                'htmlOptions'=>array('class'=>'operations'),
                        ));
                        $this->endWidget();
                ?>
				</div> <!-- .portlet-content -->
			</div>	<!-- .portlet -->	
		</div> <!-- #sidebar -->

	<?php echo $content; ?>

	</div> <!-- .whiteBox -->
		
	</div> <!-- #content -->

	<div id="help" class="clearfix">
		<div class="hint">
			<p><strong><?php echo Yii::t('strings','Do you need help with OpenEyes')?>?</strong></p>
			<p><?php echo Yii::t('strings','Before you contact the helpdesk')?>...</p>
			<p><?php echo Yii::t('strings','Is there a "Super User" in your office available')?>? (<?php echo Yii::t('strings','A "Super User" is')?>...)</p>
			<p><?php echo Yii::t('strings','Have you checked the')?> <a href="#"><?php echo Yii::t('strings','Quick Reference Guide')?>?</a></p>

		</div>
		
		<div class="hint">
			<p><strong><?php echo Yii::t('strings','Searching by patient details')?>.</strong></p>
			<p><?php echo Yii::t('strings','Although the Last Name is required it doesn\'t have to be complete')?>. <?php echo Yii::t('strings','For example if you search for "Smi", the results will include all last names starting with "Smi..."')?>. <?php echo Yii::t('strings','Any other information you can add will help narrow the search results')?>.</p>
		</div>
		
		<div class="hint">
			<p><strong><?php echo Yii::t('strings','Still need help')?>?</strong></p>

			<p><?php echo Yii::t('strings','Contact the helpdesk')?>:</p>
			<p><?php echo Yii::t('strings','Telephone')?>: 01234 12343567 ext. 0000</p>
			<p><?php echo Yii::t('strings','Email')?>: <a href="#">helpdesk@openeyes.org.uk</a></p>
		</div>
		
	</div> <!-- #help -->
  </div> 
  <!--#container -->

  
  <div id="footer">
  	<h6>&copy; <?php echo Yii::t('strings','Copyright')?> OpenEyes Foundation 2011 &nbsp;&nbsp;|&nbsp;&nbsp; <?php echo Yii::t('strings','Terms of Use')?> &nbsp;&nbsp;|&nbsp;&nbsp; <?php echo Yii::t('strings','Legals')?></h6>
  </div> <!-- #footer -->

</body>
</html>
