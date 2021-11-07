class Cart {
  items;
  properties;

  constructor(items = [], properties = {}) {
    this.items = items;
    this.properties = properties;
  }

  addProduct(productID, quantity = 1, properties = {}) {
    let item = this.items.find(item => item.product.productID == productID);

    if (item) {
      item.quantity += quantity;
    } else {
      this.items.push(new Item(productID, quantity, properties));
    }

    this.storeCart();
  }

  updateQuantity(productID, quantity) {
    let item = this.items.find(item => item.productID == productID);
    if (item) {
      if (quantity == 0) {
        this.items = this.items.filter(item => item.productID != productID);
      } else {
        item.quantity = quantity;
      }

      this.storeCart();
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

    this.storeCart();
  }

  setItemProperty(productID, key, value = null) {
    let item = this.items.find(item => item.productID == productID);
    if (item) {
      this.item.setProperty(key, value);

      this.storeCart();
    }
  }

  getPrice() {
    return this.items.reduce((acc, item) => acc + item.product.price * item.quantity, 0);
  }

  clear() {
    this.items = [];
    this.properties = {};

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

  constructor(productID, name, price, description = "") {
    this.productID = productID;
    this.name = name;
    this.price = price;
    this.description = description;
  }
}

function loadProducts() {
  window.products = {};

  fetch("/all-products.json")
    .then(data => data.json())
    .then(response => {
      console.log(response);

      response.forEach(element => {
        window.products[element.id] = new Product(element.id, element.name, element.price, element.description);
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