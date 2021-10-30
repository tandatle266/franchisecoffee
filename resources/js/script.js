$(document).ready(function () {

    /* sticky navigation*/
    $(".js--section-features").waypoint(function (direction) { //detect if user is scrolling down or up
            let $nav = $("nav");
            if (direction === "down") {
                $nav.addClass("sticky");
            } else {
                $nav.removeClass("sticky");
            }
        }, {offset: "5%"}
    );

    $(".js--section-sticky").waypoint(function (direction) { //detect if user is scrolling down or up
            let $nav = $("nav");
            if (direction === "down") {
                $nav.addClass("sticky");
            } else {
                $nav.removeClass("sticky");
            }
        }, {offset: "5%"}
    );
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

    /*  modal box*/
    // Get the modal
    const modal = document.getElementById("modal-action");

// Get the button that opens the modal
    const btn = document.getElementsByClassName("btn-modal")[0];
    const btn2 = document.getElementsByClassName("btn-modal")[1];
    const btn3 = document.getElementsByClassName("btn-modal")[2];

// Get the <span> element that closes the modal
    const span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
        document.getElementById('type-sign-up').value=1;
    }
    btn2.onclick = function() {
        modal.style.display = "block";
        document.getElementById('type-sign-up').value=2;
    }
    btn3.onclick = function() {
        modal.style.display = "block";
        document.getElementById('type-sign-up').value=3;
    }

// When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

    /*restricts input*/
// Restricts input for the given textbox to the given inputFilter.

    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox[0].addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }

// Install input filters.
    setInputFilter(document.getElementsByClassName("intTextBox"), function(value) {
        return /^-?\d*$/.test(value); });


/*source:https://jsfiddle.net/emkey08/zgvtjc51*/

});

$('#franchise-submit').on('click', function(e){
    e.preventDefault();
    let name = $('#name-sign-up').val(),
        email = $('#email-sign-up').val(),
        address = $('#address-sign-up').val(),
        phone =$('#phone-sign-up').val(),
        type =$('#type-sign-up').val();
    $.ajax({
        type: 'post',
        url: '../resources/data/FranchiseHandle.php',
        data: {fullname:name,email:email,phone:phone,address:address,type:type},
        success: function() {
            alert('thông tin đã được tiếp nhận.Chúng tôi sẽ liên hệ bạn trong thời gian ngắn nhất');
        }
    });
});
$('#feedback-submit').on('click',function(e){
    e.preventDefault();
    let name = $('#name').val(),
        email = $('#email').val(),
        phone =$('#phone').val(),
        findUs =$('#find-us').val(),
        content =$('#drop-line').val(),
        address = "none";
    $.ajax({
        type: 'POST',
        url: '../resources/data/FeedBackHandle.php',
        data: {fullname:name,email:email,phone:phone,address:address,research:findUs,content:content},
        success: function() {
            alert("thông tin đã được tiếp nhận.Cảm ơn bạn đã đóng góp ý kiến");
        }
    });
});
function myFunction()  {
    $(".bg-modal").show();
};
function someOtherFunction()  {
    $(".bg-modal").hide();
};
function closeProductFunction()  {
    $(".bg-modal").hide();
};