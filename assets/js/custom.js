/*========== REGISTER FORM ==========*/

//-- Hide and Show Register Login --//
$(document).ready(function() {

	//On click signup, hide login and show registration form
	$("#signup").click(function() {
		$(".login__wrapper").slideUp("slow", function(){
			$(".register__wrapper").slideDown("slow");
		});
			$(".spinner-border").hide(); //onclick signin show spinner	});
	});

	//On click signin, hide registration and show login form
	$("#signin").click(function() {
		$(".register__wrapper").slideUp("slow", function(){
			$(".login__wrapper").slideDown("slow");
		});
			$(".spinner-border").show(); //onclick signin show spinner
	});


});

/*========== NAVBAR TRANSPARENT TO SOLID ==========*/

$(document).ready(function() { //when document(DOM) loads completely.
        // Transition effect for navbar
        $(window).scroll(function() { //function is called while you scrolls
          // checks if window is scrolled more than 300px, adds/removes solid class
          if($(this).scrollTop() > 150) {
              $('.navbar').addClass('solid'); //add class 'solid' in any element which has class 'navbar'
          } else {
              $('.navbar').removeClass('solid'); //remove class 'solid' in any element which has class 'navbar'
          }
        });
});

/*========== DARK MODE TOGGLER ANIMATE ONSCROLL ==========*/

$(document).ready(function() { //when document(DOM) loads completely.
        // Transition effect for darkmode switch
        $(window).scroll(function() { //function is called while you scrolls
          // checks if window is scrolled more than 300px, adds/removes solid class
          if($(this).scrollTop() > 99) {
              $('.theme-switch-wrapper').removeClass('animate__animated animate__fadeInDown');
              $('.theme-switch-wrapper').addClass('animate__animated animate__fadeOutUp');
          } else {
              $('.theme-switch-wrapper').removeClass('animate__animated animate__fadeOutUp');
              $('.theme-switch-wrapper').addClass('animate__animated animate__fadeInDown');
          }
        });
});

/*========== NAVIGATION SLIDING DOWN ANIMATION ==========*/

$(document).ready(function() { //when document(DOM) loads completely.

        $(window).scroll(function() { //function is called while you scrolls
          // checks if window is scrolled more than 300px, adds/removes solid class
          if($(this).scrollTop() > 150) {
              $('.navbar-toggle').removeClass('d-none');
              $('.navbar-toggle').addClass('d-block');
          } else {
              $('.navbar-toggle').removeClass('d-block');
              $('.navbar-toggle').addClass('d-none');
          }
        });
});

/*========== CLOSE MOBILE NAV ON CLICK ==========*/

$(document).ready(function () { //when document loads completely.
    $(document).click(function (event) { //click anywhere
        var clickover = $(event.target); //get the target element where you clicked
        var _opened = $(".navbar-collapse").hasClass("show"); //check if element with 'navbar-collapse' class has a class called show. Returns true and false.
        if (_opened === true && !clickover.hasClass("navbar-toggler")) { // if _opened is true and clickover(element we clicked) doesn't have 'navbar-toggler' class
            $(".navbar-toggler").click(); //toggle the navbar; close the navbar menu in mobile.
        }
    });
});

/*========== BOOTSTRAP TOOLTIP ==========*/

$(document).ready(function(){
  $('.nav-link#home').tooltip({title: "Home", placement: "bottom", animation: true});
  $('.nav-link#messages').tooltip({title: "Messages", placement: "bottom", animation: true});
  $('.nav-link#notification').tooltip({title: "Notifications", placement: "bottom", animation: true});
  $('.nav-link#friendrequest').tooltip({title: "Request", placement: "bottom", animation: true});
  $('.nav-link#profile').tooltip({title: "Profile", placement: "bottom", animation: true});
  $('.nav-link#settings').tooltip({title: "Settings", placement: "bottom", animation: true});
  $('.nav-link#logout').tooltip({title: "LogOut", placement: "bottom", animation: true});
  $('#upload_icon_tag').tooltip({title: "Update/Upload", placement: "top", animation: true});
});

/*========== OWL-CAROUSEL CERTIFICATE SECTION ==========*/
//theCarousel
$(document).ready(function(){ //when document is ready
  $("#team-slider").owlCarousel({ //owlCarousel settings
        items:3, //by default there are 3 slides display.
        autoplay:true, //the slides will change automatically.
        smartSpeed:700, //speed of changing wil be 700
        loop:true, //infinite loop; after the last slide, first slide starts
        autoplayHoverPause:true, //when you put mouse over Carousel, slide changing will stop
        responsive : { //responsiveness as screen size changes
            // min-width: 0px
            0 : {
                items: 1 //on devices with width 0 to 579px show 1 slide
            },
            // min-width: 579px
            576 : {
                items: 1 //on devices with width 579px to 768px show show 2 slides
            },
            // min-width: 768px
            768 : {
                items: 1 //on devices with width 768px and above show 3 slides
            }
        }
  }
  );
});

/*========== SMOOTH SCROLLING TO LINKS ==========*/

$(document).ready(function(){ //document is loaded
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {//click on any link;anchor tag;

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") { //for e.g. website.com#home - #home
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;
      //console.log('hash:',hash)

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({ //animate whole html and body elements
        scrollTop: $(hash).offset().top //scroll to the element with that hash
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash; //website.com - website.com#home
        //Optional remove "window.location.hash = hash;" to prevent transparent navbar on load
      });
    } // End if
  });
});

/*========== AJAX SUBMIT PROFILE POST ==========*/

$(document).ready(function() {
	//button for profile post
	$('#submit_profile_post').click(function() {
		$.ajax({
			type: "POST",
			url: "includes/handlers/ajax_submit_profile_post.php",
			data: $('form.profile_post').serialize(),
			success: function(msg) {
				$("#myModal").modal('hide');
				location.reload();
			},
			error: function() {
				alert('Failure');
			}
		});
	});
});

/*========== TOP SCROLL BUTTON ==========*/

$(document).ready(function() { //when document is ready
  $(window).scroll(function() { //when webpage is scrolled
    if ($(this).scrollTop() > 500) { //if scroll from top is more than 500
      $('.top-scroll').fadeIn(); //display element with class 'top-scroll'; opacity increases
    } else { //if not
      $('.top-scroll').fadeOut(); //hide element with class 'top-scroll'; opacity decreases
    }
  });
});
