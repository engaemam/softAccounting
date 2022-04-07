<script>

    $(".materials").on("keyup", "input", function () {

        var materials = $(this).closest(".materials");
        var devices = $(this).closest(".devices");
        sumTotal(materials, devices);

        var countdiv = devices.find(".countdiv").val();

        var sum2 = 0;
        devices.find(".materials").each(function() {
            $(this).find(".total").each(function () {
                sum2 += Number($(this).val());
            });
            devices.find(".device_total").val(Math.round(sum2 * 100) / 100);
        });


        var sum3 = 0;
        $('.device_total').each(function () {
            sum3 += +Number($(this).val());
        });
        console.log(sum3);
        $('#total_final').val(Math.round(sum3 * 100) / 100);

    });


    $(".devices").on("keyup", "input.device", function () {
        console.log($(this).val());
        var sum2 = 0;

        var devices = $(this).closest(".devices");
        devices.find(".materials").each(function() {
            sumTotal($(this), devices);

            $(this).find(".total").each(function () {
                sum2 += Number($(this).val());
            });
            devices.find(".device_total").val(Math.round(sum2 * 100) / 100);

        });

        var sum3 = 0;
        $('.device_total').each(function () {
            sum3 += +Number($(this).val());
        });
        console.log(sum3);
        $('#total_final').val(Math.round(sum3 * 100) / 100);
    });

    function sumTotal(materials, devices){
        var device = devices.find(".device").val();

        var quantity = materials.find(".quantity").attr('data-value');
        var price = materials.find(".price").val();

        materials.find(".quantity").val(device*quantity);
        materials.find(".total").val(Math.round(quantity*device*price*100) / 100);

    }

</script>