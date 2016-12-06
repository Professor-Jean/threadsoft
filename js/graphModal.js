var graphmodal = document.getElementById('graphModal'); // Get the modal

// When the user clicks on the button, open the modal
function openGraphModal() {
    graphmodal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function closeGraphModal() {
    graphmodal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        graphmodal.style.display = "none";
        modal.style.display = "none";
    }
}
