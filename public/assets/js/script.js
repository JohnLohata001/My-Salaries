$(document).ready(function () {
    // $('#submit').click(function(e){
    //     e.preventDefault();
        // var timeStart = $('#timeStart').val();
        // var timeEnded = $('timeEnded').val();
        // let result = '';
        // if(timeStart !=''|| timeStart !='' ){
         let result = timeStart * timeEnded;
        //     $('#message').html(result);
        // }else{
            // $('#message').text('you need to fill all the fields');
        // }
        
        
    // });
    // e.preventDefault();

    $(".Schedules").click(function(){
            $('#ulMenu').slideToggle();
    });
});