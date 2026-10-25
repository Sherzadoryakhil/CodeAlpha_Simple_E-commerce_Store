import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

const motionQuery = window.matchMedia("(prefers-reduced-motion: reduce)");

function ready(callback) {
    if (document.readyState !== "loading") {
        callback();

        return;
    }

    document.addEventListener("DOMContentLoaded", callback, { once: true });
}

function initNavbarScroll() {
    const navbar = document.querySelector("[data-navbar]");

    if (!navbar) {
        return;
    }

    let ticking = false;

    const updateNavbar = () => {
        ticking = false;
        navbar.classList.toggle("nav-scrolled", window.scrollY > 8);
    };

    const requestNavbarUpdate = () => {
        if (ticking) {
            return;
        }

        ticking = true;
        window.requestAnimationFrame(updateNavbar);
    };

    window.addEventListener("scroll", requestNavbarUpdate, {
        passive: true,
    });

    requestNavbarUpdate();
}

function initRevealAnimations() {
    const revealElements = document.querySelectorAll(".reveal");

    if (!revealElements.length) {
        return;
    }

    if (motionQuery.matches || !("IntersectionObserver" in window)) {
        revealElements.forEach((element) => {
            element.classList.add("reveal-visible");
        });

        return;
    }

    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add("reveal-visible");
                revealObserver.unobserve(entry.target);
            });
        },
        {
            threshold: 0.12,
            rootMargin: "0px 0px -48px 0px",
        },
    );

    revealElements.forEach((element, index) => {
        if (element.dataset.revealBound === "true") {
            return;
        }

        element.dataset.revealBound = "true";

        const staggerContainer = element.closest("[data-stagger]");
        const staggerChildren = staggerContainer
            ? Array.from(staggerContainer.querySelectorAll(":scope > .reveal"))
            : [];
        const staggerIndex = staggerChildren.indexOf(element);
        const calculatedIndex = staggerIndex >= 0 ? staggerIndex : index % 6;
        const delay = Math.min(calculatedIndex * 70, 420);

        element.style.setProperty("--reveal-delay", `${delay}ms`);
        revealObserver.observe(element);
    });
}

function dismissAlert(alert) {
    if (!alert || alert.dataset.dismissed === "true") {
        return;
    }

    alert.dataset.dismissed = "true";
    alert.classList.add("alert-dismissed");
    alert.setAttribute("aria-hidden", "true");

    window.setTimeout(
        () => {
            alert.hidden = true;
        },
        motionQuery.matches ? 0 : 300,
    );
}

function initAutoDismissAlerts() {
    document.querySelectorAll("[data-auto-dismiss]").forEach((alert) => {
        if (alert.dataset.dismissBound === "true") {
            return;
        }

        alert.dataset.dismissBound = "true";

        const delay = Number.parseInt(alert.dataset.autoDismiss, 10) || 6000;

        window.setTimeout(() => {
            dismissAlert(alert);
        }, delay);
    });

    document.querySelectorAll("[data-dismiss-alert]").forEach((button) => {
        if (button.dataset.dismissBound === "true") {
            return;
        }

        button.dataset.dismissBound = "true";

        button.addEventListener("click", () => {
            dismissAlert(button.closest(".alert"));
        });
    });
}

function animateCartBadge(element) {
    if (!element || motionQuery.matches) {
        return;
    }

    element.classList.remove("cart-badge-pop");
    // Force reflow so the animation can replay
    void element.offsetWidth;
    element.classList.add("cart-badge-pop");

    window.setTimeout(() => {
        element.classList.remove("cart-badge-pop");
    }, 500);
}

function initCartBadgeAnimations() {
    const cartBadges = document.querySelectorAll("[data-cart-count]");

    if (!cartBadges.length) {
        return;
    }

    cartBadges.forEach((element) => {
        if (element.dataset.badgeBound === "true") {
            return;
        }

        element.dataset.badgeBound = "true";

        let previousValue = element.textContent.trim();

        const observer = new MutationObserver(() => {
            const currentValue = element.textContent.trim();

            if (currentValue === previousValue) {
                return;
            }

            previousValue = currentValue;
            animateCartBadge(element);
        });

        observer.observe(element, {
            childList: true,
            characterData: true,
            subtree: true,
        });
    });
}

ready(() => {
    document.documentElement.classList.add("js");

    initNavbarScroll();
    initRevealAnimations();
    initAutoDismissAlerts();
    initCartBadgeAnimations();
});

Alpine.start();
