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
    
    // Verifica si el campo está vacío
    if (modelo.length == 0) {
        alert('Ingresa un modelo');
        return false;
    } 
    else {
        // Valida que sea alfanumérico y menor a 25 caracteres
        if (!/^[a-zA-Z0-9 ]+$/.test(modelo) || modelo.length > 25) {
            alert('El modelo debe ser alfanumérico y menor a 25 caracteres');
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
    
    /*else{
        if(imagen.length > 0){
            if(!/^img\/\w+\.(jpg|png)$/.test(imagen)){
                alert('URL no valida. Debe ser en el formato img/nombre.(jpg o png)');
                document.getElementById('imagen').value = '';
                return false;
            }
        }
    }*/
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

function show(event) {
    var row = event.target.parentNode.parentNode;

    var id = row.cells[0].innerHTML;
    var nombre = row.cells[1].innerHTML;
    var marca = row.cells[2].innerHTML;
    var modelo = row.cells[3].innerHTML;
    var precio = row.cells[4].innerHTML;
    var unidades = row.cells[5].innerHTML;
    var detalles = row.cells[6].innerHTML;
    var imagen = row.cells[7].querySelector('img').src;

    alert("Id: "+ id +"\nNombre: " + nombre + "\nMarca: " + marca + "\nModelo: " + modelo + "\nPrecio: " + precio + "\nDetalles: " + detalles + "\nUnidades: " + unidades + "\nImagen: " + imagen);

    send2form(id,nombre, marca, modelo, precio, unidades, detalles, imagen);
}

function send2form(id, nombre, marca, modelo, precio, unidades, detalles, imagen) {
        var form = document.createElement("form");
        
        var idIn = document.createElement("input");
        idIn.type = 'hidden';
        idIn.name = 'id';
        idIn.value = id;
        form.appendChild(idIn);

        var nombreIn = document.createElement("input");
        nombreIn.type = 'hidden';
        nombreIn.name = 'nombre';
        nombreIn.value = nombre;
        form.appendChild(nombreIn);

        var marcaIn = document.createElement("input");
        marcaIn.type = 'hidden';
        marcaIn.name = 'marca';
        marcaIn.value = marca;
        form.appendChild(marcaIn);

        var modeloIn = document.createElement("input");
        modeloIn.type = 'hidden';
        modeloIn.name = 'modelo';
        modeloIn.value = modelo;
        form.appendChild(modeloIn);

        var precioIn = document.createElement("input");
        precioIn.type = 'hidden';
        precioIn.name = 'precio';
        precioIn.value = precio;
        form.appendChild(precioIn);

        var unidadesIn = document.createElement("input");
        unidadesIn.type = 'hidden';
        unidadesIn.name = 'unidades';
        unidadesIn.value = unidades;
        form.appendChild(unidadesIn);

        var detallesIn = document.createElement("input");
        detallesIn.type = 'hidden';
        detallesIn.name = 'detalles';
        detallesIn.value = detalles;
        form.appendChild(detallesIn);

        var imagenIn = document.createElement("input");
        imagenIn.type = 'hidden';
        imagenIn.name = 'imagen';
        imagenIn.value = imagen;
        form.appendChild(imagenIn);

        form.method = 'POST';
        form.action = 'http://localhost/tecweb/practicas/p09/formulario_productos_v2.php';

        // Añadir el formulario al cuerpo del documento y enviarlo
        document.body.appendChild(form);
        form.submit();
    }
