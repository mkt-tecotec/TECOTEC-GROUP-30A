/**
 * Anchor Sidebar JS
 * Mirrors gallery.js pattern (switchTab / updateSlidingLine) but vertically.
 */
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.querySelector('.hp-anchor-sidebar');
    if (!sidebar) return;

    const items    = sidebar.querySelectorAll('.hp-anchor-item');
    const slidingLine = sidebar.querySelector('.hp-anchor-sliding-line');
    if (!items.length) return;

    /* ── Sliding indicator ──────────────────────────────────── */
    function updateSlidingLine() {
        const activeItem = sidebar.querySelector('.hp-anchor-item.active');
        if (!activeItem || !slidingLine) return;

        // Both .hp-anchor-item and .hp-anchor-sliding-line share transform: translateY(-50%).
        // We can precisely align them by mapping the exact inline `top` coordinate.
        slidingLine.style.top = activeItem.style.top || (activeItem.offsetTop + 'px');
    }

    // Init after layout is ready
    setTimeout(updateSlidingLine, 150);
    window.addEventListener('resize', updateSlidingLine);

    /* ── Smooth scroll to section ───────────────────────────── */
    function scrollToSection(targetId) {
        const targetEl = document.querySelector(targetId);
        if (!targetEl) return;

        let offset = targetEl.getBoundingClientRect().top + window.scrollY;

        // Small nudge for sections with sticky headers / pin spacers
        if (targetId === '#hp-overview' || targetId === '#hp-news') {
            offset -= 50;
        }

        window.scrollTo({ top: offset, behavior: 'smooth' });
    }

    /* ── Activate an item ───────────────────────────────────── */
    function activateItem(item) {
        if (item.classList.contains('active')) return;
        items.forEach(i => i.classList.remove('active'));
        item.classList.add('active');
        updateSlidingLine();
    }

    /* ── Click handler ──────────────────────────────────────── */
    items.forEach(item => {
        item.addEventListener('click', function () {
            activateItem(this);
            scrollToSection(this.dataset.target);
        });
    });

    /* ── Scroll spy ─────────────────────────────────────────── */
    function updateActiveOnScroll() {
        const mid = window.scrollY + window.innerHeight / 2;
        let current = null;

        items.forEach(item => {
            const targetEl = document.querySelector(item.dataset.target);
            if (!targetEl) return;
            const rect = targetEl.getBoundingClientRect();
            const absTop = rect.top + window.scrollY;
            if (mid >= absTop && mid < absTop + rect.height) {
                current = item;
            }
        });

        // Fallback: bottom of page → last item
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {
            current = items[items.length - 1];
        }
        // Fallback: top of page → first item
        if (window.scrollY < 100) {
            current = items[0];
        }

        if (current) activateItem(current);
    }

    window.addEventListener('scroll', updateActiveOnScroll, { passive: true });
    setTimeout(updateActiveOnScroll, 200);
});
