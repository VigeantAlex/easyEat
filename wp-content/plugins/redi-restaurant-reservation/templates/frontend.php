<!-- ReDi restaurant reservation plugin version <?php echo $this->version?> -->
<!-- Revision: 20170923 -->
<?php require_once(REDI_RESTAURANT_TEMPLATE.'cancel.php');?>
<script type="text/javascript">var disabled_dates = [<?php echo $disabled_dates;?>];var timepicker = '<?php echo $timepicker;?>';var date_format = '<?php echo $calendar_date_format ?>';var timepicker_time_format ='<?php echo $timepicker_time_format;?>';var locale = '<?php echo $js_locale?>';var datepicker_locale = '<?php echo $datepicker_locale?>'; var timeshiftmode = '<?php echo $timeshiftmode; ?>'; var hidesteps = <?php echo $hidesteps ? 1 : 0; ?>; var apikeyid = '<?php echo $apiKeyId; ?>'; var maxDate = new Date();maxDate.setFullYear(maxDate.getFullYear() + 1); var min_persons='<?php echo $minPersons; ?>'; var max_persons = '<?php echo $maxPersons; ?>'; var large_group_message = '<?php echo (!empty($largeGroupsMessage))? __( 'More than [max] people', 'redi-restaurant-reservation' ) : '' ?>';  </script>
<form id="redi-reservation" name="redi-reservation" method="post" action="?jquery_fail=true">
			<a href="#cancel" id="cancel-reservation" class="cancel-reservation"><?php _e('Cancel reservation', 'redi-restaurant-reservation')?></a>

	<div id="step1">
		
		<?php if ( count( (array) $places ) > 1 ): /* multiple places */ ?>
            <h2>
				<?php _e( 'Step', 'redi-restaurant-reservation' ) ?> 1: <?php _e( 'Select place, date and time', 'redi-restaurant-reservation' ) ?>
			</h2>
			<label for="placeID">
				<?php _e( 'Place', 'redi-restaurant-reservation' ) ?>:</label>
		 <select name="placeID" id="placeID" class="redi-reservation-select">
			<?php foreach((array)$places as $place_current):?>
				<option value="<?php echo $place_current->ID ?>">
					<?php echo $place_current->Name ?>
				</option>
			<?php endforeach; ?>
		 </select>
		<?php else: /* only one place */ ?>
            <div class="rowLeft">
            <h2>
				<?php _e( 'Step', 'redi-restaurant-reservation' ) ?> 1: <?php _e( 'Select date and time', 'redi-restaurant-reservation' ) ?>

			</h2>
	</div>
            <input type="hidden" id="placeID" name="placeID" value="<?php echo $places[0]->ID ?>"/>
         <?php endif ?>
		<label for="redi-restaurant-startDate"><?php _e('Date', 'redi-restaurant-reservation')?>:<span class="redi_required"> *</span></label>
		<?php if($calendar === 'show'): ?>
			<div id="redi-restaurant-startDate" class="notranslate"></div>
		<?php else: ?>
		<input type="text" value="<?php echo $startDate ?>" name="startDate" id="redi-restaurant-startDate"/>
		<?php endif ?>

		<input id="redi-restaurant-startDateISO" type="hidden" value="<?php echo $startDateISO ?>" name="startDateISO"/>


		<?php if(!$hide_clock):?>
        <label for="redi-restaurant-startHour"><?php _e('Time', 'redi-restaurant-reservation')?>:<span class="redi_required"> *</span></label>
		<?php if (isset($timepicker) && $timepicker === 'dropdown'):?>
			<select id="redi-restaurant-startHour" class="redi-reservation-select">
				<?php foreach(range(0, 23) as $hour):?>
					<option value="<?php echo $hour;?>" <?php if(date('H',$startTime)==$hour):?>selected="selected"<?php endif;?>><?php echo date($time_format_hours, strtotime( $hour.':00'));?></option>
				<?php endforeach;?>
			</select>&nbsp;:&nbsp;<select id="redi-restaurant-startMinute" class="redi-reservation-select">
				<?php foreach(range(0, 45, 15) as $minute):?>
					<option value="<?php printf('%02d', $minute);?>"><?php printf('%02d', $minute);?></option>
				<?php endforeach;?>
			</select>
			<input id="redi-restaurant-startTime-alt" type="hidden" value="<?php echo date_i18n('H:i', $startTime);?>" name="startTime"/>
		<?php else:?>
				<input id="redi-restaurant-startTime-alt" type="hidden" value="<?php echo date_i18n('H:i', $startTime);?>"/>
			<input id="redi-restaurant-startTime" type="text" value="<?php echo date_i18n($time_format, $startTime);?>" name="startTime"/>
		<?php endif ?>
		<?php endif;?>
		
		<?php if(isset($start_time_array)):?>
			<input id="redi-restaurant-startTimeArray" type="hidden" name="StartTimeArray" value="<?php echo $start_time_array; ?>" />
		<?php endif;?>
        <label for="persons">
		<?php _e('Persons', 'redi-restaurant-reservation')?>:<span class="redi_required"> *</span></label>
		<select name="persons" id="persons" class="redi-reservation-select">
			<?php for ($i = $minPersons; $i != $maxPersons+1; $i++): ?>
				<option value="<?php echo $i?>" <?php if ($persons == $i) echo 'selected="selected"';?> >
                    <?php echo $i ?>
                </option>
			<?php endfor?>
            <?php if (!empty($largeGroupsMessage)):?>
                <option value="group" >
                    <?php echo sprintf( __( 'More than %s people', 'redi-restaurant-reservation' ), $maxPersons );?>
                </option>
            <?php endif ?>
		</select>
		<?php if ( $timeshiftmode === 'byshifts' || $hidesteps): ?>
			<div id="step1times">
		        <span id="step1buttons">
			        <?php
			        if ( $hidesteps ):
				        $current = 0;

				        if ( isset( $step1 ) && is_array( $step1 ) && ! isset( $step1['Error'] ) ):
					        $all_busy = true;
					        foreach ( $step1 as $key => $available ): ?>
                            <?php if ( $key === 'alternativeTime' ) continue; ?>
						        <?php $current_busy = true;
						        if ( isset( $available['Availability'] ) && is_array( $available['Availability'] ) ) {
							        foreach ( $available['Availability'] as $button ) {
								        if ( $button['Available'] ) {
									        $all_busy = $current_busy = false;
								        }
							        }
						        }?>
							        <input class="redi-restaurant-button button available" type="submit" title="<?php  _e( 'This time is fully booked', 'redi-restaurant-reservation' );?>"
							               id="time_<?php echo $current ++; ?>" value="<?php echo( isset( $available['Name'] ) ? $available['Name'] : __('Next', 'redi-restaurant-reservation')); ?>"
							               <?php if ($current_busy): ?>disabled="disabled"<?php endif ?>/>
					        <?php endforeach ?>
				        <?php endif ?>

			        <?php endif ?>
		        </span>
	        </div>
		<?php else: /* byshifts end */?>
			<?php $all_busy = false; ?>
		<div class="redi-restaurant-button-wrapper">
		        <?php if($timeshiftmode != 'byshifts'):?>
					<input class="redi-restaurant-button" id="step1button"style="display:none;" type="submit" value="<?php _e('Check available time', 'redi-restaurant-reservation');?>" name="submit">
		        <?php endif?>
		    </div>
		<?php endif /* normal */ ?>
        <div id="large_groups_message" style="display: none;" class="redi-reservation-alert-info redi-reservation-alert"><?php echo $largeGroupsMessage?></div>


		<div id="step1busy" <?php if(!$all_busy):?>style="display: none;"<?php endif; ?> class="redi-reservation-alert-error redi-reservation-alert">
			<?php _e('Reservation is not available on selected day. Please select another day.', 'redi-restaurant-reservation');?>
		</div>

		<div>
			<img id="step1load" style="display: none;" src="<?php echo REDI_RESTAURANT_PLUGIN_URL ?>img/ajax-loader.gif" alt=""/>
		</div>

		<div id="step1errors" <?php if (!isset($step1['Error'])):?>style="display: none;"<?php endif;?> class="redi-reservation-alert-error redi-reservation-alert">
			<?php if (isset($step1['Error'])):?>
				<?php echo $step1['Error'];?>
			<?php endif;?>
	</div>
	</div>


	<div id="step2" <?php if ($timeshiftmode !=='byshifts' || $hidesteps): ?>style="display: none" <?php endif ?>>

		<?php if ( $timeshiftmode !=='byshifts' || $hidesteps ): ?>
            <h2>
				<?php _e('Step', 'redi-restaurant-reservation')?> 2: <?php _e('Select available time', 'redi-restaurant-reservation')?>
			</h2>
		<?php endif ?>
		
		<?php if ( $timeshiftmode !=='byshifts'){ ?>
        
        <span id="time2label" style="display: none"><label><?php _e('Time', 'redi-restaurant-reservation')?>:</label>
        </span>
        <?php }?>
		<div id="buttons" class="buttons-wrapper">
			<?php if ( isset( $step1 ) && is_array($step1) && !isset($step1['Error'] )): ?>
				<?php $current = 0;?>
				<?php foreach ( $step1 as $available ): ?>
					<?php if ( isset( $available['Name'] ) ): ?>
						<?php if ( !$hidesteps ): ?>
							<?php echo( $available['Name'] ); ?>:</br>
						<?php endif ?>
					<?php endif ?>
					<?php if ( $hidesteps ): ?>
						<span class="opentime" id="opentime_<?php echo( $current++ ); ?>" style="display: none">
					<?php endif ?>
					<?php if ( isset( $available['Availability'] ) && is_array($available['Availability']) ): ?>
						<?php $all_busy = true; ?>

                        <?php foreach ( $available['Availability'] as $button ): ?><button title="<?php echo $button['Reason']?>" <?php if(!$button['Available']):?>disabled="disabled"<?php endif?> class="redi-restaurant-time-button button" value="<?php echo $button['StartTimeISO'] ?>"><?php echo $button['StartTime'] ?></button><?php if($button['Available']) $all_busy = false; ?><?php endforeach; ?>

					<?php endif; ?>
                        <br clear="all">
                         <?php if ( $hidesteps ): ?>
						</span>
					<?php endif ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<input type="hidden" id="redi-restaurant-startTimeHidden" value=""/>
        <img id="step2load" style="display: none;" src="<?php echo REDI_RESTAURANT_PLUGIN_URL ?>img/ajax-loader.gif" alt=""/>
        <div id="step2errors" style="display: none;" class="redi-reservation-alert-error redi-reservation-alert"></div>
		<div id="step2busy" <?php if(!$all_busy):?>style="display: none;"<?php endif; ?> class="redi-reservation-alert-error redi-reservation-alert">
			<?php _e('Reservation is not available on selected day. Please select another day.', 'redi-restaurant-reservation');?>
		</div>
		<?php if ($hidesteps):?>
			<input class="redi-restaurant-button button" type="submit" id="step2prev" value="<?php _e('Previous', 'redi-restaurant-reservation')?>">
		<?php endif ?>
	</div>
	<div id="step3" style="display: none;">
        <h2>
			<?php _e( 'Step', 'redi-restaurant-reservation' ) ?> <?php echo ( $timeshiftmode !=='byshifts' || $hidesteps ) ? 3 : 2 ?>: <?php _e( 'Provide reservation details', 'redi-restaurant-reservation' ) ?>
		</h2>

		<div>
			<label for="UserName"><?php _e('Name', 'redi-restaurant-reservation');?>:<span class="redi_required"> *</span>
			</label>
			<input type="text" value="" name="UserName" id="UserName">
		</div>
		<div>
			<label for="UserPhone"><?php _e('Phone', 'redi-restaurant-reservation');?>:<span class="redi_required"> *</span>
			</label>
			<input type="text" value="" name="UserPhone" id="UserPhone">
		</div>
		<div>
			<label for="UserEmail"><?php _e('Email', 'redi-restaurant-reservation');?>:<span class="redi_required"> *</span>
			</label>
			<input type="text" value="" name="UserEmail" id="UserEmail">
		</div>

		<!-- custom fields -->
		<?php foreach ( $custom_fields as $custom_field ):?>
				<div>
					<label for="field_<?php echo $custom_field->Id; ?>"><?php echo $custom_field->Name; ?>:
						<?php if(isset($custom_field->Required) && $custom_field->Required):?><span class="redi_required"> *</span>
							<input type="hidden" id="<?php echo 'field_'.$custom_field->Id.'_message'; ?>" value="<?php echo !empty($custom_field->Message) ? $custom_field->Message : _e('Custom field is required', 'redi-restaurant-reservation');?>">
						<?php endif;?>
					</label>
					<?php
					 $input_field_type = 'text'; 
					switch($custom_field->Type){
						case 'newsletter':
						case 'reminder':
						case 'allowsms':
						case 'checkbox':
						$input_field_type = 'checkbox';	
					}?>	
					<input <?php if(in_array($custom_field->Type, array('newsletter', 'reminder', 'allowsms'))) echo'checked="checked"' ?> type="<?php echo($input_field_type);?>" value="" id="field_<?php echo($custom_field->Id);?>" name="field_<?php echo($custom_field->Id);?>" <?php if(isset($custom_field->Required) && $custom_field->Required):?>class="field_required"<?php endif; ?>>
				</div>
		<?php endforeach; ?>
		<!-- /custom fields -->        
		<div>
			<label for="UserComments">
				<?php _e('Comment', 'redi-restaurant-reservation');?>:
			</label>
			<textarea maxlength="250" rows="5" name="UserComments" id="UserComments" cols="20" class="UserComments"></textarea>
		</div>
		<div>
			<?php if ($hidesteps):?>
				<input class="redi-restaurant-button button" type="submit" id="step3prev" value="<?php _e('Previous', 'redi-restaurant-reservation')?>">
			<?php endif ?>
			<input class="redi-restaurant-button button" type="submit" id="redi-restaurant-step3" name="action" value="<?php _e('Make a reservation', 'redi-restaurant-reservation')?>">
			<img id="step3load" style="display: none;" src="<?php echo REDI_RESTAURANT_PLUGIN_URL ?>img/ajax-loader.gif" alt=""/>
		</div>
		<div id="step3errors" style="display: none;" class="redi-reservation-alert-error redi-reservation-alert"></div>
	</div>
	<div id="step4" style="display: none;" class="redi-reservation-alert-success redi-reservation-alert">
		<h2><strong>
			<?php _e('Thank you for your reservation.', 'redi-restaurant-reservation')?>
		</strong>
        </h2>
        <div>
		<?php if (isset($manual) && $manual):?>
			<?php _e('Thank you for your reservation. We have received your request and will process it shortly. Please note that your reservation is not confirmed until you receive written confirmation from us.', 'redi-restaurant-reservation');?>
		<?php else:?>
			<?php _e('Thank you for your reservation. A confirmation email has been sent to you, should you not receive it, please rest assured that your booking has been received and is confirmed. If you wish you may contact us by phone to confirm.', 'redi-restaurant-reservation');?>
		<?php endif?>
        </div>
        <br/><br/>
        <?php _e('Your reservation number for reference:', 'redi-restaurant-reservation'); ?> <span id="reservation-id" style="font-weight: bold"></span>
    </div>
</form>
<?php if($thanks):?>
	<div id="Thanks" style="">
		<a style="float: right;" href="http://www.reservationdiary.eu/" target="_blank">
			<label style="font-size: 10px;">
			<?php _e('Powered by', 'redi-restaurant-reservation')?>
			</label>
			<img style="border:none; margin-left: 3px;" src="<?php echo REDI_RESTAURANT_PLUGIN_URL?>img/logo.png" alt="Powered by reservationdiary.eu" title="Powered by reservationdiary.eu"/></a>
	</div>
<?php endif ?>