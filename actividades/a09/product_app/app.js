
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
                    // console.log(response);
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
            $('#product-result').hide();  // Oculta el contenedor de resultados
        }
    });

    //checar si ya existe el nombre en la base de datos
    $('#product-result').hide(); 
    $('#name').keyup(function() {
        let nombre = $('#name').val();
        // console.log(nombre);
        if(nombre){    
            $.ajax({
                url: 'backend/product-searchByName.php',
                type: 'GET',
                data: {nombre},
                success: function(response){
                     console.log(response);
                    let template_bar = '';
                    let respuesta = JSON.parse(response);
                    if (respuesta.status === 'success') { // Solo muestra el mensaje si encuentra un producto
                        template_bar += `
                            <li style="list-style: none;">${respuesta.message}</li>
                        `;
                        $('#name-alert').show();
                        $('#name-alert').html(template_bar);
                    }else{
                        $('#name-alert').hide();
                    } 
                    fetchProduct();
                }
                
            })
        }else {
            fetchProduct();  // Llama a la función para obtener la lista completa de productos
            $('#name-alert').hide();  // Oculta el contenedor de resultados
        }
    });


    // agregarProducto

    $('#product-form').submit(function(e){
        e.preventDefault();
        const postData = {
            id:$('#productId').val(),
            nombre:$('#name').val(),
            marca:$('#form-marca').val(),
            modelo:$('#form-modelo').val(),
            precio:$('#form-precio').val(),
            detalles:$('#form-detalles').val(),
            unidades:$('#form-unidades').val(),
            imagen:$('#form-imagen').val(),
        };
        // console.log(postData);
        let url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';
        if (!checkForm()) {
            //   Si la validación falla, detener el proceso de envío
            return;
        }
        $.ajax({
            url: url,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(postData),
            success: function(response) {
                // console.log(postData);
                // console.log(response);  // Mostrar la respuesta del servidor
                fetchProduct();  // Actualizar la lista de productos
                resetForm();
                edit = false;  // Reiniciar el modo de edición
                $('#agregar').text('Agregar Producto');
                let template_bar = '';
                let respuesta = JSON.parse(response);
                // console.log(respuesta);
                template_bar += `
                        <li style="list-style: none;">${respuesta.status}</li>
                        <li style="list-style: none;">${respuesta.message}</li>
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
            // console.log(id);
            $.get('backend/product-delete.php', {id}, function(response){
                let template_bar = '';
                let respuesta = JSON.parse(response);
                // console.log(id);
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
        // console.log(id);
        $.post('./backend/product-single.php', {id}, function(response){
            const product = JSON.parse(response);
            $('#productId').val(product[0].id);
            // console.log(id);
            $('#name').val(product[0].nombre);
            $('#form-marca').val(product[0].marca);
            $('#form-modelo').val(product[0].modelo);
            $('#form-precio').val(product[0].precio);
            $('#form-detalles').val(product[0].detalles);
            $('#form-unidades').val(product[0].unidades);
            $('#form-imagen').val(product[0].imagen);
            edit = true;
            //Cambiar texto a boton btn prymari*/
            $('#agregar').text('Guardar cambios');

        })
    });

});

function checkName(){
    var nombre = document.getElementById('name').value;
    if(nombre.length == 0){
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">Ingresa un nombre</li>
            `;
            $('#name-alert').show();
            $('#name-alert').html(template_bar);
        return false;
    }
    if($('#name').val()){
        if(nombre.length > 100){
            let template_bar = '';
            template_bar += `
            <li style="list-style: none;">El nombre debe tener máximo 50 caracteres</li>
            `;
            $('#name-alert').show();
            $('#name-alert').html(template_bar);
            return false;
        }
        return true;
    }
    
    
}

function checkMarca(){
    var marca = document.getElementById('form-marca').value;
    if(marca.length === 0){
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">Selecciona una marca</li>
            `;
            $('#marca-alert').show();
            $('#marca-alert').html(template_bar);
        return false;
    } 
    else{
        switch(marca) {
            case 'Apple': $('#marca-alert').hide();
            case 'Samsung': $('#marca-alert').hide();
            case 'Amazon': $('#marca-alert').hide();
            case 'Sony':$('#marca-alert').hide();
            case 'Xiaomi':$('#marca-alert').hide();
                return true;
            default:
                $('#marca-alert').show();
                $('#marca-alert').html(template_bar);
                return false;
        }
    }
}

function checkModel(){
    var modelo = document.getElementById('form-modelo').value;
    
    // Verifica si el campo está vacío
    if (modelo.length == 0) {
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">Ingresa un modelo</li>
            `;
            $('#modelo-alert').show();
            $('#modelo-alert').html(template_bar);
        return false;
    } 
    else {
        // Valida que sea alfanumérico y menor a 25 caracteres
        $('#modelo-alert').hide();
        if($('#marca-alert').val()){
            $('#modelo-alert').hide();
            if (!/^-[a-zA-Z0-9 ]+$/.test(modelo) || modelo.length > 25) {
                let template_bar = '';
                template_bar += `
                <li style="list-style: none;">El modelo debe ser alfanumérico y menor a 25 caracteres</li>
                `;
                $('#modelo-alert').show();
                $('#modelo-alert').html(template_bar);
                return false;
            }
        }
    }  
    return true; 
}


function checkPrice(){
    var precio = document.getElementById('form-precio').value;
    if(precio.length == 0){
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">Ingresa el precio</li>
            `;
            $('#precio-alert').show();
            $('#precio-alert').html(template_bar);
        return false;

    }
    else{
        $('#precio-alert').hide();
        if(precio < 99.99){
            let template_bar = '';
            template_bar += `
            <li style="list-style: none;">El precio debe ser mayor a $99.99</li>
            `;
            $('#precio-alert').show();
            $('#precio-alert').html(template_bar);
            document.getElementById('precio').value = '';
            return false;
        }
    }
    return true;
}

function checkDetalles(){
    var detalles = document.getElementById('form-detalles').value;
    if(detalles.length > 0){
        if(detalles.length > 250){
            let template_bar = '';
            template_bar += `
            <li style="list-style: none;">Los detalles deben tener máximo 250 caracteres</li>
            `;
            $('#detalles-alert').show();
            $('#detalles-alert').html(template_bar);
            document.getElementById('detalles').value = '';
            return false;
        }
    }
    return true;
}

function checkUnidades(){
    var unidades = document.getElementById('form-unidades').value;
    if(unidades < 0 || unidades.length ===0){
        let template_bar = '';
        template_bar += `
        <li style="list-style: none;">Cantidad mínima de unidades es 0</li>
        `;
        $('#unidades-alert').show();
        $('#unidades-alert').html(template_bar);
        return false;
    }
    if($('#form-unidades').val()){
        $('#unidades-alert').hide();
        return true;
    }
    return true;
    
}

function checkImg(){
    var imagen = document.getElementById('form-imagen').value;
    if(imagen.length == 0){
        document.getElementById('form-imagen').value = 'img/default.png';
        return true;
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

function resetForm(){
    document.getElementById('name').value='';
    document.getElementById('form-marca').value='';
    document.getElementById('form-modelo').value='';
    document.getElementById('form-detalles').value='';
    document.getElementById('form-unidades').value='';
    document.getElementById('form-imagen').value='';
}