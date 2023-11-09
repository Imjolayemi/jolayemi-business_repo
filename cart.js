/* function amountValue(id) {
    var price = +document.getElementById("price_" + id).value;
    var qty = +document.getElementById("quantity_" + id).value;
    document.getElementById("total_" + id).value = price * qty;
}
 */


// Function to handle the change in input and store the value in local storage
function amountValue(productId) {
    var price = +document.getElementById("price_" + productId).value;
    var quantityInput = document.getElementById('quantity_' + productId);
    var totalInput = document.getElementById('total_' + productId);

    // Update the total based on the quantity, assuming some calculation logic
    var quantityValue = parseInt(quantityInput.value);
    var calculatedTotal = quantityValue * price /* Your item price or calculation logic */;

    totalInput.value = calculatedTotal ? calculatedTotal : "Amount";

    // Store the values in local storage
    localStorage.setItem('quantity_' + productId, quantityInput.value);
    localStorage.setItem('total_' + productId, calculatedTotal);
}

// Function to retrieve values from local storage on page load
window.onload = function() {
    // Loop through the input elements to retrieve and set the stored values
    var inputs = document.querySelectorAll('input[id^="quantity_"]');
    inputs.forEach(function(input) {
        var productId = input.id.split('_')[1];
        var quantity = localStorage.getItem('quantity_' + productId);
        var total = localStorage.getItem('total_' + productId);

        // Set the input values if stored values exist
        if (quantity !== null) {
            input.value = quantity;
        }

        // Set the total value if stored value exists
        var totalInput = document.getElementById('total_' + productId);
        if (total !== null) {
            totalInput.value = total;
        }
    });
};
