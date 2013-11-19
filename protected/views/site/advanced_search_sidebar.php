<div class="box admin">
	<h2>Advanced search</h2>
	<ul class="navigation admin">
		<?php
		$uris = array('Core' => Yii::app()->createUrl('/site/advancedSearch'));
		foreach (Yii::app()->params['advanced_search'] as $module) {
			$uris[$module] = Yii::app()->createUrl("/$module/search/index");
		}?>
		<?php foreach ($uris as $title => $uri) {?>
			<li<?php if (Yii::app()->getController()->action->id == preg_replace('/^\/admin\//','',$uri)) {?> class="selected"<?php }?>>
				<?php if (Yii::app()->getController()->action->id == preg_replace('/^\/admin\//','',$uri)) {?>
					<?php echo CHtml::link($title,array($uri),array('class' => 'selected'))?>
				<?php } else {?>
					<?php echo CHtml::link($title,array($uri))?>
				<?php }?>
			</li>
		<?php }?>
	</ul>
</div>
