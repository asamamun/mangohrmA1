

// The Modal is in header.php
function ShowActionMessage(message, mtype, title, timer) {

// If function got any params which is not defined when we will set default value
    var modal_type = typeof mtype !== 'undefined' ? mtype : true;
    var title = typeof title !== 'undefined' ? title : 'Alert Message';
    var timers = typeof timer !== 'undefined' ? timer : 2000;
    var timernum = parseInt(timers);

    
    
   // alert(modal_type);
    if (modal_type == true) {
		$("#ActionMessageModal .modal-body").removeClass('action_message_body_fail');
        $("#ActionMessageModal .modal-body").addClass('action_message_body_success');
		mtype =null;
		 
    } else {
$("#ActionMessageModal .modal-body").removeClass('action_message_body_success');
        $("#ActionMessageModal .modal-body").addClass('action_message_body_fail');
		mtype =null;
		
    }



//  Jquery method for inserting param value into modal which identify by ID;
    $("#AMMmodaltitle").html(title);
    $("#AMMmodaldesc").html(message);



// To Display Modal Automatically when we call the function;
    $('#ActionMessageModal').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });


// Set timer how much time the modal will be displayed.

    var startTime = new Date().getTime();
    var interval = setInterval(function() {
        if (new Date().getTime() - startTime > timernum) {
            clearInterval(interval);
          //  return;
        }

        $('#ActionMessageModal').modal('hide');
        // After Hidding modal, we will clear value of modal    
        $("#AMMmodaltitle").html("");
        $("#AMMmodaldesc").html("");
      //  $("#ActionMessageModal .modal-body").removeClass('action_message_body_fail');
		$("#ActionMessageModal .modal-body").removeClass('action_message_body_success');

        //do whatever here..
    }, timernum);



    



    // alert('The title is' + title + 'Message is ' + message);
}




