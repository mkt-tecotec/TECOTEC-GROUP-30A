document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    
    gsap.registerPlugin(ScrollTrigger);

    const wrapper = document.getElementById('hp-overview');
    if (!wrapper) return;

    const sections = wrapper.querySelectorAll('.hp-overview-section');

    // Create a master timeline pinned to the wrapper
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: wrapper,
            start: "top top",
            end: "+=300%", // Scroll distance corresponds to 3 sections
            pin: true,
            scrub: 1
        }
    });

    // Parallax background layers tied to scroll
    if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        gsap.to(".hero-bg-particles", {
            y: "-15%",
            ease: "none",
            scrollTrigger: {
                trigger: wrapper,
                start: "top top",
                end: "+=300%",
                scrub: 1
            }
        });
        
        gsap.to(".hero-bg-grid", {
            y: "-8%",
            ease: "none",
            scrollTrigger: {
                trigger: wrapper,
                start: "top top",
                end: "+=300%",
                scrub: 1
            }
        });
        
        gsap.to(".hero-bg-glow", {
            y: "-4%",
            ease: "none",
            scrollTrigger: {
                trigger: wrapper,
                start: "top top",
                end: "+=300%",
                scrub: 1
            }
        });
    }

    // Background Layer Animations
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    
    if (!reduceMotion) {
        gsap.to(".hero-bg-grid", {
            backgroundPosition: "48px 48px",
            duration: 6,
            ease: "none",
            repeat: -1
        });
    
        gsap.to(".hero-bg-glow", {
            x: 18,
            y: -14,
            duration: 7,
            ease: "sine.inOut",
            repeat: -1,
            yoyo: true
        });
    
        gsap.to(".hero-bg-light-sweep", {
            x: "430%",
            duration: 7.5,
            ease: "power2.inOut",
            repeat: -1,
            repeatDelay: 4
        });
    
        gsap.to(".hero-bg-particles span", {
            y: -18,
            x: 10,
            opacity: 0.25,
            duration: 4.2,
            ease: "sine.inOut",
            repeat: -1,
            yoyo: true,
            stagger: {
                each: 0.45,
                from: "random"
            }
        });
    }

    sections.forEach((section, index) => {
        const text = section.querySelector('.hp-overview-text');
        const highlights = section.querySelectorAll('.highlight-word');

        // Cinematic reveal of the section
        tl.fromTo(section,
            { autoAlpha: 0 },
            { autoAlpha: 1, duration: 0.1 }
        );

        // Overdrive text reveal: scale up slightly, fade in, un-blur, and rotate in 3D
        tl.fromTo(text, 
            { autoAlpha: 0, y: 80, scale: 0.9, filter: "blur(15px)", rotationX: -15 }, 
            { autoAlpha: 1, y: 0, scale: 1, filter: "blur(0px)", rotationX: 0, duration: 1.4, ease: "power3.out" },
            "<" // start simultaneously with section visibility
        );

        // Animate highlight and underline if present
        if (highlights.length > 0) {
            tl.to(highlights, {
                color: "#ff9900",
                backgroundSize: "100% 100%",
                textShadow: "0px 0px 30px rgba(255, 153, 0, 0.45)", // Glow effect matching #ff9900
                duration: 1.2,
                stagger: 0.25, // Cascade animation
                ease: "power2.inOut"
            }, "-=0.6"); // Overlap with text reveal
        }

        // Add a slight pause for reading
        tl.to({}, { duration: 0.8 });

        // Fade out with a cinematic exit
        tl.to(text, { 
            autoAlpha: 0, 
            y: -60, 
            scale: 1.05, 
            filter: "blur(10px)", 
            duration: 1.2, 
            ease: "power2.in" 
        });
        tl.to(section, { autoAlpha: 0, duration: 0.1 });
    });
});
