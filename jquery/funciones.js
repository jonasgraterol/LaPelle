
/*
document.write("<script type='text/javascript' src='formulario/vaidaciones/validaTipoHabitacion.js'></script>");
document.write("<script type='text/javascript' src='formulario/valdaciones/validaTipoReserva.js'></script>");
document.write("<script type='text/javascript' src='formulario/vaidaciones/validaHabitacion.js'></script>");
document.write("<script type='text/javascript' src='formulario/valdaciones/validaCliente.js'></script>");
document.write("<script type='text/javascript' src='formulario/valdaciones/validaTarifaHabitacion.js'></script>");
*/	
	// Variables para setear
	


function cargarDatos() 
{
	cAyuda=document.getElementById("mensajesAyuda");
	cNombre=document.getElementById("ayudaTitulo");
	cTex=document.getElementById("ayudaTexto");
	divTransparente=document.getElementById("transparencia");
	divMensaje=document.getElementById("transparenciaMensaje");
	form=document.getElementById("formulario");
	//urlDestino="mail.php";
	
	claseNormal="input";
	claseError="inputError";
	
	//Mensajes de ayuda
	ayuda=new Array();
	ayuda["Nombre"]="Ingresa tu nombre. De 4 a 50 caracteres. OBLIGATORIO";
	ayuda["Empresa"]="Ingresa el nombre de tu Empresa. De 4 a 50 caracteres.";
	ayuda["Telefono"]="Ingresa un teléfono de contacto.";
	ayuda["Correo"]="Ingresa un e-mail válido. OBLIGATORIO";
	ayuda["Comentario"]="Ingresa tus comentarios. De 5 a 500 caracteres. OBLIGATORIO";
	ayuda["Porcentaje Incremento"]="Es el porcentaje que se incrementara a la tarifa durante la temporada. El valor debe ser entre 0 y 100";
	ayuda["Monto Incremento"]="Es la cantidad de BsF que se incrementara a la tarifa durante la temporada.";
	ayuda["Formato Hora"]="Formato de hora militar (00:00-23:00)";
	
	preCarga("ok.gif", "loading.gif", "error.gif");
}

function preCarga()
{
	imagenes=new Array();
	for(i=0; i<arguments.length; i++)
	{
		imagenes[i]=document.createElement("img");
		imagenes[i].src=arguments[i];
	}
}

