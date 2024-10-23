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

    // buscarProducto
    $('#product-result').hide();

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

        $.post('backend/product-add.php',productoJsonString, function(response){
            console.log(response);
            $('product-form').trigger('reset');
        });
    });
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
