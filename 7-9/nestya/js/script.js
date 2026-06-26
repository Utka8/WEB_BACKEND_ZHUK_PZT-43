/**
 * БАЗОВЫЕ КЛАССЫ И КОМПОНЕНТЫ
 */

// Базовый класс для всех UI компонентов
class UIComponent {
    constructor(selector) {
        this.container = document.querySelector(selector);
    }
}

// Класс для слайдеров (универсальный)
class Slider extends UIComponent {
    constructor(selector, options = {}) {
        super(selector);
        if (!this.container) return;

        this.track = this.container.querySelector(options.trackSelector);
        this.dotsEl = document.querySelector(options.dotsSelector);
        this.prevBtn = document.querySelector(options.prevBtn);
        this.nextBtn = document.querySelector(options.nextBtn);
        
        this.cards = Array.from(this.track.children);
        this.current = 0;
        this.perView = options.perView || 1;
        
        this.init();
    }

    init() {
        this.buildDots();
        this.initEvents();
    }

    buildDots() {
        if (!this.dotsEl) return;
        this.dotsEl.innerHTML = '';
        const total = Math.ceil(this.cards.length / this.perView);
        for (let i = 0; i < total; i++) {
            const dot = document.createElement('button');
            dot.className = 'slider-dot' + (i === this.current ? ' active' : '');
            dot.addEventListener('click', () => this.goTo(i));
            this.dotsEl.appendChild(dot);
        }
    }

    goTo(idx) {
        const total = Math.ceil(this.cards.length / this.perView);
        this.current = Math.max(0, Math.min(idx, total - 1));
        
        // Расчет смещения
        const cardWidth = this.cards[0].offsetWidth + (this.perView > 1 ? 16 : 0);
        this.track.style.transform = `translateX(${-this.current * this.perView * cardWidth}px)`;

        if (this.dotsEl) {
            this.dotsEl.querySelectorAll('.slider-dot').forEach((d, i) => {
                d.classList.toggle('active', i === this.current);
            });
        }
    }

    initEvents() {
        if (this.prevBtn) this.prevBtn.addEventListener('click', () => this.goTo(this.current - 1));
        if (this.nextBtn) this.nextBtn.addEventListener('click', () => this.goTo(this.current + 1));
        
        // Touch events
        this.track.addEventListener('touchstart', e => { this.startX = e.touches[0].clientX; }, { passive: true });
        this.track.addEventListener('touchend', e => {
            const diff = this.startX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) this.goTo(diff > 0 ? this.current + 1 : this.current - 1);
        });
    }
}

// Класс для FAQ Аккордеона
class FAQ extends UIComponent {
    constructor(selector) {
        super(selector);
        this.items = this.container.querySelectorAll('.faq-item');
        this.init();
    }

    init() {
        this.items.forEach(item => {
            item.querySelector('.faq-question').addEventListener('click', () => this.toggle(item));
        });
    }

    toggle(clickedItem) {
        this.items.forEach(item => {
            if (item !== clickedItem) item.classList.remove('active');
        });
        clickedItem.classList.toggle('active');
    }
}

/**
 * ИНИЦИАЛИЗАЦИЯ
 */
document.addEventListener('DOMContentLoaded', () => {
    // Уведомления и Хедер (оставляем процедурными, так как это простые действия)
    const notifClose = document.getElementById('notifClose');
    if (notifClose) {
        notifClose.addEventListener('click', () => {
            document.getElementById('notificationBar').style.display = 'none';
            document.getElementById('mainHeader').classList.add('notif-hidden');
            document.body.classList.add('no-notif');
        });
    }

    window.addEventListener('scroll', () => {
        document.getElementById('mainHeader').classList.toggle('scrolled', window.scrollY > 10);
    }, { passive: true });

    // Инициализация ООП компонентов
    const reviews = new Slider('.reviews-slider-wrapper', {
        trackSelector: '#reviewsTrack',
        dotsSelector: '#reviewsDots',
        prevBtn: '#reviewsPrev',
        nextBtn: '#reviewsNext',
        perView: window.innerWidth <= 768 ? 1 : 2
    });

    const faq = new FAQ('.faq-list');
});