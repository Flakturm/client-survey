<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div id="logo" class="row text-center">
        <img src="<?php echo base_url(IMAGES.'logo.png');?>" alt="logo">
      </div>
      <div class="text-center">
        <h4>Interactive May System</h4>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo lang('create_user_heading');?></h3>
        </div>
        <div class="panel-body">
          <?php if($message) { ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
          <?php } ?>
          <?php
            $attributes = array('class' => 'form-horizontal');
            echo form_open("auth/signup", $attributes);?>
            <fieldset>
              <!-- first name -->
              <div class="form-group">
                <?php
                  $attributes = array('class' => 'col-sm-4 control-label');
                  echo form_label(lang('create_user_fname_label'), 'first_name', $attributes);
                ?>
                <div class="col-sm-8">
                  <?php echo form_input($first_name);?>
                </div>
              </div>
              <!-- last name -->
              <div class="form-group">
                <?php
                  $attributes = array('class' => 'col-sm-4 control-label');
                  echo form_label(lang('create_user_lname_label'), 'last_name', $attributes);
                ?>
                <div class="col-sm-8">
                  <?php echo form_input($last_name);?>
                </div>
              </div>
              <!-- email -->
              <div class="form-group">
                <?php
                  $attributes = array('class' => 'col-sm-4 control-label');
                  echo form_label(lang('create_user_email_label'), 'email', $attributes);
                ?>
                <div class="col-sm-8">
                  <?php echo form_input($email);?>
                </div>
              </div>
              <!-- company code -->
              <div class="form-group">
                <?php
                  $attributes = array('class' => 'col-sm-4 control-label');
                  echo form_label(lang('create_user_company_code_label'), 'company_code', $attributes);
                ?>
                <div class="col-sm-8">
                  <?php echo form_input($company_code);?>
                </div>
              </div>
              <!-- company -->
              <div class="form-group">
                <?php
                  $attributes = array('class' => 'col-sm-4 control-label');
                  echo form_label(lang('create_user_company_label'), 'company', $attributes);
                ?>
                <div class="col-sm-8">
                <select class="form-control" name="company">
                <?php foreach ($companies as $company) { ?>
                  <option value="<?php echo $company['company_id'] ?>"><?php echo $company['name']; ?></option>
                <?php } ?>
                </select>
                </div>
              </div>
              <!-- phone -->
              <div class="form-group">
                <?php
                  $attributes = array('class' => 'col-sm-4 control-label');
                  echo form_label(lang('create_user_phone_label'), 'phone', $attributes);
                ?>
                <div class="col-sm-8">
                  <?php echo form_input($phone);?>
                </div>
              </div>
              <!-- password -->
              <div class="form-group">
                <?php
                  $attributes = array('class' => 'col-sm-4 control-label');
                  echo form_label(lang('create_user_password_label'), 'password', $attributes);
                ?>
                <div class="col-sm-8">
                  <?php echo form_input($password);?>
                </div>
              </div>
              <!-- password repeat -->
              <div class="form-group">
                <?php
                  $attributes = array('class' => 'col-sm-4 control-label');
                  echo form_label(lang('create_user_password_confirm_label'), 'password_confirm', $attributes);
                ?>
                <div class="col-sm-8">
                  <?php echo form_input($password_confirm);?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-11">
                  <div class="col-sm-offset-2 col-sm-4">
                        <?php echo form_submit($submit);?>
                  </div>
                  <div class="col-xs-6">
                  <a href="login" class="btn btn-link"><?php echo lang('sign_up_have_account');?>
                  </a>
                </a>
                </div>
              </div>
            </fieldset>
          <?php echo form_close();?>
        </div>
      </div>
    </div>
  </div>
</div>
