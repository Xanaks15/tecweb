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
                    
                    productos.forEach(producto => {

                        let template = '';
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

        /*  VALIDAR EL OBJETO JSON ANTES DE ENVIARLO
        if (!validarJson(finalJSON)) {
            //   Si la validación falla, detener el proceso de envío
            return;
        }*/

        // SE OBTIENE EL STRING DEL JSON FINAL
        
        productoJsonString = JSON.stringify(finalJSON, null, 2);
        console.log(productoJsonString);
        // Asignar el ID al objeto JSON
        let url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';
        $.post(url,productoJsonString, function(response){
            // console.log(response);
            fetchProduct();
            $('product-form').trigger('reset');
        });
    });

    function fetchProduct(){
        $.ajax( {
            url:'backend/product-list.php',
            type: 'GET',
            success: function(response){
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
                                <td><ul>${descripcion}</ul></td>
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
            $.get('backend/product-delete.php', {id}, function(response){
                console.log(response);
                fetchProduct();
        })
        } 
    })

    $(document).on('click','.product-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.post('backend/product-single.php', { id }, function(response) {
    const producto = JSON.parse(response);

    // Asignar solo el nombre al campo de nombre
    $('#name').val(producto.Nombre);

    // Crear un objeto excluyendo el nombre
    const productoSinNombre = {
        Precio: producto.Precio,
        Unidades: producto.Unidades,
        Modelo: producto.Modelo,
        Marca: producto.Marca,
        Detalles: producto.Detalles
    };

    // Asignar el resto del objeto a la descripción
    $('#description').val(JSON.stringify(productoSinNombre, null, 2));
    $('#productId').val(producto.id)
    edit = true;
});

    })

});

function validarJson(finalJSON) {
    // Validar marca
    const marcasValidas = ['Apple', 'Samsung', 'Amazon', 'Sony', 'Xiaomi'];
    if (!finalJSON.marca || finalJSON.marca.length == 0) {
        alert('Selecciona una marca');
        return false;
    }
    if (!marcasValidas.includes(finalJSON.marca)) {
        alert('Marca no válida, selecciona una válida (Apple, Samsung, Amazon, Sony, Xiaomi)');
        return false;
    }

    // Validar modelo
    if (!finalJSON.modelo || finalJSON.modelo.length == 0) {
        alert('Ingresa un modelo');
        return false;
    }
    if (!/^[a-zA-Z0-9 ]+$/.test(finalJSON.modelo) || finalJSON.modelo.length > 25) {
        alert('El modelo debe ser alfanumérico y menor a 25 caracteres');
        return false;
    }

    // Validar precio
    if (!finalJSON.precio || finalJSON.precio.length == 0) {
        alert('Ingresa el precio');
        return false;
    }
    if (finalJSON.precio < 99.99) {
        alert('El precio debe ser mayor a $99.99');
        return false;
    }

    // Validar detalles
    if (finalJSON.detalles && finalJSON.detalles.length > 250) {
        alert('Los detalles deben tener máximo 250 caracteres');
        return false;
    }

    // Validar unidades
    if (finalJSON.unidades == null || finalJSON.unidades < 0) {
        alert('Cantidad mínima de unidades es 0');
        return false;
    }

    // Validar imagen
    if (!finalJSON.imagen || finalJSON.imagen.length == 0) {
        finalJSON.imagen = 'img/default.png';  // Asignar una imagen por defecto
    }

    // Si pasa todas las validaciones
    return true;
}
