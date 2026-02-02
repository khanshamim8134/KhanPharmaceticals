/* ============================================
   MOBILE MENU TOGGLE
============================================ */
const mainMenu = document.getElementById("main_menu");
let mobileMenuBtn;

// Create Mobile Menu Button
function createMobileMenu() {
    mobileMenuBtn = document.createElement("div");
    mobileMenuBtn.innerHTML = "☰";
    mobileMenuBtn.style.fontSize = "34px";
    mobileMenuBtn.style.cursor = "pointer";
    mobileMenuBtn.style.display = "none";
    mobileMenuBtn.style.position = "absolute";
    mobileMenuBtn.style.top = "15px";
    mobileMenuBtn.style.right = "20px";
    mobileMenuBtn.style.color = "white";
    mobileMenuBtn.style.zIndex = "999";

    document.querySelector(".header_area").appendChild(mobileMenuBtn);

    mobileMenuBtn.addEventListener("click", function () {
        if (mainMenu.style.display === "block") {
            mainMenu.style.display = "none";
        } else {
            mainMenu.style.display = "block";
        }
    });
}
createMobileMenu();

/* ============================================
   RESPONSIVE MENU FUNCTIONALITY
============================================ */
function handleResponsiveMenu() {
    if (window.innerWidth <= 900) {
        mainMenu.style.display = "none";
        mainMenu.style.flexDirection = "column";
        mainMenu.style.background = "#000";
        mobileMenuBtn.style.display = "block";
        mainMenu.style.padding = "20px";
    } else {
        mainMenu.style.display = "block";
        mainMenu.style.flexDirection = "row";
        mobileMenuBtn.style.display = "none";
    }
}
window.addEventListener("resize", handleResponsiveMenu);
handleResponsiveMenu();

/* ============================================
   DROPDOWN MENU (Responsive)
============================================ */
document.querySelectorAll("#main_menu ul li").forEach((item) => {
    item.addEventListener("click", function (e) {
        if (window.innerWidth <= 900) {
            const submenu = this.querySelector("ul");
            if (submenu) {
                e.preventDefault();
                submenu.style.display =
                    submenu.style.display === "block" ? "none" : "block";
            }
        }
    });
});

/* ============================================
   SMOOTH SCROLL EFFECT
============================================ */
document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener("click", function (e) {
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            e.preventDefault();
            window.scrollTo({
                top: target.offsetTop - 60,
                behavior: "smooth",
            });
        }
    });
});

/* ============================================
   SHRINK HEADER ON SCROLL
============================================ */
window.addEventListener("scroll", function () {
    const header = document.querySelector(".header_area");
    if (window.scrollY > 60) {
        header.style.padding = "5px 20px";
    } else {
        header.style.padding = "20px 30px";
    }
});

/* ============================================
   RESPONSIVE IMAGE AUTO RESIZER
============================================ */
window.addEventListener("load", function () {
    document.querySelectorAll("img").forEach((img) => {
        img.style.maxWidth = "100%";
        img.style.height = "auto";
    });
});

/* ============================================
   FUTURE EXPANSION (DATABASE SUPPORT READY)
============================================ */

// Load Dynamic Products (If backend added later)
async function loadProducts() {
    try {
        const res = await fetch("http://localhost:5000/products");
        const data = await res.json();

        const section = document.querySelector(".main_content");
        let output = "<h2>All Products</h2>";

        data.forEach((p) => {
            output += `
                <div class="product-box">
                    <h3>${p.name}</h3>
                    <p>${p.description}</p>
                    <p><b>Category:</b> ${p.category}</p>
                    <p><b>Price:</b> ${p.price} TK</p>
                </div>
            `;
        });

        section.innerHTML = output;
    } catch (error) {
        console.log("Backend not connected.");
    }
}
