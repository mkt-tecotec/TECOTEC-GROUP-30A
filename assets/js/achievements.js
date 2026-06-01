/**
 * Achievements — Simple translateY wipe reveal
 *
 * The .hp-achievements section has:
 *   margin-top: -100vh   → slides up physically behind/under #history end
 *   position: relative   → stays in normal flow
 *
 * GSAP scrubs translateY from 100vh → 0 as user scrolls the last
 * portion of #history. Clean, no body-background leak, no fixed hacks.
 */
(function () {
  window.addEventListener('load', function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    const section  = document.querySelector('.hp-achievements');
    const history  = document.getElementById('history');
    if (!section || !history) return;

    /* ── initial state ─────────────────────────────────────────────── */
    gsap.set(section, { y: () => window.innerHeight });

    /* ── wipe: scrub translateY as #history's last 100vh scrolls ───── */
    gsap.to(section, {
      y: 0,
      ease: 'none',
      scrollTrigger: {
        trigger: history,
        start: 'bottom bottom',   // when #history bottom hits viewport bottom
        end:   'bottom top',      // when #history bottom hits viewport top
        scrub: 0.4,
      },
    });

    /* ── content fade-in after card is ~50% revealed ───────────────── */
    const inner = section.querySelector('.hp-achievements-container');
    if (inner) {
      gsap.fromTo(inner,
        { opacity: 0, y: 40 },
        {
          opacity: 1, y: 0,
          duration: 0.7,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: history,
            start: 'bottom 60%',
            toggleActions: 'play none none reverse',
          },
        }
      );
    }

    ScrollTrigger.refresh();
  });
})();
