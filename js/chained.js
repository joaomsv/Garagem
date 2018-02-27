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
                    $('#salarelatorio').html(html);
                }
            });
        }
    });
    $('#salarelatorio').on('change',function(){
        var salarelatorioID = $(this).val();
        if(salarelatorioID){
            $.ajax({
                type:'POST',
                url:'ajaxDataRelatorioMes.php',
                data:'salarelatorio='+salarelatorioID,
                success:function(html){
                    $('#mes').html(html);
                }
            });
        }
    });
    $('#mes').on('change',function(){
        var mesID = $(this).val();
        var salarelatorio = $('#salarelatorio').val();
        if(mesID){
            $.ajax({
                type:'POST',
                url:'ajaxDataRelatorioDia.php',
                data:{mes:mesID, salarelatorio:salarelatorio},
                success:function(html){
                    $('#dia').html(html);
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
