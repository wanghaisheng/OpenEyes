<span>
	<?php foreach ($key->formValue as $item) {?>
		<span>
			<?php
			$model = $key->metadata1;
			$object = $model::model()->findByPk($item);
			echo $object->{$key->metadata2};?>
			<br/>
		</span>
	<?php }?>
</span>
