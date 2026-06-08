/**
 * Hero Canvas Dot Particle Effect
 *
 * - Fetches positions from circle_positions.json
 * - Interactive repulsion + elastic spring return
 */
(function () {
    'use strict';

    // ── Ambient Particles (Background) ──────────────────────────────────
    class AmbientParticles {
        constructor(wrapEl) {
            this.wrap = wrapEl;
            this.canvas = document.createElement('canvas');
            this.ctx = this.canvas.getContext('2d');
            this.particles = [];
            this.numParticles = 60; 
            this.colors = ['#ff9900', '#146eb4'];
            this.rafId = null;
            this.W = 0;
            this.H = 0;
            
            this._setup();
            this._createParticles();
            this._bind();
            this._loop();
        }

        _setup() {
            this.canvas.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:20;';
            this.wrap.insertBefore(this.canvas, this.wrap.firstChild);
            this._resize();
        }

        _resize() {
            const rect = this.wrap.getBoundingClientRect();
            const dpr = window.devicePixelRatio || 2;
            this.W = rect.width;
            this.H = rect.height;
            this.canvas.width = this.W * dpr;
            this.canvas.height = this.H * dpr;
            this.ctx.scale(dpr, dpr);
        }

        _createParticles() {
            this.particles = [];
            for (let i = 0; i < this.numParticles; i++) {
                this.particles.push({
                    x: Math.random() * this.W,
                    y: Math.random() * this.H,
                    vx: (Math.random() - 0.5) * 0.8,
                    vy: (Math.random() - 0.5) * 0.8,
                    r: Math.random() * 2 + 1.5,
                    color: this.colors[Math.floor(Math.random() * this.colors.length)],
                    alpha: Math.random() * 0.5 + 0.2
                });
            }
        }

        _bind() {
            window.addEventListener('resize', () => {
                this._resize();
            });
        }

        _loop() {
            this.ctx.clearRect(0, 0, this.W, this.H);

            for (let i = 0; i < this.particles.length; i++) {
                const p = this.particles[i];
                p.x += p.vx;
                p.y += p.vy;

                if (p.x < -10) p.x = this.W + 10;
                if (p.x > this.W + 10) p.x = -10;
                if (p.y < -10) p.y = this.H + 10;
                if (p.y > this.H + 10) p.y = -10;

                this.ctx.beginPath();
                this.ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                this.ctx.fillStyle = p.color;
                this.ctx.globalAlpha = p.alpha;
                this.ctx.fill();
            }
            this.ctx.globalAlpha = 1;

            this.rafId = requestAnimationFrame(() => this._loop());
        }
    }

    // ── Main Logo Particles (JSON driven) ──────────────────────────────
    function initLogoParticles(section, wrapper, img) {
        // We set visibility to hidden so the image still takes up space in the DOM,
        // preventing the wrapper's height from collapsing.
        img.style.visibility = 'hidden';

        // Setup Canvas
        const OVERFLOW = 150; // px extra canvas space on each side to allow particles to fly beyond wrapper
        const canvas = document.createElement('canvas');
        canvas.style.cssText = 'position:absolute;top:0;left:0;user-select:none;z-index:10;';
        
        wrapper.style.position = 'relative';
        wrapper.appendChild(canvas);

        const ctx = canvas.getContext("2d", { willReadFrequently: true });

        let width, height;
        let circles = [];
        const mouse = { x: 0, y: 0, active: false };
        let logoBounds = { width: 0, height: 0 };

        let isAnimating = false;
        let isSettling = false;
        let hasSettled = false;
        let animationFrame;
        let settleStartTime = 0;
        let inactiveFrames = 0;
        const wiggleDuration = 750;

        function resizeCanvas() {
            const rect = wrapper.getBoundingClientRect();
            const dpr = window.devicePixelRatio || 1;

            width = rect.width;
            height = rect.height;

            if (width === 0 || height === 0) return;

            // Expand canvas beyond wrapper so repelled particles are not clipped
            const cw = width  + OVERFLOW * 2;
            const ch = height + OVERFLOW * 2;
            canvas.style.width  = `${cw}px`;
            canvas.style.height = `${ch}px`;
            canvas.style.top    = `-${OVERFLOW}px`;
            canvas.style.left   = `-${OVERFLOW}px`;
            canvas.width  = Math.round(cw * dpr);
            canvas.height = Math.round(ch * dpr);

            ctx.setTransform(1, 0, 0, 1, 0, 0);
            ctx.scale(dpr, dpr);

            if (circles.length) recenterLogo();
        }

        async function loadPositions() {
            const themeUrl = img.src.split('/assets/')[0];
            const jsonUrl = themeUrl + '/assets/circle_positions.json';

            try {
                const res = await fetch(jsonUrl);
                const positions = await res.json();
                
                await document.fonts.ready;

                let minX = Infinity, minY = Infinity, maxX = -Infinity, maxY = -Infinity;
                for (const p of positions) {
                    if (p.x < minX) minX = p.x;
                    if (p.y < minY) minY = p.y;
                    if (p.x > maxX) maxX = p.x;
                    if (p.y > maxY) maxY = p.y;
                }

                const origLw = maxX - minX;
                const origLh = maxY - minY;

                // --- TEXT TO DOTS LOGIC ---
                const tCanvas = document.createElement('canvas');
                const tCtx = tCanvas.getContext('2d', { willReadFrequently: true });
                const tW = Math.floor(origLw * 1.5);
                const tH = Math.floor(origLh);
                tCanvas.width = tW;
                tCanvas.height = tH;
                
                const fontSize1 = tH * 0.17;
                const fontSize2 = tH * 0.09;
                
                tCtx.textBaseline = 'middle';
                
                // Draw YEARS
                tCtx.fillStyle = 'rgba(255, 255, 255, 1)';
                tCtx.font = `800 ${fontSize1}px "Montserrat", "Inter", sans-serif`;
                tCtx.fillText('YEARS', 0, tH * 0.47);
                
                // Draw 1996 - 2026
                tCtx.fillStyle = 'rgba(255, 255, 255, 1)';
                tCtx.font = `700 ${fontSize2}px "Montserrat", "Inter", sans-serif`;
                tCtx.fillText('1996 - 2026', 0, tH * 0.59);

                const imgData = tCtx.getImageData(0, 0, tW, tH).data;
                const stepOriginal = Math.max(2, Math.floor(tH / 140)); 
                
                const textStartX = minX + origLw * 0.58; 
                const textStartY = minY;

                let totalR = 0;
                for (const p of positions) totalR += (p.rr || p.r || 1.2);
                const avgR = (totalR / positions.length) * 0.42; // Tăng một chút so với 0.35 để chữ trắng được rõ và sáng hơn

                const step = 4.5; // Giảm mạnh mật độ chấm để giảm lag (ít hạt hơn rất nhiều)
                
                for (let y = 0; y < tH; y += step) {
                    for (let x = 0; x < tW; x += step) {
                        const px = Math.floor(x);
                        const py = Math.floor(y);
                        const idx = (py * tW + px) * 4;
                        const a = imgData[idx + 3];
                        if (a > 128) {
                            positions.push({
                                x: textStartX + x,
                                y: textStartY + y,
                                r: avgR * 1.1, // Giảm kích thước hạt để chữ thanh thoát, không bị đậm/to quá
                                cr: 255,
                                cg: 255,
                                cb: 255,
                                opacity: 1
                            });
                        }
                    }
                }

                // Recalculate bounds with new text dots
                minX = Infinity; minY = Infinity; maxX = -Infinity; maxY = -Infinity;
                for (const p of positions) {
                    if (p.x < minX) minX = p.x;
                    if (p.y < minY) minY = p.y;
                    if (p.x > maxX) maxX = p.x;
                    if (p.y > maxY) maxY = p.y;
                }

                logoBounds.width = maxX - minX;
                logoBounds.height = maxY - minY;

                circles = positions.map(pos => ({
                    originalX: pos.x - minX,
                    originalY: pos.y - minY,
                    originalR: (pos.rr || pos.r || avgR) * 0.9,
                    cr: pos.cr || 255,
                    cg: pos.cg || 255,
                    cb: pos.cb || 255,
                    opacity: ('opacity' in pos) ? pos.opacity : 1,
                    x: 0, y: 0, ox: 0, oy: 0, r: 0,
                    vx: 0, vy: 0,
                    randomX: Math.random() - 0.5,
                    randomY: Math.random() - 0.5
                }));

                requestAnimationFrame(() => {
                    resizeCanvas();
                    recenterLogo();
                    checkActivation();
                });
            } catch (err) {
                console.error("[Hero Particle] Error loading JSON:", err);
            }
        }

        function recenterLogo() {
            const { width: lw, height: lh } = logoBounds;
            
            const availW = width;
            const availH = height;
            
            const scale = Math.min(availW / lw, availH / lh);
            // Shift by OVERFLOW so (0,0) in canvas coords = (-OVERFLOW,-OVERFLOW) in wrapper coords
            const offX = (width - lw * scale) / 2 + OVERFLOW;
            const offY = (height - lh * scale) / 2 + OVERFLOW;

            for (let c of circles) {
                c.x = c.ox = c.originalX * scale + offX;
                c.y = c.oy = c.originalY * scale + offY;
                c.r = c.originalR * scale;
                c.vx = 0; c.vy = 0;
            }
        }

        function easeOutElastic(t) {
            if (t === 0) return 0;
            if (t === 1) return 1;
            const c4 = (2 * Math.PI) / 5;
            return Math.pow(2, -8 * t) * Math.sin((t * 10 - 0.75) * c4) + 1;
        }

        function animate(timestamp) {
            if (!isAnimating) return;

            ctx.clearRect(0, 0, width + OVERFLOW * 2, height + OVERFLOW * 2);

            // Responsive repulsion radius
            const repelRadius = Math.min(width, window.innerWidth) * 0.08;
            const forceDist = repelRadius * repelRadius;
            const drag = 0.93;
            const ease = 0.015;

            if (isSettling) {
                if (!settleStartTime) settleStartTime = timestamp;
                const elapsed = timestamp - settleStartTime;
                const progress = Math.min(elapsed / wiggleDuration, 1);
                const eased = easeOutElastic(progress);
                const intensity = (1 - eased) * 30;

                for (let c of circles) {
                    c.vx += c.randomX * intensity;
                    c.vy += c.randomY * intensity;
                    const dx = c.ox - c.x, dy = c.oy - c.y;
                    c.vx += dx * ease; c.vy += dy * ease;
                    c.vx *= drag; c.vy *= drag;
                    c.x += c.vx; c.y += c.vy;
                    
                    ctx.beginPath();
                    ctx.arc(c.x, c.y, c.r, 0, Math.PI * 2);
                    if (c.cr > 200 && c.cg > 100 && c.cb < 100) {
                        ctx.fillStyle = `rgba(255, 153, 0, ${c.opacity})`;
                        ctx.fill();
                    } else {
                        ctx.fillStyle = `rgba(255, 255, 255, ${c.opacity})`;
                        ctx.fill();
                    }
                }

                if (progress >= 1) {
                    isSettling = false;
                    hasSettled = true;
                    settleStartTime = 0;
                }
            } else {
                for (let c of circles) {
                    let dx = mouse.x - c.x, dy = mouse.y - c.y;
                    let dist2 = dx * dx + dy * dy;

                    if (mouse.active && dist2 < forceDist) {
                        let dist = Math.sqrt(dist2);
                        let norm = dist / repelRadius;
                        let baseForce = Math.max(0, (1 - norm) * 10);
                        const chaos = (Math.random() - 0.5) * 3;
                        const force = baseForce + chaos;
                        let angle = Math.atan2(dy, dx) + (Math.random() - 0.5) * 0.2;
                        c.vx -= Math.cos(angle) * force;
                        c.vy -= Math.sin(angle) * force;
                    }

                    const dxb = c.ox - c.x, dyb = c.oy - c.y;
                    c.vx += dxb * ease; c.vy += dyb * ease;
                    c.vx *= drag; c.vy *= drag;
                    c.x += c.vx; c.y += c.vy;

                    ctx.beginPath();
                    ctx.arc(c.x, c.y, c.r, 0, Math.PI * 2);
                    if (c.cr > 200 && c.cg > 100 && c.cb < 100) {
                        ctx.fillStyle = `rgba(255, 153, 0, ${c.opacity})`;
                        ctx.fill();
                    } else {
                        ctx.fillStyle = `rgba(255, 255, 255, ${c.opacity})`;
                        ctx.fill();
                    }
                }
            }

            let maxVelocity = 0;
            for (let c of circles) {
                maxVelocity = Math.max(maxVelocity, Math.abs(c.vx), Math.abs(c.vy));
            }
            if (!mouse.active && maxVelocity < 0.01) {
                inactiveFrames++;
                if (inactiveFrames > 60) {
                    isAnimating = false;
                    cancelAnimationFrame(animationFrame);
                    return;
                }
            } else {
                inactiveFrames = 0;
            }

            animationFrame = requestAnimationFrame(animate);
        }

        function checkActivation() {
            const rect = section.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;

            if (isVisible && !isAnimating) {
                isAnimating = true;
                for (let c of circles) {
                    c.randomX = Math.random() - 0.5;
                    c.randomY = Math.random() - 0.5;
                }
                isSettling = true;
                settleStartTime = 0;
                hasSettled = false;
                animationFrame = requestAnimationFrame(animate);
            } else if (!isVisible && isAnimating) {
                isAnimating = false;
                cancelAnimationFrame(animationFrame);
            }
        }

        const observer = new IntersectionObserver(
            (entries) => { entries.forEach(e => { if (e.target === section) checkActivation(); }); },
            { threshold: [0, 0.1, 0.5] }
        );
        observer.observe(section);

        window.addEventListener("scroll", checkActivation, { passive: true });
        window.addEventListener("resize", () => {
            requestAnimationFrame(resizeCanvas);
        });

        let lastMouseMove = 0;
        canvas.addEventListener("mousemove", e => {
            if (!isAnimating || !hasSettled) return;
            const now = performance.now();
            if (now - lastMouseMove < 16) return;
            lastMouseMove = now;
            const rect = canvas.getBoundingClientRect();
            mouse.x = e.clientX - rect.left;
            mouse.y = e.clientY - rect.top;
            mouse.active = true;
        });

        canvas.addEventListener("mouseleave", () => { mouse.active = false; });
        canvas.addEventListener("touchmove", e => {
            if (!isAnimating || !hasSettled) return;
            const t = e.touches[0];
            const rect = canvas.getBoundingClientRect();
            mouse.x = t.clientX - rect.left;
            mouse.y = t.clientY - rect.top;
            mouse.active = true;
        }, { passive: true });
        canvas.addEventListener("touchend", () => { mouse.active = false; });

        // Initial check
        if (circles.length > 0) checkActivation();

        loadPositions();
    }

    // ── Auto-init ────────────────────────────────────────────
    function tryInit() {
        const heroSec = document.querySelector('.hp-hero');
        const wrapper = document.querySelector('.hp-hero-visual');
        const img     = wrapper && wrapper.querySelector('img.hp-hero-logo');

        // Init ambient particles
        if (heroSec) {
            new AmbientParticles(heroSec);
        }

        // Init logo particles
        if (heroSec && wrapper && img) {
            if (img.complete && img.src) {
                initLogoParticles(heroSec, wrapper, img);
            } else {
                img.addEventListener('load', () => initLogoParticles(heroSec, wrapper, img));
            }
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', tryInit);
    } else {
        setTimeout(tryInit, 80);
    }
})();
