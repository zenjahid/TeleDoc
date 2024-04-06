document.addEventListener("DOMContentLoaded", function() {
    // Prevent form submission for login and register forms
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();
    });

    document.getElementById("registerForm").addEventListener("submit", function(event) {
        event.preventDefault();
    });

    // Toggle dropdown menu
    var dropdownToggle = document.querySelector('.dropdown-toggle');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownToggle.addEventListener('click', function() {
        dropdownMenu.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    window.addEventListener('click', function(event) {
        if (!event.target.matches('.dropdown-toggle')) {
            if (dropdownMenu.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
            }
        }
    });

    // Toggle active class for background images
    var images = document.querySelectorAll('.background-image');
    var index = 0;

    function nextImage() {
        images[index].classList.remove('active');
        index = (index + 1) % images.length;
        images[index].classList.add('active');
        setTimeout(nextImage, 5000); 
    }

    images[index].classList.add('active');
    setTimeout(nextImage, 5000);
});

function bookAppointment(i) {
    alert("Book appointment for row index: " + i);
}
