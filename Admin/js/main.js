let dropDown = document.querySelector("#dropdown");
let drop = document.querySelector(".drop");

dropDown.addEventListener("click", () => {
    drop.classList.toggle('active');
});

let Alert =  document.querySelector(".alert");

const hideAlert = ()=>{
    Alert.style.display = 'none';
}

console.log('loe')