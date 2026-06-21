document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // ==========================================
    // 1. Initialize AOS (Animate on Scroll)
    // ==========================================
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out-cubic',
            once: true,
            offset: 50,
        });
    }

    // ==========================================
    // 2. Preloader
    // ==========================================
    const preloader = document.getElementById('preloader');
    window.addEventListener('load', () => {
        if (preloader) {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        }
    });

    // ==========================================
    // 3. Navbar Scroll Effect & Active Links
    // ==========================================
    const navbar = document.getElementById('mainNav');
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    window.addEventListener('scroll', () => {
        // Navbar shrink/background change
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled', 'shadow-sm');
        } else {
            navbar.classList.remove('scrolled', 'shadow-sm');
        }

        // Active link highlighting based on scroll position
        let current = '';
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (window.scrollY >= sectionTop - 150) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach((link) => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });

    // ==========================================
    // 4. Smooth Scrolling for Anchor Links
    // ==========================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                // Close mobile menu if open
                const navbarCollapse = document.getElementById('navbarNav');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
                
                window.scrollTo({
                    top: targetElement.offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ==========================================
    // 5. Scroll to Top Button
    // ==========================================
    const scrollTopBtn = document.getElementById('scrollTop');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.add('show');
        } else {
            scrollTopBtn.classList.remove('show');
        }
    });

    scrollTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // ==========================================
    // 6. Number Counter Animation (Intersection Observer)
    // ==========================================
    const counters = document.querySelectorAll('.stat-num, .number-val');
    let counted = false;

    const counterObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const updateCount = () => {
                    const targetValue = +target.getAttribute('data-count');
                    const count = +target.innerText;
                    // Lower increment value for slower animation, higher for faster
                    const inc = targetValue / 100;

                    if (count < targetValue) {
                        target.innerText = Math.ceil(count + inc);
                        setTimeout(updateCount, 20);
                    } else {
                        target.innerText = targetValue;
                    }
                };
                updateCount();
                observer.unobserve(target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        counterObserver.observe(counter);
    });


    // ==========================================
    // 8. Testimonials Slider (Drag & Auto Scroll)
    // ==========================================
    const slider = document.getElementById('testimonialsContainer');
    if (slider) {
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2; // Scroll-fast
            slider.scrollLeft = scrollLeft - walk;
        });
    }

});

// ==========================================
// 9. Lightbox Functionality
// ==========================================
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightboxImg');
let currentImageIndex = 0;
// We collect all images from the gallery
const galleryImages = Array.from(document.querySelectorAll('.gallery-card img')).map(img => img.src);

function openLightbox(index) {
    if (lightbox && galleryImages[index]) {
        currentImageIndex = index;
        lightboxImg.src = galleryImages[currentImageIndex];
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
}

function closeLightbox() {
    if (lightbox) {
        lightbox.classList.remove('show');
        document.body.style.overflow = 'auto'; // Restore background scrolling
        setTimeout(() => {
            lightboxImg.src = '';
        }, 300);
    }
}

function changeLightbox(step) {
    currentImageIndex += step;
    
    // Loop back if out of bounds
    if (currentImageIndex >= galleryImages.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = galleryImages.length - 1;
    }
    
    // Add brief fade effect
    lightboxImg.style.opacity = '0';
    setTimeout(() => {
        lightboxImg.src = galleryImages[currentImageIndex];
        lightboxImg.style.opacity = '1';
    }, 200);
}

// Close lightbox on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeLightbox();
    } else if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
        // Handle keyboard navigation for RTL, left arrow goes next (visually), right goes prev
        if (document.body.getAttribute('dir') === 'rtl') {
            if (e.key === 'ArrowLeft') changeLightbox(1);
            if (e.key === 'ArrowRight') changeLightbox(-1);
        } else {
            if (e.key === 'ArrowRight') changeLightbox(1);
            if (e.key === 'ArrowLeft') changeLightbox(-1);
        }
    }
});

// ==========================================
// 10. Video Play Functionality
// ==========================================
function playVideo(element) {
    const videoWrap = element.closest('.video-wrap');
    const video = videoWrap.querySelector('video');
    
    if (video.paused) {
        // Pause all other videos
        document.querySelectorAll('video').forEach(v => {
            if (v !== video) {
                v.pause();
                v.closest('.video-wrap').querySelector('.video-play-overlay').style.display = 'flex';
            }
        });
        
        video.play();
        element.style.display = 'none'; // Hide overlay
        video.setAttribute('controls', 'true');
    }
}

// Show overlay when video is paused
document.querySelectorAll('video').forEach(video => {
    video.addEventListener('pause', function() {
        const overlay = this.closest('.video-wrap').querySelector('.video-play-overlay');
        if (overlay) overlay.style.display = 'flex';
    });
    video.addEventListener('ended', function() {
        const overlay = this.closest('.video-wrap').querySelector('.video-play-overlay');
        if (overlay) overlay.style.display = 'flex';
    });
});

// ==========================================
// 11. Form Submission (Toast Notification)
// ==========================================
function submitForm(event) {
    event.preventDefault(); // Prevent actual form submission
    
    const form = document.getElementById('contactForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Change button state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> جاري الإرسال...';
    submitBtn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        // Show toast
        const toast = document.getElementById('toast');
        toast.classList.add('show');
        
        // Reset form
        form.reset();
        
        // Reset button
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
        
    }, 1500);
}
