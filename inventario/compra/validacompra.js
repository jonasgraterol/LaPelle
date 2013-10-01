
document.write("<script type='text/javascript' src='jquery/funciones.js'></script>");

function limpiaFormCompra()
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

function blanquearCompra()
{
	for(i=0; i<=4; i++)
	{
		form.elements[i].value="";
	}
	//document.getElementById("descripcion").value="";
}


function validaCom(modulo,accion,id)
{
	
	cargarDatos(); 
	//limpiaFormCompra();
	escondeError();
	error=0;
	
	var proveedorId=eliminaEspacios(form.lista_proveedor.value);
	var fact=eliminaEspacios(form.fact.value);
	var fecha=eliminaEspacios(form.fecha.value);
	var desc=eliminaEspacios(form.desc.value);	
	var totalTotal = eliminaEspacios(form.totalTotal.value);
	
	
	if(!validaLongitud(proveedorId, 0, 1, 5)) muestraError(form.lista_proveedor.id);
	if(!validaLongitud(fact, 0, 1, 50)) muestraError(form.fact.id);
	if(!validaLongitud(fecha, 0, 8, 12)) muestraError(form.fecha.id);
	if(!validaLongitud(desc, 1, 3, 500)) muestraError(form.desc.id);
	
	var ids = new Array();
	var precios = new Array();
	var cants = new Array();
	var subs = new Array();
	var n = 0;
	$j(".agre").each(function() {
			
			//alert("id="+$j(this).attr("id")+" Cant="+$j(this).attr("cantidad")+" Precio="+$j(this).attr("precio")+" SubT="+$j(this).attr("subt"));
		ids[n] = $j(this).attr("pid");
		precios[n] = $j(this).attr("precio");
		cants[n] = $j("#cant_"+ids[n]).val();
		subs[n] = parseFloat($j("#lblTotal"+ids[n]).html());
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
		ajax.open("POST", "inventario/"+modulo+"/guardar"+modulo+".php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("accion="+accion+"&id="+id+"&proveedorId="+proveedorId+"&fact="+fact+"&fecha="+fecha+"&desc="+desc+"&ids="+ids+"&precios="+precios+"&cants="+cants+"&subs="+subs+"&totalTotal="+totalTotal+"&n="+n);
		
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
						if(ok!=-1)
						{
							texto = "<strong>Operacion Exitosa</strong> Se ha guardado el registro en la base de datos.";
							msj('valid',texto);
							
							//setTimeout("cargarDiv('left','modulos/renglon/crearCompra.php');",4000);
							cargar2Div('centro','inventario/'+modulo+'/administrar'+modulo+'.php','derecha','inventario/'+modulo+'/registrar.php');	
							
							
						}
						else 
						{
							texto="Error: El servidor fallo, intente m�s tarde. "+respuesta;
							msj('error',texto);
						}
					}	
					
					if(exis==-1)
					{
						blanquearCompra();
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
							var texto="Error: El servidor fallo al intentar Actualizar el registro, intente m�s tarde.["+respuesta+"]<br><br>";
							msj(texto);
						}
						
						var t = "cargar2Div('derecha','inventario/"+modulo+"/editar"+modulo+".php?id="+id+"','centro','inventario/"+modulo+"/administrar"+modulo+".php')";
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
						cargarDiv('centro','inventario/'+modulo+'/administrar'+modulo+'.php');
						
						//blanquearCompra();
					}
					else
					{
						var texto="Error: El servidor fallo al intentar Eliminar el registro, intente m�s tarde.["+respuesta+"]";
						msj('error',texto);
					}
					
					setTimeout('limpiarDivSinCarga("derecha");',5000);
				}
			}
		}
	}
}