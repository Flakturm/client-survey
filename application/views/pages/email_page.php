<div id="tasks" class="container container-margin">
    <div class="container-border">
    <?php $attributes = array('id' => 'create_email'); echo form_open('', $attributes); ?> 
        <div class="row">
          <div class="col-md-9">
            <h3><?php echo $title; ?></h3>
          </div>
          
          <div class="col-md-3">
            <div class="pull-right">
                <?php if (!isset($email_sent)) { ?>
                    <?php //echo form_input($btn_save); ?>
                    <?php echo form_input($btn_preview); ?>
                    <a class="btn btn-danger" href="<?php echo site_url(); ?>" role="button"><?php echo lang('button_cancel') ?></a>
                <?php } else { ?>
                <a class="btn btn-info" href="<?php echo site_url(); ?>" role="button"><?php echo lang('button_back') ?></a>
                <?php } ?>
            </div>
          </div>
          
        </div>
        <?php if (!isset($email_sent)) { ?>
        <?php if ($message) { ?>
        <!-- alert messages -->
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger"><?php echo $message; ?></div>
            </div>
        </div>
        <?php } else if (isset($sucessful_message)) { ?>
        <!-- alert messages -->
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success"><?php echo $sucessful_message; ?></div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <div class="row">
            <div class="col-md-2">
                <?php echo lang('label_choose_template', 'template'); ?>
            </div>
            <div class="col-md-10">
                <label>
                    <input type="radio" name="template" value="english" <?php echo set_radio('template', $company_language, TRUE); ?> /> <?php echo lang('text_template_en') ?>
                </label>
                <?php if ($company_language != 'english') { ?>
                <label>
                    <input type="radio" name="template" value="<?php echo $company_language ?>" <?php echo set_radio('template', $company_language, ($company_language == $language)); ?> /> <?php echo lang('text_template_local') ?>
                </label>
                <?php } ?>
            </div>
        </div>
        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_company', 'company'); ?>
            </div>
            <div class="col-md-3">
                 <?php echo form_input($company);?>
            </div>
        </div>
        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_customer_name', 'customer_name'); ?>
            </div>
            <div class="col-md-3">
                 <?php echo form_input($customer_name);?>
            </div>
        </div>
        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_email_address', 'email'); ?>
            </div>
            <div class="col-md-3">
                 <?php echo form_input($email);?>
            </div>
        </div>
        <div class="row top7">
            <div class="col-md-2">
                <?php echo lang('label_reference', 'reference'); ?>
            </div>
            <div class="col-md-3">
                 <?php echo form_input($reference);?>
            </div>
        </div>
        <?php echo form_close();?>

        <?php if (isset($email_sent)) { ?>
        <?php if (!empty($feeback_comment) || !empty($files)) { ?>
        <div class="row">
            <div class="col-md-12">
                <h3><?php echo lang('text_feedback') ?></h3>
            </div>
        </div>
        
        <?php if ($feeback_comment) { ?>
        <div class="row">
            <div class="col-md-1">
                <b><?php echo lang('label_message'); ?></b>
            </div>
            <div class="col-md-11">
                <p><?php echo $feeback_comment ?></p>
            </div>
        </div>
        <?php } ?>
        <?php if ($files) { ?>
        <div class="row">
            <div class="col-md-1">
                <b><?php echo lang('label_files'); ?></b>
            </div>
            <div class="col-md-11">
                <?php foreach ($files as $file) { 
                    $ext = substr(strrchr($file['file_name'],'.'),1);
                ?>
                    <div class="files-block">
                    <?php if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') { ?>
                        <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url(UPLOAD . $file['file_name']); ?>">
                        <img class="img-responsive" alt="" src="<?php echo base_url(UPLOAD . $file['file_name']); ?>" />
                        </a> 
                    <?php } else { ?>                    
                        <a class="thumbnail" href="<?php echo base_url(UPLOAD . $file['file_name']); ?>" target="
                        _blank">
                        <img class="img-responsive" alt="" src="<?php echo base_url(IMAGES . 'video-placeholder.jpg'); ?>" />
                        </a>
                    <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <script>
            window.onload = function() {
                $(function(){
                    $('input').prop("disabled", true);

                    $(".fancybox").fancybox({
                        openEffect  : 'none',
                        closeEffect : 'none'
                    });
                });
            } 
        </script>
        <?php } ?>

	</div>
    
    
    
</div>

