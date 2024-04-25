document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();
    });

    document.getElementById("registerForm").addEventListener("submit", function(event) {
        event.preventDefault();
    });

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