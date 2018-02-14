$(document).ready(function(){
    $('#Marca').on('change',function(){
        var marcaID = $(this).val();
        if(marcaID){
            $.ajax({
                type:'POST',
                url:'ajaxDataEntrada.php',
                data:'marca_id='+marcaID,
                success:function(html){
                    $('#Modelo').html(html);                    
                }
            }); 
        }else{
            $('#Modelo').html('<option value="">Selecione a marca primeiro</option>');            
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
});