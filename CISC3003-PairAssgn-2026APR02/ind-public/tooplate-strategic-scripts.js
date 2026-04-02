// JavaScript Document - 精简版
// 只保留CSS无法实现的核心功能

// Mobile Menu Toggle - 基础切换功能
const mobileMenu = document.querySelector('.mobile-menu');
const navLinks = document.querySelector('.nav-links');

if (mobileMenu && navLinks) {
   mobileMenu.addEventListener('click', () => {
      navLinks.classList.toggle('active');
      mobileMenu.classList.toggle('active');
   });
}

// Active Menu Highlight - 基于滚动位置更新导航
function updateActiveMenu() {
   const sections = document.querySelectorAll('section[id]');
   const navLinks = document.querySelectorAll('.nav-links a');

   let current = 'home';

   if (window.scrollY > 100) {
      sections.forEach(section => {
         const sectionTop = section.offsetTop;
         if (scrollY >= sectionTop - 200) {
            current = section.getAttribute('id');
         }
      });
   }

   navLinks.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('href').substring(1) === current) {
         link.classList.add('active');
      }
   });
}

window.addEventListener('scroll', updateActiveMenu);

// Initialize with only home active on page load
document.addEventListener('DOMContentLoaded', () => {
   const navLinks = document.querySelectorAll('.nav-links a');
   const homeLink = document.querySelector('.nav-links a[href="#home"]');

   navLinks.forEach(link => link.classList.remove('active'));
   if (homeLink) {
      homeLink.classList.add('active');
   }
   updateActiveMenu();
});

// Services Tab Functionality - 标签切换
const serviceTabs = document.querySelectorAll('.service-tab');
const serviceDetails = document.querySelectorAll('.service-details');

serviceTabs.forEach(tab => {
   tab.addEventListener('click', () => {
      const target = tab.getAttribute('data-target');

      serviceTabs.forEach(t => t.classList.remove('active'));
      serviceDetails.forEach(d => d.classList.remove('active'));

      tab.classList.add('active');
      document.querySelector(`.service-details[data-service="${target}"]`).classList.add('active');
   });
});

// Smooth Scrolling - 锚点链接平滑滚动
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
   anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
         target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
         });
      }
      // 关闭移动菜单
      if (navLinks.classList.contains('active')) {
         navLinks.classList.remove('active');
         mobileMenu.classList.remove('active');
      }
   });
});

// Scroll Animations - 元素进入视口动画
const observerOptions = {
   threshold: 0.15,
   rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
   entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
         setTimeout(() => {
            entry.target.classList.add('animate');
         }, index * 100);
      }
   });
}, observerOptions);

// 观察所有动画元素
document.querySelectorAll('.fade-in, .service-tab, .team-member, .testimonial, .counter').forEach(el => {
   observer.observe(el);
});

// Enhanced Counter Animation - 数字递增动画
function animateCounter(element) {
   if (element.classList.contains('animated')) return;
   element.classList.add('animated');

   const target = parseInt(element.getAttribute('data-count'));
   const increment = target / 80;
   let current = 0;

   const timer = setInterval(() => {
      current += increment;
      const value = Math.floor(current);
      element.textContent = target > 100 ? value : value + '%';

      if (current >= target) {
         element.textContent = target > 100 ? target : target + '%';
         clearInterval(timer);
      }
   }, 25);
}

// Contact Form submission - 表单提交处理
const contactForm = document.querySelector('.contact-form');
if (contactForm) {
   contactForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const submitBtn = contactForm.querySelector('.submit-btn');
      const originalText = submitBtn.textContent;

      submitBtn.textContent = 'Initiating Connection...';
      submitBtn.classList.add('loading');

      setTimeout(() => {
         submitBtn.textContent = 'Partnership Initiated!';
         setTimeout(() => {
            submitBtn.textContent = originalText;
            submitBtn.classList.remove('loading');
            contactForm.reset();
         }, 3000);
      }, 2000);
   });
}

// 页面加载完成后添加类
document.addEventListener('DOMContentLoaded', () => {
   document.body.classList.add('page-loading');

   // 添加滚动进度条功能
   const scrollProgress = document.createElement('div');
   scrollProgress.className = 'scroll-progress';
   document.body.appendChild(scrollProgress);

   window.addEventListener('scroll', () => {
      const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
      scrollProgress.style.width = scrolled + '%';
   });
});