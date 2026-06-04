/**
 * Hero Canvas Dot Particle Effect
 *
 * - Fetches SVG as Blob URL → draws to canvas → correct colors (no CORS)
 * - Every 4px = 1 small round dot (radius 1.5px)
 * - Mouse repulsion + spring return
 */
(function () {
    'use strict';

    // ── CONFIG ──────────────────────────────────────────────
    const CFG = {
        SAMPLE_GAP:     4,      // px between dot centers (4px grid)
        DOT_RADIUS:     1.5,    // radius of each dot in px
        EXPLODE_RADIUS: 100,    // cursor influence radius in px
        EXPLODE_FORCE:  35,     // push strength — higher = fly further
        JITTER_FORCE:   4,      // random bounce/jitter when hovered
        SPRING:         0.06,   // return spring stiffness
        DAMPING:        0.88,   // higher damping = dots travel further before slowing
        ALPHA_THRESH:   30,     // min alpha to include a dot (0-255)
        RENDER_SCALE:   2,      // canvas DPR (2 = sharp on retina)
        PADDING:        120,    // extra canvas padding in px to prevent clipping
    };
    // ────────────────────────────────────────────────────────

    class DotParticle {
        constructor(wrapEl, svgSrc) {
            this.wrap   = wrapEl;
            this.src    = svgSrc;
            this.parts  = [];
            this.mouse  = { x: -9999, y: -9999 };
            this.canvas = null;
            this.ctx    = null;
            this.rafId  = null;
            this.W      = 0;
            this.H      = 0;

            this._fetchAndInit();
        }

        // ── Fetch SVG as Blob → avoids cross-origin canvas taint ──
        _fetchAndInit() {
            fetch(this.src)
                .then(r => {
                    if (!r.ok) throw new Error('fetch failed');
                    return r.text();
                })
                .then(svgText => {
                    const blob   = new Blob([svgText], { type: 'image/svg+xml' });
                    const blobURL = URL.createObjectURL(blob);
                    const img    = new Image();
                    img.onload = () => {
                        URL.revokeObjectURL(blobURL);
                        this._setup(img);
                        this._sample(img);
                        this._bind();
                        this._loop();
                    };
                    img.onerror = () => console.warn('[DotParticle] Image failed to load');
                    img.src = blobURL;
                })
                .catch(err => console.warn('[DotParticle] Fetch error:', err));
        }

        _setup(img) {
            const rect  = this.wrap.getBoundingClientRect();
            const scale = rect.width / img.naturalWidth;
            this.imgW = Math.round(rect.width);
            this.imgH = Math.round(img.naturalHeight * scale);

            const pad = CFG.PADDING;
            this.W = this.imgW + pad * 2;
            this.H = this.imgH + pad * 2;

            const dpr = CFG.RENDER_SCALE;

            this.canvas = document.createElement('canvas');
            this.canvas.width  = this.W * dpr;
            this.canvas.height = this.H * dpr;
            // Negative margin pulls the canvas back so the inner image aligns exactly with the wrapper
            this.canvas.style.cssText = `width:${this.W}px;height:${this.H}px;display:block;position:relative;margin:-${pad}px 0 0 -${pad}px;z-index:10;opacity:0;transition:opacity 3s ease-in-out;`;

            this.ctx = this.canvas.getContext('2d');
            this.ctx.scale(dpr, dpr);
            this.ctx.imageSmoothingEnabled = false;

            // Hide original img → show canvas
            const orig = this.wrap.querySelector('img.hp-hero-logo');
            if (orig) orig.style.display = 'none';
            this.wrap.appendChild(this.canvas);

            // Kích hoạt fade in
            setTimeout(() => {
                if (this.canvas) this.canvas.style.opacity = '1';
            }, 50);
        }

        _sample(img) {
            // Draw at display size to get correct pixel positions
            const off  = document.createElement('canvas');
            off.width  = this.imgW;
            off.height = this.imgH;
            const octx = off.getContext('2d');
            octx.imageSmoothingEnabled = true;
            octx.imageSmoothingQuality = 'high';
            octx.drawImage(img, 0, 0, this.imgW, this.imgH);

            const data  = octx.getImageData(0, 0, this.imgW, this.imgH).data;
            const gap   = CFG.SAMPLE_GAP;
            const alpha = CFG.ALPHA_THRESH;
            const r_dot = CFG.DOT_RADIUS;
            const pad   = CFG.PADDING;

            const step = 1; // Duyệt qua từng pixel để lấy modulo linh hoạt
            for (let y = step; y < this.imgH - step; y += step) {
                for (let x = step; x < this.imgW - step; x += step) {
                    const i  = (y * this.imgW + x) * 4;
                    const a  = data[i + 3];
                    if (a < alpha) continue;

                    const r = data[i];
                    const g = data[i + 1];
                    const b = data[i + 2];

                    // Phân biệt màu cam và màu trắng dựa trên kênh Blue (cam có b rất thấp)
                    const isOrange = (b < 100 && r > 200);

                    if (!isOrange) {
                        // Màu trắng: khoảng cách 4px (chuẩn cũ)
                        if (x % gap !== 0 || y % gap !== 0) {
                            continue;
                        }
                    } else {
                        // Màu cam: tăng khoảng cách lên 4px (thưa hơn 3px)
                        if (x % 4 !== 0 || y % 4 !== 0) {
                            continue;
                        }
                    }

                    // Kích thước hạt: cam nhỉnh hơn một chút nhưng không quá to
                    const radius = isOrange ? r_dot * 1.15 : r_dot;

                    // Hiệu ứng bắt đầu: phân tán ngẫu nhiên để tạo hiệu ứng bay vào
                    const startX = x + pad + (Math.random() - 0.5) * 800;
                    const startY = y + pad + (Math.random() - 0.5) * 800;

                    this.parts.push({
                        x:  startX,   y:  startY,
                        ox: x + pad,  oy: y + pad,
                        vx: 0,  vy: 0,
                        color: `rgb(${r},${g},${b})`,
                        r: radius,
                    });
                }
            }
        }

        _bind() {
            const getPos = (e) => {
                const rect = this.canvas.getBoundingClientRect();
                return { x: e.clientX - rect.left, y: e.clientY - rect.top };
            };

            this.canvas.addEventListener('mousemove', e => {
                const p = getPos(e);
                this.mouse.x = p.x;
                this.mouse.y = p.y;
            });

            // Using document to clear mouse if it leaves the window entirely
            // or we could keep canvas mouseleave. Let's keep it on canvas for performance.
            this.canvas.addEventListener('mouseleave', () => {
                this.mouse.x = -9999;
                this.mouse.y = -9999;
            });

            // Touch support
            this.canvas.addEventListener('touchmove', e => {
                const t = e.touches[0];
                const rect = this.canvas.getBoundingClientRect();
                this.mouse.x = t.clientX - rect.left;
                this.mouse.y = t.clientY - rect.top;
            }, { passive: true });

            this.canvas.addEventListener('touchend', () => {
                this.mouse.x = -9999;
                this.mouse.y = -9999;
            });

            // Rebuild on resize
            let _rt;
            window.addEventListener('resize', () => {
                clearTimeout(_rt);
                _rt = setTimeout(() => this._rebuild(), 400);
            });
        }

        _rebuild() {
            cancelAnimationFrame(this.rafId);
            this.parts  = [];
            this.canvas.remove();
            const orig = this.wrap.querySelector('img.hp-hero-logo');
            if (orig) orig.style.display = '';
            this._fetchAndInit();
        }

        _loop() {
            const ctx = this.ctx;
            const mx  = this.mouse.x;
            const my  = this.mouse.y;
            const R   = CFG.EXPLODE_RADIUS;
            const F   = CFG.EXPLODE_FORCE;
            const SP  = CFG.SPRING;
            const DM  = CFG.DAMPING;

            ctx.clearRect(0, 0, this.W, this.H);

            for (let i = 0; i < this.parts.length; i++) {
                const p  = this.parts[i];
                const dx = p.x - mx;
                const dy = p.y - my;
                const d  = Math.sqrt(dx * dx + dy * dy);

                // Repulsion — quadratic falloff
                if (d < R && d > 0) {
                    const t     = (R - d) / R;
                    const force = t * t * F;
                    const ang   = Math.atan2(dy, dx);
                    p.vx += Math.cos(ang) * force;
                    p.vy += Math.sin(ang) * force;

                    // Jitter / bounce effect while hovered
                    const jitter = t * CFG.JITTER_FORCE;
                    p.vx += (Math.random() - 0.5) * jitter;
                    p.vy += (Math.random() - 0.5) * jitter;
                }

                // Spring back
                p.vx += (p.ox - p.x) * SP;
                p.vy += (p.oy - p.y) * SP;

                // Damping
                p.vx *= DM;
                p.vy *= DM;

                p.x += p.vx;
                p.y += p.vy;

                // Draw dot
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = p.color;
                ctx.fill();
            }

            this.rafId = requestAnimationFrame(() => this._loop());
        }
    }

    class AmbientParticles {
        constructor(wrapEl) {
            this.wrap = wrapEl;
            this.canvas = document.createElement('canvas');
            this.ctx = this.canvas.getContext('2d');
            this.particles = [];
            this.numParticles = 60; // Số lượng hạt ambient
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
            this.canvas.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:1;';
            this.wrap.insertBefore(this.canvas, this.wrap.firstChild);
            this._resize();
        }

        _resize() {
            const rect = this.wrap.getBoundingClientRect();
            const dpr = CFG.RENDER_SCALE || 2;
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
                    r: Math.random() * 2 + 1.5, // Bán kính 1.5px đến 3.5px
                    color: this.colors[Math.floor(Math.random() * this.colors.length)],
                    alpha: Math.random() * 0.5 + 0.2 // Độ mờ 0.2 - 0.7
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

                // Vòng lặp khi hạt bay ra khỏi màn hình
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

    // ── Auto-init ────────────────────────────────────────────
    function tryInit() {
        const wrapper = document.querySelector('.hp-hero-visual');
        const img     = wrapper && wrapper.querySelector('img.hp-hero-logo');
        const heroSec = document.querySelector('.hp-hero');

        // Init ambient particles
        if (heroSec) {
            new AmbientParticles(heroSec);
        }

        if (!wrapper || !img) return;

        function start() {
            const rect = wrapper.getBoundingClientRect();
            if (rect.width > 0) {
                new DotParticle(wrapper, img.src);
            } else {
                requestAnimationFrame(start);
            }
        }

        if (img.complete && img.naturalWidth > 0) {
            start();
        } else {
            img.addEventListener('load', start);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', tryInit);
    } else {
        setTimeout(tryInit, 80);
    }
})();
