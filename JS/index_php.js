// JavaScript para la página de productos

// Función para agregar un producto al carrito
function agregarAlCarrito(event) {
    // Obtener el producto seleccionado
    const producto = event.target.parentElement;
    const id = producto.querySelector('.agregar-carrito').getAttribute('data-id');
    const nombre = producto.querySelector('h3').textContent;
    const precio = parseFloat(producto.querySelector('p').textContent.replace('Precio: $', ''));

    // Crear un nuevo elemento de lista para el carrito
    const itemCarrito = document.createElement('li');
    itemCarrito.innerHTML = `${nombre} - $${precio}`;

    // Agregar el nuevo elemento al carrito
    const listaProductos = document.querySelector('.lista-productos');
    listaProductos.appendChild(itemCarrito);

    // Actualizar el total
    const totalElement = document.querySelector('.total');
    const total = parseFloat(totalElement.textContent);
    totalElement.textContent = (total + precio).toFixed(2);
}

// Función para vaciar el carrito
function vaciarCarrito() {
    const listaProductos = document.querySelector('.lista-productos');
    listaProductos.innerHTML = '';
    document.querySelector('.total').textContent = '0.00';
}

// Event listeners
document.querySelectorAll('.agregar-carrito').forEach(button => {
    button.addEventListener('click', agregarAlCarrito);
});

document.querySelector('.vaciar-carrito').addEventListener('click', vaciarCarrito);
