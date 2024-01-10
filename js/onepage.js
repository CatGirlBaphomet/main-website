// Select all navigation links
var navLinks = document.querySelectorAll('.flex-container a');

// Select all sections
var sections = document.querySelectorAll('.main-content');

// Add a click event listener to each link
navLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
        // Prevent the default action (jumping to the section immediately)
        event.preventDefault();

        // Hide all sections
        sections.forEach(function(section) {
            section.style.display = 'none';
        });

        // Get the target section from the link's href attribute
        var target = document.querySelector(this.getAttribute('href'));

        // Show the target section
        target.style.display = 'block';
    });
});