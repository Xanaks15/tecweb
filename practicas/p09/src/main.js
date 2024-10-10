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
        if(modelo){
        }  
}