class Cart {
  items;
  properties;

  constructor(items = [], properties = {}) {
    this.items = items;
    this.properties = properties;
  }

  addProduct(productID, quantity = 1, properties = {}) {
    let item = this.items.find(item => item.product.productID == productID);

    if (quantity == 1) {
      let quantityInput = document.querySelector("#quantity");
      if (quantityInput) {
        quantity = Number(quantityInput.value);
      }
    }

    if (item) {
      item.quantity += quantity;
    } else {
      this.items.push(new Item(productID, quantity, properties));
    }

    this.updateCart();
  }

  increaseQuantity(index) {
    this.items[index].quantity += 1;
    this.updateCart();
  }

  decreaseQuantity(index) {
    let quantity = this.items[index].quantity - 1;

    if (quantity <= 0) {
      this.items.splice(index, 1);
    } else {
      this.items[index].quantity = quantity;
    }

    this.updateCart();
  }

  updateQuantity(productID, quantity) {
    let item = this.items.find(item => item.product.productID == productID);
    if (item) {
      if (quantity == 0) {
        this.items = this.items.filter(item => item.product.productID != productID);
      } else {
        item.quantity = quantity;
      }

      this.updateCart();
    }
  }

  removeProduct(productID) {
    this.updateQuantity(productID, 0);
  }

  setProperty(key, value = null) {
    if (!value) {
      delete this.properties[key];
    } else {
      this.properties[key] = value;
    }

    this.updateCart();
  }

  setItemProperty(productID, key, value = null) {
    let item = this.items.find(item => item.product.productID == productID);
    if (item) {
      this.item.setProperty(key, value);

      this.updateCart();
    }
  }

  getPrice() {
    return this.items.reduce((acc, item) => acc + item.product.price * item.quantity, 0);
  }

  render() {
    let cartHtml;
    
    if (this.items.length) {
      cartHtml = `
        <thead>
          <th>Item</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Action</th>
        </thead>
        <tbody>
        ${
          this.items.map((item, index) => {
            let product = item.product;
            return `
              <tr>
                <td>
                  <p>${product.name} - ${product.description}</p>
                  <img
                    class="cart-image"
                    src="${product.image}"/>
                </td>
                <td>
                  <div class="quantity-wrapper">
                    <input type="hidden" name="product[${index}]" value="${product.productID}">
                    <button onclick="cart.increaseQuantity(${index})">+</button>
                    <input type="number" name="quantity[${index}]" value="${item.quantity}" size="2" readonly>
                    <button onclick="cart.decreaseQuantity(${index})">-</button>
                  </div>
                </td>
                <td>${product.price.toFixed(2)}$</td>
                <td>
                  <button name="remove" onclick="cart.removeProduct(${product.productID})" value="1">Remove</button>
                </td>
              </tr>
            `;
          }).join('')
        }
        </tbody>
      `;
    } else {
      cartHtml = `<tr><td><p>Cart is empty!</p><a href="/">Continue shopping</a></td></tr>`;
    }

    document.querySelectorAll('.js-cart').forEach(cart => cart.innerHTML = cartHtml);
  }

  renderSummary() {
    let summaryHtml;
    
    if (this.items.length) {
      let subtotal = this.items.reduce((acc, item) => acc + item.product.price * item.quantity, 0);
      let quantity = this.items.reduce((acc, item) => acc + item.quantity, 0);
      let qst = subtotal * 0.09975;
      let gst = subtotal * 0.05;
      let total = subtotal + qst + gst;

      summaryHtml = `
        <div>${quantity} item${(quantity > 1)?"s":""}</div>
        <div>Subtotal: ${subtotal.toFixed(2)}$</div>
        <div>QST: ${qst.toFixed(2)}$</div>
        <div>GST: ${gst.toFixed(2)}$</div>
        <div>Total: ${total.toFixed(2)}$</div>
        <button formaction="/checkout">Checkout</button><br>
        <a href="/">Continue shopping</a>
      `;
    } else {
      summaryHtml = ``;
    }

    document.querySelectorAll('.js-cart-summary').forEach(cart => cart.innerHTML = summaryHtml);
  }

  clear() {
    this.items = [];
    this.properties = {};

    this.updateCart();
  }

  updateCart() {
    this.render();
    this.renderSummary();
    this.storeCart();
  }

  storeCart() {
    localStorage.setItem('cart', JSON.stringify(this));
  }
}

class Item {
  product;
  quantity;
  properties;

  constructor(productID, quantity = 1, properties = {}) {
    let product = window.products[productID];

    if (product) {
      this.product = product;
    } else {
      this.product = new Product(productID, "Test", 10);
    }

    this.quantity = quantity;
    this.properties = properties;
  }

  setProperty(key, value = null) {
    if (!value) {
      delete this.properties[key];
    } else {
      this.properties[key] = value;
    }
  }
}

class Product {
  productID;
  name;
  price;
  description;
  image;

  constructor(productID, name, price, description = "", image = "/images/products/banana.jpg") {
    this.productID = productID;
    this.name = name;
    this.price = price;
    this.description = description;
    this.image = image;
  }
}

function loadProducts() {
  window.products = {};

  fetch("/all-products.json")
    .then(data => data.json())
    .then(response => {
      console.log(response);

      response.forEach(element => {
        window.products[element.id] = new Product(element.id, element.name, element.price, element.description, element.image);
      });
    });
}

function loadCart() {
  console.log("loading cart");

  const storedCart = localStorage.getItem('cart');
  if (storedCart) {
    let cartData = JSON.parse(storedCart);

    window.cart = new Cart(cartData.items, cartData.properties?storedCart.properties:{});
  } else {
    window.cart = new Cart();
  }
}

loadProducts();
loadCart();