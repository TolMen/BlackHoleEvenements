// Déclenche la vidéo lorsque la section est visible
const videoElement = document.getElementById("heroVideo");
const videoSection = document.getElementById("videoSection");

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                videoElement.play();
            } else {
                videoElement.pause();
            }
        });
    },
    {
        threshold: 0.8, // La vidéo démarre quand 80% de la section est visible
    }
);

observer.observe(videoSection);
