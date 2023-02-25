let Alert = document.querySelector(".alert");
const hideAlert = () => {
    Alert.style.display = "none";
};
let dropDown = document.querySelector("#dropdown");
let drop = document.querySelector(".drop");
let showHideBtns = Array.from(document.querySelectorAll(".showHide"));
let passwds = Array.from(document.querySelectorAll(".passwd"));
console.log(passwds);
passwds.forEach((passwd) => {
    passwd.addEventListener("input", (e) => {
        if (e.target.value.length > 0) {
            passwd.nextElementSibling.style.display = "block";
        } else {
            passwd.nextElementSibling.style.display = "none";
        }
    });
});
showHideBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        let sib = btn.previousElementSibling;
        if (sib.type == "text") {
            sib.type = "password";
            btn.innerText = "SHOW";
        } else {
            sib.type = "text";
            btn.innerText = "HIDE";
        }
    });
});
dropDown.addEventListener("click", () => {
    drop.classList.toggle("active");
});
