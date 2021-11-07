window.addEventListener('DOMContentLoaded', (event) => {
  var quantity = document.querySelector("#quantity");
  var price;
  var name = document.title;
  var unit = document.getElementById("unit").innerHTML.match(/\d{1,}.\d\d/);
   
  if (sessionStorage.getItem("autosave")) {
    quantity.value = sessionStorage.getItem("autosave");
  }
  
  window.updateContent = function() {
    price = (quantity.value * unit).toFixed(2);
    document.getElementById("priceDisplay").innerHTML = "Price: " + price + " $";

    window.autosave();
  }

  window.autosave = function() {
    sessionStorage.setItem("autosave", quantity.value);
  }
  
  window.addbutton = function() {
    quantity.value = Number(quantity.value) + 1;
    window.updateContent();
  }
  
  window.minusbutton = function() {
    quantity.value = Math.max(1, quantity.value - 1);
    window.updateContent();
  }

  quantity.addEventListener('change', autosave);

  updateContent();
});