// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
    // fetchProduct();
}
 

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
            resetForm();     // Resetea el formulario
            $('#product-result').hide();  // Oculta el contenedor de resultados
        }
    });

    // agregarProducto

    $('#product-form').submit(function(e){
        e.preventDefault();
        // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
        var productoJsonString = document.getElementById('description').value;
    
        // SE CONVIERTE EL JSON DE STRING A OBJETO
        var finalJSON = JSON.parse(productoJsonString);
        
        // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
        finalJSON['nombre'] = document.getElementById('name').value;
        // Asignar el ID al objeto JSON
        finalJSON['id'] = document.getElementById('productId').value;
         //VALIDAR EL OBJETO JSON ANTES DE ENVIARLO
        if (!validarJson(finalJSON)) {
        //     //   Si la validación falla, detener el proceso de envío
            return;
        }
        productoJsonString = JSON.stringify(finalJSON, null, 2);
        
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

function validarJson(finalJSON) {

    // Validar nombre
    if (!finalJSON.nombre || finalJSON.nombre.length == 0 ) {
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message: Ingresa un nombre</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false;
    }else if (finalJSON.nombre.length > 50) {
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message: El nombre debe tener máximo 50 caracteres</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false	
    }
    // Validar marca
    const marcasValidas = ['Apple', 'Samsung', 'Amazon', 'Sony', 'Xiaomi'];
    if (!finalJSON.marca || finalJSON.marca.length == 0) {
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message: Selecciona una marca</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false;
    }
    if (!marcasValidas.includes(finalJSON.marca)) {
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message: Marca no válida, selecciona una válida (Apple, Samsung, Amazon, Sony, Xiaomi)</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false;
    }

    // Validar modelo
    if (!finalJSON.modelo || finalJSON.modelo.length == 0) {
        
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message: Ingresa un modelo</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false;
    }
    if (!-/^[a-zA-Z0-9-]+$/.test(finalJSON.modelo) || finalJSON.modelo.length > 25) {
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message: El modelo debe ser alfanumérico y menor a 25 caracteres</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false;
    }

    // Validar precio
    if (!finalJSON.precio || finalJSON.precio.length == 0) {
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message:Ingresa el precio</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false;
    }
    if (finalJSON.precio < 99.99) {
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message: El precio debe ser mayor a $99.99</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false;
    }

    // Validar detalles
    if (finalJSON.detalles && finalJSON.detalles.length > 250) {
        
        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message: Los detalles deben tener máximo 250 caracteres</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false;
    }

    // Validar unidades
    if (finalJSON.unidades == null || finalJSON.unidades < 0) {

        let template_bar = '';
        template_bar += `
            <li style="list-style: none;">message: Cantidad mínima de unidades es 0</li>
            `;
            $('#product-result').show();
            $('#container').html(template_bar);
        return false;
    }

    // Validar imagen
    if (!finalJSON.imagen || finalJSON.imagen.length == 0) {
        finalJSON.imagen = 'img/default.png';  // Asignar una imagen por defecto
    }

    // Si pasa todas las validaciones
    return true;
}


function resetForm() {
    // Limpiar todos los campos del formulario
    $('#product-form').trigger('reset');
    
    // Volver a cargar el JSON base en el campo 'description'
    $('#description').val(JSON.stringify(baseJSON, null, 2));  // Usar el JSON base

    // Limpiar el campo del ID del producto
    $('#productId').val('');
}

