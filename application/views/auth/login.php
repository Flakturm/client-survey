<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div id="logo" class="row text-center">
        <img src="<?php echo base_url(IMAGES.'logo.png');?>" alt="logo">
      </div>
      <div class="text-center">
        <h4>Interactive May System</h4>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo lang('login_heading');?></h3>
        </div>
        <div class="panel-body">
          <?php if($message) { ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
          <?php } ?>
          <!-- <p><?php echo lang('login_subheading');?></p> -->
          <?php echo form_open("auth/login");?>
            <fieldset>
              <div class="form-group">
                <?php echo form_input($identity);?>
              </div>
              <div class="form-group">
                <?php echo form_input($password);?>
              </div>
              <div class="checkbox">
                <label>
                  <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                  <?php echo lang('login_remember_label');?>
                </label>
              </div>
              <div class="form-group">
                <?php echo form_submit($submit);?>
              </div>
              <div class="form-group">
                <a href="signup"><?php echo lang('create_user_submit_btn');?></a>
                <!-- <a href="forgot_password" class="pull-right"><?php echo lang('login_forgot_password');?> -->
                </a>
              </div>
            </fieldset>
          <?php echo form_close();?>
        </div>
      </div>
    </div>
  </div>
</div>