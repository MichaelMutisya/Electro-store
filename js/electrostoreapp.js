//selectors
let menubar = document.querySelector(".menu-container").querySelectorAll("a");
console.log(menubar);
//event listeners
menubar.forEach(element => {
    element.addEventListener("click", toggleMenu)
});
//functions
function toggleMenu(){
    menubar.forEach(menu => {
        menu.classList.remove("active");
    })  
    this.classList.add("active");
}