function nuevoAjax()
{
	var xmlhttp=false; 
	try 
	{ 
		// No IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!="undefined") { xmlhttp=new XMLHttpRequest(); } 
	return xmlhttp; 
}

function limpiaForm()
{
	for(i=0; i<=4; i++)
	{
		form.elements[i].className=claseNormal;
	}
	document.getElementById("inputComentario").className=claseNormal;
}

function campoError(campo)
{
	muestraError(campo.id);
	//campo.className="inputError";
	error=1;
}

function muestraError(id)
{
	$j("#"+id+"-error").slideDown(500);
	$j("#"+id).focus();	
	error=1;
}

function campoError2(campo)
{
	campo.className="inputError";
	error=1;
}

function ocultaMensaje()
{
	divTransparente.style.display="none";
}

function muestraMensaje(mensaje)
{
	var ancho = $JQy("#transparencia").parent().width();
	var alto = $JQy("#transparencia").parent().height();
	//alert("ancho:"+ancho+" alto:"+alto);
	$JQy("#transparencia").width(ancho-50);
	$JQy("#transparencia").height(alto-30);
	divMensaje.innerHTML=mensaje;
	divTransparente.style.display="block";
	
}

function dialogoEmergente()
{
	$JQy(function(){
	
					
					// Dialog			
					$JQy('#dialog').dialog({
						autoOpen: false,
						modal: true,
						width: 600,
						buttons: {
							"Ok": function() { 
								$JQy(this).dialog("close"); 
							}, 
							"Cancel": function() { 
								$JQy(this).dialog("close"); 
							} 
						}
					});
				 });
}

function muestraMensaje2(mensaje)
{	
	divTransparente=document.getElementById("transparencia");
	divMensaje=document.getElementById("transparenciaMensaje");
	divMensaje.innerHTML=mensaje;
	divTransparente.style.display="block";
}

function eliminaEspacios(cadena)
{
	
	// Funcion para eliminar espacios delante y detras de cada cadena
	while(cadena.charAt(cadena.length-1)==" ") cadena=cadena.substr(0, cadena.length-1);
	while(cadena.charAt(0)==" ") cadena=cadena.substr(1, cadena.length-1);
	return cadena;
}

function validaLongitud(valor, permiteVacio, minimo, maximo)
{
	
	var cantCar=valor.length;
	if(valor=="")
	{
		if(permiteVacio) return true;
		else return false;
	}
	else
	{
		if(cantCar>=minimo && cantCar<=maximo) return true;
		else return false;
	}
}

function validaCorreo(valor)
{
	
	var reg=/(^[a-zA-Z0-9._-]{1,30})@([a-zA-Z0-9.-]{1,30}).([a-zA-Z0-9.-]{1,30})/;
	if(reg.test(valor)) return true;
	else return false;
}

function validaNumero(valor)
{
	
	var expresion=/(^[0-9.,-]*$)/;
	if(expresion.test(valor)) return true;
	else return false;
}

function formateaNombre(caja)
{
	var aux = "";
	var nombres = caja.value.split(" ");
	for (var n=0; n<nombres.length; n++)
	{
		aux += nombres[n].charAt(0).toUpperCase();
		aux += nombres[n].substr(1, nombres[n].length-1);
		aux += " ";
	}
	aux = aux.substr(0, aux.length-1);
	caja.value = aux;
	
}

//conpara 2 fechas en formato dd/mm/YYYY si la primera es MAYOR O IGUAL que la segunda retorna false, si la primera es menor retorna true
function compara_fechas(fecha, fecha2)  
{  
     var xMonth=fecha.substring(3, 5);  
     var xDay=fecha.substring(0, 2);  
     var xYear=fecha.substring(6,10);  
     var yMonth=fecha2.substring(3, 5);  
     var yDay=fecha2.substring(0, 2);  
     var yYear=fecha2.substring(6,10);  
     if (xYear> yYear)  
     {  
         return(true)  
     }  
     else  
     {  
       if (xYear == yYear)  
       {   
         if (xMonth> yMonth)  
         {  
             return(true)  
         }  
         else  
         {   
           if (xMonth == yMonth)  
           {  
             if (xDay>= yDay)  
               return(true);  
             else  
               return(false);  
           }  
           else  
             return(false);  
         }  
       }  
       else  
         return(false);  
     }  
}

//conpara 2 fechas en formato dd/mm/YYYY si la primera es mayor que la segunda retorna false, si la primera es MENOR O IGUAL retorna true
function compara_fechas_permisiva(fecha, fecha2)  
{  
     var xMonth=parseInt(fecha.substring(3, 5));  
     var xDay=parseInt(fecha.substring(0, 2));  
     var xYear=parseInt(fecha.substring(6,10));  
     var yMonth=parseInt(fecha2.substring(3, 5));  
     var yDay=parseInt(fecha2.substring(0, 2));  
     var yYear=parseInt(fecha2.substring(6,10));  
     if (xYear> yYear)  
     {  
         return(true)  
     }  
     else  
     {  
       if (xYear == yYear)  
       {   
         if (xMonth> yMonth)  
         {  
             return(true)  
         }  
         else  
         {   
           if (xMonth == yMonth)  
           { 
             if (xDay> yDay)  
               return(true);  
             else  
               return(false);  
           }  
           else  
             return(false);  
         }  
       }  
       else  
         return(false);  
     }  
}

function validaFechaNacimiento(caja)
{
	var $JQy = jQuery.noConflict();
	var aux = "";
	caja.className="inputNormal";
	
	//var partes = caja.value.split("/");
	//var camp = document.getElementById('inputNombre');
	if ((caja.value != "") && (caja.value != "  /  /    "))
	{
		var partes = caja.value.split("/");
		var hoy = new Date()
		//Validacion de los dias de la fecha (entre 01 y 31)
		if (partes[0] != "  ")
		{
			if ((partes[0].charAt(0) >= 0) && (partes[0].charAt(0) <= 3))
			{													
				if (partes[0].charAt(0) == 0)
				{
					if (partes[0].charAt(1) < 1)
					{
						campoError2(caja);
						//camp.value="1";
					}
				}
				else
				{
					if (partes[0].charAt(0) == 3)
					{
						if ((partes[0].charAt(1) != 0) && (partes[0].charAt(1) != 1))
						{
							campoError2(caja);
							//camp.value="2";
						}
					}
				}
			}
			else 
			{
				campoError2(caja);
				//camp.value="3";
			}
		}

		//validacion para los meses de la fecha (entre 01 y 12)
		if (partes[1] != "  ")
		{
			if ((partes[1].charAt(0) >= 0) && (partes[1].charAt(0) <= 1))
			{													
				if (partes[1].charAt(0) == 0)
				{
					if (partes[1].charAt(1) < 1 )
					{
						campoError2(caja);
						//camp.value="4";
					}
				}
				else
				{
					if (partes[1].charAt(0) == 1)
					{
						if (partes[1].charAt(1) > 2)
						{
							campoError2(caja);
							//camp.value="5";
						}
					}
				}
			}
			else
			{
				campoError2(caja);
				//camp.value="6";
			}
		}
		
		
		//validacion del año
		if (partes[2] != "    ")
		{
			var ano = partes[2].substr(0, 2);
			var ano2 = partes[2].substr(2, 3);
			if ((ano != 19) && (ano != 20))
			{
				campoError2(caja);
				//camp.value="7";
			}
			else
			{
				if (ano == 20)
				{
					if (partes[2] > hoy.getFullYear())
					{
						campoError2(caja);
						//camp.value="8";
					}
				}
			}
		}
	}
	else
	{
		campoError2(caja);
	}
	
}

function calculaEdad(fecha,label)
{
	var partes = fecha.split("/");
	var hoy = new Date();
	if ((partes[0] != "  ") && (partes[1] != "  ") && (partes[2] != "    "))
	{
		var edad = hoy.getFullYear() - partes[2] -1;
		if (hoy.getMonth() + 1 - partes[1] < 0) //+ 1 porque los meses empiezan en 0
       	{	
			//return edad;
		}
		if (hoy.getMonth() + 1 - partes[1] > 0)
       	{	
			edad = edad+1;
		}
		
		if (hoy.getMonth() + 1 - partes[1] == 0)
		{
			if (hoy.getUTCDate() - partes[0] >= 0)
			{
			   edad = edad + 1;
			}
			else
			{
				//return edad;
			}
		}
		//donde.value=edad ;
		//donde2.innerHTML = edad;
		document.getElementById(label).innerHTML = edad;
	}
}

function comaXpunto(a)
{
	a.value=a.value.split(',').join('.' );	
}

function cambiaNombre(caja,caja2)
{
	caja2.value = caja.value.toUpperCase();
}

function validaForm()
{
	cargarDatos(); 
	limpiaForm();
	error=0;
	
	var nombre=eliminaEspacios(form.inputNro.value);
	var empresa=eliminaEspacios(form.inputEmpresa.value);
	var telefono=eliminaEspacios(form.inputTelefono.value);
	var correo=eliminaEspacios(form.inputCorreo.value);
	var comentarios=eliminaEspacios(form.inputComentario.value);
	
	if(!validaLongitud(nombre, 0, 4, 50)) campoError(form.inputNro);
	if(!validaLongitud(empresa, 1, 4, 50)) campoError(form.inputEmpresa);
	if(!validaLongitud(telefono, 1, 4, 50)) campoError(form.inputTelefono);
	if(!validaCorreo(correo)) campoError(form.inputCorreo);
	if(!validaLongitud(comentarios, 0, 5, 500)) campoError(form.inputComentario);
	
	if(error==1)
	{
		var texto="<img src='formulario/images/error.gif' alt='Error' ><br><br>Error: revise los campos en rojo.<br><br><button style='width:45px; height:18px; font-size:10px;' onClick='ocultaMensaje()' type='button'>Ok</button>";
		muestraMensaje(texto);
	}
	else
	{
		var texto="<img src='formulario/images/loading.gif' alt='Enviando'><br>Enviando. Por favor espere.<br><br><button style='width:60px; height:18px; font-size:10px;' onClick='ocultaMensaje()' type='button'>Ocultar</button>";
		muestraMensaje(texto);
		
		var ajax=nuevoAjax();
		ajax.open("POST", urlDestino, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("nombre="+nombre+"&empresa="+empresa+"&telefono="+telefono+"&correo="+correo+"&comentarios="+comentarios);
		
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				if(respuesta=="OK")
				{
					var texto="<img src='formulario/images/ok.gif' alt='Ok'><br>Gracias por su mensaje.<br>Le responderemos a la brevedad.<br><br><button style='width:45px; height:18px; font-size:10px;' onClick='ocultaMensaje()' type='button'>Ok</button>";
				}
				else var texto="<img src='formulario/images/error.gif'><br><br>Error: intente más tarde.<br><br><button style='width:45px; height:18px; font-size:10px;' onClick='ocultaMensaje()' type='button'>Ok</button>";
				
				muestraMensaje(texto);
			}
		}
	}
}

