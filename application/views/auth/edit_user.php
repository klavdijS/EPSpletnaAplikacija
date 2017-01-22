<!-- Page Content -->
<div class="container bottom-space">

  <div class="row">

    <div class="col-sm-12">

      <h1><?php echo lang('edit_user_heading');?></h1>
      <p><?php echo lang('edit_user_subheading');?></p>

      <div id="infoMessage"><?php echo $message;?></div>

      <?php echo form_open(uri_string());?>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
                  <?php echo form_input($first_name);?>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
                  <?php echo form_input($last_name);?>
                </div>
              </div>
            </div>

            <!-- Address -->
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <?php echo lang('edit_user_address_street_label', 'street'); ?>
                        <?php echo form_input($street); ?>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <?php echo lang('edit_user_address_street_number_label', 'street_number'); ?>
                        <?php echo form_input($street_number); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <?php echo lang('edit_user_address_postcode_label', 'postcode'); ?>
                        <?php echo form_input($postcode); ?>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="form-group">
                        <?php echo lang('edit_user_address_city_label', 'city'); ?>
                        <?php echo form_input($city); ?>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="form-group">
                        <?php echo lang('edit_user_address_country_label', 'country'); ?>
                        <?php echo form_input($country); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <?php echo lang('edit_user_phone_label', 'phone');?> <br />
              <?php echo form_input($phone);?>
            </div>

            <div class="form-group">
              <?php echo lang('edit_user_password_label', 'password');?> <br />
              <?php echo form_input($password);?>
            </div>

            <div class="form-group">
              <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
              <?php echo form_input($password_confirm);?>
            </div>

            <h3><?php echo lang('edit_user_groups_heading');?></h3>
            
            <?php foreach ($groups as $group):?>
              <?php if ($this->ion_auth->is_admin() OR $group['id'] == 3): ?>
                <div class="radio">
                  <label>
                    <?php
                        $gID=$group['id'];
                        $checked = null;
                        $item = null;
                        foreach($currentGroups as $grp) {
                            if ($gID == $grp->id) {
                                $checked= ' checked="checked"';
                            break;
                            }
                        }
                    ?>
                    <input type="radio" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                    <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                  </label>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>

            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>

            <?php echo form_submit('submit', lang('edit_user_submit_btn'), array("class" => "btn btn-default")); ?>

      <?php echo form_close();?>

    </div>
  </div>
</div>
