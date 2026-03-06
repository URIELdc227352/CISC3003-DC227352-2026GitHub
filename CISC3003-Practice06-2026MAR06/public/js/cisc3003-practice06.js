/* add loop and other code here ... in this simple exercise we are not
   going to concern ourselves with minimizing globals, etc */
   var subtotal = 0;
   const TAX_RATE = 0.10;         
   const SHIPPING_THRESHOLD = 1000; 

   for (var i = 0; i < titles.length; i++) {
       var total = calculateTotal(quantities[i], prices[i]);
       subtotal += total;

       outputCartRow(filenames[i], titles[i], quantities[i], prices[i], total);
   }

   var tax = calculateTax(subtotal, TAX_RATE);
   var shipping = calculateShipping(subtotal, SHIPPING_THRESHOLD);
   var grandTotal = calculateGrandTotal(subtotal, tax, shipping);
   
   document.write("<tr class='totals'>");
   document.write("<td colspan='4'>Subtotal</td>");
   document.write("<td>"); outputCurrency(subtotal); document.write("</td>");
   document.write("</tr>");

   document.write("<tr class='totals'>");
   document.write("<td colspan='4'>Tax (10%)</td>");
   document.write("<td>"); outputCurrency(tax); document.write("</td>");
   document.write("</tr>");

   document.write("<tr class='totals'>");
   document.write("<td colspan='4'>Shipping</td>");
   document.write("<td>"); outputCurrency(shipping); document.write("</td>");
   document.write("</tr>");

   document.write("<tr class='totals'>");
   document.write("<td colspan='4' class='focus' style='font-weight: bold; color: red;'>Grand Total</td>");
   document.write("<td class='focus' style='font-weight: bold; color: red;'>"); 
   outputCurrency(grandTotal); 
   document.write("</td>");
   document.write("</tr>");
