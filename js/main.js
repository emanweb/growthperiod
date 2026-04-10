document.addEventListener("DOMContentLoaded", function(event) {
    toggleMenu();
    fixedHeader();
    hideHeaderScrollDown();
    scrollIntro();
    scrollClients();
    toggleFeedbackForm();
    scrollCases();
    typeCaptions();
    servicesSlider();
    caseStudiesCarousel();
    loadMore();
    experienceSlider();
    popups();
    apartGalleryPopup();
    teamFilter();
    hoverAparts();
    smoothScroll();
    checkForm();
    teamSliders();
    slideToggleArticle();

    document.body.classList.remove('preload');
    if (typeof AOS !== 'undefined' && AOS && typeof AOS.init === 'function') {
        AOS.init({
            once: true,
            duration: 1000,
            startEvent: 'load',
            offset: 20
        });
    } else {
        document.querySelectorAll('[data-aos]').forEach((element) => {
            element.classList.add('aos-animate');
        });
    }
});

const fixedHeader = () => {
    let header = document.querySelector('.header');
    let checkScroll = () => {
        if (window.scrollY > 0 && window.innerWidth < 768) {
            header.classList.add('is-fixed')
        } else {
            header.classList.remove('is-fixed')
        }
    }

    checkScroll();

    window.addEventListener('scroll', checkScroll, false);
}

const toggleMenu = () => {
    let menu = document.querySelector(".header__menu-outer"),
        burger = document.querySelector(".header__burger");


    burger.addEventListener('click', () => {
        menu.classList.toggle('is-active');
        burger.classList.toggle('is-active');

        if(menu.classList.contains('is-active')) {
            document.body.style.overflow = 'hidden'
        } else {
            document.body.style.overflow = ''
        }
    }, false);
}

const scrollIntro = () => {
    let intro = document.querySelector('#intro');
    if(intro) {
        const scrollIntroFunc = () => {
            if (window.scrollY > 0) {

                if (!intro.classList.contains('js-compressed')) {
                    let _height = intro.clientHeight;
                    intro.style.height = _height * .65 + "px";
                    intro.classList.add('js-compressed');
                }

            } else {
                intro.removeAttribute('style');
                intro.classList.remove('js-compressed');
            }
        }

        scrollIntroFunc();

        window.addEventListener('scroll', () => {
            scrollIntroFunc()
        })
    }
}

const hideHeaderScrollDown = () => {
    let didScroll,
        lastScrollTop = 0,
        delta = 5,
        header = document.querySelector('.header'),
        navbarHeight = header.clientHeight;

    checkScroll();

    window.addEventListener('scroll', function(event){
        checkScroll();
    });

    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false; 
        }
    }, 50);

    function checkScroll() {
        didScroll = true;
        let st = window.scrollY;
        if (st > 0) {
            header.classList.add('nav-fixed');
        } else {
            header.classList.remove('nav-fixed');
        }
    }

    function hasScrolled() {
        let st = window.scrollY;

        if(Math.abs(lastScrollTop - st) <= delta)
            return;

        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            header.classList.remove('nav-down');
            header.classList.add('nav-up');
        } else {
            // Scroll Up
            if(st + window.outerHeight < document.body.offsetHeight) {
                header.classList.remove('nav-up');
                header.classList.add('nav-down');
            }
        }

        lastScrollTop = st;
    }
}

const scrollClients = () => {
    let list = document.querySelector('#clients2');
    if(list) {
        let box = list.getBoundingClientRect();

        if (window.outerWidth > 768 && !list.classList.contains('is-started')) {
            let items = list.querySelectorAll('.clients__list-item');

            let startX = items[2].getBoundingClientRect().x,
                startY = items[2].getBoundingClientRect().y;
            items.forEach((item, index) => {
                let _itemX = item.getBoundingClientRect().x,
                    _itemY = item.getBoundingClientRect().y,
                    currentX = startX - _itemX,
                    currentY = startY - _itemY;

                item.querySelector('.clients__list-content').style.transform = `translate(${currentX}px,${currentY}px) rotate(${index * 2}deg)`;
            })
        }

        window.addEventListener('scroll', (e) => {

            box = list.getBoundingClientRect();

            if (box.y < window.innerHeight / 1.15) {
                list.classList.add('is-started');

                    setTimeout(() => {
                        if(list.classList.contains('is-started') && !list.classList.contains('active')) {
                            clientsSlider();
                            list.classList.add('active');
                        }
                    }, 1000)
            }

            if (window.outerWidth > 768 && list.classList.contains('is-started')) {
                let items = list.querySelectorAll('.clients__list-item');

                items.forEach(item => {
                    item.querySelector('.clients__list-content').style.transform = `translate(0px,0px)`;
                })
                list.classList.add('is-started');
            }
        })
    }

    const clientsSlider = () => {
        let slider = document.querySelector('#clients2');
        const splide = new Splide( slider, {
            type   : 'loop',
            drag   : 'free',
            focus  : 0,
            perPage: 'auto',
            arrows: false,
            autoWidth: true,
            autoScroll: {
                speed: 1,
                pauseOnHover: false,
                rewind: true
            },
        } );

        splide.mount( window.splide.Extensions);
    }
}

