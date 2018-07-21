    function validarusuario(){
            var cedula          = document.getElementById("cedula").value;
            var nombre          = document.getElementById("nombre").value;
            var apellido        = document.getElementById("apellido").value;
            var fechanacimiento = document.getElementById("fechanacimiento").value;
            var tipousuario     = document.getElementById("tipousuario").selectedIndex;
            var usuario         = document.getElementById("usuario").value;
            var contrasena      = document.getElementById("contrasena").value;
            if (validaru) {

            if(isNaN(cedula)){
                alert('[ERROR] la cédula debe solo contener número');
                return false;
            } else if( cedula.length < 7 ) {
                alert('[ERROR] La cédula debe contener minimo 7 digitos...');
                return false;
            } else if ( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) || !isNaN(nombre) ) {
                alert('[ERROR] Debe ingresar un nombre valido');
                return false;
            } else if ( apellido == null || apellido.length == 0 || /^\s+$/.test(apellido) || !isNaN(apellido)) {
                alert('[ERROR] Debe ingresar un apellido valido');
                return false;
            } else if ( fechanacimiento == null || fechanacimiento.length == 0 || /^\s+$/.test(fechanacimiento)) {
                alert('[ERROR] Debe ingresar una fecha de nacimiento...');
                return false;
            } else if ( tipousuario == null || tipousuario == 0 ) {
                alert('[ERROR] Debe seleccionar un tipo de usuario...');
                return false;
            } else if ( usuario == null || usuario.length == 0 || /^\s+$/.test(usuario) || !isNaN(usuario)) {
                alert('[ERROR] Debe ingresar un nombre de usuario valido');
                return false;
            } else if( contrasena == null || contrasena.length <= 5 ) {
                alert('[ERROR] Debe ingresar una contraseña mayor a 5 caracteres que sea valida...');
                return false;
            }
            return true;
            }
            return true;
}
    function validacionmat() {
            var tipm      = document.forms["form-material"]["tipomaterial"].selectedIndex;
            var modelo    = document.forms["form-material"]["modelo"].selectedIndex;
            var codigo    = document.forms["form-material"]["codigo"].value;
            var nombre    = document.forms["form-material"]["nombre"].value;
            var capacidad = document.forms["form-material"]["capacidad"].value;
            var medida    = document.forms["form-material"]["medida"].value;
            var stock     = document.forms["form-material"]["stock"].value;
            if (validarm) {

            if ( tipm == null || tipm == 0 ) {
                alert('[ERROR] El tipo de material es necesario...');
                return
            } else if( modelo == null || modelo == 0 ) {
                alert('[ERROR] Debe seleccionar un modelo del material...');
                return false;
            } else if( isNaN(codigo) || codigo == null || codigo.length == 0){
                alert('[ERROR] Debe Ingresar un codigo valido...');
                return false;
            } else if ( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) || !isNaN(nombre)) {
                alert('[ERROR] Debe ingresar un nombre para el material...');
                return false;
            } else if ( capacidad == null || capacidad.length == 0 || /^\s+$/.test(capacidad) ) {
                alert('[ERROR] Debe ingresar una capacidad para el material...');
                return false;
            } else if ( medida == null || medida.length == 0 || /^\s+$/.test(medida) ) {
                alert('[ERROR] Debe ingresar una medida para el material...');
                return false;
            } else if ( stock == null || stock.length == 0 || /^\s+$/.test(stock) ) {
                alert('[ERROR] El stock es necesario...');
                return false;
            }
            return true;
            }
            return true;
}

    function validarresponsable(){
            var cedula          = document.getElementById("cedula").value; 
            var nombre          = document.getElementById("nombre").value;
            var apellido        = document.getElementById("apellido").value;
            var fechanacimiento = document.getElementById("fechanacimiento").value;
            var codigo          = document.getElementById("codigo").value;
            var status          = document.getElementById("status").value;
            if (validarr) {

            if(isNaN(cedula)){
                alert('[ERROR] la cédula debe solo contener número');
                return false;
            } else if( cedula.length < 7 ) {
                alert('[ERROR] La cédula debe contener minimo 7 digitos...');
                return false;
            } else if ( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) || !isNaN(nombre)) {
                alert('[ERROR] Debe ingresar un nombre valido');
                return false;
            } else if ( apellido == null || apellido.length == 0 || /^\s+$/.test(apellido) || !isNaN(apellido)) {
                alert('[ERROR] Debe ingresar un apellido valido');
                return false;
            } else if ( fechanacimiento == null || fechanacimiento.length == 0 || /^\s+$/.test(fechanacimiento)) {
                alert('[ERROR] Debe ingresar una fecha de nacimiento...');
                return false;
            } else if ( isNaN(codigo) || codigo == null || codigo.length == 0 || /^\s+$/.test(codigo) ) {
                alert('[ERROR] Debe ingresar un codigo valido que solamente contenga solo números.');
                return false;
            } else if ( status == null || status.length == 0 || /^\s+$/.test(status) || !isNaN(status)) {
                alert('[ERROR] Debe ingresar un status valido');
                return false;
            }
            return true;
            }
            return true;
}

    function validacionveh() {
            var codigo = document.forms["form-vehiculo"]["codigo"].value;
            var marca  = document.forms["form-vehiculo"]["marca"].value;
            var modelo = document.getElementById("modelo").value;
            var codinventario = document.getElementById("codinventario").selectedIndex;

            if (validarvehiculo) {
            if ( isNaN(codigo) || codigo == null || codigo.length == 0 ) {
                 // Si no se cumple la condicion...
                 
                alert('[ERROR] El codgo debe contener solo número...');
                return false;
            } else if (marca == null || marca.length == 0 || /^\s+$/.test(marca) || !isNaN(marca)) 
            { 
                // document.getElementById('marca').style.borderbottom = "2px solid red";
                alert('[ERROR] El campo  marca debe tener un valor valido...');
                return false;
            }
            if ( modelo == null || modelo.length == 0 || /^\s+$/.test(modelo) ) 
            {
                // Si no se cumple la condicion...
                alert('[ERROR] El campo modelo debe tener un valor valido...');
                return false;
            } 
            if( codinventario == null || codinventario == 0 ) {
              // Si no se cumple la condicion...
                alert('[ERROR] Debe seleccionar un codigo de inventario...');
                return false;
            }
            return true;
            }
            return true;
}


    function validartipomaterial(){
    var tipomaterial = document.forms["form-tipomaterial"]["tmaterial"].value;
    var unidad = document.forms["form-tipomaterial"]["unidad"].selectedIndex;

    if (validartm) {
        if ( !isNaN(tipomaterial) || tipomaterial == null || tipomaterial.length == 0 || /^\s+$/.test(tipomaterial) ){ 
                // document.getElementById('marca').style.borderbottom = "2px solid red";
                alert('[ERROR] El campo tipo de material debe tener un valor valido...');
                return false;
            }else if (unidad == null || unidad == 0) {
                // Si no se cumple la condicion...
               alert('[ERROR] Debe seleccionar una unidad de medida de...');
                return false;
            } 
            return true;
    }
    return true;
}


    function validarmodelo(){
    var modelo = document.forms["form-modelo"]["modelo"].value;

    if (validarmodel) {
         if ( !isNaN(modelo) || modelo == null || modelo.length == 0 || /^\s+$/.test(modelo) ){ 
                // document.getElementById('marca').style.borderbottom = "2px solid red";
                alert('[ERROR] El campo debe tener un valor valido...');
                return false;
            }
            return true;
    }
    return true;
}

    function validarunidad(){
    var unidad = document.forms["form-unidad"]["unidad"].value;
    if (validarunida) {
         if ( !isNaN(unidad) || unidad == null || unidad.length == 0 || /^\s+$/.test(unidad) ){ 
                // document.getElementById('marca').style.borderbottom = "2px solid red";
                alert('[ERROR] El campo debe tener un valor valido...');
                return false;
            }
            return true;
    }
    return true;
}

    function validarmunicipio(){
    var municipio = document.forms["form-municipio"]["municipio"].value;
    if (validarmu) {
         if ( !isNaN(municipio) || municipio == null || municipio.length == 0 || /^\s+$/.test(municipio) ){ 
                // document.getElementById('marca').style.borderbottom = "2px solid red";
                alert('[ERROR] El campo debe tener un valor valido...');
                return false;
            }
            return true;
    }
    return true;
}

    function validarparroquia(){
    var parroq = document.forms["form-parroquia"]["parroquia"].value;
    var munic = document.forms["form-parroquia"]["municipio"].selectedIndex;
    if (validarparr) {
         if ( !isNaN(parroq) || parroq == null || parroq.length == 0 || /^\s+$/.test(parroq) ){ 
                // document.getElementById('marca').style.borderbottom = "2px solid red";
                alert('[ERROR] El campo debe tener un valor valido...');
                return false;
            } else if ( munic == null || munic == 0 ){
                 alert('[ERROR] debe seleccionar un municipio asociado a la parroquia nueva...');
                return false;
            }
            return true;
    }
    return true;
}

    function validarsector(){
    var sector    = document.forms["form-sector"]["sector"].value;
    var parroquia = document.forms["form-sector"]["parroquia"].selectedIndex;
    if (validarsect) {
         if ( !isNaN(sector) || sector == null || sector.length == 0 || /^\s+$/.test(sector) ){ 
                // document.getElementById('marca').style.borderbottom = "2px solid red";
                alert('[ERROR] El campo sector debe tener un valor valido...');
                return false;
            } else if ( parroquia == null || parroquia == 0 ){
                 alert('[ERROR] debe seleccionar una parroquia asociado al sector nuevo...');
                return false;
            }
            return true;
    }
    return true;
}

    function validartipousuario(){
    var tipousuario = document.forms["form-tipousuario"]["nombre"].value;
    if (validartpous) {
         if ( !isNaN(tipousuario) || tipousuario == null || tipousuario.length == 0 || /^\s+$/.test(tipousuario) ){ 
                // document.getElementById('marca').style.borderbottom = "2px solid red";
                alert('[ERROR] El campo debe tener un valor valido...');
                return false;
            }
            return true;
    }
    return true;
}


