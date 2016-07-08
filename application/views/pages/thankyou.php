<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $title ?></title>
<meta name="viewport" content="width=device-width">


<link rel="stylesheet" href="<?php echo base_url(CSS."bootstrap.css");?>">
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url(CSS."main.css");?>">

<script src="<?php echo base_url(JS."libs/modernizr-2.6.2.min.js");?>"></script>

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="<?php echo base_url(IMAGES.'ico/favicon.ico');?>">
<link rel="apple-touch-icon" href="<?php echo base_url(IMAGES.'ico/apple-touch-icon-precompresse.png');?>">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(IMAGES.'ico/apple-touch-icon-57x57-precompressed.png');?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(IMAGES.'ico/apple-touch-icon-72x72-precompressed.png');?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(IMAGES.'ico/apple-touch-icon-114x114-precompressed.png');?>">

</head>
<body>
    <header id="header" class="navbar navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <img style="display: block; height: 58px;" class="navbar-brand" src="<?php echo base_url(IMAGES.'company-logos/'.$logo_name.'.png');?>" alt="">
            </div>
            <div class="navbar-collapse collapse">
            </div>
        </div>
    </header>

    <div id="main" role="main" class="row">
        <div id="tasks" class="container container-margin">
          <div class="container-border">
            <?php if (isset($success) && strlen($success)) { ?>
            <!-- alert messages -->
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success"><?php echo $success; ?></div>
                </div>
            </div>
            <?php } ?>

            <?php if (isset($errors) && strlen($errors)) { ?>
            <!-- alert messages -->
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger"><?php echo $errors; ?></div>
                </div>
            </div>
            <?php } ?>
            
            <?php if ($show_form) { ?>
                <div class="row">
                  <div class="col-md-12">
                    <p><?php echo $message; ?></p>
                  </div>
                </div>
                <?php echo form_open_multipart();?>
                <div class="row">
                  <div class="col-md-12">
                    <?php echo form_textarea($feedback_comment) ?>
                  </div>
                </div>
                <div class="row">
                    <div class="top15">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Browse&hellip; <input type="file" name="userfile[]" multiple>
                                    </span>
                                </span>
                                <input type="text" class="form-control" style="background-color: white;cursor: text" data-toggle="tooltip" data-placement="bottom" title="File has to be less than 10MB and in jpg, png, gif, mp4 or mov format." readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="pull-right">
                                <?php echo form_input($btn_send) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
            <?php } else { ?>
                <div class="row">
                  <div class="col-md-12">
                    <?php echo $thankyou_default_message ?>
                  </div>
                </div>
            <?php } ?>

          </div>
        </div>
    </div>
    

    <script
        src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(JS."libs/jquery-1.10.2.min.js");?>"><\/script>')</script>
    <script src="<?php echo base_url(JS."libs/underscore-min-1.5.0.js");?>"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(JS."plugins.js");?>"></script>
    <script src="<?php echo base_url(JS."script.js");?>"></script>

    <script>

        $(document).on('change', '.btn-file :file', function() {
          var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [numFiles, label]);
        });
        
        $(function(){
            $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
                var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }
            });
        });

    </script> 
</body>
</html>