const toggleFeedbackForm = () => {
    let linkForm = document.querySelector('#contactsFormLink'),
        linkMenu = document.querySelector('#contactsFormLinkMenu'),
        linkMenuClass = document.querySelector('.contactsFormLinkMenu'),
        form = document.querySelector("#contactsFrom"),
        close = document.querySelector("#contactsFromClose");

    function openForm () {
        form.classList.add('is-active');
        document.body.style.overflow = 'hidden';
        document.body.style.paddingRight = calculateScrollbarWidth() +'px';
    }

    document.addEventListener('click', (e)=>{
        const trigger = e.target.closest('#contactsFormLink, #contactsFormLinkMenu, .contactsFormLinkMenu');
        if(trigger) {
            openForm();
            e.preventDefault();
        }
    })

    close.addEventListener('click', ()=>{
        form.classList.remove('is-active');
        document.body.style.overflow = '';
        document.body.style.paddingRight = ''
    }, false);



    document.addEventListener('click', (e) => {
        const withinBoundariesForm = e.composedPath().includes(form),
            withinBoundariesLinkForm = e.composedPath().includes(linkForm),
            withinBoundariesLinkMenu = e.composedPath().includes(linkMenu),
            withinBoundariesLinkMenuClass = e.composedPath().includes(linkMenuClass);

        if(!withinBoundariesForm && !withinBoundariesLinkForm && !withinBoundariesLinkMenu && !withinBoundariesLinkMenuClass && form.classList.contains('is-active')) {
            form.classList.remove('is-active');
            document.body.style.overflow = '';
            document.body.style.paddingRight = ''
        }
    }, false)
}

const calculateScrollbarWidth = function() {
    // Create the parent element
    const outer = document.createElement('div');
    outer.style.visibility = 'hidden';
    outer.style.overflow = 'scroll';

    // Append it to `body`
    document.body.appendChild(outer);

    // Create the child element
    const inner = document.createElement('div');
    outer.appendChild(inner);

    // Calculate the difference between their widths
    const scrollbarWidth = outer.offsetWidth - inner.offsetWidth;

    // Remove the parent element
    document.body.removeChild(outer);

    return scrollbarWidth;

};

const scrollCases = () => {
    let list = document.querySelector('.cases__list');
    if(list) {
        let box = list.getBoundingClientRect();

        if (window.outerWidth > 768 && !list.classList.contains('is-started')) {
            let items = list.querySelectorAll('.cases__list-item');

            let startX = list.getBoundingClientRect().width / 2,
                startY = list.getBoundingClientRect().y;
            items.forEach((item, index) => {
                let _itemX = item.getBoundingClientRect().x,
                    _itemY = item.getBoundingClientRect().y,
                    currentX = startX - _itemX,
                    currentY = startY - _itemY;

                item.style.transform = `translate(${currentX}px,0px) rotate(${index * 2}deg)`;
                item.style.margin = '0';
            })
            //list.classList.add('is-started')
        }

        window.addEventListener('scroll', () => {
            box = list.getBoundingClientRect();

            if (box.y < window.innerHeight / 1.15) {
                list.classList.add('is-started')
            }

            if (window.outerWidth > 768 && list.classList.contains('is-started')) {
                let items = list.querySelectorAll('.cases__list-item');

                items.forEach(item => {
                    item.style.transform = `translate(0px,0px)`;
                    item.style.margin = '';
                })
            }
        })
    }
}

