window.bootstrap = require("bootstrap");
window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.baseURL = "http://khutinati.test";

let sidebarCart = document.querySelector("[data-sidebar-cart]");
let cartOpenBtn = document.querySelector("[data-cart-open-btn]");

window.showFullPageLoading = () => {
  const backdrop = document.createElement("div");
  backdrop.classList.add("loader-backdrop");

  const loader = document.createElement("div");
  loader.classList.add("loader");
  backdrop.appendChild(loader);
  document.body.appendChild(backdrop);
};
window.hideFullPageLoading = () => {
  document.querySelector(".loader-backdrop").remove();
};

// NOTE: Opens sidebar cart
cartOpenBtn.addEventListener("click", () => {
  sidebarCart.classList.toggle("open");
});

// NOTE: Closes sidebar cart
let cartCloseBtn = document.querySelector("[data-cart-close-btn]");
cartCloseBtn.addEventListener("click", () => {
  sidebarCart.classList.toggle("open");
});

// NOTE: Opens/closes submenu in category multilevel menu
let categoryMobileItems = document.querySelectorAll("[data-cartgory-dropdown]");
categoryMobileItems.forEach((el) => {
  el.addEventListener("click", (e) => {
    el.parentElement.classList.toggle("open");
  });
});

// NOTE: Adds shadow to header and hides .navbar-top when scrolled down
window.addEventListener("scroll", (e) => {
  const header = document.querySelector("[data-fixed-haeder]");
  const navTop = document.querySelector(".navbar-top");
  if (window.pageYOffset > 0) {
    header.classList.add("shadow");
    navTop.style.display = "none";
  } else {
    header.classList.remove("shadow");
    navTop.style.display = "block";
  }
});

/*****
 * SECTION: Handle Cart
 */
const cartContainer = document.querySelector("[data-cart-container]");
let cart = [];
if (localStorage.getItem("cart") != null) {
  cart = JSON.parse(localStorage.getItem("cart"));
}

initCart(cart);

// NOTE: Initializes cart using cart data stored in local storage
function initCart(cartItems) {
  if (cartItems == null) return;

  document.querySelector("[data-cart-empty]").style.display = "none";

  cartContainer.querySelectorAll("[data-product]").forEach((el) => {
    el.remove();
  });

  cartItems.forEach((item) => {
    cartContainer.appendChild(createCartItem(item));
  });

  updateCartTotal();
}

// NOTE: Updates sum of prices of all products added to the cart
function updateCartTotal() {
  let cartPrices = cart.map((a) =>
    a.discountedPrice ? a.discountedPrice * a.quantity : a.price * a.quantity
  );

  const cartTotalElements = document.querySelectorAll("[data-cart-total]");

  cartTotalElements.forEach((el) => {
    el.innerText =
      "৳ " + cartPrices.reduce((a, b) => parseInt(a) + parseInt(b), 0);
  });
}

checkCart();
// Checks products added to the cart in localstorage
// and updates product cards accordingly
function checkCart() {
  if (cart == null) return;

  let productCards = document.querySelectorAll("[data-product]");
  let ids = cart.map((a) => a.id);
  productCards.forEach((el) => {
    let id = el.id.split("__")[1];
    if (ids.includes(id)) {
      el.querySelector("[data-product-footer]")?.classList.add("in-cart");
      let quantity = cart.find((a) => a.id === id).quantity;
      el.querySelector("[data-product-quantity]").innerText = quantity;

      if (quantity >= 5) {
        el.querySelector("[data-cart-item-increase]").disabled = true;
      }
    }
  });

  updateCartIconBadge();
}

function updateCartIconBadge() {
  if (cart.length > 0) {
    cartOpenBtn.querySelector("span").innerText = cart.length;
    return;
  }
  cartOpenBtn.querySelector("span").innerText = "";
}

// NOTE: Creats individual cart product DOM element for sidebar cart
function createCartItem(product) {
  let finalPrice = product.price;
  if (product.discountedPrice) {
    finalPrice = product.discountedPrice;
  }

  let cartItem = document.createElement("div");
  cartItem.classList.add("cart-item");
  cartItem.setAttribute("id", "product__" + product.id);
  cartItem.setAttribute("data-product", "");

  let cartItemInner = `
    <img class="cart-item-img" src="${product.image}" alt="" data-product-image>
    <div class="cart-item-details">
      <div class="cart-item-title" data-product-name>${product.name}</div>
      <div class="cart-item-unit">
        <span data-product-price>৳ ${finalPrice}</span> /
        <span data-product-unit>${product.unit}</span>
      </div>
      <div class="cart-item-tools">
        <button class="cart-tool-btn text-start" data-cart-item-decrease>
          <i class="fa-solid fa-angle-left"></i>
        </button>
        <span class="me-1 ms-1" data-product-quantity>${product.quantity}</span>
        <button class="cart-tool-btn text-end" data-cart-item-increase>
          <i class="fa-solid fa-angle-right"></i>
        </button>
      </div>
    </div>
    <div class="cart-item-price" data-product-total>
      ৳ ${finalPrice * product.quantity}
    </div>
    <div class="cart-item-remove" data-cart-item-remove>
      <i class="fa-solid fa-xmark"></i>
    </div>`;

  cartItem.innerHTML = cartItemInner;
  return cartItem;
}

