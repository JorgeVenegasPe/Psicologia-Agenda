document.addEventListener("DOMContentLoaded", function() {
    // Esperar 5 segundos antes de mostrar las secciones
    setTimeout(function() {
    mostrarSecciones();
    }, 2000);
});

function mostrarSecciones() {
    document.getElementById("section1").style.display = "block";
};

/* ===== Cargar el carrito  ===========*/
document.addEventListener("DOMContentLoaded", function() {
    showHTML();
});


const pagar = document.querySelector('.pagar');
const metpago = document.querySelector('.metodos-pago');
pagar.addEventListener("click", () => {
    metpago.classList.remove("active");
});

/* ===== HEADER ===========*/
const menuBtn = document.querySelector(".nav-menu-btn");
const closeBtn = document.querySelector(".nav-close-btn");
const navigation = document.querySelector(".container-icons");
const navItems = document.querySelectorAll(".icons a");
const mainItems = document.querySelector(".main");

menuBtn.addEventListener("click", () => {
    navigation.classList.add("active");
    mainItems.classList.add("active");
});

closeBtn.addEventListener("click", () => {
    navigation.classList.remove("active");
    mainItems.classList.remove("active");
});

navItems.forEach((navItem) => {
    navItem.addEventListener("click", () => {
        navigation.classList.remove("active");
    });
});




/*===================== CARRITO ====================*/
const btnCart = document.querySelector('.container-cart-icon');
const containerCartProducts = document.querySelector('.container-cart-products');

btnCart.addEventListener('click', () => {
	containerCartProducts.classList.toggle('hidden-cart')
    mainItems.classList.toggle("active");
    if (!allProducts.length) {
		cartEmpty.classList.remove('hidden');
		rowProduct.classList.add('hidden');
		cartTotal.classList.add('hidden');
	}
});

/* ========================= */
const cartInfo = document.querySelector('.cart-product');
const rowProduct = document.querySelector('.row-product');

// Lista de todos los contenedores de productos

// Variable de arreglos de Productos
let allProducts = [];

const valorTotal = document.querySelector('.total-pagar');

const countProducts = document.querySelector('#contador-productos');

const cartEmpty = document.querySelector('.cart-empty');
const cartTotal = document.querySelector('.cart-total');
const DOMbotonVaciar = document.querySelector('#vaciar');
const miLocalStorage = window.localStorage;
const productsList = document.querySelector('.swiper-wrapper');

productsList.addEventListener('click', e => {
    if (e.target.classList.contains('Añadir')) {
        const buttonContainer = e.target.closest('.container-descrip'); // Buscar el contenedor más cercano
        const productContainer = buttonContainer.parentElement;
        const infoProduct = {
            quantity: 1,
            title: productContainer.querySelector('h1').textContent,
            price: productContainer.querySelector('h2').textContent,
            image: productContainer.querySelector('img').src,
            value1: productContainer.querySelector('p:nth-child(3)').textContent, // Agrega el tercer <p>
            value0: productContainer.querySelector('p:nth-child(4)').textContent, // Agrega el cuarto <p>
        };
        

        const exists = allProducts.some(
            product => product.title === infoProduct.title
        );

        if (exists) {
            const updatedProducts = allProducts.map(product => {
                if (product.title === infoProduct.title) {
                    product.quantity++;
                    return product;
                } else {
                    return product;
                }
            });
            allProducts = [...updatedProducts];
        } else {
            allProducts = [...allProducts, infoProduct];
        }

        showHTML();
        guardarCarritoEnLocalStorage();
    }
});
rowProduct.addEventListener('click', e => {
	if (e.target.classList.contains('icon-close')) {
		const product = e.target.parentElement;
		const title = product.querySelector('p').textContent;

		allProducts = allProducts.filter(
			product => product.title !== title
		);

		console.log(allProducts);

		showHTML();
        guardarCarritoEnLocalStorage();
	}
});

// Funcion para mostrar  HTML
const showHTML = () => {
    if (!allProducts.length) {
        cartEmpty.classList.remove('hidden');
        metpago.classList.add('active');
        rowProduct.classList.add('hidden');
        cartTotal.classList.add('hidden');
    } else {
        cartEmpty.classList.add('hidden');
        rowProduct.classList.remove('hidden');
        cartTotal.classList.remove('hidden');
    }

    // Limpiar HTML
    rowProduct.innerHTML = '';

    let total = 0;
    let totalOfProducts = 0;

    allProducts.forEach(product => {
        const containerProduct = document.createElement('div');
        containerProduct.classList.add('cart-product');

        // Calculamos el precio total por producto
        const totalPricePerProduct = parseInt(product.quantity) * parseInt(product.price.slice(3));
        

        containerProduct.innerHTML = `
        <div class="info-cart-product">
            <img src="${product.image}" alt="${product.title}" class="imagen-producto-carrito">
            <span class="cantidad-producto-carrito">${product.quantity}</span>
            <p class="titulo-producto-carrito">${product.title}</p>
            <p class="value1-producto-carrito" style="padding:25px; display:none;">${product.value1}</p> <!-- Muestra $row[1] -->
            <p class="value0-producto-carrito" style="padding:25px; display:none;">${product.value0}</p> <!-- Muestra $row[0] -->
            <span class="precio-producto-carrito">S/${totalPricePerProduct}.00</span>
        </div>
        <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="icon-close">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>`;
    

        rowProduct.append(containerProduct);

        total += totalPricePerProduct;
        totalOfProducts += parseInt(product.quantity);
    });

    valorTotal.innerText = `S/ ${total}.00`;
    countProducts.innerText = totalOfProducts;
};

