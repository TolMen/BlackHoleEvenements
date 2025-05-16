document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll(".count-up");
    const duration = 1000; // Durée totale en ms (1s)

    counters.forEach((counter) => {
        const target = +counter.getAttribute("data-target");
        let start = 0;
        const frameRate = 1000 / 60; // ~60 FPS
        const totalFrames = Math.round(duration / frameRate);
        const increment = target / totalFrames;
        let frame = 0;

        const counterInterval = setInterval(() => {
            frame++;
            const current = Math.round(increment * frame);
            if (current >= target) {
                counter.innerText = target;
                clearInterval(counterInterval);
            } else {
                counter.innerText = current;
            }
        }, frameRate);
    });
});
