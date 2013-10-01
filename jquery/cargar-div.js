
var $jQ = jQuery.noConflict();
var imagenCarga = '<img src="images/indicator.gif" alt="Cargando..." class="imgCarga">';
function cargarDivV(div,contenido){
		//var $jQ = jQuery.noConflict();
		alert("cargar Viejo");
		$jQ('#emergenteMedio').hide();
		$jQ.ajax({
			type: "GET",
			url: contenido,
			success: function(msg){
				$jQ('#'+div).html(msg);
				muestra_oculta('carga');
			}
		});
		
	}

//NUEVA FORMA
function cargarDiv(div,contenido){
		//var $jQ = jQuery.noConflict();
		//$jQ('#emergenteMedio').hide();
		$jQ('#'+div).html(imagenCarga).load(contenido, function(response, status, xhr) {						  
				  if (status == "error") {
					var msg = "Ha ocurrido el sigueinte error: ";
					$jQ('#'+div).html(msg + xhr.status + " " + xhr.statusText);
				  }
			});
		/*
		$jQ.ajax({
			type: "GET",
			url: contenido,
			success: function(msg){
				$jQ('#'+div).html(msg);
				muestra_oculta('carga');
			}
		});
		*/
		//muestra_oculta('carga');
}	

function bloquearPantalla()
{
		
	if ($jQ('#emergenteMedio').is(":visible") || $jQ('#emergenteReporte').is(":visible"))
	{
		if ($jQ('#emergenteMedio').height() > $jQ('#emergenteReporte').height())
		{
			$jQ('#bloqueadora').height($jQ('#emergenteMedio').height()+350+"px");
		}
		else
		{
			$jQ('#bloqueadora').height($jQ('#emergenteReporte').height()+350+"px");
		}			
		$jQ('#bloqueadora').show();
	}
	else 
	{
		$jQ('#bloqueadora').hide();
	}
}

function muestraOcultaDiv(div){
		
		$jQ('#'+div).slideToggle();
		
	}	
	
function emergente(divEmerge,divMensaje,contenido){
		//var $jQ = jQuery.noConflict();
		$jQ('#'+divEmerge).toggle();
		$jQ.ajax({
			type: "GET",
			url: contenido,
			success: function(msg){
				$jQ('#'+divMensaje).html(msg);
				//muestra_oculta('carga');
				
			}
		});
		
	}	
	
function emergente2(divEmerge,contenido){
		//var $jQ = jQuery.noConflict();
		muestra_oculta('carga');
		$jQ('#'+divEmerge).slideToggle("fast");
		$jQ.ajax({
			type: "GET",
			url: contenido,
			success: function(msg){
				$jQ('#'+divEmerge).html(msg);
				muestra_oculta('carga');
				
			}
		});
		
	}		
	
function cargarDivSinCarga(div,contenido){
		//var $jQ = jQuery.noConflict();
		
		$jQ.ajax({
			type: "GET",
			url: contenido,
			success: function(msg){
				$jQ('#'+div).html(msg);
				//muestra_oculta('carga');
			}
		});
		
	}	
	
function cargar2DivV(div1,contenido1,div2,contenido2){
		
		$jQ('#emergenteMedio').hide();
		$jQ.ajax({
			type: "GET",
			url: contenido1,
			success: function(msg){
				
				$jQ('#'+div1).html(msg);
				//muestra_oculta('carga');
			}
		});
		
		$jQ.ajax({
			type: "GET",
			url: contenido2,
			success: function(msg){
				
				$jQ('#'+div2).html(msg);
				//muestra_oculta('carga');
			}
			
		});
	}	
	
function cargar2Div(div1,contenido1,div2,contenido2){
		
	
		$jQ('#'+div1).html(imagenCarga)
			.load(contenido1, function(response, status, xhr) {						  
				  if (status == "error") {
					var msg = "Ha ocurrido el sigueinte error: ";
					$jQ('#'+div1).html(msg + xhr.status + " " + xhr.statusText);
				  }
			});
		$jQ('#'+div2).html(imagenCarga)
			.load(contenido2, function(response, status, xhr) {						  
				  if (status == "error") {
					var msg = "Ha ocurrido el sigueinte error: ";
					$jQ('#'+div2).html(msg + xhr.status + " " + xhr.statusText);
				  }
			});	
		//muestra_oculta('carga');
}

function limpiarDiv2(div){
		//var $jQ = jQuery.noConflict();
	var d = document.getElementById(div);
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);

	}
	
 function limpiarDiv(id)
        {
            var div;
 			
                div = document.getElementById(id);
				if (div.hasChildNodes()){					
					while(div.hasChildNodes())
					{
						div.removeChild(div.lastChild);
					}
				}
        }
		
 function limpiarDivSinCarga(id)
        {
            var div;
 			//muestra_oculta('carga');
                div = document.getElementById(id);
				if (div.hasChildNodes()){					
					while(div.hasChildNodes())
					{
						div.removeChild(div.lastChild);
					}
				}
        }		

 function limpiar2Div(id1,id2)
        {
            var div;
 			var div2;
		
                div1 = document.getElementById(id1);
				div2 = document.getElementById(id2);
				if (div1.hasChildNodes()){					
					while(div1.hasChildNodes())
					{
						div1.removeChild(div1.lastChild);
					}
				}
				if (div2.hasChildNodes()){					
					while(div2.hasChildNodes())
					{
						div2.removeChild(div2.lastChild);
					}
				}
        }
		
 function limpiarAreas(id,hijo1,hijo2)
        {
            var div;
			var div1;
			var div2;
 
                div = document.getElementById(id);
          		div1 = document.getElementById(hijo1);
				div2 = document.getElementById(hijo2);
				
                div.removeChild(div1);
				div.removeChild(div2);
				
				
        }		
		
		
 function crearDiv(idpadre,idhijo)
        {
            var div;
			var padre;
			
				padre = document.getElementById(idpadre)
                div = document.createElement('div');
          		div.setAttribute('id',idhijo);
				
				padre.appendChild(div);
                
        }		
		
 function crearTr(idtabla,idtr)
        {
            var tr;
			var tabla;
			var td1;
			var td2;
			var i = 0;
			var idTr = "lista_t_habitacion-"+i;
							
				tabla = document.getElementById(idtabla)
                tr = document.createElement('tr');
          		tr.setAttribute('id','tr'+i);
				td1 = document.createElement('td');
				td2 = document.createElement('td');
				
				
				padre.appendChild(div);
                
        }				

 function muestra_oculta(id)
 	{
		
			var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
			el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
		
	}
	