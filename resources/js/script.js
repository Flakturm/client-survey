$(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('#first_name').focus();

    $('.back').on('click', function() {
        parent.history.back();
        return false;
    });

    $('#select_language').on('change', function() {
        window.location.href = SITE_URL + 'langswitch/switchLanguage/' + $(this).val();
    });

    // $("#start_date").datepicker({
    //   dateFormat: 'dd-mm-yy'
    // });
    // var today = new Date();
    // var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
    // var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    // var date1 = nowTemp.getDate()+'/'+nowTemp.getMonth()+'/'+nowTemp.getFullYear();
    // default dates
    // $('#start_date').val(tomorrow);
    // $('#end_date').val(nowTemp.getDate()+'/'+(nowTemp.getMonth()+1)+'/'+nowTemp.getFullYear());
    
});