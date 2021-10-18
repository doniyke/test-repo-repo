$(document).ready(function($) {

    
    $("#subscribe").submit(function(event) {
        event.preventDefault();
       

        $.ajax({
            url: 'server/classes/controller.php?_mode=subscribe',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsgSubscribe").addClass('alert alert-danger');
                 $("#errorMsgSubscribe").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsgSubscribe").removeClass('alert alert-danger');
                $("#errorMsgSubscribe").addClass('alert alert-success');
                $("#errorMsgSubscribe").html(response.message);
                 
               
                // window.location = "index.php";
                
            

            }

            else{
                
                $("#errorMsgSubscribe").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });

    $("#contact-us").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'server/classes/controller.php?_mode=contact-us',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorContact").addClass('alert alert-danger');
                 $("#errorContact").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorContact").removeClass('alert alert-danger');
                $("#errorContact").addClass('alert alert-success');
                $("#errorContact").html(response.message);
                 
               
                // window.location = "index.php";
                
            

            }

            else{
                
                $("#errorContact").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });

    

    $("#freeResource").submit(function(event) {
        event.preventDefault();
       

        $.ajax({
            url: 'server/classes/controller.php?_mode=freeResource',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsgFree").addClass('alert alert-danger');
                 $("#errorMsgFree").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsgFree").removeClass('alert alert-danger');
                $("#errorMsgFree").addClass('alert alert-success');
                $("#errorMsgFree").html(response.message);
                 
               
                window.location = "free-download.php?link="+response.free_link+"&&training_slug="+response.training_slug;
                
            

            }

            else{
                
                $("#errorMsgFree").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });

    

    $("#register").submit(function(event) {
        event.preventDefault();
       

        $.ajax({
            url: 'server/classes/controller.php?_mode=register',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsg").addClass('alert alert-danger');
                 $("#errorMsg").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsg").removeClass('alert alert-danger');
                $("#errorMsg").addClass('alert alert-success');
                $("#errorMsg").html('Your Account Was Created Successfully, Please Enter Your Login Details On The Next Modal To Continue');
                 
                setTimeout(function(){ 
                    $("#modalRegister").modal('hide');
                    $("#modalLogin").modal('show');
                }, 5000);      

            }

            else{
                
                $("#errorMsg").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });

    $("#login").submit(function(event) {
        event.preventDefault();
       

        $.ajax({
            url: 'server/classes/controller.php?_mode=login',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsgLogin").addClass('alert alert-danger');
                 $("#errorMsgLogin").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsgLogin").removeClass('alert alert-danger');
                $("#errorMsgLogin").addClass('alert alert-success');
                $("#errorMsgLogin").html(response.message);



                setTimeout(function(){ 
                    $("#modalLogin").modal('hide');
                    let training_slug = getCookie("training_slug");
                      if (training_slug != "") {
                        
                        if (confirm("We noticed you previously checked out a training, will you like to continue from where you left off?")) {
                            window.location = "course-details.php?training_slug="+training_slug;
                        }else{
                            document.cookie = "training_slug=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            window.location = "i/";
                        }
                      } else {
                        window.location = "i/";
                      }

                    
                }, 1000);     
                 
               
                
                
            

            }

            else{
                
                $("#errorMsgLogin").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });






    $("#updateProfile").submit(function(event) {
        event.preventDefault();
       

        $.ajax({
            url: '../server/classes/controller.php?_mode=updateProfile',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsg").addClass('alert alert-danger');
                 $("#errorMsg").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsg").removeClass('alert alert-danger');
                $("#errorMsg").addClass('alert alert-success');
                $("#errorMsg").html(response.message);

                // setTimeout(function(){ 
                //     window.location = "i/";
                // }, 1000);     
                 
               
                
                
            

            }

            else{
                
                $("#errorMsgLogin").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });


    $("#updateUserProfile").submit(function(event) {
        event.preventDefault();
       

        $.ajax({
            url: '../server/classes/controller.php?_mode=updateUserProfile',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsg").addClass('alert alert-danger');
                 $("#errorMsg").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsg").removeClass('alert alert-danger');
                $("#errorMsg").addClass('alert alert-success');
                $("#errorMsg").html(response.message);

                // setTimeout(function(){ 
                //     window.location = "i/";
                // }, 1000);     
                 
               
                
                
            

            }

            else{
                
                $("#errorMsgLogin").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });





    $("#adminLogin").submit(function(event) {
        event.preventDefault();
       

        $.ajax({
            url: '../server/classes/controller.php?_mode=adminLogin',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsg").addClass('alert alert-danger');
                 $("#errorMsg").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsg").removeClass('alert alert-danger');
                $("#errorMsg").addClass('alert alert-success');
                $("#errorMsg").html(response.message);

                setTimeout(function(){ 
                    window.location = "index.php";
                }, 1000);     
                 
               
                
                
            

            }

            else{
                
                $("#errorMsgLogin").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });


    $("#updateAdminPassword").submit(function(event) {
        event.preventDefault();
       

        $.ajax({
            url: '../server/classes/controller.php?_mode=updateAdminPassword',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsg").addClass('alert alert-danger');
                 $("#errorMsg").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsg").removeClass('alert alert-danger');
                $("#errorMsg").addClass('alert alert-success');
                $("#errorMsg").html(response.message);

                setTimeout(function(){ 
                    window.location = "index.php";
                }, 1000);     
                 
               
                
                
            

            }

            else{
                
                $("#errorMsgLogin").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });








    $("#addTraining").submit(function(event) {
        event.preventDefault();
        var formUpload = document.getElementById("addTraining");
        $.ajax({
            url : '../server/classes/controller.php?_mode=addTraining',
            type: "POST",
            cache: false,
            async: false,
            contentType: false,
            processData: false,
            data :  new FormData(formUpload),
            dataType : 'json'
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsg").addClass('alert alert-danger');
                 $("#errorMsg").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsg").removeClass('alert alert-danger');
                $("#errorMsg").addClass('alert alert-success');
                $("#errorMsg").html(response.message);
                 
               
                window.location = "trainings.php";
                
            

            }
            else{
                
                $("#error").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });


    $("#updateTraining").submit(function(event) {
        event.preventDefault();
        var formUpload = document.getElementById("updateTraining");
        $.ajax({
            url : '../server/classes/controller.php?_mode=updateTraining',
            type: "POST",
            cache: false,
            async: false,
            contentType: false,
            processData: false,
            data :  new FormData(formUpload),
            dataType : 'json'
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsg").addClass('alert alert-danger');
                 $("#errorMsg").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsg").removeClass('alert alert-danger');
                $("#errorMsg").addClass('alert alert-success');
                $("#errorMsg").html(response.message);
                 
               
                window.location = "trainings.php";
                
            

            }
            else{
                
                $("#error").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });


    


    $("#addResource").submit(function(event) {
        event.preventDefault();
        var formUpload = document.getElementById("addResource");
        $.ajax({
            url : '../server/classes/controller.php?_mode=addResource',
            type: "POST",
            cache: false,
            async: false,
            contentType: false,
            processData: false,
            data :  new FormData(formUpload),
            dataType : 'json'
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsg").addClass('alert alert-danger');
                 $("#errorMsg").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsg").removeClass('alert alert-danger');
                $("#errorMsg").addClass('alert alert-success');
                $("#errorMsg").html(response.message);
                 
               
                window.location = "resources.php";
                
            

            }
            else{
                
                $("#error").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });


    $("#addFreeResource").submit(function(event) {
        event.preventDefault();
        var formUpload = document.getElementById("addFreeResource");
        $.ajax({
            url : '../server/classes/controller.php?_mode=addFreeResource',
            type: "POST",
            cache: false,
            async: false,
            contentType: false,
            processData: false,
            data :  new FormData(formUpload),
            dataType : 'json'
        })
        .done(function(response) {
            if(response.status==0){
                $("#errorMsg").addClass('alert alert-danger');
                 $("#errorMsg").html(response.message);
            }
            
            else if (response.status==1) {
                $("#errorMsg").removeClass('alert alert-danger');
                $("#errorMsg").addClass('alert alert-success');
                $("#errorMsg").html(response.message);
                 
               
                window.location = "free-resources.php";
                
            

            }
            else{
                
                $("#error").html("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    });

});

function changeStatus(training_status, training_id) {       
       var training_status = training_status;
        var id = training_id;

        $.ajax({
            url: '../server/classes/controller.php?_mode=changeStatus',
            type: 'POST',
            dataType: 'json',
            data: { training_status:training_status, id : training_id},
        })
        .done(function(response) {
            if(response.status==0){
                
                alert(response.message);
            }
            
            else if (response.status==1) {
                alert(response.message);
                window.location.reload();

            }

            else{
                
                alert("please check what you are doing");
                
                
                                
            }
        }).fail(function(error) {
            console.log(error)
        });
    }


function setCookie(cname, cvalue, exdays) {
   
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}