// Mensajes de ayuda

if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
else navegador=1;

function colocaAyuda(event)
{
	cargarDatos();
	if(navegador==0)
	{
		var corX=window.event.clientX+document.documentElement.scrollLeft;
		var corY=window.event.clientY+document.documentElement.scrollTop;
	}
	else
	{
		var corX=event.clientX+window.scrollX;
		var corY=event.clientY+window.scrollY;
	}
	cAyuda.style.top=corY+20+"px";
	cAyuda.style.left=corX+15+"px";
}

function ocultaAyuda()
{
	cAyuda.style.display="none";
	if(navegador==0) 
	{
		document.detachEvent("onmousemove", colocaAyuda);
		document.detachEvent("onmouseout", ocultaAyuda);
	}
	else 
	{
		document.removeEventListener("mousemove", colocaAyuda, true);
		document.removeEventListener("mouseout", ocultaAyuda, true);
	}
}

function muestraAyuda(event, campo)
{
	colocaAyuda(event);
	
	if(navegador==0) 
	{ 
		document.attachEvent("onmousemove", colocaAyuda); 
		document.attachEvent("onmouseout", ocultaAyuda); 
	}
	else 
	{
		document.addEventListener("mousemove", colocaAyuda, true);
		document.addEventListener("mouseout", ocultaAyuda, true);
	}
	
	cNombre.innerHTML=campo;
	cTex.innerHTML=ayuda[campo];
	cAyuda.style.display="block";
}

