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

/*========== AJAX MESSAGE FRIEND SEARCH ==========*/

function getUsers(value, user) {
	$.post("includes/handlers/ajax_friend_search.php", {query:value, userLoggedIn:user}, function(data) {
		$(".results").html(data);
	});
}

/*========== AJAX NAVIGATION MESSAGE POP-UP ==========*/

function getDropdownData(user, type) {

	if($(".dropdown_data_window").css("height") == "0px") {

		var pageName;

		if(type == 'notification') {

		}
		else if (type == 'message') {
			pageName = "ajax_load_messages.php";
			$("span").remove("#unread_message");
		}

		var ajaxreq = $.ajax({
			url: "includes/handlers/" + pageName,
			type: "POST",
			data: "page=1&userLoggedIn=" + user,
			cache: false,

			success: function(response) {
				$(".dropdown_data_window").html(response);
				$(".dropdown_data_window").css({"padding" : "0px", "height" : "280px", "border-top" : "1px solid var(--alinks)"});
				$("#dropdown_data_type").val(type);
			}
		});
	}
	else {
		$(".dropdown_data_window").html("");
		$(".dropdown_data_window").css({"padding" : "0px", "height" : "0px", "border-top" : "none"});
	}
}

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

/*========== INTERNET NOTIFICATION POPUP MESSAGE ==========*/

const offlineConnection = document.querySelector('.offline')
const onlineConnection = document.querySelector('.online')
const closeBtn = document.querySelectorAll('.close')
const refreshBtn = document.querySelector('.refreshBtn')

function online() {
	offlineConnection.classList.remove('active')
	onlineConnection.classList.add('active')
}
function offline() {
	offlineConnection.classList.add('active')
	onlineConnection.classList.remove('active')
}

window.addEventListener('online',()=>{
	online();
	setTimeout(() => {
		onlineConnection.classList.remove('active')
	}, 5000);
})
window.addEventListener('offline',()=>{
	offline();
})

for (let i = 0; i < closeBtn.length; i++) {
	closeBtn[i].addEventListener('click',()=>{
		closeBtn[i].parentNode.classList.remove('active');
		if (closeBtn[i].parentNode.classList.contains('offline')) {
			setTimeout(() => {
				closeBtn[i].parentNode.classList.add('active');
			}, 500);
		}
	})
}

refreshBtn.addEventListener("click",()=>{
	window.location.reload();
})
