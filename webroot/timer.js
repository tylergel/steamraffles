$('.aclass').each(function(i, obj) {
  var countDownDate = $(obj).attr('name');
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime() / 1000;
  // Find the distance between now an the count down date
  var distance = countDownDate - now;
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / 86400);
  var distance = Math.floor(distance % 86400);
  var hours = Math.floor(distance / 3600);
  var distance = Math.floor(distance % 3600);
  var minutes = Math.floor((distance / 60));
  var distance = Math.floor(distance % 60);
  var seconds = Math.floor(distance % 60);


  // Display the result in the element with id="demo"
  (obj).innerHTML = days + "d " + hours + "h "
  + minutes + "m " + distance + "s ";
  var id = ($(obj).attr('id'));
  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    (obj).innerHTML = "Raffle finished.  And the winner is...";
    $.ajax({
           type: 'POST',
           url: '/raffles/delete',
            data: {id: id},
           success: function(data){
             alert('Raffle completed!  Check the completed raffles to see if you won.');
           }
       });
       return false;
  }
}, 1000);
});