function muestraDetalles(event, campo)
{
	colocaAyuda(event);
	
	if(navegador==0) 
	{ 
		document.attachEvent("onmousemove", colocaAyuda); 
		document.attachEvent("onmouseout", ocultaAyuda); 
	}
	else 
	{
		document.addEventListener("mousemove", colocaAyuda, true);
		document.addEventListener("mouseout", ocultaAyuda, true);
	}
	
	cNombre.innerHTML=campo;
	cTex.innerHTML=detalles[campo];
	cAyuda.style.display="block";
}

//Compara dos horas
function CompararHoras(sHora1, sHora2) {
    
    var arHora1 = sHora1.split(":");
    var arHora2 = sHora2.split(":");
    
    // Obtener horas y minutos (hora 1)
    var hh1 = parseInt(arHora1[0],10);
    var mm1 = parseInt(arHora1[1],10);

    // Obtener horas y minutos (hora 2)
    var hh2 = parseInt(arHora2[0],10);
    var mm2 = parseInt(arHora2[1],10);

    // Comparar
    if (hh1<hh2 || (hh1==hh2 && mm1<mm2))
        return 1;  //sHora1 MENOR sHora2
    else if (hh1>hh2 || (hh1==hh2 && mm1>mm2))
        return 0; //sHora1 MAYOR sHora2
    else 
        return 1; //sHora1 IGUAL sHora2
}