const typeCaptions = () => {
    const typeElements = document.querySelectorAll('.js-type');

    if (typeof appear !== 'function') {
        typeElements.forEach((el) => {
            el.classList.add('is-appear');
        });
        return;
    }

    appear({
        elements: function elements(){
            return typeElements
        },
        appear: function appear(el){
            el.classList.add('is-appear')
        }
    });
}
const servicesSlider = () => {
    let servicesBusinessSlider = document.querySelectorAll('.js-servicesBusinessSlider');

    if(servicesBusinessSlider) {
        servicesBusinessSlider.forEach((slider) => {
            let sliderCountsDom = slider.querySelector('.swiper-counts__counts'),
                currentSlide = slider.querySelector('.swiper-counts__current');

            new Swiper(slider, {
                loop: true,
                spaceBetween: 52,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 'auto',
                        spaceBetween: 30,
                    }
                },
                on: {
                    init: function () {
                        let slides = this.slides;
                        slides.forEach((slide,index)=>{
                            let content = slide.querySelector('.services-business__slider-slide');
                            content.setAttribute('data-aos', 'fade-left');
                            content.setAttribute('data-aos-delay', index*50)
                        })
                    },
                    beforeInit: function () {
                        sliderCountsDom.textContent = this.wrapperEl.querySelectorAll(".swiper-slide").length;
                    },
                    slideChange: function (swiper) {
                        currentSlide.textContent = swiper.realIndex+1
                    }
                },
            });
        })
    }
}

const caseStudiesCarousel = () => {
    let caseStudiesSliders = document.querySelectorAll('.js-caseStudiesCarousel');

    if(caseStudiesSliders) {
        caseStudiesSliders.forEach((slider) => {
            let sliderWrap = slider.closest('.cases__carousel-wrap'),
                controls = sliderWrap ? sliderWrap.querySelector('.swiper-controls') : null,
                sliderCountsDom = slider.querySelector('.swiper-counts__counts'),
                currentSlide = slider.querySelector('.swiper-counts__current');

            new Swiper(slider, {
                loop: false,
                spaceBetween: 16,
                slidesPerView: 1.1,
                navigation: {
                    nextEl: controls ? controls.querySelector('.swiper-button-next') : null,
                    prevEl: controls ? controls.querySelector('.swiper-button-prev') : null,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2.15,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 3.15,
                        spaceBetween: 24,
                    },
                    1440: {
                        slidesPerView: 4,
                        spaceBetween: 24,
                    }
                },
                on: {
                    beforeInit: function () {
                        if(sliderCountsDom) {
                            sliderCountsDom.textContent = this.wrapperEl.querySelectorAll('.swiper-slide').length;
                        }
                        if(currentSlide) {
                            currentSlide.textContent = this.wrapperEl.querySelectorAll('.swiper-slide').length ? '1' : '0';
                        }
                    },
                    slideChange: function (swiper) {
                        if(currentSlide) {
                            currentSlide.textContent = String(swiper.realIndex + 1);
                        }
                    }
                },
            });
        })
    }
}

const loadMoreFunc = (button, container) => {
    button.addEventListener('click', (e) => {
        let items = container.querySelectorAll(".is-hidden");

        items.forEach((item) => {
            item.classList.remove("is-hidden");
        });

        button.parentElement.style.display = 'none';
        e.preventDefault();
    }, false);
};

const loadMore = () => {
    let lists = document.querySelectorAll('.list');

    if(lists) {
        lists.forEach((list) => {
            let itemsHidden = list.querySelectorAll('.is-hidden'),
                btnLoadMore = list.querySelector('.list-btn');
            btnLoadMore.querySelector('.count').innerText = itemsHidden.length;

            loadMoreFunc(btnLoadMore, list)
        })
    }
}

const experienceSlider = () => {
    let logos = document.querySelector('#experienceClients');
    if(logos) {
        let alphabet = document.querySelector('#experienceAlphabet'),
            letters = alphabet.querySelectorAll('span');

        let logosSettings = {
            freeMode: true,
            slidesPerView: 'auto',
            spaceBetween: 20,
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true
            },
            observeParents: true,
            observeSlideChildren: true,
            runCallbacksOnInit: true,
            observer: true
        }

        let slider = new Swiper(logos, logosSettings);

        letters.forEach((letter) => {
            letter.addEventListener('click', (e) => {
                let active = alphabet.querySelector('.is-active');
                if(active) active.classList.remove('is-active');
                letter.classList.add('is-active');

                let slides = slider.slides;

                slides.forEach((slide) => {
                    let slideLetter = slide.getAttribute('data-sort'),
                        currentLetter = letter.getAttribute('data-letter');

                    slideLetter === currentLetter ? slide.style.display = '' : slide.style.display = 'none';
                    currentLetter === 'all' ? slide.style.display = '' : '';
                })
                slider.update();
                slider.slideTo(0);

                e.preventDefault();
            }, false)
        })


    }
}

