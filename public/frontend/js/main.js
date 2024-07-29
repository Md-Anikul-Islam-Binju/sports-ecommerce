document.addEventListener("DOMContentLoaded", () => {
    /**
     * Scroll top button
     */
    const scrollTop = document.querySelector(".scroll-top");
    if (scrollTop) {
        const togglescrollTop = function () {
            window.scrollY > 100
                ? scrollTop.classList.add("active")
                : scrollTop.classList.remove("active");
        };
        window.addEventListener("load", togglescrollTop);
        document.addEventListener("scroll", togglescrollTop);
        scrollTop.addEventListener(
            "click",
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            })
        );
    }

    /**
     * Hero Image Slider
     */
    let heroSlider = new Swiper(".heroSlider", {
        spaceBetween: 30,
        grabCursor: true,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    /**
     * Proud Kit Partner Logo Slider
     */
    let proudKitPartner = new Swiper(".proudKitPartner", {
        cssMode: true,
        slidesPerView: 3,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        mousewheel: true,
        keyboard: true,
        breakpoints: {
            640: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 5,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 8,
                spaceBetween: 30,
            },
        },
    });

    /**
     * Customer Review Testimonials
     */
    let customerReview = new Swiper(".customerReview", {
        cssMode: true,
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        mousewheel: true,
        keyboard: true,
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 30,
            },
        },
    });

    /**
     * Product Details page slider
     */
    var productImage = new Swiper(".productImage", {
        loop: true,
        spaceBetween: 25,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var productImageThumb = new Swiper(".productImageThumb", {
        loop: true,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: productImage,
        },
    });

    // Function to handle enabling/disabling the Add to Cart button
    function handleSizeSelection() {
        const addToCartButton = document.getElementById("add_to_cart");
        const sizeRadios = document.getElementsByName("available_size");

        sizeRadios.forEach((radio) => {
            radio.addEventListener("change", function () {
                if (radio.checked) {
                    addToCartButton.disabled = false;
                }
            });
        });
    }

    // Category active
    var parentCategories = document.querySelectorAll(
        ".sub_category_wrap .parent_category"
    );

    parentCategories.forEach(function (parentCategory) {
        parentCategory.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Get the parent li element
            var parentLi = parentCategory.closest(".sub_category_wrap");

            // Toggle the active class to show/hide subcategories
            parentLi.classList.toggle("active");
        });
    });

    /**
     * Animation on scroll function and init
     */
    AOS.init({
        duration: 1200,
    });
    // Easy Zoom
    let $easyzoom = $(".easyzoom").easyZoom();

    handleSizeSelection();
});

// Right click disable
document.addEventListener("contextmenu", function (e) {
    e.preventDefault();
});
