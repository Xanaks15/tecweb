
$(document).ready(function() {
    let edit = false;
    // buscarProducto
    $('#product-result').hide();
    fetchProduct();
    $('#search').keyup(function() {
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url: 'backend/product-search.php',
                type: 'GET',
                data: {search},
                success: function(response){
                    console.log(response);
                    let productos = JSON.parse(response);
                    let template = '';
                    let template_bar = '';
                    productos.forEach(producto => {

                        
                        template_bar += `

                        <li>${producto.nombre}</il>
                        `;

                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                            
                        `;
                    
                    });
                    $('#product-result').show();
                    $('#container').html(template_bar);
                    $('#products').html(template);
                }
            })
        }else {
            // Si el campo de búsqueda está vacío, restablecer la página al estado inicial
            fetchProduct();  // Llama a la función para obtener la lista completa de productos
            resetForm();     // Resetea el formulario
            $('#product-result').hide();  // Oculta el contenedor de resultados
        }
    });

    //checar si ya existe el nombre en la base de datos
    $('#product-result').hide(); 

    $('#name').keyup(function() {
        let nombre = $('#name').val();
        if(nombre){
            
            $.ajax({
                url: 'backend/product-singleByName.php',
                type: 'GET',
                data: {nombre},
                success: function(response){
                    // console.log(response);
                    console.log(response);
                    let template_bar = "Ya existe un producto con ese nombre";
                    $('#product-result').show();
                    $('#container').html(template_bar);
                    fetchProduct();
                }
                
            })
        }else {
            fetchProduct();  // Llama a la función para obtener la lista completa de productos
            resetForm();     // Resetea el formulario
            $('#product-result').hide();  // Oculta el contenedor de resultados
        }
    });
    // agregarProducto

    $('#product-form').submit(function(e){
        e.preventDefault();
        let nombre = $('#name').val();
        let descripcion = $('#description').val();
        
        let url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';
        $.ajax({
            url: url,
            type: 'POST',
            data: JSON.stringify(finalJSON), // Convertir el objeto JSON a string
            contentType: 'application/json; charset=utf-8', // Enviar como JSON
            success: function(response) {
                // console.log(finalJSON);  // Mostrar el JSON enviado
                console.log(response);  // Mostrar la respuesta del servidor
                fetchProduct();  // Actualizar la lista de productos
                  // Resetear el formulario correctamente
                resetForm();
                edit = false;  // Reiniciar el modo de edición
                $('#agregar').text('Agregar Producto');
                let template_bar = '';
                let respuesta = JSON.parse(response);
                console.log(respuesta);
                template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                $('#product-result').show();
                $('#container').html(template_bar);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud:', textStatus, errorThrown);  // Manejo de errores
            }
        });
    });

    function fetchProduct(){
        $.ajax( {
            url:'backend/product-list.php',
            type: 'GET',
            success: function(response){
                // console.log(response);
                let productos = JSON.parse(response);
                let template = ``;
    
                productos.forEach(producto =>{
                    let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>
                                    <a href="#" class="product-item">${producto.nombre}</a>
                                </td>
                                <td><ul>${descripcion}<t/ul></td>
                            
                                <td>
                                    <button class="product-edit btn btn-light">
                                        Editar
                                    </button>
                                </td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;

                        
                        
                })
                $('#products').html(template);
    
            }
        });
    }

    $(document).on('click','.product-delete', function(){
        if(confirm('Estas seguro de querer eliminar el producto?')){
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productId');
            console.log(id);
            $.get('backend/product-delete.php', {id}, function(response){
                let template_bar = '';
                let respuesta = JSON.parse(response);
                console.log(id);
                template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                $('#product-result').show();
                $('#container').html(template_bar);
                fetchProduct();
        })
        } 
    })

    $(document).on('click', '.product-edit', function() {
        let id = $(this)[0].parentElement.parentElement.getAttribute('productid');
        console.log(id);
        $.post('./backend/product-single.php', {id}, function(response){
            const product = JSON.parse(response);
            
            $('#name').val(product[0].nombre);
            $('#productId').val(product[0].id);
            let productWithoutNameAndId = {...product[0]};
            delete productWithoutNameAndId.nombre;
            delete productWithoutNameAndId.id;
            delete productWithoutNameAndId.eliminado;
            $('#description').val(JSON.stringify(productWithoutNameAndId, null, 4));
            edit = true;
            //Cambiar texto a boton btn prymari*/
            console.log;
            $('#agregar').text('Guardar cambios');

        })
    });

});

function checkName(){
    var nombre = document.getElementById('name').value;
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

function resetForm() {
    document.getElementById('product-form').reset();
}