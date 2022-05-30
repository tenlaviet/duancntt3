const arrow = document.querySelector(".dropdown");

arrow.addEventListener("click", (e) =>{
    let arrowParent = e.target.parentElement.parentElement;
    arrowParent.classList.toggle("showSubMenu");
    console.log(arrowParent)
})