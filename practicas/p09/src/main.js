function checkName(){
    var nombre = document.getElementById('form-nombre').value;
    if(nombre.length == 0){
        alert('Ingresa un nombre');
        return false;
    }
    else{
        if(nombre.length > 100){
            alert('El nombre debe tener maximo 100 caracteres');
            document.getElementById('nombre').value = '';
            return false;
        }
    return true;
    }
}

function checkMarca(){
    var marca = document.getElementById('marca').value;
    if(marca.length == 0){
        alert('Selecciona una marca');
        return false;
    } 
    else{
        switch(marca) {
            case 'Apple':
            case 'Samsung': 
            case 'Amazon': 
            case 'Sony':
            case 'Xiaomi':
                return true;
                val[2]=0
            default:
                checkMarca();
                return false;
        }
    }
}

function checkModel(){
    var modelo = document.getElementById('modelo').value;
    if(modelo.length == 0){
        alert('Ingresa un modelo');
        return false;
    }
    else{
        /*Validad que el campo sea alfanumerico y menor a 25 caracateres*/
        if(!/^[a-zA-Z0-9]+$/.test(modelo) || modelo.length > 25){
            alert('El modelo debe ser alfanumerico y menor a 25 caracteres');
            document.getElementById('modelo').value = '';
            return false;
        }
    }
    return true; 
}

function checkPrice(){
    var precio = document.getElementById('precio').value;
    if(precio.length == 0){
        alert('Ingresa el precio');
        return false;

    }
    else{
        if(precio < 99.99){
            alert('El precio debe ser mayor a $99.99');
            document.getElementById('precio').value = '';
            return false;
        }
    }
    return true;
}

function checkDetalles(){
    var detalles = document.getElementById('detalles').value;
    if(detalles.length > 0){
        if(detalles.length > 250){
            alert('Los etalles deben tener maximo 250 caracteres');
            document.getElementById('detalles').value = '';
            return false;
        }
    }
    return true;
}

function checkUnidades(){
    var unidades = document.getElementById('unidades').value;
    if(unidades.length == 0){
        while(unidades.length == 0){
            alert('Ingresa la cantidad de unidades');
            return false;
        }
    }
    else{
        if(unidades < 0){
            alert('Cantidad minima 0');
            document.getElementById('unidades').value = '';
            return false;
        }
    }
    return true;
}

function checkImg(){
    var imagen = document.getElementById('imagen').value;
    if(imagen.length == 0){
        document.getElementById('imagen').value = 'img/pre.png';
        return true;
        val[7]=0
    }
    else{
        if(imagen.length > 0){
            if(!/^img\/\w+\.(jpg|png)$/.test(imagen)){
                alert('URL no valida. Debe ser en el formato img/nombre.(jpg o png)');
                document.getElementById('imagen').value = '';
                return false;
            }
        }
    }
    return true;
}

function checkForm(){
    var check = [checkName(),checkMarca(),checkModel(),checkPrice(),checkDetalles(),checkUnidades(),checkImg()];
    if(check.includes(false)){
        return false;
    }
    else{
        return true;
    }
}