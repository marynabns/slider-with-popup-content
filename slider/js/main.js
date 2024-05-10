const swiper = new Swiper('.swiper', {
    speed: 400,
    slidesPerView: 4,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
            spaceBetween: 20
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20
        },
        // when window width is >= 640px
        1024: {
            slidesPerView: 4,
            spaceBetween: 30
        }
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let slides = document.querySelectorAll('.slide');
    let popup = document.querySelector('.popup');
    let popupContent = document.querySelector('.popup-content');
    let popupClose = document.querySelector('.popup-close');

    slides.forEach(function(slide) {
        slide.addEventListener('click', function() {
            let postId = this.dataset.id;
            const url = 'http://127.0.0.1:8000/wp-admin/admin-ajax.php';
            fetch(url, {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'get_popup_content',
                    post_id: postId
                })
            })
                .then(response => response.text())
                .then(data => {
                    popupContent.innerHTML = data;
                    popup.style.display = 'block';
                })
                .catch(error => console.error('Error:', error));
        });
    });

    popupClose.addEventListener('click', function() {
        popup.style.display = 'none';
    });
});