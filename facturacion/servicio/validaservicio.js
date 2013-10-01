
document.write("<script type='text/javascript' src='jquery/funciones.js'></script>");

function limpiaFormServicio()
{
	for(i=0; i<=6; i++)
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

function blanquearServicio()
{
	for(i=0; i<=6; i++)
	{
		form.elements[i].value="";
	}
	//document.getElementById("descripcion").value="";
}


function validaPla(modulo,accion,id)
{
	
	cargarDatos(); 
	//limpiaFormServicio();
	escondeError();
	error=0;
	
	var nomb=eliminaEspacios(form.nombre.value);
	var tiposervicioId=eliminaEspacios(form.lista_tiposervicio.value);
	var precio=eliminaEspacios(form.precio.value);
	var precio2=eliminaEspacios(form.precio2.value);
	var precio3=eliminaEspacios(form.precio3.value);
	var imagen=eliminaEspacios(form.imgservicio.value);
	var desc=eliminaEspacios(form.desc.value);
		
	if(!validaLongitud(nomb, 0, 3, 500)) muestraError(form.nombre.id);
	if(!validaLongitud(tiposervicioId, 0, 1, 5)) muestraError(form.lista_tiposervicio.id);
	
	if(!validaLongitud(precio, 0, 1, 10)) muestraError(form.precio.id);
	if(!validaNumero(precio)) muestraError(form.precio.id);
	if(!validaLongitud(precio2, 0, 1, 10)) muestraError(form.precio2.id);
	if(!validaNumero(precio2)) muestraError(form.precio2.id);
	if(!validaLongitud(precio3, 0, 1, 10)) muestraError(form.precio3.id);
	if(!validaNumero(precio3)) muestraError(form.precio3.id);
		
	if(!validaLongitud(imagen, 1, 1, 200)) muestraError(form.imgservicio.id);
	if(!validaLongitud(desc, 1, 3, 500)) muestraError(form.desc.id);
	
	
	
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
		ajax.send("accion="+accion+"&id="+id+"&nomb="+nomb+"&tiposervicioId="+tiposervicioId+"&precio="+precio+"&precio2="+precio2+"&precio3="+precio3+"&imagen="+imagen+"&desc="+desc);
		
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
							
							//setTimeout("cargarDiv('left','modulos/renglon/crearServicio.php');",4000);
							cargarDiv('centro','facturacion/'+modulo+'/administrar'+modulo+'.php');	
							
							
						}
						else 
						{
							texto="Error: El servidor fallo, intente más tarde. "+respuesta;
							msj('error',texto);
						}
					}	
					
					if(exis==-1)
					{
						blanquearServicio();
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
						
						//blanquearServicio();
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