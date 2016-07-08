<div style="margin-bottom:10px">
    <?php echo $company_logo; ?>
    <?php if ($company_link) { echo "<br>". $company_link; } ?>
</div>
    <p>
        Dear <?php echo $customer_name ?>, <br>Thank you for giving use the opportunity to serve you better.<br>Please to tell use about the service that you  have received so far regarding <b><?php echo $reference; ?></b>.
    </p>
<div style="margin-bottom:10px;margin-top:10px">
<?php if (isset($encoded_id) && isset($encoded_like) && isset($encoded_language) && isset($encoded_logo)) {
    echo anchor('vote/to/'.$encoded_id.'/'.$encoded_like.'/'.$encoded_language.'/'.$encoded_logo, img($img_like));
    echo 'or';
    echo anchor('vote/to/'.$encoded_id.'/'.$encoded_better.'/'.$encoded_language.'/'.$encoded_logo, img($img_better));
} else { ?>
<?php echo img(IMAGES.'like.jpg')?> or 
<?php echo img(IMAGES.'we-can-do-better.jpg'); } ?>
</div>
<p>
    We appreciate your business and want to make sure we meet you expectations.
</p>
<br>
<p>
    Best regards,<br>
    <?php echo $user_name; ?>
</p>