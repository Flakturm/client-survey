<div id="tasks" class="container container-margin">
    <div class="container-border">
    
        <div class="row">
          <div class="col-md-9">
            <h3><?php echo $title; ?></h3>
          </div>
          
          <div class="col-md-3">
            <div class="pull-right">
                <a class="btn btn-info" href="<?php echo site_url(); ?>" role="button"><?php echo lang('button_back') ?></a>
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
        <?php echo form_open('reporting/export_csv');?>
        <div class="row">
            <div class="col-md-1">
                <?php echo lang('label_country', 'geo_zone_id'); ?>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="geo_zone_id" name="geo_zone_id">
                    <?php if(!$this->ion_auth->is_admin()) { ?>
                    <option value="<?php echo $country->geo_zone_id; ?>"><?php echo $country->name; ?></option>
                    <?php } else { ?>
                        <option value=""><?php echo lang('text_all'); ?></option>
                        <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country['geo_zone_id'] ?>"><?php echo ucwords(strtolower($country['name'])) ?></option>
                    <?php } } ?>
                </select>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-1">
                <?php echo lang('label_opco', 'company_id'); ?>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="company_id" name="company_id">
                    <?php if(!$this->ion_auth->is_admin()) { ?>
                    <option value="<?php echo $company->company_id; ?>"><?php echo $company->name; ?></option>
                    <?php } else { ?>
                    <option value=""><?php echo lang('text_all'); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-1">
                <?php echo lang('label_employee', 'user_id'); ?>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="user_id" name="user_id">
                <option value=""><?php echo lang('text_all'); ?></option>
                    <?php if(!$this->ion_auth->is_admin()) { 
                    foreach ($employees as $employee) { ?>
                        <option value="<?php echo $employee['id'] ?>"><?php echo ucwords(strtolower($employee['name'])) ?></option>
                    <?php } } ?>
                </select>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-1">
                <?php echo lang('label_date', 'from_date'); ?>
            </div>
            <div class="col-md-3">
                <div class="controls">
                    <div class="input-group">
                        <?php echo form_input($from_date); ?>
                        <label for="from_date" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <?php echo lang('label_to', 'to_date'); ?>
            </div>
            <div class="col-md-3">
                <div class="controls">
                    <div class="input-group">
                        <?php echo form_input($to_date); ?>
                        <label for="to_date" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row top7">
            <div class="col-md-1">
                <?php echo lang('label_status', 'feedback_id'); ?>
            </div>
            <div class="col-md-3">
                 <select class="form-control" id="feedback_id" name="feedback_id">
                    <option value=""><?php echo lang('text_all'); ?></option>
                    <?php foreach ($statuses as $status) { ?>
                    <option value="<?php echo $status['feedback_id'] ?>"><?php echo lang('text_'.$status['description']) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row top17">
            <div class="col-md-1">
            </div>
            <div class="col-md-11">
                <?php echo form_input($export_report) ?>
            </div>
        </div>
        <?php echo form_close();?>
	</div>
</div>
<script>
    window.onload = function() {
        $(function(){
            var country = $('#geo_zone_id');
            var company = $('#company_id');
            var employee = $('#user_id');
            var feedback = $('#feedback_id');

            // get JSON data to populate the options of the select box
            country.on('change', function() {
                company.find($('.company')).remove();
                $.ajax({
                    url:"<?php echo site_url('json/country_companies') ?>",
                    type:'POST',
                    data: 'geo_zone_id=' + $(this).val(),
                    dataType: 'json',
                    success: function( json ) {
                        // console.log(json.employees);
                        if (json.companies) {
                            $.each(json.companies, function(i, value) {
                                company.append($("<option class='company'>").text(value.name).attr('value', value.company_id));
                            });
                        }
                    }
                });
            });
            company.on('change', function() {
                employee.find($('.employee')).remove();
                $.ajax({
                    url:"<?php echo site_url('json/company_employees') ?>",
                    type:'POST',
                    data: 'company_id=' + $(this).val(),
                    dataType: 'json',
                    success: function( json ) {
                        // console.log(json.employees);
                        if (json.employees) {
                            $.each(json.employees, function(i, value) {
                                employee.append($("<option class='employee'>").text(value.name).attr('value', value.id));
                            });
                        }
                    }
                });
            });

            $.fn.datepicker.defaults.format = "yyyy/mm/dd";
            var checkin = $('#from_date').datepicker({
              // onRender: function(date) {
              //   return date.valueOf() < now.valueOf() ? 'disabled' : '';
              // }
            }).on('changeDate', function(ev) {
              if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
              }
              checkin.hide();
              $('#to_date')[0].focus();
            }).data('datepicker');

            var checkout = $('#to_date').datepicker({
              // onRender: function(date) {
              //   console.log(checkin.date.valueOf());
              //   return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
              // }
            }).on('changeDate', function(ev) {
              checkout.hide();
            }).data('datepicker');

        });
    } 
</script>
