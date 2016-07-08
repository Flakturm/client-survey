<div id="tasks" class="container container-margin">
  <div class="container-border">
    <div class="row">
      <div class="col-md-9">
        <h3><?php echo $title; ?></h3>
      </div>
      <div class="col-md-3">
            <div class="pull-right">
                <a class="btn btn-success" href="<?php echo site_url('email/create'); ?>" role="button"><?php echo lang('button_new') ?></a>
            </div>
          </div>
    </div>
    <?php if (isset($message)) { ?>
    <!-- alert messages -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success"><?php echo $message; ?></div>
        </div>
    </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-12 table-responsive">
        
        <table class="table table-striped table-hover table-bordered sortable">
          
          <thead>
            <tr>
              <th><?php echo lang('column_recipient') ?></th>
              <th><?php echo lang('column_company') ?></th>
              <th><?php echo lang('column_customer_name') ?></th>
              <th><?php echo lang('column_reference') ?></th>
              <!-- <th><?php echo lang('column_date_added') ?></th> -->
              <th><?php echo lang('column_date_sent') ?></th>
              <th><?php echo lang('column_status') ?></th>
              <th><?php echo lang('column_feedback') ?></th>
            </tr>
          </thead>
          <tbody>
          <?php if($emails) { ?>
          <?php foreach ($emails as $email) { ?>
            <tr>
              <?php if ($email['status'] == $this->config->item('email_status_sent')) {
                $url = site_url('email/sent/' . $email['email_id']);
              } else {
                $url = site_url('email/draft/' . $email['email_id']);
              } ?>
              <td><a href="<?php echo $url; ?>"><?php echo $email['email'] ?></a></td>
              <td><?php echo $email['company'] ?></td>
              <td><?php echo $email['customer_name'] ?></td>
              <td><?php echo ($email['reference']) ? $email['reference'] : '-' ?></td>
              <!-- <td><?php echo (strtotime($email['date_added'])) ? $email['date_added'] : '-' ?></td> -->
              <td><?php echo (strtotime($email['date_sent'])) ? $email['date_sent'] : '-' ?></td>
              <td><?php echo ($email['status'] == $this->config->item('email_status_sent')) ? lang('text_sent') : "-" ?></td>
              <td><?php echo (lang('text_' . $email['description'])) ? lang('text_' . $email['description']) : '-' ?></td>
            </tr>
          <?php } } else { ?>
              <tr>
                <td colspan="7" class="text-center"><?php echo lang('text_no_email') ?></td>
              </tr>
          <?php } ?>
          </tbody>

        </table>
        <div class="pagination">
          <?php echo $this->pagination->create_links(); ?>  
        </div>

      </div>
    </div>
	</div>
</div>

