
document.write("<script type='text/javascript' src='jquery/funciones.js'></script>");

function limpiaFormUsuario()
{
	for(i=0; i<=3; i++)
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

function blanquearUsuario()
{
	for(i=0; i<=3; i++)
	{
		form.elements[i].value="";
	}
	//document.getElementById("descripcion").value="";
}


function validaUsu(modulo,accion,id)
{
	
	cargarDatos(); 
	//limpiaFormUsuario();
	escondeError();
	error=0;
	
	var nomb=eliminaEspacios(form.nombre.value);
	var clave=eliminaEspacios(form.clave.value);
	var clave2=eliminaEspacios(form.clave2.value);
	
	
	
	if(!validaLongitud(nomb, 0, 3, 50)) muestraError(form.nombre.id);
	if(!validaLongitud(clave, 0, 1, 20)) muestraError(form.clave.id);
	if(!validaLongitud(clave2, 0, 1, 20)) muestraError(form.clave2.id);
	
	if(clave!=clave2)
	{
		error=1;	
		 muestraError(form.clave.id);
		 muestraError(form.clave2.id);
	}
	
	if(error==1)
	{
		if(clave!=clave2)
		{
			msj('error','Repita la clave para confirmarla. Deben ser iguales.');
		}
		
	}
	else
	{
		//$j("#message_sent").html(" <img src='images/cargando.gif' alt='Enviando...' class='cargaMsj' /> Enviando...").slideDown(500);
		msj('cargando','Cargando...');
		var ajax=nuevoAjax();
		ajax.open("POST", "administracion/"+modulo+"/guardar"+modulo+".php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("accion="+accion+"&id="+id+"&nombre="+nomb+"&clave="+clave);
		
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
							
							//setTimeout("cargarDiv('left','modulos/renglon/crearUsuario.php');",4000);
							cargarDiv('centro','administracion/'+modulo+'/administrar'+modulo+'.php');	
							
							
						}
						else 
						{
							texto="Error: El servidor fallo, intente más tarde. "+respuesta;
							msj('error',texto);
						}
					}	
					
					if(exis==-1)
					{
						blanquearUsuario();
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
						
						//blanquearUsuario();
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