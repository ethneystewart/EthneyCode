function search(){

    for (var i = 0; i < 6; i++) {
        var store = "prices" + i;
        document.getElementById(store).style.background = null;
    }

    // document.getElementById(store).style.background = none;
    searchItems = ["bread", "apple", "biscuits", "tomatoes", "milk", "eggs", "chicken", "beef", "pork", "fish", "rice", "pasta", "potatoes", "onions", "garlic", "carrots", "lettuce", "cucumber", "tomatoes", "peppers", "spinach", "broccoli", "cauliflower", "beans", "peas", "corn", "bananas", "apples", "oranges", "grapes", "strawberries", "blueberries", "raspberries", "cherries", "peaches", "plums", "watermelon", "mango", "pineapple", "kiwi", "lemon", "lime", "coffee", "tea", "milk", "juice", "water", "soda", "beer", "wine", "chocolate", "candy", "ice cream", "cookies", "cake", "bread", "butter", "margarine", "oil", "sugar", "salt", "pepper", "flour", "baking powder", "baking soda", "vanilla", "cinnamon", "nutmeg", "ginger", "cumin", "paprika", "mustard", "ketchup", "mayonnaise", "salsa", "soy sauce", "vinegar", "olive oil", "balsamic vinegar", "rice", "pasta", "potatoes", "onions", "garlic", "carrots", "lettuce", "cucumber", "tomatoes", "peppers", "spinach", "broccoli", "cauliflower", "beans", "peas", "corn", "bananas", "apples", "oranges", "grapes", "strawberries", "blueberries", "raspberries", "cherries", "peaches", "plums", "watermelon", "mango", "pineapple", "kiwi", "lemon", "lime", "coffee", "tea", "milk", "juice", "water", "soda", "beer", "wine", "chocolate", "candy", "ice cream", "cookies", "cake", "bread", "butter", "margarine", "oil", "sugar", "salt", "pepper", "flour"];

    console.log("searching");
    var search = document.getElementById("ed-srch-term").value;
    console.log(search);
    for (var i = 0; i < searchItems.length; i++) {
        if (searchItems[i] == search) {
            console.log("found");
            // generating random number between 0 and 20 as prices
            var price1 = Math.floor(Math.random() * 20);
            var price2 = Math.floor(Math.random() * 20);
            var price3 = Math.floor(Math.random() * 20);
            var price4 = Math.floor(Math.random() * 20);
            var price5 = Math.floor(Math.random() * 20);
            var price6 = Math.floor(Math.random() * 20);

            amounts = [price1, price2, price3, price4, price5, price6];

            // finding lowest price
            var min = Math.min.apply(null, amounts);
            console.log(min);

            for (var j = 0; j < amounts.length; j++) {
                if (amounts[j] == min) {
                    var store = "prices" + j;
                    document.getElementById(store).innerText = search + ": $" + min;
                    document.getElementById(store).style.background = "chartreuse";
                }
                else {
                    var store = "prices" + j;
                    document.getElementById(store).innerText = search + ": $" + amounts[j];
                }
            }
            document.getElementById("ed-srch-term").value = "";
            return true;
        }
    }
    document.getElementById("ed-srch-term").value = "";
    alert("Item not available");
}