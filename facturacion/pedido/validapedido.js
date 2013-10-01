
document.write("<script type='text/javascript' src='jquery/funciones.js'></script>");

function limpiaFormPedido()
{
	for(i=0; i<=4; i++)
	{
		form.elements[i].className=claseNormal;
	}
	//document.getElementById("descripcion").className=claseNormal;
}

function escondeError()
{
	$j("input, textarea, select").each(function () {
		id = $j(this).attr("id");								  	
		$j("#"+id+"-error").hide();															
	});
}

function blanquearPedido()
{
	for(i=0; i<=4; i++)
	{
		form.elements[i].value="";
	}
	//document.getElementById("descripcion").value="";
}


function validaPed(modulo,accion,id)
{
	
	cargarDatos(); 
	//limpiaFormPedido();
	escondeError();
	error=0;
	/*
	var proveedorId=eliminaEspacios(form.lista_proveedor.value);
	var fact=eliminaEspacios(form.fact.value);
	var fecha=eliminaEspacios(form.fecha.value);
	var desc=eliminaEspacios(form.desc.value);	
	*/
	var totalTotal = eliminaEspacios(form.totalTotal.value);
	
	/*
	if(!validaLongitud(proveedorId, 0, 1, 5)) muestraError(form.lista_proveedor.id);
	if(!validaLongitud(fact, 0, 1, 50)) muestraError(form.fact.id);
	if(!validaLongitud(fecha, 0, 8, 12)) muestraError(form.fecha.id);
	if(!validaLongitud(desc, 1, 3, 500)) muestraError(form.desc.id);
	*/
	var ids = new Array();
	var precios = new Array();
	var cants = new Array();
	var subs = new Array();
	var n = 0;
	$j(".agre").each(function() {
			
			
		ids[n] = $j(this).attr("pid");
		precios[n] = $j(this).attr("precio");
		cants[n] = $j("#cantidad_"+ids[n]).val();
		subs[n] = parseFloat($j("#lblTotal"+ids[n]).html());
		//alert("id="+ids[n]+" Cant="+cants[n]+" Precio="+precios[n]+" SubT="+subs[n]);
			//alert("#cantidad_"+ids[n]);
		n++;
		
	});
	
	if(error==1)
	{
		
	}
	else
	{
		//$j("#message_sent").html(" <img src='images/cargando.gif' alt='Enviando...' class='cargaMsj' /> Enviando...").slideDown(500);
		msj('cargando','Cargando...');
		var ajax=nuevoAjax();
		ajax.open("POST", "facturacion/"+modulo+"/guardar"+modulo+".php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("accion="+accion+"&id="+id+"&ids="+ids+"&precios="+precios+"&cants="+cants+"&subs="+subs+"&totalTotal="+totalTotal+"&n="+n);
		
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				
				if (accion=="guardar")
				{	
					//respuesta.lastIndexOf("Existe"); busca el string "Existe" en respuesta y devuelve el indice de la ultima ocurrencia donde lo encuentra 
					// si no lo encuentra retorna -1
					var exis=respuesta.lastIndexOf("Existe");
					if(exis!=-1)
					{
						muestraError(form.nombre.id);
						//$j("#message_sent").html('El nombre <font color=red>'+nomb+'</font> ya existe, por favor verifiquelo.');
						msj('warning','El nombre <font color=red>'+nomb+'</font> ya existe, por favor verifiquelo.')
					}
					else
					{
						var ok=respuesta.lastIndexOf("OK");
						var id=respuesta.split("-");
						
						if(ok!=-1)
						{
							texto = "<strong>Operacion Exitosa</strong> Se ha guardado el registro en la base de datos.";
							msj('valid',texto);
							
							//setTimeout("cargarDiv('left','modulos/renglon/crearPedido.php');",4000);
							limpiarDiv('big');
							cargarDiv('centro','facturacion/'+modulo+'/administrar'+modulo+'.php');	
							cargarDiv('derecha','facturacion/'+modulo+'/editar'+modulo+'.php?id='+id[1]);	
							
						}
						else 
						{
							texto="Error: El servidor fallo, intente más tarde. "+respuesta;
							msj('error',texto);
						}
					}	
					
					if(exis==-1)
					{
						blanquearPedido();
					}	
				}
				if (accion=="editar")
				{
					
					var exis=respuesta.lastIndexOf("Existe");
					
					if(exis!=-1)
					{
						muestraError(form.nombre.id);
						var texto = 'El nombre <font color=red>'+nomb+'</font> ya existe, por favor verifiquelo.';
						msj('warning',texto);
					}
					else
					{
						var edit=respuesta.lastIndexOf("Editado");
						if(edit!=-1)
						{
							var texto="<strong>Edicion Exitosa</strong> Se han Editado correctamente los datos.";
							msj('valid',texto);
							//setTimeOut(3000);
							//cargarDiv('medio','formulario/editarTipoHabitacion.php?id='+id);
						}
						else 
						{
							var texto="Error: El servidor fallo al intentar Actualizar el registro, intente más tarde.["+respuesta+"]<br><br>";
							msj(texto);
						}
						
						var t = "cargar2Div('derecha','facturacion/"+modulo+"/editar"+modulo+".php?id="+id+"','centro','facturacion/"+modulo+"/administrar"+modulo+".php')";
						setTimeout(t,4000);
					}
				}
				if (accion=="eliminar")
				{
					var eli=respuesta.lastIndexOf("Eliminado");
					if(eli!=-1)
					{
						var texto="<strong>Eliminado con exito</strong> Se han Eliminado con exito el registro.";
						msj('valid',texto);
						cargarDiv('centro','facturacion/'+modulo+'/administrar'+modulo+'.php');
						
						//blanquearPedido();
					}
					else
					{
						var texto="Error: El servidor fallo al intentar Eliminar el registro, intente más tarde.["+respuesta+"]";
						msj('error',texto);
					}
					
					setTimeout('limpiarDivSinCarga("derecha");',5000);
				}
			}
		}
	}
}