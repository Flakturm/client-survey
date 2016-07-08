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
            <?php echo $customer_name ?> 先生/女士：
        </td>
    </tr>
    <tr style="height: 10px"></tr>
    <tr>
        <td colspan="2">
            謝謝您給我們機會為您提供更佳的服務。請告訴我們直至目前為止您曾接受的 <b><?php echo $reference; ?></b> 服務。
        </td>
    </tr>
    <tr>
        <td colspan="2">
            我們感謝您的惠顧，並希望確保我們的服務能達到您的期望。
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
            此致
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