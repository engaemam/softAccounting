
    $(document).ready(function(){
        $('#select12').change(function(){
            if($(this).is(":checked")) {
                $('.print1').addClass('no-print');
            } else {
                $('.print1').removeClass('no-print');
            }
        });
    });
    $(document).ready(function(){
        $('#select13').change(function(){
            if($(this).is(":checked")) {
                $('.print2').addClass('no-print');
            } else {
                $('.print2').removeClass('no-print');
            }
        });
    });
