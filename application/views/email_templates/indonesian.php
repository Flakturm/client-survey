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
            Kepada Yth. <?php echo $customer_name ?>,
        </td>
    </tr>
    <tr style="height: 10px"></tr>
    <tr>
        <td colspan="2">
            Terima kasih telah memberi kami kesempatan untuk melayani Anda dengan lebih baik.  Silakan beri tahu kami mengenai layanan yang telah Anda terima sejauh ini terkait <b><?php echo $reference; ?></b>.
        </td>
    </tr>
    <tr>
        <td colspan="2">
            Kami menghargai kesibukan Anda dan ingin memastikan bahwa kami memenuhi harapan Anda.
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
           Salam,
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