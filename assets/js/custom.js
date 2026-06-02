/**
 * Custom Theme Scripts
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        initHeroDotGrid();
        initCustomCursor();
    });

    // Custom orange dot cursor
    function initCustomCursor() {
        const cursor = document.createElement('div');
        cursor.classList.add('custom-cursor');
        document.body.appendChild(cursor);

        let mouseX = 0;
        let mouseY = 0;
        let isMoving = false;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            if (!isMoving) {
                isMoving = true;
                requestAnimationFrame(() => {
                    cursor.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0)`;
                    isMoving = false;
                });
            }
        });

        // Hover effect using event delegation
        document.addEventListener('mouseover', (e) => {
            if (e.target.closest('a, button, .year-wrap, input, textarea, select')) {
                cursor.classList.add('hover');
            }
        });

        document.addEventListener('mouseout', (e) => {
            if (e.target.closest('a, button, .year-wrap, input, textarea, select')) {
                cursor.classList.remove('hover');
            }
        });
    }

    // Hero section animated dot grid (canvas)
    function initHeroDotGrid() {
        const canvas = document.getElementById('heroDotCanvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let width, height, dots = [];
        const spacing = 50, dotSize = 1;
        function resize() {
            width = canvas.width = canvas.offsetWidth;
            height = canvas.height = canvas.offsetHeight;
            dots = [];
            for (let x = 0; x < width; x += spacing) {
                for (let y = 0; y < height; y += spacing) {
                    dots.push({ x, y, originX: x, originY: y, phase: Math.random() * Math.PI * 2 });
                }
            }
        }
        window.addEventListener('resize', resize);
        resize();
        let tick = 0;
        function animate() {
            tick += 0.01;
            ctx.clearRect(0, 0, width, height);
            dots.forEach(dot => {
                const moveX = Math.sin(tick + dot.phase) * 10;
                const moveY = Math.cos(tick + dot.phase) * 10;
                ctx.beginPath();
                ctx.arc(dot.originX + moveX, dot.originY + moveY, dotSize, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(254, 124, 3, 0.15)';
                ctx.fill();
            });
            requestAnimationFrame(animate);
        }
        animate();
    }

})(jQuery);
