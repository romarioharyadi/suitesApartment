<!-- footer section starts  -->

<section class="footer">

    <div class="footer-container">

        <div class="box-container">

            <div class="box">
                <h3>branch location</h3>
                <a href="#">india</a>
                <a href="#">USA</a>
                <a href="#">france</a>
                <a href="#">russia</a>
                <a href="#">japan</a>
            </div> 
            
            <div class="box">
                <h3>quick links</h3>
                <a href="#">home</a>
                <a href="#">services</a>
                <a href="#">featured</a>
                <a href="#">agents</a>
                <a href="#">contact</a>
            </div> 

            <div class="box">
                <h3>extra links</h3>
                <a href="#">my account</a>
                <a href="#">my favorite</a>
                <a href="#">my list</a>
            </div> 

            <div class="box">
                <h3>follow us</h3>
                <a href="#">facebook</a>
                <a href="#">twitter</a>
                <a href="#">instagram</a>
                <a href="#">linkedin</a>
            </div> 

        </div>
        <div class="credit">&copy; 2021<span> Ejos.</span> | all rights reserved</div>
    </div>
</section>
<!-- javascript part  -->
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}
function currentSlide(n) {
  showSlides(slideIndex = n);
}
function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}


let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
    navbar.classList.toggle('active');
    menu.classList.toggle('fa-times');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
    menu.classList.remove('fa-times');
}

</script>

</body>
</html>