function checkName(campo){
    nombre = campo.value;
    if(nombre.length == 0){
        while(nombre.length ==  0){
            alert('Campo requerido');
            return false;
        }
    }
    else{
        if(nombre.length > 100){
            alert('El campo debe tener maximo 100 caracteres');
            campo.value = '';
            return false;
        }
    return true;
    }
}

function checkMarca(campo){
    marca = campo.value;
    if(marca.length == 0){
        while(marca.length == 0){
        alert('Selecciona una marca');
        return false;
        }
    } 
    else{
        switch(marca) {
            case 'Apple':
            case 'Samsung': 
            case 'Amazon': 
            case 'Sony':
            case 'Xiaomi':
                return true;
            default:
                alert('Marca no valida');
                return false;
        }
    }
}

function checkModel(campo){
    modelo = campo.value;
    if(modelo.length == 0){
        while(modelo.length == 0){
            alert('Campo requerido');
            return false;
        }
    }
    else{
        /*Validad que el campo sea alfanumerico y menor a 25 caracateres*/
        if(!/^[a-zA-Z0-9]+$/.test(modelo) || modelo.length > 25){
            alert('El campo debe ser alfanumerico y menor a 25 caracteres');
            campo.value = '';
            return false;
        }
    }
    return true; 
}

function checkPrice(campo){
    precio = campo.value;
    if(precio.length == 0){
        while(precio.length == 0){
            alert('Campo requerido');
            return false;
        }
    }
    else{
        if(precio < 99.99){
            alert('El campo debe ser mayor a $99.99');
            campo.value = '';
            return false;
        }
    }
    return true;
}

function checkDetalles(campo){
    detalles = campo.value;
    if(detalles.length > 0){
        if(detalles.length > 250){
            alert('El campo debe tener maximo 250 caracteres');
            campo.value = '';
            return false;
        }
    }
    return true;
}

function checkUnidades(campo){
    unidades = campo.value;
    if(unidades.length == 0){
        while(unidades.length == 0){
            alert('Campo requerido');
            return false;
        }
    }
    else{
        if(unidades < 0){
            alert('Cantidad minima 0');
            campo.value = '';
            return false;
        }
    }
    return true;
}

function checkImg(campo){
    imagen = campo.value;
    if(imagen.length == 0){
        campo.value = 'img/pre.png';
        return true;
    }
    else{
        if(imagen.length > 0){
            if(!/^img\/\w+\.(jpg|png)$/.test(imagen)){
                alert('URL no valida. Debe ser en el formato img/nombre.(jpg o png)');
                campo.value = '';
                return false;
            }
        }
    }
}

function checkForm(){
    var form = document.getElementById('form');
    var nombre = document.getElementById('nombre');
    var marca = document.getElementById('marca');
    var modelo = document.getElementById('modelo');
    var precio = document.getElementById('precio');
    var detalles = document.getElementById('detalles');
    var unidades = document.getElementById('unidades');

    if(checkName(nombre) && checkMarca(marca) && checkModel(modelo) && checkPrice(precio) && checkDetalles(detalles) && checkUnidades(unidades)){
        form.submit();
    }
}