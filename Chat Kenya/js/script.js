    //toggle icon navbar
    let menuIcon = document.querySelector('#menu-icon');
    let navbar = document.querySelector('.navbar');



    menuIcon.onclick = () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
    }

    //scroll sections
    let sections = document.querySelectorAll('section');
    let navlinks = document.querySelectorAll('headernav nav a');

    window.onscroll = () =>{
    sections.forEach(sec => {
        let top = window.scrollY;
        let offset = sec.offsetTop - 100;
        let height = set.offsetHeight;
        let id = sec.getAttribute('id');

        if(top >= offset && top < offset + height){
        navlinks.forEach(Links =>{
            Links.classList.remove('active');
            document.querySelector('headernav nav a[href*=' + id + ']').classList.add('active');
        });
        }
    });

    let header = document.querySelector('headernav');

    header.classList.toggle('sticky',window.scrollY > 100);
    }



    document.addEventListener("DOMContentLoaded", function () {
        const modeToggle = document.getElementById("modeToggle");
        const body = document.body;
        const icon = modeToggle.querySelector('i');

        // Retrieve mode from localStorage if available
        const savedMode = localStorage.getItem("mode");

        if (savedMode) {
            body.classList.add(savedMode);

            // Update the button icon based on the saved mode
            updateIcon(savedMode);
        }

        modeToggle.addEventListener("click", function () {
            body.classList.toggle("dark-mode");

            const currentMode = body.classList.contains("dark-mode") ? "dark-mode" : "light-mode";

            // Update the button icon based on the current mode
            updateIcon(currentMode);

            // Store mode in localStorage
            localStorage.setItem("mode", currentMode);
        });

        function updateIcon(mode) {
            if (mode === 'dark-mode') {
                icon.classList.remove('bxs-moon');
                icon.classList.add('bxs-sun');
                icon.style.color = 'white';
            } else {
                icon.classList.remove('bxs-sun');
                icon.classList.add('bxs-moon');
                icon.style.color = 'black';
            }
        }
    });


    var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    var storySection = document.getElementById('storySection');
    
    function setBackgroundImage(imageUrl) {
      if (width > 720) {
        storySection.style.backgroundImage = "url('" + imageUrl + "')";
      } else {
        storySection.style.backgroundImage = "none";
      }
    }
    
    function fetchImageUrlFromMetaTag() {
      var metaTag = document.querySelector('meta[name="image-url"]');
      var imageUrl = metaTag.getAttribute('content');
      setBackgroundImage(imageUrl);
    }
    
    fetchImageUrlFromMetaTag();
    window.addEventListener('resize', fetchImageUrlFromMetaTag);
    
