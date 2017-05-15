// Clients Label change on click
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
