
document.write("<script type='text/javascript' src='jquery/funciones.js'></script>");

function limpiaFormArticulo()
{
	for(i=0; i<=5; i++)
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

function blanquearArticulo()
{
	for(i=0; i<=5; i++)
	{
		form.elements[i].value="";
	}
	//document.getElementById("descripcion").value="";
}


function validaAli(modulo,accion,id)
{
	
	cargarDatos(); 
	//limpiaFormArticulo();
	escondeError();
	error=0;
	
	if(accion!='ajustar')
	{
		
		var nomb=eliminaEspacios(form.nombre.value);
		var tipoarticuloId=eliminaEspacios(form.lista_tipoarticulo.value);
		var tipounidadId=eliminaEspacios(form.lista_tipounidad.value);
		
		var precio=eliminaEspacios(form.precio.value);
		var precio2=eliminaEspacios(form.precio2.value);
		var precio3=eliminaEspacios(form.precio3.value);
		var imagen=eliminaEspacios(form.imgarticulo.value);
		var venta=0;
		if($j("#venta").is(":checked")) venta=1;
			
		var stockmin=eliminaEspacios(form.stockmin.value);
		var stockmax=eliminaEspacios(form.stockmax.value);
		
		
		if(!validaLongitud(nomb, 0, 3, 500)) muestraError(form.nombre.id);
		if(!validaLongitud(tipoarticuloId, 0, 1, 5)) muestraError(form.lista_tipoarticulo.id);
		if(!validaLongitud(tipounidadId, 0, 1, 5)) muestraError(form.lista_tipounidad.id);
		
		if(!validaLongitud(precio, 0, 1, 10)) muestraError(form.precio.id);
		if(!validaNumero(precio)) muestraError(form.precio.id);
		if(!validaLongitud(precio2, 0, 1, 10)) muestraError(form.precio2.id);
		if(!validaNumero(precio2)) muestraError(form.precio2.id);
		if(!validaLongitud(precio3, 0, 1, 10)) muestraError(form.precio3.id);
		if(!validaNumero(precio3)) muestraError(form.precio3.id);
			
		if(!validaLongitud(imagen, 1, 1, 200)) muestraError(form.imgarticulo.id);
		
		if(!validaLongitud(stockmin, 0, 1, 5)) muestraError(form.stockmin.id);
		if(!validaLongitud(stockmax, 0, 1, 5)) muestraError(form.stockmax.id);
		if(!validaNumero(stockmin)) muestraError(form.stockmin.id);
		if(!validaNumero(stockmax)) muestraError(form.stockmax.id);
	}
	else
	{
		var precio=eliminaEspacios(form.precio.value);
		var precio2=eliminaEspacios(form.precio2.value);
		var precio3=eliminaEspacios(form.precio3.value);
		
		if(!validaLongitud(precio, 0, 1, 10)) muestraError(form.precio.id);
		if(!validaNumero(precio)) muestraError(form.precio.id);
		if(!validaLongitud(precio2, 0, 1, 10)) muestraError(form.precio2.id);
		if(!validaNumero(precio2)) muestraError(form.precio2.id);
		if(!validaLongitud(precio3, 0, 1, 10)) muestraError(form.precio3.id);
		if(!validaNumero(precio3)) muestraError(form.precio3.id);
	}
		
	
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
		if(accion!='ajustar')
		{
			ajax.send("accion="+accion+"&id="+id+"&nombre="+nomb+"&tipoarticuloId="+tipoarticuloId+"&tipounidadId="+tipounidadId+"&stockmin="+stockmin+"&stockmax="+stockmax+"&precio="+precio+"&precio2="+precio2+"&precio3="+precio3+"&imagen="+imagen+"&venta="+venta);
		}
		else
		{
			ajax.send("accion="+accion+"&id="+id+"&precio="+precio+"&precio2="+precio2+"&precio3="+precio3);		
		}
		
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
							$j('#imagen').uploadify('upload');
							texto = "<strong>Operacion Exitosa</strong> Se ha guardado el registro en la base de datos.";
							msj('valid',texto);
							
							//setTimeout("cargarDiv('left','modulos/renglon/crearArticulo.php');",4000);
							cargarDiv('centro','inventario/'+modulo+'/administrar'+modulo+'.php');	
							
							
						}
						else 
						{
							texto="Error: El servidor fallo, intente más tarde. "+respuesta;
							msj('error',texto);
						}
					}	
					
					if(exis==-1)
					{
						blanquearArticulo();
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
							$j('#imagen').uploadify('upload');
							var texto="<strong>Edicion Exitosa</strong> Se han Editado correctamente los datos.";
							msj('valid',texto);
							//setTimeOut(3000);
							//cargarDiv('medio','formulario/editarTipoHabitacion.php?id='+id);
						}
						else 
						{
							var texto="Error: El servidor fallo al intentar Actualizar el registro, intente más tarde.["+respuesta+"]<br><br>";
							msj('error',texto);
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
						
						//blanquearArticulo();
					}
					else
					{
						var texto="Error: El servidor fallo al intentar Eliminar el registro, intente más tarde.["+respuesta+"]";
						msj('error',texto);
					}
					
					setTimeout('limpiarDivSinCarga("derecha");',5000);
				}
				//AJUSTES DE PRECIOS
				if (accion=="ajustar")
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
						var edit=respuesta.lastIndexOf("Ajustado");
						if(edit!=-1)
						{
							$j('#imagen').uploadify('upload');
							var texto="<strong>Precios Actualizados </strong> .";
							msj('valid',texto);
							//setTimeOut(3000);
							//cargarDiv('medio','formulario/editarTipoHabitacion.php?id='+id);
						}
						else 
						{
							var texto="Error: El servidor fallo al intentar Actualizar el registro, intente más tarde.["+respuesta+"]<br><br>";
							msj('error',texto);
						}
						
						var t = "cargar2Div('derecha','inventario/"+modulo+"/ajustarprecios.php?id="+id+"','centro','inventario/"+modulo+"/administrar"+modulo+"ajuste.php')";
						setTimeout(t,4000);
					}
				}
			}
		}
	}
}