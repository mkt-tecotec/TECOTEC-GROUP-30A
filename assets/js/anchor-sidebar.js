document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.hp-anchor-item');
    if (!items.length) return;

    // Smooth scroll to section
    items.forEach(item => {
        item.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                let offset = targetSection.getBoundingClientRect().top + window.scrollY;
                
                // Fine-tuning for sections
                if (targetId === '#hp-overview') {
                    // Overview might have some padding or pin logic
                    offset -= 50; 
                } else if (targetId === '#hp-news') {
                    offset -= 50;
                }

                window.scrollTo({
                    top: offset,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Update active state on scroll
    function updateActiveAnchor() {
        let currentActive = null;
        // Check activation when section reaches middle of viewport
        const scrollPosition = window.scrollY + (window.innerHeight / 2);

        items.forEach(item => {
            const targetId = item.getAttribute('data-target');
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                const rect = targetSection.getBoundingClientRect();
                const absoluteTop = rect.top + window.scrollY;
                
                if (scrollPosition >= absoluteTop && scrollPosition < absoluteTop + rect.height) {
                    currentActive = item;
                }
            }
        });

        // Fallback for bottom of page
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {
            currentActive = items[items.length - 1];
        }

        // Fallback for top of page
        if (window.scrollY < 100) {
            currentActive = items[0];
        }

        if (currentActive) {
            items.forEach(i => i.classList.remove('active'));
            currentActive.classList.add('active');
        }
    }

    window.addEventListener('scroll', updateActiveAnchor, { passive: true });
    // Initial call
    setTimeout(updateActiveAnchor, 100);
});
