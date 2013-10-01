
document.write("<script type='text/javascript' src='jquery/funciones.js'></script>");

function limpiaFormMarca()
{
	for(i=0; i<=2; i++)
	{
		form.elements[i].className=claseNormal;
	}
	//document.getElementById("descripcion").className=claseNormal;
}

function escondeError()
{
	$j("input, textarea").each(function () {
		id = $j(this).attr("id");								  	
		$j("#"+id+"-error").hide();															
	});
}

function blanquearMarca()
{
	for(i=0; i<=2; i++)
	{
		form.elements[i].value="";
	}
	//document.getElementById("descripcion").value="";
}


function validaTalla(modulo,accion,id)
{
	
	cargarDatos(); 
	//limpiaFormMarca();
	escondeError();
	error=0;
	
	var nomb=eliminaEspacios(form.nombre.value);
	var tipoArticulo=eliminaEspacios(form.lista_tipoarticulo.value);
	
	
	
	if(!validaLongitud(nomb, 0, 1, 50)) muestraError(form.nombre.id);
	if(!validaLongitud(tipoArticulo, 0, 1, 5)) muestraError(form.lista_tipoarticulo.id);
	
	
	
	if(error==1)
	{
		
	}
	else
	{
		//$j("#message_sent").html(" <img src='images/cargando.gif' alt='Enviando...' class='cargaMsj' /> Enviando...").slideDown(500);
		msj('cargando','Cargando...');
		var ajax=nuevoAjax();
		ajax.open("POST", "administracion/"+modulo+"/guardar"+modulo+".php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("accion="+accion+"&id="+id+"&nombre="+nomb+"&tipoArticulo="+tipoArticulo);
		
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
//				alert(respuesta);
				if (accion=="guardar")
				{	
					//respuesta.lastIndexOf("Existe"); busca el string "Existe" en respuesta y devuelve el indice de la ultima ocurrencia donde lo encuentra 
					// si no lo encuentra retorna -1
					var exis=respuesta.lastIndexOf("Existe");
					if(exis!=-1)
					{
						muestraError(form.nombre.id);
						//$j("#message_sent").html('El nombre <font color=red>'+nomb+'</font> ya existe, por favor verifiquelo.');
						msj('warning','Esta combinaci&oacute;n de talla y tipo de art&iacute;culo ya existe.')
					}
					else
					{
						var ok=respuesta.lastIndexOf("OK");
						if(ok!=-1)
						{
							texto = "<strong>Operaci&ocaute;n Exitosa</strong> Se ha guardado el registro en la base de datos.";
							msj('valid',texto);
							
							//setTimeout("cargarDiv('left','modulos/renglon/crearMarca.php');",4000);
							cargarDiv('centro','administracion/'+modulo+'/administrar'+modulo+'.php');	
							
							
						}
						else 
						{
							texto="Error: El servidor fallo, intente m�s tarde. "+respuesta;
							msj('error',texto);
						}
					}	
					
					if(exis==-1)
					{
						blanquearMarca();
					}	
				}
				if (accion=="editar")
				{
					var exis=respuesta.lastIndexOf("Existe");
					if(exis!=-1)
					{
						muestraError(form.nombre.id);
						var texto = 'Esta combinaci�n de talla y tipo de art�culo ya existe.';
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
						
						var t = "cargar2Div('derecha','administracion/"+modulo+"/editar"+modulo+".php?id="+id+"','centro','administracion/"+modulo+"/administrar"+modulo+".php')";
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
						cargarDiv('centro','administracion/'+modulo+'/administrar'+modulo+'.php');
						
						//blanquearMarca();
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