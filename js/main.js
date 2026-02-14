/**
 * TransAsia Integrate Service Ltd
 * Main JavaScript File
 */

document.addEventListener('DOMContentLoaded', function () {
  // Initialize all components
  initNavigation();
  initScrollAnimations();
  initCounters();
  initAccordions();
  initMobileMenu();
  initBackToTop();
  initSmoothScroll();
  initFormValidation();
  initClientFilter();
  initTestimonialsSlider();
  initContactFormToggle();
});

/**
 * Navigation - Sticky header with hide/show on scroll
 */
function initNavigation() {
  const navbar = document.querySelector('.navbar');
  let lastScrollY = window.scrollY;
  let ticking = false;

  if (!navbar) return;

  function updateNavbar() {
    const currentScrollY = window.scrollY;

    // Add/remove scrolled class
    if (currentScrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }

    // Hide/show on scroll direction
    if (currentScrollY > lastScrollY && currentScrollY > 200) {
      navbar.classList.add('hidden');
    } else {
      navbar.classList.remove('hidden');
    }

    lastScrollY = currentScrollY;
    ticking = false;
  }

  window.addEventListener('scroll', function () {
    if (!ticking) {
      requestAnimationFrame(updateNavbar);
      ticking = true;
    }
  }, { passive: true });
}

/**
 * Scroll Animations using Intersection Observer
 */
function initScrollAnimations() {
  const animatedElements = document.querySelectorAll('[data-aos]');

  if (animatedElements.length === 0) return;

  const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('aos-animate');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  animatedElements.forEach(el => {
    observer.observe(el);
  });
}

/**
 * Animated Counters
 */
function initCounters() {
  const counters = document.querySelectorAll('.counter');

  if (counters.length === 0) return;

  const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.5
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const counter = entry.target;
        const target = parseInt(counter.getAttribute('data-target'));
        const suffix = counter.getAttribute('data-suffix') || '';
        const duration = 2000; // 2 seconds
        const startTime = performance.now();

        function updateCounter(currentTime) {
          const elapsed = currentTime - startTime;
          const progress = Math.min(elapsed / duration, 1);

          // Easing function (ease-out)
          const easeOut = 1 - Math.pow(1 - progress, 3);
          const current = Math.floor(easeOut * target);

          counter.textContent = current.toLocaleString() + suffix;

          if (progress < 1) {
            requestAnimationFrame(updateCounter);
          } else {
            counter.textContent = target.toLocaleString() + suffix;
          }
        }

        requestAnimationFrame(updateCounter);
        observer.unobserve(counter);
      }
    });
  }, observerOptions);

  counters.forEach(counter => {
    observer.observe(counter);
  });
}

/**
 * Accordion functionality
 */
function initAccordions() {
  const accordionHeaders = document.querySelectorAll('.accordion-header');

  accordionHeaders.forEach(header => {
    header.addEventListener('click', function () {
      const accordionItem = this.parentElement;
      const isActive = accordionItem.classList.contains('active');

      // Close all accordions
      document.querySelectorAll('.accordion-item').forEach(item => {
        item.classList.remove('active');
      });

      // Open clicked accordion if it wasn't active
      if (!isActive) {
        accordionItem.classList.add('active');
      }
    });
  });
}

/**
 * Mobile Menu
 */
function initMobileMenu() {
  const menuBtn = document.querySelector('.mobile-menu-btn');
  const mobileMenu = document.querySelector('.mobile-menu');
  const menuOverlay = document.querySelector('.mobile-menu-overlay');
  const menuClose = document.querySelector('.mobile-menu-close');
  const menuLinks = document.querySelectorAll('.mobile-menu a');

  if (!menuBtn || !mobileMenu) return;

  function openMenu() {
    mobileMenu.classList.add('active');
    if (menuOverlay) menuOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    mobileMenu.classList.remove('active');
    if (menuOverlay) menuOverlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  menuBtn.addEventListener('click', openMenu);
  if (menuClose) menuClose.addEventListener('click', closeMenu);
  if (menuOverlay) menuOverlay.addEventListener('click', closeMenu);

  menuLinks.forEach(link => {
    link.addEventListener('click', closeMenu);
  });
}

/**
 * Back to Top Button with Progress
 */
function initBackToTop() {
  const backToTop = document.querySelector('.back-to-top');
  const progressCircle = document.querySelector('.progress-ring-progress');

  if (!backToTop) return;

  const radius = 25;
  const circumference = 2 * Math.PI * radius;

  if (progressCircle) {
    progressCircle.style.strokeDasharray = `${circumference} ${circumference}`;
    progressCircle.style.strokeDashoffset = circumference;
  }

  function updateProgress() {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollPercent = scrollTop / docHeight;

    if (progressCircle) {
      const offset = circumference - (scrollPercent * circumference);
      progressCircle.style.strokeDashoffset = offset;
    }

    // Show/hide button
    if (scrollTop > 300) {
      backToTop.classList.add('visible');
    } else {
      backToTop.classList.remove('visible');
    }
  }

  window.addEventListener('scroll', updateProgress, { passive: true });

  backToTop.addEventListener('click', function () {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  // Initial call
  updateProgress();
}

/**
 * Smooth Scroll for anchor links
 */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        e.preventDefault();
        const navbarHeight = document.querySelector('.navbar')?.offsetHeight || 80;
        const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - navbarHeight;

        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });
  });
}

