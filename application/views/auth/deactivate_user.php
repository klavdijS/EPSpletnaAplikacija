<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-sm-12">		

			<h1><?php echo lang('deactivate_heading');?></h1>
			<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

			<?php echo form_open("auth/deactivate/".$user->id);?>

				<div class="radio">
					<label>
						<input type="radio" name="confirm" value="yes" checked="checked" />Yes
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" name="confirm" value="no" />No
					</label>
				</div>

				<?php echo form_hidden($csrf); ?>
				<?php echo form_hidden(array('id'=>$user->id)); ?>

				<?php echo form_submit('submit', lang('deactivate_submit_btn'), array("class" => "btn btn-default")); ?>

			<?php echo form_close();?>

		</div>

	</div>

</div>