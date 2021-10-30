$(document).ready(function () {

    /* sticky navigation*/
    $(".js--section-sticky").waypoint(function (direction) { //detect if user is scrolling down or up
            let $nav = $("nav");
            if (direction === "down") {
                $nav.addClass("sticky");
            } else {
                $nav.removeClass("sticky");
            }
        }, {offset: "5%"}
    );

    /*scroll on button*/
    $(".js--scroll-to-start").click(function(){
        $("html,body").animate({scrollTop:$(".js--section-features").offset().top},1000)
    });
     $(".js--scroll-to-plan").click(function(){
        $("html,body").animate({scrollTop:$(".js--section-plan").offset().top},1000)
    });

    /*navigation scroll*/

    // Select all links with hashes
    $('a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '')
                &&
                location.hostname === this.hostname
            ) {
                // Figure out element to scroll to
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        let $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        }
                    });
                }
            }
        });
    /*source: css-tricks.com/snippets/jquery/smooth-scrolling/ */

    /*mobile nav*/
    $(".js--mobile-nav-icon").click(function(){
       let nav = $(".js--main-nav") ;
        let icon = $(".js--mobile-nav-icon i");
        nav.slideToggle(150);
        if(icon.hasClass("ion-navicon-round")){
            icon.addClass("ion-close-round");
            icon.removeClass("ion-navicon-round");
        }else{
            icon.addClass("ion-navicon-round");
            icon.removeClass("ion-close-round");

        }
    });
});

