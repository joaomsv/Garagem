$(document).ready(function(){
    $('#placaentrada').on('change',function(){
        var placaentrada = $(this).val();
        if(placaentrada){
            $.ajax({
                type:'POST',
                url:'ajaxDataEntrada.php',
                data:'placaentrada='+placaentrada,
                success:function(html){
                    $('#dadosentrada').html(html);
                }
            });
        }
    });

	  $('#placa').on('change',function(){
        var placaID = $(this).val();
        if(placaID){
            $.ajax({
                type:'POST',
                url:'ajaxDataSaida.php',
                data:'id='+placaID,
                success:function(html){
                    $('#dados').html(html);
                }
            });
        }
    });

	  $('#ano').on('change',function(){
        var anoID = $(this).val();
        if(anoID){
            $.ajax({
                type:'POST',
                url:'ajaxDataRelatorio.php',
                data:'ano='+anoID,
                success:function(html){
                    $('#mes').html(html);
                }
            });
        }
    });

    $('#info').on('change',function(){
        var userID = $(this).val();
        if(userID){
            $.ajax({
                type:'POST',
                url:'ajaxDataAlterar.php',
                data:'id='+userID,
                success:function(html){
                    $('#alterar').html(html);
                }
            });
        }
    });
});
