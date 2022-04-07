<script>

    $(".materials").on("keyup", "input", function () {
alert('ssssssssss');
        var materials = $(this).closest(".materials");
        var devices = $(this).closest(".devices");
        sumTotal(materials, devices);

        var countdiv = devices.find(".countdiv").val();

        var sum2 = 0;
        devices.find(".materials").each(function() {
            $(this).find(".total").each(function () {
                sum2 += Number($(this).val());
            });
            devices.find(".device_total").val(sum2);
        });


        var sum3 = 0;
        $('.device_total').each(function () {
            sum3 += +Number($(this).val());
        });
        console.log(sum3);
        $('#total_final').val(sum3);

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
            devices.find(".device_total").val(sum2);

        });

        var sum3 = 0;
        $('.device_total').each(function () {
            sum3 += +Number($(this).val());
        });
        console.log(sum3);
        $('#total_final').val(sum3);
    });

    function sumTotal(materials, devices){
        var device = devices.find(".device").val();

        var quantity = materials.find(".quantity").attr('data-value');
        var price = materials.find(".price").val();

        materials.find(".quantity").val(device*quantity);
        materials.find(".total").val(quantity*device*price);

    }

</script>