/**
 * Form Validation
 */
function initFormValidation() {
  const forms = document.querySelectorAll('form[data-validate]');

  forms.forEach(form => {
    form.addEventListener('submit', function (e) {
      let isValid = true;
      const requiredFields = form.querySelectorAll('[required]');

      requiredFields.forEach(field => {
        const formGroup = field.closest('.form-group');

        if (!field.value.trim()) {
          isValid = false;
          field.classList.add('error');
          if (formGroup) formGroup.classList.add('has-error');
        } else {
          field.classList.remove('error');
          if (formGroup) formGroup.classList.remove('has-error');
        }

        // Email validation
        if (field.type === 'email' && field.value) {
          const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailPattern.test(field.value)) {
            isValid = false;
            field.classList.add('error');
            if (formGroup) formGroup.classList.add('has-error');
          }
        }
      });

      if (!isValid) {
        e.preventDefault();
      }
    });
  });
}

/**
 * Client Logo Filter
 */
function initClientFilter() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const clientItems = document.querySelectorAll('.client-grid-item');

  if (filterBtns.length === 0) return;

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      const filter = this.getAttribute('data-filter');

      // Update active button
      filterBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      // Filter items
      clientItems.forEach(item => {
        const region = item.getAttribute('data-region');

        if (filter === 'all' || region === filter) {
          item.style.display = 'flex';
          item.style.animation = 'fadeIn 0.3s ease';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
}

/**
 * Testimonials Slider
 */
function initTestimonialsSlider() {
  const slider = document.querySelector('.testimonials-slider');
  if (!slider) return;

  const slides = slider.querySelectorAll('.testimonial-slide');
  const prevBtn = slider.querySelector('.slider-prev');
  const nextBtn = slider.querySelector('.slider-next');
  let currentSlide = 0;

  if (slides.length <= 1) return;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.style.display = i === index ? 'block' : 'none';
    });
  }

  function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
  }

  function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
  }

  // Initialize
  showSlide(currentSlide);

  // Auto-advance
  let autoSlide = setInterval(nextSlide, 5000);

  // Button controls
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      clearInterval(autoSlide);
      nextSlide();
      autoSlide = setInterval(nextSlide, 5000);
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      clearInterval(autoSlide);
      prevSlide();
      autoSlide = setInterval(nextSlide, 5000);
    });
  }

  // Pause on hover
  slider.addEventListener('mouseenter', () => clearInterval(autoSlide));
  slider.addEventListener('mouseleave', () => {
    autoSlide = setInterval(nextSlide, 5000);
  });
}

/**
 * Contact Form Toggle (Employer/Job Seeker)
 */
function initContactFormToggle() {
  const toggleBtns = document.querySelectorAll('.toggle-btn');
  const companyField = document.querySelector('.company-field');

  if (toggleBtns.length === 0) return;

  toggleBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      const type = this.getAttribute('data-type');

      // Update active button
      toggleBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      const hiddenTypeInput = document.getElementById('form-type-hidden');
      if (hiddenTypeInput) {
        hiddenTypeInput.value = type;
      }

      // Show/hide company field
      if (companyField) {
        if (type === 'employer') {
          companyField.style.display = 'block';
          companyField.querySelector('input').setAttribute('required', 'required');
        } else {
          companyField.style.display = 'none';
          companyField.querySelector('input').removeAttribute('required');
        }
      }
    });
  });
}

/**
 * Lazy Loading Images
 */
if ('IntersectionObserver' in window) {
  const lazyImages = document.querySelectorAll('img[loading="lazy"]');

  const imageObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src || img.src;
        img.removeAttribute('loading');
        imageObserver.unobserve(img);
      }
    });
  });

  lazyImages.forEach(img => imageObserver.observe(img));
}

/**
 * Add CSS animation keyframes dynamically
 */
const style = document.createElement('style');
style.textContent = `
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  
  .form-group input.error,
  .form-group select.error,
  .form-group textarea.error {
    border-color: #dc3545;
  }
  
  .form-group.has-error label {
    color: #dc3545;
  }
`;
document.head.appendChild(style);
