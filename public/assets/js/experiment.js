let nav = document.querySelector('.navMenu');
        let img = document.querySelector('.imgHeader');

        addEventListener('scroll', () => {
            if (this.scrollY > 100) {
                nav.style.top = "0";
            }
            nav.style.backgroundColor = "rgba(255, 255, 255," + this.scrollY / 100 + ")";

            img.style.transform = "translateY(" + this.scrollY * 0.1 + "px)";
            document.querySelector(".main_content").style.transform = "translateY(" + this.scrollY * 0.4 + "px)";
        })
