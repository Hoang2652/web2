/*=============== CHECK AGAIN IF YOU WANT TO DELETE A RATING ===============*/
function checkdeldanhgia(iddanhgia) {
    var url = 'admin/update_sanpham.php?&submit_xoadanhgia=' + iddanhgia;
    if (confirm('Bạn có chắc chắn muốn xóa đánh giá này ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById('nav-menu'),
    navToggle = document.getElementById('nav-toggle'),
    navClose = document.getElementById('nav-close')

/*===== MENU SHOW =====*/
/* Validate if constant exists */
if (navToggle) {
    navToggle.addEventListener('click', () => {
        navMenu.classList.add('show-menu')
    })
}

/*===== MENU HIDDEN =====*/
/* Validate if constant exists */
if (navClose) {
    navClose.addEventListener('click', () => {
        navMenu.classList.remove('show-menu')
    })
}

/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll('.nav__link')

function linkAction() {
    const navMenu = document.getElementById('nav-menu')
        // When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))

/*=============== CHANGE BACKGROUND HEADER ===============*/
function scrollHeader() {
    const header = document.getElementById('header')
        // When the scroll is greater than 50 viewport height, add the scroll-header class to the header tag
    if (this.scrollY >= 50) header.classList.add('scroll-header');
    else header.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)

/*=============== TESTIMONIAL SWIPER ===============*/
window.addEventListener('load', function() {
    const swapperCmt = document.querySelector('.swiper-wrapper')
    const nextBtn = document.querySelector('.swiper-button-next')
    const prevBtn = document.querySelector('.swiper-button-prev')
    let positionX = 0;

    nextBtn.addEventListener('click', () => {
        changeCmt(1)
    })

    prevBtn.addEventListener('click', () => {
        changeCmt(-1)
    })

    function changeCmt(direction) {
        if (direction === -1) {
            positionX = positionX + 500
            if (positionX === 500) {
                positionX = -1000;
            }
            swapperCmt.style = `transform: translate3d(${positionX}px,0px,0px)`
        } else if (direction === 1) {
            positionX = positionX - 500
            if (positionX === -1500) {
                positionX = 0;
            }
            swapperCmt.style = `transform: translate3d(${positionX}px,0px,0px)`
        }
    }
})

/*=============== NEW SLIDES ===============*/
window.addEventListener('load', function() {
    const swapperPro = document.querySelector('.swiper-wrapper-1')
    const nextNew = document.querySelector('.new-button-next')
    const prevNew = document.querySelector('.new-button-prev')
    let positionY = 0

    nextNew.addEventListener('click', () => {
        changePro(1)
    })

    prevNew.addEventListener('click', () => {
        changePro(-1)
    })

    function changePro(direction) {
        if (direction === -1 | direction === 1) {
            positionY = positionY + 1000
            if (positionY <= -2000 || positionY >= 2000) {
                positionY = 0;
            }
            swapperPro.style = `transform: translate3d(${-positionY}px,0px,0px)`
        }
    }
})


/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
const sections = document.querySelectorAll('section[id]')

function scrollActive() {
    const scrollY = window.pageYOffset

    sections.forEach(current => {
        const sectionHeight = current.offsetHeight,
            sectionTop = current.offsetTop - 58,
            sectionId = current.getAttribute('id')

        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.add('active-link')
        } else {
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.remove('active-link')
        }
    })
}
window.addEventListener('scroll', scrollActive)