const popupShow = (popup) => {
    popup = document.querySelector(popup);
    if(popup) {
        let video = popup.querySelector('.video--popup video');
        if(video) {
            popupVideo(video)
        }

        let iframe = popup.querySelector('iframe');
        if(iframe && popup.classList.contains('popup--video')) {
            const player = new Vimeo.Player(iframe);

            let playPromise = player.play();
            if (playPromise !== undefined) {

                playPromise.then(function() {
                    // Automatic playback started!

                }).catch(function(error) {
                    // Automatic playback failed.
                    // Show a UI element to let the user manually start playback.
                });
            }
        }

        popup.querySelector('.simplebar-content-wrapper') && popup.querySelector('.simplebar-content-wrapper').scrollTo(0, 0);

        popup.classList.add('is-active');
        document.body.style.overflow = 'hidden'
        document.body.style.paddingRight = calculateScrollbarWidth()+'px';
        popup.style.paddingRight = calculateScrollbarWidth()+'px';
    } else {
        console.log('Error: No popup with this name')
    }

}
const popupHide = (popup) => {
    popup = popup ||  document.querySelector(popup);

    let video = popup.querySelector('.video--popup video');
    if(video) {
        video.pause();
        video.closest('.video').classList.add('is-paused');
    }

    let iframe = popup.querySelector('iframe');
    if(iframe && popup.classList.contains('popup--video')) {
        const player = new Vimeo.Player(iframe);
        player.pause();
    }
    popup.classList.remove('is-active');
    document.body.style.overflow = ''
    document.body.style.paddingRight = '';
    popup.style.paddingRight = '';
}

const popups = () => {
    document.addEventListener('click', (e) => {
        let _target = e.target,
            popupName = _target.classList.contains('popup-link') ? _target.getAttribute('data-popup') : _target.closest('.popup-link') ? _target.closest('.popup-link').getAttribute('data-popup') : null,
            popupClose = _target.classList.contains('popup__close');

        if(popupName) {
            popupShow(popupName);
            e.preventDefault();
        }
        if(popupClose) {
            popupHide(_target.closest('.popup'))
        }

    }, false);

    document.addEventListener('click', (e) => {
        let video = document.querySelector('.popup--video video');
        if(e.target === video) {
            if (video.paused === false) {
                video.pause();
                video.closest('.video').classList.add('is-paused');
            } else {
                video.play();
                video.closest('.video').classList.remove('is-paused');
            }
        }
    }, false)

    document.addEventListener('keydown', function(event){
        if(event.key === "Escape" && document.querySelector('.popup.is-active')){
            popupHide(document.querySelector('.popup.is-active'));
        }
    }, false);
}

const apartGalleryPopup = () => {
    const galleryItems = document.querySelectorAll('.js-apart-gallery-item');
    const galleryPopup = document.querySelector('#apartGalleryPopup');

    if (!galleryItems.length || !galleryPopup) {
        return;
    }

    const popupImage = galleryPopup.querySelector('.about-sets-us-apart__popup-image');
    if (!popupImage) {
        return;
    }

    galleryItems.forEach((galleryItem) => {
        galleryItem.addEventListener('click', () => {
            const fullImage = galleryItem.getAttribute('data-image');
            const fullImageAlt = galleryItem.getAttribute('data-image-alt') || '';

            if (!fullImage) {
                return;
            }

            popupImage.setAttribute('src', fullImage);
            popupImage.setAttribute('alt', fullImageAlt);
        }, false);
    });
}

const popupVideo = (video) => {
    let playPromise = video.play();

    // In browsers that don’t yet support this functionality,
    // playPromise won’t be defined.
    if (playPromise !== undefined) {
        playPromise.then(function() {
            // Automatic playback started!
            video.closest('.video').classList.remove('is-paused');

        }).catch(function(error) {
            // Automatic playback failed.
            // Show a UI element to let the user manually start playback.
        });
    }
    video.addEventListener('ended', () => {
        video.load();
        video.closest('.video').classList.add('is-paused');
    })
}

