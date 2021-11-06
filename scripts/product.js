 var quantity=document.getElementById("quantity");
    var price;
    var name=document.title;
    var unit=document.getElementById("unit").innerHTML.match(/\d{1,}.\d\d/);

function addbutton(){
   quantity.value=Number(quantity.value)+1;
   price=(quantity.value*unit).toFixed(2);
       document.getElementById("priceDisplay").innerHTML="Price: "+price+" $";
       

   }
   function minusbutton(){
   if(quantity.value<=1){
   quantity.value=1;
   }
      else quantity.value=Number(quantity.value)-1;


      price=(quantity.value*unit).toFixed(2);
          document.getElementById("priceDisplay").innerHTML="Price: "+price+" $";
          

      }