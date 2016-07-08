<div id="tasks" class="container container-margin">
    <div class="container-border">
    <?php echo form_open(); ?>
        <div class="row">
            <div class="col-md-9">
                <h3><?php echo $title; ?></h3>
            </div>
            <div class="col-md-3">
                <div class="pull-right">
                    <a class="btn btn-info" href="<?php echo site_url(); ?>" role="button"><?php echo lang('button_back') ?></a>
                    <?php echo form_input($btn_save); ?>
                </div>
            </div>
        </div>

        <?php if ($message) { ?>
        <!-- alert messages -->
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger"><?php echo $message; ?></div>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-2">
                <?php echo lang('label_company', 'company'); ?>
            </div>
            <div class="col-md-3">
                 <?php echo form_input($company);?>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_first_name', 'first_name'); ?>
            </div>
            <div class="col-md-2">
                 <?php echo form_input($first_name);?>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_last_name', 'last_name'); ?>
            </div>
            <div class="col-md-2">
                 <?php echo form_input($last_name);?>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_email_address', 'email_address'); ?>
            </div>
            <div class="col-md-2">
                 <?php echo form_input($email_address);?>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_phone', 'phone'); ?>
            </div>
            <div class="col-md-2">
                 <?php echo form_input($phone);?>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_password', 'password'); ?>
            </div>
            <div class="col-md-2">
                 <?php echo form_input($password);?>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_password_confirm', 'password_confirm'); ?>
            </div>
            <div class="col-md-2">
                 <?php echo form_input($password_confirm);?>
            </div>
        </div>
    <?php echo form_close(); ?>
	</div>
</div>

