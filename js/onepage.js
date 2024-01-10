document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll('.sidebar nav a');
    const sections = document.querySelectorAll('.main-content');

    links.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();

            const targetId = link.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);

            sections.forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(-50px)';
                setTimeout(() => {
                    section.style.display = 'none';
                }, 300); // Delay display change after fade-out
            });

            setTimeout(() => {
                targetSection.style.display = 'block';
                setTimeout(() => {
                    targetSection.style.opacity = '1';
                    targetSection.style.transform = 'translateY(0)';
                }, 10);
            }, 500); // Delay new section display and fade-in after fade-out of the current section
        });
    });
});
