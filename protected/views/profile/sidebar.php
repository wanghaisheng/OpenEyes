<div class="admingroup curvybox">
	<h4>Profile</h4>
	<ul>
		<?php
		$links = array();
		if (Config::get('profile_user_can_edit')) {
			$links['Basic information'] = '/profile/info';
		}
		if (Config::get('profile_user_can_change_password')) {
			$links['Change password'] = '/profile/password';
		}
		foreach (array_merge($links,array(
			'Sites' => '/profile/sites',
			'Firms' => '/profile/firms',
		)) as $title => $uri) {?>
			<li<?php if (Yii::app()->getController()->action->id == preg_replace('/^\/profile\//','',$uri)) {?> class="active"<?php }?>>
				<?php if (Yii::app()->getController()->action->id == preg_replace('/^\/profile\//','',$uri)) {?>
					<span class="viewing"><?php echo $title?></span>
				<?php }else{?>
					<?php echo CHtml::link($title,array($uri))?>
				<?php }?>
			</li>
		<?php }?>
	</ul>
</div>
