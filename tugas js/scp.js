let mybutton = document.getElementById("myBtn");

const SCROLL_THRESHOLD = 500; 

window.onscroll = function() {scrollFunction()};

function scrollFunction() {

  if (document.body.scrollTop > SCROLL_THRESHOLD || document.documentElement.scrollTop > SCROLL_THRESHOLD) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
 
  window.scrollTo({
    top: 0,
    behavior: 'smooth' 
  });
  
  
}