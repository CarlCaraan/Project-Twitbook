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
});
