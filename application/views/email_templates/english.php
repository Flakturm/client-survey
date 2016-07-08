<table width="800px" >
    <tr>
        <td style="width:50%">
            <?php echo $company_logo; ?>
        </td>
        <td style="width:50%; text-align: right" valign="top">
            <?php if ($company_link) { echo $company_link; } ?>
        </td>
    </tr>
    <tr style="height: 40px"></tr>
    <tr>
        <td colspan="2">
            Dear <?php echo $customer_name ?>,
        </td>
    </tr>
    <tr style="height: 10px"></tr>
    <tr>
        <td colspan="2">
            Thank you for giving us the opportunity to serve you better. Please to tell us about the service that you have received so far regarding <b><?php echo $reference; ?></b>.
        </td>
    </tr>
    <tr>
        <td colspan="2">
            We appreciate your business and want to make sure we meet your expectations.
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table width="100%">
                <tr>
                    <td width="25%"></td>
                    <?php if (isset($encoded_id) && isset($encoded_like) && isset($encoded_language) && isset($encoded_logo)) { ?>
                    <td width="25%">
                    <?php echo anchor('vote/to/'.$encoded_id.'/'.$encoded_like.'/'.$encoded_language.'/'.$encoded_logo, img($img_satisfied)); ?>
                    </td>
                    <td width="25%">
                    <?php echo anchor('vote/to/'.$encoded_id.'/'.$encoded_better.'/'.$encoded_language.'/'.$encoded_logo, img($img_better)); ?>
                    </td>
                    <?php } else { ?>
                    <td width="25%"><?php echo img($img_satisfied)?></td>
                    <td width="25%"><?php echo img($img_better)?></td>
                    <?php } ?>
                    <td width="25%"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="height: 10px"></tr>
    <tr>
        <td colspan="2">
            Best regards,
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?php echo $user_name; ?>
        </td>
    </tr>
    <tr style="height: 10px"></tr>
    <tr>
        <td colspan="2">
            <?php echo img($img_energysavingweek) ?>
        </td>
    </tr>
</table>