const teamFilter = () => {
    let teamFilter = document.querySelector('#teamFilter'),
        teamList = document.querySelector('#teamList');

    if(teamFilter) {
        let filters = teamFilter.querySelectorAll('.team-experts__filter-control'),
            persons = teamList.querySelectorAll('.team-experts__filter-item'),
            filter = [];

        function arrayRemove(arr, value) {
            return arr.filter(function(ele){
                return ele !== value;
            });
        }

        function findCommonElements(arr1, arr2) {
            return arr1.some(item => arr2.includes(item))
        }

        filters.forEach((item)=> {
            item.addEventListener('click', () => {
                let _target = parseInt(item.getAttribute('data-filter')),
                    currentFilter = [];

                item.classList.toggle('is-active');

                if(item.classList.contains('is-active')) {
                    filter.push(_target)
                } else {
                    filter = arrayRemove(filter,_target)
                }

                teamFilter.setAttribute('data-filter', filter)

                let activeCounts = teamFilter.querySelectorAll('.is-active').length;

                currentFilter = teamFilter.getAttribute('data-filter');
                currentFilter = currentFilter.split(',');

                persons.forEach((person) => {
                    let personFilter = person.getAttribute('data-filter');
                    personFilter = personFilter.split(',')

                    findCommonElements(currentFilter, personFilter) ? person.hidden = false : person.hidden = true;

                    if(activeCounts === 0) {
                        person.hidden = false
                    }
                })
            })
        })
    }
}

const hoverAparts = () => {
    let apartsList = document.querySelector('.about-sets-us-apart__list');

    if(apartsList) {
        const aparts = apartsList.querySelectorAll('.about-sets-us-apart__list-item');
        const desktopHoverMedia = window.matchMedia('(min-width: 64em) and (hover: hover) and (pointer: fine)');

        if (!aparts.length) {
            return;
        }

        const setActive = (item) => {
            if (!item || item.classList.contains('is-active')) {
                return;
            }

            const current = apartsList.querySelector('.about-sets-us-apart__list-item.is-active');
            if (current) {
                current.classList.remove('is-active');
            }

            item.classList.add('is-active');
        };

        if (!apartsList.querySelector('.about-sets-us-apart__list-item.is-active')) {
            aparts[0].classList.add('is-active');
        }

        aparts.forEach((item, index) => {
            item.addEventListener('mouseenter', () => {
                if (desktopHoverMedia.matches) {
                    setActive(item);
                }
            }, false);

            item.addEventListener('focus', () => {
                setActive(item);
            }, false);

            item.addEventListener('click', () => {
                setActive(item);
            }, false);

            item.addEventListener('keydown', (event) => {
                let nextIndex = null;

                if (event.key === 'ArrowDown' || event.key === 'ArrowRight') {
                    nextIndex = (index + 1) % aparts.length;
                }

                if (event.key === 'ArrowUp' || event.key === 'ArrowLeft') {
                    nextIndex = (index - 1 + aparts.length) % aparts.length;
                }

                if (event.key === 'Home') {
                    nextIndex = 0;
                }

                if (event.key === 'End') {
                    nextIndex = aparts.length - 1;
                }

                if (nextIndex !== null) {
                    event.preventDefault();
                    aparts[nextIndex].focus();
                    setActive(aparts[nextIndex]);
                }
            }, false);
        });
    }
}


const smoothScroll = () => {
    document.addEventListener('click', (e) => {
        let _target = e.target;

        if(_target.getAttribute('data-smooth-scroll')) {
            console.log(e)
            let element = document.querySelector(_target.getAttribute('href'));
            element.scrollIntoView({ behavior: 'smooth', block: 'start'});
            e.preventDefault();
            return false
        }
    }, false)
}

const checkForm = () => {
    let validateEmail = (input) => {
        let emailFormat = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
        if(input.value.match(emailFormat)) {
            input.classList.remove('error')
            return true;
        }
        else {
            input.classList.add('error')
            return false;
        }
    }

    let emailInputs = document.querySelectorAll('.js-email');
    if(emailInputs) {
        emailInputs.forEach((email) => {
            email.addEventListener('keyup', () => {
                validateEmail(email);
                if (email.value === '') email.classList.remove('error')
            });
        })
    }
}

