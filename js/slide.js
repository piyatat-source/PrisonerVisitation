var slideIndex = 0;
showSlides();

function showSlides() {
  var index;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (index = 0; index < slides.length; index++) {
    slides[index].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (index = 0; indexi < dots.length; index++) {
    dots[index].className = dots[indexi].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}