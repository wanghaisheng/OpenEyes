<div class="admingroup curvybox">
	<h4>Core</h4>
	<ul>
		<?php foreach (ConfigGroup::model()->findAll(array('order'=>'display_order')) as $config_group) {?>
			<li>
				<?php if (Yii::app()->getController()->action->id == strtolower($config_group->name)) {?>
					<span class="viewing"><?php echo $config_group->name?></span>
				<?php }else{?>
					<?php echo CHtml::link($config_group->name,array('/settings/'.strtolower($config_group->name)))?>
				<?php }?>
			</li>
		<?php }?>
	</ul>
</div>
<?php if (ConfigKey::model()->find('module_name is not null')) {?>
	<div class="admingroup curvybox">
		<h4>Modules</h4>
		<ul>
			<?php foreach (ConfigKey::model()->moduleList() as $class => $module) {?>
				<li>
					<?php echo CHtml::link($module,array('/settings/module/'.$class))?>
				</li>
			<?php }?>
		</ul>
	</div>
<?php }?>
