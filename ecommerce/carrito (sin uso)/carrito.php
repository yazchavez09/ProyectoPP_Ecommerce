<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-carrito.css">
    <title>Document</title>
</head>
<body>








    

    <div class="contenedor">
        <div class="producto" data-index="0">
            <img src="Imagenes/conjuntos.jpg" alt="Producto 1">
            <div class="producto-info">
                <h3 class="nombreproducto">CONJUNTO AFA</h3>
                <div class="producto-detalles">
                    <p>COLOR: Negro</p>
                    <p>TALLE: M</p>
                </div>
            </div>
            <div class="contador">
                <button onclick="decrementar(0)">-</button>
                <input type="text" id="cantidad0" value="1" readonly>
                <button onclick="incrementar(0)">+</button>
                <span>unidades</span>
            </div>
            <div class="precio" id="precio0">$10.000</div>
            <div class="eliminar" onclick="eliminarProducto(0)">🗑️</div>
        </div>

        <div class="producto" data-index="1">
            <img src="Imagenes/zapatillas.jpg" alt="Producto 2">
            <div class="producto-info">
                <h3 class="nombreproducto">A. Mcqueen</h3>
                <div class="producto-detalles">
                    <p>COLOR: Negro</p>
                    <p>TALLE: 42</p>
                </div>
            </div>
            <div class="contador">
                <button onclick="decrementar(1)">-</button>
                <input type="text" id="cantidad1" value="3" readonly>
                <button onclick="incrementar(1)">+</button>
                <span>unidades</span>
            </div>
            <div class="precio" id="precio1">$30.000</div>
            <div class="eliminar" onclick="eliminarProducto(1)">🗑️</div>
        </div>

        <div class="producto" data-index="2">
            <img src="Imagenes/remeras.jpg" alt="Producto 3">
            <div class="producto-info">
                <h3 class="nombreproducto">Deportivo ICB negro</h3>
                <div class="producto-detalles">
                    <p>COLOR: Negro</p>
                    <p>TALLE: M</p>
                </div>
            </div>
            <div class="contador">
                <button onclick="decrementar(2)">-</button>
                <input type="text" id="cantidad2" value="3" readonly>
                <button onclick="incrementar(2)">+</button>
                <span>unidades</span>
            </div>
            <div class="precio" id="precio2">$30.000</div>
            <div class="eliminar" onclick="eliminarProducto(2)">🗑️</div>
        </div>

        <h2 class="total">Total: <span id="total">$70.000</span></h2>
        <button class="realizar-pago">Realizar pago</button>
    </div>

    <script>
        let precios = [10000, 10000, 10000];
        let cantidades = [1, 3, 3];

        function incrementar(index) {
            cantidades[index]++;
            actualizar(index);
        }

        function decrementar(index) {
            if (cantidades[index] > 1) {
                cantidades[index]--;
                actualizar(index);
            }
        }

        function eliminarProducto(index) {
            const producto = document.querySelector(`.producto[data-index="${index}"]`);
            producto.remove();
            precios[index] = 0;
            cantidades[index] = 0;
            actualizarTotal();
        }

        function actualizar(index) {
            document.getElementById('cantidad' + index).value = cantidades[index];
            document.getElementById('precio' + index).textContent = '$' + (precios[index] * cantidades[index]).toLocaleString();
            actualizarTotal();
        }

        function actualizarTotal() {
            let total = cantidades.reduce((acc, cantidad, index) => acc + cantidad * precios[index], 0);
            document.getElementById('total').textContent = '$' + total.toLocaleString();
        }
    </script>
    
</body>
</html>