const teamSliders = () => {
    let sliderFirst = document.querySelector('.about-team__slider--first'),
        sliderSecond = document.querySelector('.about-team__slider--second');

    const initTeamSlider = (sliderElement, attempt = 0) => {
        if (!sliderElement) {
            return;
        }

        if (typeof Swiper !== 'function') {
            if (attempt < 20) {
                setTimeout(() => {
                    initTeamSlider(sliderElement, attempt + 1);
                }, 150);
            }
            return;
        }

        if (sliderElement.dataset.teamSliderInitialized === '1') {
            return;
        }

        sliderElement.dataset.teamSliderInitialized = '1';

        new Swiper(sliderElement, {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 'auto',
            direction: 'vertical',
            autoplay: {
                delay: 1
            },
            freeMode: true,
            speed: 20000,
            allowTouchMove: false,
            breakpoints: {
                1200: {
                    spaceBetween: 30
                }
            }
        });
    };

    const runWhenImagesReady = (sliderElement) => {
        if (!sliderElement) {
            return;
        }

        if (typeof imagesLoaded === 'function') {
            imagesLoaded(sliderElement, function () {
                initTeamSlider(sliderElement);
            });
            return;
        }

        initTeamSlider(sliderElement);
    };

    if(sliderFirst) {
        runWhenImagesReady(sliderFirst);
        runWhenImagesReady(sliderSecond);
    }
}

const slideToggleArticle = () => {
    let articles = document.querySelectorAll('.giving-back__list-description');

    articles.forEach(article => {
        let trigger = article.querySelector('.giving-back__list-trigger');

        let rmjs = new Readmore(article, {
            speed: 300,
            moreLink: function(element) {
                return `<span>[...]</span>`;
            },
            lessLink: function(element) {
                return `<span></span>`;
            },
            beforeToggle: function () {
                article.querySelector('.giving-back__list-trigger').remove()
            },
            afterToggle: function() {
                rmjs.destroy();
            },
            collapsedHeight: 200
        });

        article.addEventListener('click', (e) => {
            if(article.getAttribute('data-readmore') != null && article.getAttribute('data-readmore').length >= 0) {
                let realTrigger = article.parentElement.querySelector('[data-readmore-toggle]'),
                    event = new Event("click");

                realTrigger.dispatchEvent(event);

                e.preventDefault();
            }
        }, false)
    })
}

var DOMAnimations = {

    /**
    * SlideUp
    *
    * @param {HTMLElement} element
    * @param {Number} duration
    * @returns {Promise<boolean>}
    */
    slideUp: function (element, duration = 500) {

        return new Promise(function (resolve, reject) {

            element.style.height = element.offsetHeight + 'px';
            element.style.transitionProperty = `height, margin, padding`;
            element.style.transitionDuration = duration + 'ms';
            element.offsetHeight;
            element.style.overflow = 'hidden';
            element.style.height = 0;
            element.style.paddingTop = 0;
            element.style.paddingBottom = 0;
            element.style.marginTop = 0;
            element.style.marginBottom = 0;
            window.setTimeout(function () {
                element.style.display = 'none';
                element.style.removeProperty('height');
                element.style.removeProperty('padding-top');
                element.style.removeProperty('padding-bottom');
                element.style.removeProperty('margin-top');
                element.style.removeProperty('margin-bottom');
                element.style.removeProperty('overflow');
                element.style.removeProperty('transition-duration');
                element.style.removeProperty('transition-property');
                resolve(false);
            }, duration)
        })
    },

    /**
    * SlideDown
    *
    * @param {HTMLElement} element
    * @param {Number} duration
    * @returns {Promise<boolean>}
    */
    slideDown: function (element, duration = 500) {

        return new Promise(function (resolve, reject) {

            element.style.removeProperty('display');
            let display = window.getComputedStyle(element).display;

            if (display === 'none')
                display = 'block';

            element.style.display = display;
            let height = element.offsetHeight;
            element.style.overflow = 'hidden';
            element.style.height = 0;
            element.style.paddingTop = 0;
            element.style.paddingBottom = 0;
            element.style.marginTop = 0;
            element.style.marginBottom = 0;
            element.offsetHeight;
            element.style.transitionProperty = `height, margin, padding`;
            element.style.transitionDuration = duration + 'ms';
            element.style.height = height + 'px';
            element.style.removeProperty('padding-top');
            element.style.removeProperty('padding-bottom');
            element.style.removeProperty('margin-top');
            element.style.removeProperty('margin-bottom');
            window.setTimeout(function () {
                element.style.removeProperty('height');
                element.style.removeProperty('overflow');
                element.style.removeProperty('transition-duration');
                element.style.removeProperty('transition-property');
            }, duration)
        })
    },

    /**
    * SlideToggle
    *
    * @param {HTMLElement} element
    * @param {Number} duration
    * @returns {Promise<boolean>}
    */
    slideToggle: function (element, duration = 500) {

        if (window.getComputedStyle(element).display === 'none') {

            return this.slideDown(element, duration);

        } else {

            return this.slideUp(element, duration);
        }
    }
}