<script>

    $(document).on("keyup", ".device", function() {
      var device_quantity = $(this).find('.device_quantity').val();
      var device_total = 0;
      $(this).find('.device_materials').each(function () {
        var device_material_quantity = $(this).find('.device_material_quantity').attr('data-value');
        var device_material_price = $(this).find('.device_material_price').val();


        $(this).find('.device_material_quantity').val(device_quantity * device_material_quantity);
        var device_material_quantity_total = Math.round((device_quantity * device_material_quantity * device_material_price)*100) / 100;
        $(this).find('.device_material_quantity_total').val(device_material_quantity_total);

        device_total += device_material_quantity_total;
      });

      $(this).find('.device_total').val(device_total);

      var total_final = 0;
      $('.device_total').each(function () {
        total_final += Number($(this).val());
      });
      $('.total_final').val(total_final);

    });

  $(document).on("click", ".device .remove_device", function() {
console.log('ssss');
    $(this).parent().remove();

    var total_final = 0;
    $('.device_total').each(function () {
      total_final += Number($(this).val());
    });
    $('.total_final').val(total_final);

  });





    $(document).on("change",".color",function(){

        if(this.value == 20){

            if (zxc >= 2){
                $(this).closest("tr").remove();
                $('.select2').select2().trigger("select2:close");
            }else {
            $(".size").val(27);
            $('.size').trigger('change');
            $('.size').prop('disabled', true);
            }
        }else{
            $('.size').trigger('change');
            $('.size').prop('disabled', false);
        }

    });
</script>
