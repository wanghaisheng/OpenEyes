		<h2><?php echo Yii::t('strings','Waiting List')?></h2>

		<div class="fullWidth fullBox clearfix">
			<div id="whiteBox">
				<p><strong><?php echo Yii::t('strings','Use the filters below to find patients')?>:</strong></p>
			</div>

		<div id="waitinglist_display">
			<form method="post" action="/waitingList/search" id="waitingList-filter">
				<div id="search-options">

					<div id="main-search" class="grid-view">
						<h3><?php echo Yii::t('strings','Search Waiting Lists by')?>:</h3>
					        <table>
					        <tbody>
					        	<tr>
					                <th><?php echo Yii::t('strings','Service')?>:</th>
					                <th><?php echo Yii::t('strings','Firm')?>:</th>

					                <th><?php echo Yii::t('strings','Type')?>:</th>

					        	</tr>
					        	<tr  class="even">
					                <td>
					                	<?php
										        echo CHtml::dropDownList('specialty-id', '', Specialty::model()->getList(),
										                array('empty'=>Yii::t('strings','All specialties'), 'ajax'=>array(
										                        'type'=>'POST',
										                        'data'=>array('specialty_id'=>'js:this.value'),
										                        'url'=>Yii::app()->createUrl('waitingList/filterFirms'),
										                        'success'=>"js:function(data) {
										                                if ($('#specialty-id').val() != '') {
										                                        $('#firm-id').attr('disabled', false);
										                                        $('#firm-id').html(data);
										                                } else {
										                                        $('#firm-id').attr('disabled', true);
										                                        $('#firm-id').html(data);
										                                }
										                        }",
                					))); ?>
									</td>
					                <td>

					                	<?php
										        echo CHtml::dropDownList('firm-id', '', array(),
                									array('empty'=>Yii::t('strings','All firms'), 'disabled'=>(empty($firmId))));
                						?>
					                </td>
					                <td>
					                	<?php
									        echo CHtml::dropDownList('status', '', ElementOperation::getLetterOptions())
									    ?>
									</td>
									<td>
										<button value="submit" type="submit" class="btn_search ir" style="float:right;"><?php echo Yii::t('strings','Search')?></button>

									</td>
								</tr>
								</tbody>
							</table>
					        </div> <!-- #main-search -->
					        <!-- extra search currently just used as padding but could be used like Theatre Management for extra filtering -->
					        <div id="extra-search" class="eventDetail clearfix">
					        	<h5><?php echo Yii::t('strings','Search Results')?>:</h5>

								<!--<div class="data">
									no extra search filters
								</div>-->
							</div> <!-- #extra-search -->
					</form>
				</div> <!-- #search-options -->

				<div id="searchResults" class="whiteBox">
				</div> <!-- #searchResults -->
			</div> <!-- #waitinglist_display -->
		</div> <!-- .fullWidth -->
<script type="text/javascript">
        $('#waitingList-filter button[type="submit"]').click(function() {
                $.ajax({
                        'url': '<?php echo Yii::app()->createUrl('waitingList/search'); ?>',
                        'type': 'POST',
                        'data': $('#waitingList-filter').serialize(),
                        'success': function(data) {
                                $('#searchResults').html(data);
                                return false;
                        }
                });
                return false;
        });
</script>
