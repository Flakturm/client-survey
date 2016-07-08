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
            <?php echo $customer_name ?> 님,
        </td>
    </tr>
    <tr style="height: 10px"></tr>
    <tr>
        <td colspan="2">
            저희에게�더�나은�서비스를�제공할�기회를�주셔서�감사합니다.  <b><?php echo $reference; ?></b>와�관련하여�귀하가�지금까지�받은�서비스에�대한�의견을�제시하여�주십시오.
        </td>
    </tr>
    <tr>
        <td colspan="2">
            귀사에�감사한�마음으로�귀사의�기대에�부응하고자�합니다.
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
            감사합니다.
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