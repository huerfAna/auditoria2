$( document ).ready(function() {
    var anx = $('#anx option:selected').val();
    if(anx != 0)
        showTable(anx);      
});

$("#anx").change(function () {
    var anx = $('#anx option:selected').val();
    showTable(anx);   
});

function showTable(anx)
{
    $( "#table" ).empty();
    $.get( "validation/"+anx, function( data ) {
        $('#table').append(  '<table>' );
            $('#table').append( '<thead><th>ATRIBUTO</th><th></th><th colspan="4">VALIDACION</th></thead>' );
            $.each(data, function( i, valor ){                
                var res = valor.val_data.split("|");
                val = valor.val_data;
                if(valor.attribute_id == 6)
                    val = res[0];
                if(valor.attribute_id == 5)
                    val = ' SI ' + res[2] + ' ES '+ res[3] + ' A ' + res[4];

                $('#table').append( '<tr><td>' + valor.name + '</td><td>   </td><td colspan="4">' + val + '</td><td><a href="" onclick="deleteValidation('+valor.id+')"><i class="icon icon-trash1"></i></td></tr>' );
             });
        $('#table').append('</table>' );        
    });
}

$("#attr").change(function () {
    $( "#data_1" ).empty();
    $( "#data_2" ).empty();
    $( "#data_3" ).empty();
    var valattr = $('#attr option:selected').val();
   
    if(valattr == 1)
        $( "#data_1" ).append( "VALOR: <select name='dato' class='campo'><option value='0'>Seleccione...</option><option value='1'>Numerico</option><option value='2'>Texto</option></select>" );
    if(valattr == 2)
        $( "#data_1" ).append( "TAMAÑO: <input type='number' class='campo'>" );
    
    if(valattr == 5 || valattr == 6) 
    {
        var token =  $('input[name="_token"]').val();
        $.ajax({
            dataType: "JSON",                
            url:   'catalogos',
            data: { _token: token},
            type:  'post',                
            success: function(respuesta){                    
                $('#data_1').text('TABLA: ');
                var sel = $('<select onchange="getFields()" id="table" class="tabla">').appendTo('#data_1');
                sel.append($("<option>").attr('value', '0').text('Selecciona...'));
                $.each( respuesta, function( i, tabla ){
                    sel.append($("<option>").attr('value',tabla.name).text(tabla.name));
                }); 
            },
            error:function(xhr,err){ 
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
            }
        });
    }  
    if(valattr == 8)      
    {
        var token =  $('input[name="_token"]').val();
        $.ajax({
            dataType: "JSON",                
            url:   'tipoDocumento',
            data: { _token: token},
            type:  'post',                
            success: function(respuesta){
                var sel = $('<select name="field1" class="tabla">').appendTo('#data_1');                    
                sel.append($("<option>").attr('value', '0').text('Selecciona...'));
                $.each(respuesta.documento, function( i, campo ){
                    sel.append($("<option>").attr('value',campo.doc_clave).text(campo.doc_nombre));
                }); 
            },
            error:function(xhr,err){ 
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
            }
        });
        $( "#data_2" ).append( "<input type='text' class='campo'>" );
    }
});    

//Obtener campos de la tabla seleccionada
function getFields()
{
    var attr = $('#attr option:selected').val();
        
    $("#table option:selected").each(function () {
        $( "#data_2" ).empty();
        var table = $(this).val();
        var token =  $('input[name="_token"]').val();
        $.ajax({
            dataType: "JSON",                
            url:   'campos',
            data: { _token: token, table: table, attr: attr},
            type:  'post',                
            success: function(respuesta){
                if(attr == 5)
                    $('#data_2').text('MOSTRAR: ');
                else
                    $('#data_2').text('CAMPO: ');
                var sel1 = $('<select name="field1" class="campo">').appendTo('#data_2');                    
                sel1.append($("<option>").attr('value', '0').text('Selecciona...'));
                $.each(respuesta.campos, function( i, campo ){
                    sel1.append($("<option>").attr('value',campo.name).text(campo.name));
                }); 
                if(attr == 5)
                    newComparation(respuesta);                        
            },
            error:function(xhr,err){ 
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
            }
        });
    });                       
}  

