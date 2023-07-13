
// BOUTON POUR DEFILER TOUT EN HAUT DE LA PAGE

document.addEventListener("DOMContentLoaded", function() {
    var scrollToTop = document.querySelector("#scrollToTop");
  
    scrollToTop.addEventListener("click", function() {
      document.documentElement.scrollTop = 0;
      document.body.scrollTop = 0;
      return false;
    });
  
    window.addEventListener("load", function() {
      function checkScroll() {
        if (document.documentElement.scrollHeight > window.innerHeight) {
          scrollToTop.style.display = "block";
        } else {
          scrollToTop.style.display = "none";
        }
      }
  
      window.addEventListener("scroll", checkScroll);
  
      checkScroll();
    });
  });
  
  


// Chargement entre chaque page 


document.addEventListener("DOMContentLoaded", function() {
    var loader = document.getElementById("loader");
    loader.style.display = "flex";
    
    window.addEventListener("load", function() {
      var content = document.getElementsByClassName("hidden-content");
      
      setTimeout(function() {
        for (var i = 0; i < content.length; i++) {
          content[i].classList.remove("hidden-content");
        }
        
        loader.style.display = "none";
        document.body.style.overflow = "auto";
      }, 400); 
    });
  });