// Validaciones campos de procesos ...
function validacionsol() {

sector      = document.forms["form-solicitud"]["sector"].selectedIndex;
direccion   = document.forms["form-solicitud"]["direccion"].value;
observacion = document.forms["form-solicitud"]["observacion"].value;
if (validar) {
    if ( sector == null || sector == 0 ) {
    // Si no se cumple la condicion...
    alert('[ERROR] Debe seleccionar el sector...');
    return false;
    }
    if (direccion == null || direccion.length == 0 || /^\s+$/.test(direccion) ) {
    // Si no se cumple la condicion...
    alert('[ERROR] La dirección es necesaria...');
    return false;
    }
    if (observacion == null || observacion.length == 0 || /^\s+$/.test(observacion) ) {
    // Si no se cumple la condicion...
    alert('[ERROR] La observación es necesaria...');
    return false;
    }
    return true;
}
    return true;
}

function validartrabajo() {

    responsable = document.forms["form-trabajo"]["responsable"].selectedIndex;
    vehiculo    = document.forms["form-trabajo"]["vehiculo"].selectedIndex;
    observacion = document.forms["form-trabajo"]["observacion"].value;
    solicitudes = document.getElementById("solicitud");

    if (validartrab) {
        if ( responsable  == null || responsable == 0 ) {
        // Si no se cumple la condicion...
            alert('[ERROR] Debe seleccionar el responsable...');
            return false;
        } else if(vehiculo  == null || vehiculo == 0 ){
            alert('[ERROR] Debe seleccionar Un vehiculo...');
            return false;
        } else if (observacion == null || observacion.length == 0 || /^\s+$/.test(observacion) ) {
        // Si no se cumple la condicion...
        alert('[ERROR] La Observación es necesaria...');
        return false;
        } else if ( !solicitudes.checked ){
            alert('[ERROR] Es necesario asignar alguna solicitud al responsable....');
            return false;
        }
        return true;
    } else if(procesar){
        puntosreparados = document.forms["form-trabajo"]["ptoreparados"].value;
        if ( puntosreparados  == null) {
            alert('[ERROR] Indique cuantos puntos fueron reparados');
            return false;
        }
        return true;
    }
    return true;
}
function validarreporte1(){
    mes        = document.forms['form-reporte1']['radio'].value;
    meses1     = document.forms['form-reporte1']['meses1'].selectedIndex;
    responsabl = document.forms['form-reporte1']['responsable'].selectedIndex;
    anos       = document.forms['form-reporte1']['anos'].selectedIndex;
    meses2     = document.forms['form-reporte1']['meses2'].selectedIndex;
    anos1      = document.forms['form-reporte1']['anos1'].selectedIndex;
    if(validarreport){
        if(mes < 1 ){
            alert('Oye debes de seleccionar que tipo de reporte quieres.');
            return false;
        }else if(mes == 1 ){
                if(meses1 == null || meses1 == 0){
                    alert('Es necesario que selecciones un mes');
                    return false;
                }else if(anos1 == null || anos1 == 0){
                    alert("Es necesario que seleccione un año");
                    return false;
                }else if(responsabl == null || responsabl == 0){
                    alert("Es necesario que selecciones un reponsable");
                    return false;
                }
                return true;
            }else if(mes == 2 ){
                if(meses2 == null || meses2 == 0){
                alert('Es necesario que selecciones un mes');
                return false;
            }else if(anos == null || anos == 0){
                alert("Es necesario que seleccione un año");
                return false;
            }
            return true;
            }
    }else{
        return true;
    }
    
}