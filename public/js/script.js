document.addEventListener("DOMContentLoaded", () => {
    const dropBtn = document.querySelector("#drop-btn");
    const navItem = document.querySelector(".nav-item");
    const subMenu = document.querySelector(".sub-menu");

    if (dropBtn) {
        dropBtn.addEventListener("click", (e) => {
            e.preventDefault();
            navItem.classList.toggle("showMenu");

            if (subMenu.style.display === "none" || subMenu.style.display === "") {
                subMenu.style.display = "block";
            } else {
                subMenu.style.display = "none";
            }
        });
    }
});
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    const searchBtn = document.querySelector(".bi-search");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });

    searchBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });

    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bi-list", "bi-menu-button-fill");
        } else {
            closeBtn.classList.replace("bi-menu-button-fill", "bi-list");
        }
    }
});


window.onload = function () {
    menuBtnChange();
};