// NOTE: Adds products to sidebar cart and
// also stores them in the local storage
function addToCart(el) {
  document.querySelector("[data-cart-empty]").style.display = "none";

  let id = el.parentElement.parentElement.id.split("__")[1];

  let name = el.parentElement.parentElement.querySelector(
    "[data-product-title]"
  ).innerText;

  let unit = el.parentElement.parentElement.querySelector(
    "[data-product-unit]"
  ).innerText;

  let price = el.parentElement.parentElement
    .querySelector("[data-product-price]")
    .innerText.split(" ")[1];

  let discountedPrice = null;
  if (
    el.parentElement.parentElement.querySelector(
      "[data-product-discount-price]"
    )
  ) {
    discountedPrice = el.parentElement.parentElement
      .querySelector("[data-product-discount-price]")
      .innerText.split(" ")[1];
  }
  console.log(discountedPrice);

  let image = el.parentElement.parentElement
    .querySelector("[data-product-image]")
    .getAttribute("src");

  let quantity = 1;

  el.parentElement.parentElement.querySelector(
    "[data-product-quantity]"
  ).innerText = 1;

  let cartProduct = {
    id: id,
    name: name,
    unit: unit,
    price: price,
    discountedPrice: discountedPrice,
    quantity: quantity,
    image: image,
  };

  cart.push(cartProduct);
  localStorage.setItem("cart", JSON.stringify(cart));

  cartContainer.appendChild(createCartItem(cartProduct));

  updateCartIconBadge();
  updateCartTotal();
}

// NOTE: Removes product from sidebar cart localstorage and
// updates product card on the page accordingly
function removeFromCart(id) {
  let cartItems = cartContainer.querySelectorAll("[data-product]");
  cartItems.forEach((el) => {
    if (el.id.split("__")[1] != id) return;
    el.remove();
  });

  cart = cart.filter((a) => a.id != id);
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartTotal();

  let productCards = document.querySelectorAll("[data-product]");
  productCards.forEach((el) => {
    if (!el.classList.contains("product-card")) return;
    if (el.id.split("__")[1] != id) return;
    el.querySelector("[data-product-footer]").classList.remove("in-cart");
  });

  if (cart == null || cart.length == 0) {
    document.querySelector("[data-cart-empty]").style.display = "block";
  }

  updateCartIconBadge();
}

function cartItemDecrease(el) {
  let quantity = el.nextElementSibling.innerText;
  if (quantity == 1) {
    let productId =
      el.parentElement.parentElement.parentElement.id.split("__")[1];
    removeFromCart(productId);
    return;
  }

  quantity--;
  let productId =
    el.parentElement.parentElement.parentElement.id.split("__")[1];

  let cards = document.querySelectorAll("[data-product]");
  cards.forEach((el) => {
    if (el.id.split("__")[1] != productId) return;
    el.querySelector("[data-product-quantity]").innerText = quantity;
    if (quantity <= 5) {
      el.querySelector("[data-cart-item-increase]").disabled = false;
    }
  });

  let produuctIndex = cart.findIndex((a) => a.id == productId);
  cart[produuctIndex].quantity -= 1;
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartTotal();
}

function cartItemIncrease(el) {
  let quantity = el.previousElementSibling.innerText;
  if (quantity >= 5) return;

  quantity++;

  let productId =
    el.parentElement.parentElement.parentElement.id.split("__")[1];

  let cards = document.querySelectorAll("[data-product]");
  cards.forEach((el) => {
    if (el.id.split("__")[1] != productId) return;

    el.querySelector("[data-product-quantity]").innerText = quantity;
    if (quantity == 5) {
      el.querySelector("[data-cart-item-increase]").disabled = true;
    }
  });

  let produuctIndex = cart.findIndex((a) => a.id == productId);
  cart[produuctIndex].quantity += 1;
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartTotal();
}

function updateProductCards() {
  let cards = document.querySelectorAll("[data-product]");
  cards.forEach((el) => {
    if (el.classList.contains("product-card")) {
      let id = el.id.split("__")[1];
    }
  });
}

document.addEventListener("click", (e) => {
  if (e.target.hasAttribute("data-add-to-cart")) {
    addToCart(e.target);
    e.target.parentElement.classList.add("in-cart");
  }

  if (e.target.hasAttribute("data-cart-item-decrease")) {
    cartItemDecrease(e.target);
  }

  if (e.target.hasAttribute("data-cart-item-increase")) {
    cartItemIncrease(e.target);
  }

  if (e.target.hasAttribute("data-cart-item-remove")) {
    removeFromCart(e.target.parentElement.id.split("__")[1]);
  }
});
