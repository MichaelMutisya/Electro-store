//selectors
let menuBar = document.querySelector(".menu").querySelectorAll("a");
let addButton = document.querySelector(".purchase").querySelectorAll("button");
console.log(menuBar);
console.log(addButton);

//event listeners
menuBar.forEach(element => {
    element.addEventListener("click", toggleMenu)
});
addButton.addEventListener("click", hideButton);
//functions
//funtion to toggle through the menu
function toggleMenu(){
    menuBar.forEach(menu => {menu.classList.remove("active"); 
        this.classList.add("active");
    })
}

//function to remove and add add to cart button when active
function hideButton(){
    addButton.forEach(add => {add.classList.remove("button-active"); 
        this.classList.add("button-active");
    })
}