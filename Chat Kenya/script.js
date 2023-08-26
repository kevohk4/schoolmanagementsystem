//toggle icon navbar
let menuIcon = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');



menuIcon.onclick = () => {
  menuIcon.classList.toggle('bx-x');
  navbar.classList.toggle('active');
}

/*
$(document).ready(function() {
  // Toggle navigation links on click of the hamburger icon
  $('#menu-icon').click(function() {
    $('.navbar').slideToggle('fast');
  });

  // Hide the navigation links if the window is resized and becomes larger than the specified breakpoint
  $(window).resize(function() {
    var windowWidth = $(window).width();
    if (windowWidth > 768) {
      $('.navbar').removeAttr('style');
    }
  });
});
*/

//scroll sections
let sections = document.querySelectorAll('section');
let navlinks = document.querySelectorAll('header nav a');

window.onscroll = () =>{
  sections.forEach(sec => {
    let top = window.scrollY;
    let offset = sec.offsetTop - 100;
    let height = set.offsetHeight;
    let id = sec.getAttribute('id');

    if(top >= offset && top < offset + height){
      navlinks.forEach(Links =>{
        Links.classList.remove('active');
        document.querySelector('header nav a[href*=' + id + ']').classList.add('active');
      });
    }
  });

  let header = document.querySelector('header');

  header.classList.toggle('sticky',window.scrollY > 100);
}


    // JavaScript code for dark mode toggle
    const modeToggleDark = document.getElementById('modeToggle');
    const body = document.body;
    const icon = modeToggleDark.querySelector('i');

    modeToggleDark.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    body.classList.toggle('light-mode');

    // Update the button icon based on the current mode
    if (body.classList.contains('dark-mode')) {
        icon.classList.remove('bxs-moon');
        icon.classList.add('bxs-sun');
        icon.style.color = 'white';
    } else {
        icon.classList.remove('bxs-sun');
        icon.classList.add('bxs-moon');
        icon.style.color = 'black';
    }
});
