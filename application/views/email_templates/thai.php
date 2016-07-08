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
            เรียน <?php echo $customer_name ?>,
        </td>
    </tr>
    <tr style="height: 10px"></tr>
    <tr>
        <td colspan="2">
            ขอขอบคุณที่ท่านให้โอกาสเราในการมอบบริการที่ดียิ่งขึ้นให้แก่ท่าน โปรดบอกเราเกี่ยวกับบริการที่ท่านได้รับจนถึงปัจจุบันเกี่ยวกับ <b><?php echo $reference; ?></b>.
        </td>
    </tr>
    <tr>
        <td colspan="2">
            เราชื่นชมธุรกิจของท่านและต้องการตรวจสอบให้แน่ใจว่าเราทำตามความคาดหวังของท่าน
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
            ขอแสดงความนับถือ
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