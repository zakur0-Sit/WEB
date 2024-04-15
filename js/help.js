const btns = document.querySelectorAll(".nav-btn");
const slides = document.querySelectorAll(".video-slide");
const contents = document.querySelectorAll(".content");

    var sliderNav= function(manual) {
     
        btns.forEach((btn) => {
            btn.classList.remove("active");
        });

        slides.forEach((slide) => {
            slide.classList.remove("active");
        });

        contents.forEach((content) => {
            content.classList.remove("active");
        });

    
        btns[manual].classList.add("active");
        slides[manual].classList.add("active");
        contents[manual].classList.add("active");

    }

    btns.forEach((btn, i) => {
        btn.addEventListener("click", () => {
            sliderNav(i);
        });
    });
   
    document.addEventListener("DOMContentLoaded", function() {
    const contents = document.querySelectorAll(".content");

    contents.forEach(content => {
        const moreContent = content.querySelector(".more-content");
        const readMoreButton = content.querySelector(".read-more");

        // Ascunde conținutul extins inițial
        moreContent.style.display = "none";

        // Adaugă eveniment de clic pentru butonul "Read More"
        readMoreButton.addEventListener("click", () => {
            if (moreContent.style.display === "none" || moreContent.style.display === "") {
                moreContent.style.display = "block";
                readMoreButton.textContent = "Read Less";
            } else {
                moreContent.style.display = "none";
                readMoreButton.textContent = "Read More";
            }
        });
    });
});

