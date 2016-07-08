    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo  base_url()?>dashboard"><img style="display: block; height: 60px;" src="<?php echo base_url(IMAGES.'logo.png');?>" alt=""></a>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <p class="navbar-text pull-right">
                    <a href="<?php echo site_url('email/create'); ?>"><?php echo lang('button_new') ?></a>
                </p>
            </li>
            <li>
                <p class="navbar-text pull-right">
                    <a href="<?php echo site_url('reporting') ?>"><?php echo lang('text_reporting') ?></a>
                </p>
            </li>
            <li>
                <p class="navbar-text pull-right"><?php echo lang('text_welcome') ?> <a href="<?php echo site_url('profile'); ?>"><?php echo $this->session->userdata('username'); ?></a>! [<a href="<?php echo site_url('auth/logout'); ?>"><?php echo lang('text_logout') ?></a>]</p>
            </li>
            <li>
                <p class="navbar-text pull-right">
                    <select class="form-control" id="select_language">
                        <?php foreach ($languages as $language) { ?>
                        <option <?php echo ($language['language'] == $this->session->userdata('site_lang')) ? 'selected' : '' ?> value="<?php echo $language['language'] ?>"><?php echo lang('lang_' . $language['language']) ?></option>
                        <?php } ?>
                    </select>
                    
                </p>
            </li>
        </ul>
    </div>