cargarCarritoDeLocalStorage()
function guardarCarritoEnLocalStorage () {
    miLocalStorage.setItem('carrito', JSON.stringify(allProducts));
    
}

function cargarCarritoDeLocalStorage () {
    // ¿Existe un carrito previo guardado en LocalStorage?
    if (miLocalStorage.getItem('carrito') !== null) {
        // Carga la información
        allProducts = JSON.parse(miLocalStorage.getItem('carrito'));
        console.log(allProducts)
    }
    else{
        //console.log("csdcsdc")
    }
}

function vaciarca() {
    allProducts=[];
    showHTML();
    //borarr lcal
    localStorage.clear();

}

DOMbotonVaciar.addEventListener('click', vaciarca);
// Obtener el valor 'id' de la URL
const urlParams = new URLSearchParams(window.location.search);
const categoria = urlParams.get('id');

// Agregar esta función para redirigir a la página de pago con los productos seleccionados y la categoría
function irAPago() {
    const form = document.createElement('form');
    form.method = 'post';
    form.action = 'pago.php?id=' + categoria; // Incluimos la categoría en la URL

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'productos';
    input.value = JSON.stringify(allProducts);

    const inputValorTotal = document.createElement('input');
    inputValorTotal.type = 'hidden';
    inputValorTotal.name = 'valorTotal';
    inputValorTotal.value = valorTotal.innerText; // Asigna el valor de valorTotal

    form.appendChild(input);
    form.appendChild(inputValorTotal);

    document.body.appendChild(form);
    form.submit();
}

// Asociar la función a algún evento, por ejemplo, cuando se hace clic en un botón "Continuar al pago"
const btnContinuarPago = document.getElementById('btn-continuar-pago');
btnContinuarPago.addEventListener('click', irAPago);



// Animacion de añadido al carrito 

document.addEventListener('DOMContentLoaded', () => {
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');
    const modal = document.getElementById('myModal');
    const checkmarkContainer = document.querySelector('.checkmark-container');
    const addedText = document.querySelector('.added-text');
  
    const animateButtons = document.querySelectorAll('.Añadir');
  
    // Función para mostrar el modal con animación
    const showModal = () => {
      modal.style.display = 'block';
      checkmarkContainer.style.display = 'flex';
      addedText.innerText = 'Añadido al Carro';
  
      // Cerrar modal después de 5 segundos
      setTimeout(() => {
        closeModal();
      }, 1000);
    };
  
    // Función para ocultar el modal
    const closeModal = () => {
      modal.style.display = 'none';
      checkmarkContainer.style.display = 'none';
      addedText.innerText = '';
    };
  
    // Abrir modal al hacer clic en el botón "Añadir"
    animateButtons.forEach(button => {
      button.addEventListener('click', () => {
        showModal();
      });
    });
  
    // Cerrar modal al hacer clic en el botón de cierre
    closeModalButton.addEventListener('click', () => {
      closeModal();
    });
    
  });
  

document.addEventListener("DOMContentLoaded", function() {
    // Abrir Modal de Libro de reclamaciones

    const serviceModalslb = document.querySelectorAll(".modalformlb");
    const serviceModalscg = document.querySelectorAll(".modalformcg");
    const libroreclamacionBtns = document.querySelectorAll(".libro-reclamacion");
    const perfilBtns = document.querySelectorAll(".perfil");
    const modalCloseBtns = document.querySelectorAll(".modal-close-btn");

    var modallb = function(modalClick){
        serviceModalslb[modalClick].classList.add("active");
    }
    var modalcg = function(modalClick){
        serviceModalscg[modalClick].classList.add("active");
    }

    libroreclamacionBtns.forEach((libroreclamacionBtn, i) => {
        libroreclamacionBtn.addEventListener("click", () => {
            modallb(i);
      });
    });

    perfilBtns.forEach((perfilBtn, i) => {
        perfilBtn.addEventListener("click", () => {
            modalcg(i);
      });
    });
  
    modalCloseBtns.forEach((modalCloseBtn) => {
        modalCloseBtn.addEventListener("click", () =>{
            serviceModalslb.forEach((modalView)=>{
                 modalView.classList.remove("active");
            });
            serviceModalscg.forEach((modalView)=>{
                modalView.classList.remove("active");
            });
        });
    });
});