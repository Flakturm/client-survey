<div id="tasks" class="container container-margin">
    <div class="container-border">
        <div class="row">
          <div class="col-md-9">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="col-md-3">
            <div class="pull-right">
                <a class="btn btn-info back" href="" role="button"><?php echo lang('button_back') ?></a>
                <?php
                    $url = 'email/send';
                    if(isset($email_id)) { $url .= '/'.$email_id; }
                ?>
                <a id="send-email" class="btn btn-info" href="<?php echo site_url($url); ?>" role="button"><?php echo lang('button_send') ?></a>
                <a class="btn btn-danger" href="<?php echo site_url(); ?>" role="button"><?php echo lang('button_cancel') ?></a>
            </div>
          </div>
        </div>
        <?php if (isset($message)) { ?>
        <!-- alert messages -->
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger"><?php echo $message; ?></div>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <?php $this->load->view($template_file); ?>
            </div>
      </div>
	</div>
</div>

