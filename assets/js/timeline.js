// Timeline rotation — 1:1 port from 25.hgcapital.com scripts.js
// - step = 15° per year, transform-origin: 0% 50% on .timelinecircle
// - Rotation interpolates with easing factor 0.2 per frame
// - Snaps to nearest year 800ms after user stops scrolling
// - Pre/post 200px buffer in section before/after rotation starts

(function () {
  const section = document.getElementById('history');
  if (!section) return;

  const circle = section.querySelector('.timelinecircle');
  if (!circle) return;

  const STEP = 15;                       // deg per year
  const ROT_START_OFFSET = window.innerHeight * 0.2; // 20vh buffer at top
  const BASE_ROT_END_OFFSET = 0;
  const getRotEndOffset = () => window.innerHeight * 0.15; // 15vh buffer at end (was 120vh — caused skip-2-years bug)
  const EASE = 0.2;                      // per-frame easing
  const SNAP_DELAY = 800;                // ms idle before snap

  let lastRotation = 0;       // target rotation from scroll
  let smoothedRotation = 0;   // currently rendered rotation
  let lastAppliedIndex = -1;

  const years = Array.from(circle.querySelectorAll('.year-wrap'));
  const images = Array.from(section.querySelectorAll('.year-image'));

  const TOTAL_ROTATION = -STEP * (years.length - 1);

  // Click vào năm/dấu chấm để cuộn tới năm đó
  years.forEach((year, index) => {
    year.addEventListener('click', () => {
      const rect = section.getBoundingClientRect();
      const sectionTop = window.scrollY + rect.top;
      const stickyTravel = rect.height - window.innerHeight;
      const scrollRange = stickyTravel - ROT_START_OFFSET - getRotEndOffset();

      const progress = years.length > 1 ? index / (years.length - 1) : 0;
      const targetScrollY = sectionTop + ROT_START_OFFSET + progress * scrollRange;

      if (window.lenis && typeof window.lenis.scrollTo === 'function') {
        window.lenis.scrollTo(targetScrollY);
      } else {
        window.scrollTo({ top: targetScrollY, behavior: 'smooth' });
      }
    });
  });

  function applyYearClasses(rotation) {
    const exactIndex = Math.abs(rotation / STEP);
    const activeIndex = Math.round(exactIndex);

    if (activeIndex === lastAppliedIndex) return;
    lastAppliedIndex = activeIndex;

    years.forEach((year, idx) => {
      year.classList.remove('active', 'nearby', 'far');
      const diff = Math.abs(idx - activeIndex);
      if (diff === 0) year.classList.add('active');
      else if (diff === 1) year.classList.add('nearby');
      else if (diff === 2) year.classList.add('far');
    });

    images.forEach((img, idx) => {
      img.classList.toggle('active', idx === activeIndex);
    });
  }

  function updateTimelineRotation() {
    const rect = section.getBoundingClientRect();
    // Sticky travel = how far -rect.top moves while .timeline-stage stays pinned
    const stickyTravel = rect.height - window.innerHeight;
    const scrollRange = stickyTravel - ROT_START_OFFSET - getRotEndOffset();
    const scrollOffset = Math.min(
      Math.max(-rect.top - ROT_START_OFFSET, 0),
      Math.max(scrollRange, 0)
    );
    const progress = scrollRange > 0 ? scrollOffset / scrollRange : 0;
    const currentRotation = TOTAL_ROTATION * progress;

    // Step to the nearest year exactly
    lastRotation = Math.round(currentRotation / -STEP) * -STEP;
  }

  const tunnelCircle1 = section.querySelector('.tc-1');
  const tunnelCircle2 = section.querySelector('.tc-2');

  function smoothRender() {
    smoothedRotation += (lastRotation - smoothedRotation) * EASE;
    circle.style.transform = `rotate(${smoothedRotation}deg)`;
    applyYearClasses(smoothedRotation);

    // Dotted circle tunnel effect
    if (tunnelCircle1 && tunnelCircle2) {
      // --- BẠN CÓ THỂ CHỈNH TỐC ĐỘ PHÓNG TO Ở ĐÂY ---
      // 1 = Phóng to hết cỡ trong lúc cuộn qua 1 năm.
      // 2 = Phóng to chậm hơn một nửa (mất 2 năm để phóng hết vòng).
      // 0.5 = Phóng to nhanh gấp đôi (1 năm phóng 2 lần).
      const ZOOM_CYCLE = 3;

      const exactIndex = Math.abs(smoothedRotation / STEP);
      const fraction = (exactIndex % ZOOM_CYCLE) / ZOOM_CYCLE;
      // ----------------------------------------------

      const scale1 = 1 + fraction * 3; // Expands from 1x to 4x (tràn qua màn hình)
      const opacity1 = 0.8 * (1 - Math.pow(fraction, 2)); // Fades out a bit later so we can see it get big

      const scale2 = 0.25 + 0.75 * fraction; // Appears from 0.25x to 1x
      const opacity2 = 0.8 * Math.pow(fraction, 0.5); // Fades in quickly

      tunnelCircle1.style.transform = `scale(${scale1})`;
      tunnelCircle1.style.opacity = opacity1;

      tunnelCircle2.style.transform = `scale(${scale2})`;
      tunnelCircle2.style.opacity = opacity2;
    }

    requestAnimationFrame(smoothRender);
  }

  function onScroll() {
    updateTimelineRotation();
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', updateTimelineRotation);

  updateTimelineRotation();
  applyYearClasses(0);
  requestAnimationFrame(smoothRender);

  // --- Setup GSAP ScrollTriggers for Zoom In/Out effects ---
  //
  // ROOT FIX for the "timeline shrinks mid-scroll" race condition:
  // timeline.js runs *before* overview.js finishes registering its GSAP pin.
  // When overview.js pins #hp-overview it inserts a ~2757px pin spacer that
  // shifts every element below it down in scroll-space. If we register
  // ScrollTriggers here (synchronously, during DOMContentLoaded), the
  // coordinates for #history triggers are calculated WITHOUT that spacer,
  // so zoom-out fires ~781px into the section instead of near the very end.
  //
  // Solution: defer GSAP setup to window 'load', which fires after ALL
  // DOMContentLoaded callbacks — including the one in overview.js that
  // creates the pin. ScrollTrigger.refresh() then recalculates with the
  // pin spacer correctly included.
  window.addEventListener('load', function initTimelineGSAP() {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    const stageInner = section.querySelector('.timeline-stage-inner');
    if (!stageInner) return;

    // Zoom In on Enter — now scrubbed to match user scroll speed as it stacks over overview.
    // The scale and opacity synchronize with the physical slide-up of the section.
    gsap.fromTo(stageInner,
      { scale: 0.95, opacity: 0 },
      {
        scale: 1,
        opacity: 1,
        ease: 'none',
        immediateRender: true,
        scrollTrigger: {
          trigger: section,
          start: 'top bottom', // Begins animating when the top of timeline touches bottom of viewport
          end: 'top top',      // Reaches full state when it completely covers the overview
          scrub: 0.5,
        }
      }
    );

    // Zoom Out on Exit — only starts when section bottom is nearly at
    // viewport top (section almost fully scrolled past), not mid-content.
    gsap.to(stageInner,
      {
        scale: 0.85,
        opacity: 0,
        ease: 'power1.in',
        scrollTrigger: {
          trigger: section,
          start: 'bottom 15%',
          end: 'bottom top',
          scrub: 1,
        }
      }
    );

    // Force recalculate so any late-registered pins (overview spacer)
    // are included in the trigger coordinate math.
    ScrollTrigger.refresh();
  });

})();
