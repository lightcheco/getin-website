/* Clients Label change on click */
$('.perks-section li').on('click', function(){
    var id = this.id;
    console.log(this.id);
    $('.perks-section li').removeClass('btn-tracking-active');
    $('#visitorTracking').addClass('hidden');
    $('#wifiMap').addClass('hidden');
    $('#pushNotification').addClass('hidden');
    if (id === "visitorTrackingBtn") {
      $('#visitorTracking').removeClass('hidden');
      $(this).addClass('btn-tracking-active');
    }
    if (id === "wifiMapBtn") {
      $('#wifiMap').removeClass('hidden');
      $(this).addClass('btn-tracking-active');
    }
    if (id === "pushNotificationBtn") {
      $('#pushNotification').removeClass('hidden');
      $(this).addClass('btn-tracking-active');
    }
});


/* Smooth Scroll to sections  */
  // Select all links with hashes
  $('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
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
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