function newComparation(respuesta)
{
    
    $('#data_3').text('SI ');
    var sel2 = $('<select class="campowhr" name="field2">').appendTo('#data_3');
    sel2.append($("<option>").attr('value', '0').text('Selecciona...'));
    $.each( respuesta.campos, function( i, campo ){
        sel2.append($("<option>").attr('value',campo.name).text(campo.name));
    });
    $( "#data_3").append( "<div class='medium-3'><select name='opera' class='opera'><option value='1'> < </option><option value='2'> > </option><option value='3'> <= </option><option value='4'> >= </option><option value='5'> = </option></select></div>" );
    var sel3 = $('<select class="campoanx" name="field3">').appendTo('#data_3');
    sel3.append($("<option>").attr('value', '0').text('Selecciona...'));
    $.each( respuesta.camposanx, function( i, campo ){
        sel3.append($("<option>").attr('value',campo.id).text(campo.a22_name));
    });
}

$('#button').click(function(){    
    if($('.tabla').val() == undefined)
        tabla = '';
    else
        tabla = $('.tabla').val() + '|';

    if($('.campo').val() == undefined)
        campo = '';
    else
        campo = $('.campo').val() + '|';

    if($('.campowhr').val() == undefined)
        campowh = '';
    else
        campowh = $('.campowhr').val() + ',';

    if($('.campoanx').val() == undefined)
        campoanx = '';
    else
        campoanx = $('.campoanx').val() + '|';

    if($(".opera option:selected").html() == undefined)
        operador = '';
    else
        operador = $(".opera option:selected").html() +',';
    
    result = tabla+campowh+operador+campoanx+campo;

    $('#data').val(result.substring(0,result.length - 1));
    $( "#form" ).submit();
});

function deleteValidation(id)
{
    var x = confirm("Deseas eliminar la validacion?");
    var token =  $('input[name="_token"]').val();
    if (x) {
        event.preventDefault();
        $.ajax({
            dataType: "JSON",                
            url:   'validation/'+id,            
            type:  'delete',   
            data: { _token: token},             
            success: function(respuesta){
               showTable(respuesta);
            },
            error:function(xhr,err){ 
                return false;
            }
        });
        
    }
    else {
        event.preventDefault();
        return false;
    }
}
function checkValue(tabla)
{
    var res = '';

    data = {        
        "mdb_aduanas" : "Aduanas",
        "mdb_cambio" : "Tipo de Cambio",
        "mdb_consolid" : "Contribuciones",
        "mdb_conten" : "Contenedores",
        "mdb_contrib" : "Contribuciones",
        "mdb_cpedimen" : "Clave de Pedimento",
        "mdb_datgral" : "Datos generales",
        "mdb_destinos" : "Destinos aduaneros",
        "mdb_empresas" : "Empresas",
        "mdb_fmonext" : "Factor Moneda",
        "mdb_fpago" : "Forma de pago",
        "mdb_fraccion" : "Fraccion",
        "mdb_ident" : "Identificadores",
        "mdb_incoterm" : "Incoterms",
        "mdb_inpc" : "INPC",
        "mdb_material" : "Materiales",
        "mdb_monedas" : "Monedas",        
        "mdb_omamonedas" : "Moneda (OMA)",
        "mdb_omaumedida" : "Unidad de Medida (OMA)",
        "mdb_operacion" : "Tipo de Operacion",
        "mdb_paises" : "Paises",
        "mdb_permisos" : "Permisos",
        "mdb_recintoe" : "Recintos Entrada",
        "mdb_recintos" : "Recintos Salida",
        "mdb_regimen" : "Regimen",
        "mdb_regular" : "Regularizaciones",
        "mdb_sustanci" : "Sustencias",
        "mdb_tasas" : "Tasas",
        "mdb_tfactura" : "Tipo Factura",
        "mdb_tipocambio" : "Tipo de cambio",
        "mdb_tipodocum" : "Tipo de documento",
        "mdb_tpediment" : "Tipo de pedimento",
        "mdb_transp" : "Transporte",
        "mdb_umedida" : "Unidad de Medida",
        "mdb_valora" : "Valor Aduana"
    };
    
    $.each(data, function(key, value){
        if(tabla == key)
            res = data[key];
    });

    return res;

}