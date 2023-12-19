function previewImage(input) {
    const uploadContainer = input.parentElement;
    const preview = uploadContainer;

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.style.backgroundImage = `url('${e.target.result}')`;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function previewWallpaper(input) {
   const uploadContainer = input.parentElement;
   const preview = uploadContainer;

   if (input.files && input.files[0]) {
       const reader = new FileReader();

       reader.onload = function (e) {
           preview.style.backgroundImage = `url('${e.target.result}')`;
       };

       reader.readAsDataURL(input.files[0]);
   }
}
//video preview
function previewVideo(input) {
    const trailerPlayer = document.getElementById('video-player');
    const trailerUrl = input.value;

    if (isValidUrl(trailerUrl)) {
        trailerPlayer.src = trailerUrl;
    } else {
        alert('Invalid URL');
    }
}
function previewTrailer(input) {
    const trailerPlayer = document.getElementById('trailer-player');
    const trailerUrl = input.value;

    if (isValidUrl(trailerUrl)) {
        trailerPlayer.src = trailerUrl;
    } else {
        alert('Invalid URL');
    }
}

function isValidUrl(url) {
    return url.trim() !== '';
}
//region limitations
function limitRegions() {
    var checkboxes = document.querySelectorAll('input[name="countries_id[]"]');
    var selectedCount = 0;
    
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            selectedCount++;
        }
    }

    if (selectedCount >= 2) {
        for (var i = 0; i < checkboxes.length; i++) {
            if (!checkboxes[i].checked) {
                checkboxes[i].disabled = true;
            }
        }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].disabled = false;
        }
    }
}

$(document).ready(function() {
    $(document).on('click','.delete_genre_btn',function(e){

      e.preventDefault();

      var id = $(this).val();

      //alert(id);

      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax
            ({
                  method: "POST",
                  url: "code.php",
                  data: {
                      'genre_id':id,
                      'delete_genre_btn': true,
                  },
                  success: function(response){ 
      
                     if (response == 200) 
                     {
                        swal("Success!", "Genre deleted successfully", "success");
                        $("#genre_table").load(location.href + " #genre_table");
                     } 
                     else if(response == 500)
                     {
                        swal("Error!", "Something went wrong", "error");
                     }
                     else if(response == 404)
                     {
                        swal("404!", "Genre not foundg", "error");
                     }                           
                  }
            });
          }
        });
  })
  $(document).on('click','.delete_region_btn',function(e){

    e.preventDefault();

    var id = $(this).val();

    //alert(id);

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax
          ({
                method: "POST",
                url: "code.php",
                data: {
                    'countries_id':id,
                    'delete_region_btn': true,
                },
                success: function(response){ 
    
                   if (response == 200) 
                   {
                      swal("Success!", "Region deleted successfully", "success");
                      $("#region_table").load(location.href + " #region_table");
                   } 
                   else if(response == 500)
                   {
                      swal("Error!", "Something went wrong", "error");
                   }
                   else if(response == 404)
                   {
                      swal("404!", "Region not found", "error");
                   }                       
                }
          });
        }
      });
})
$(document).on('click','.delete_content_type_btn',function(e){

    e.preventDefault();

    var id = $(this).val();

    //alert(id);

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax
          ({
                method: "POST",
                url: "code.php",
                data: {
                    'content_type_id':id,
                    'delete_content_type_btn': true,
                },
                success: function(response){ 
    
                   if (response == 200) 
                   {
                      swal("Success!", "Content type deleted successfully", "success");
                      $("#content_type_table").load(location.href + " #content_type_table");
                   } 
                   else if(response == 500)
                   {
                      swal("Error!", "Something went wrong", "error");
                   }
                   else if(response == 404)
                   {
                      swal("404!", "Region not found", "error");
                   }                       
                }
          });
        }
      });
})
});
$(document).on('click','.delete_movie_btn',function(e){

   e.preventDefault();

   var id = $(this).val();

   //alert(id);

   swal({
       title: "Are you sure?",
       text: "Once deleted, you will not be able to recover !",
       icon: "warning",
       buttons: true,
       dangerMode: true,
     })
     .then((willDelete) => {
       if (willDelete) {
         $.ajax
         ({
               method: "POST",
               url: "code.php",
               data: {
                   'content_id':id,
                   'delete_movie_btn': true,
               },
               success: function(response){ 
   
                  if (response == 200) 
                  {
                     swal("Success!", "Content type deleted successfully", "success");
                     $("#content_table").load(location.href + " #content_table");
                  } 
                  else if(response == 500)
                  {
                     swal("Error!", "Something went wrong", "error");
                  }
                  else if(response == 404)
                  {
                     swal("404!", "Region not found", "error");
                  }                       
               }
         });
       }
     });
})
$(document).on('click','.delete_serie_btn',function(e){

    e.preventDefault();
 
    var id = $(this).val();
 
    //alert(id);
 
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax
          ({
                method: "POST",
                url: "code.php",
                data: {
                    'series_id':id,
                    'delete_serie_btn': true,
                },
                success: function(response){ 
    
                   if (response == 200) 
                   {
                      swal("Success!", "Content type deleted successfully", "success");
                      $("#series_table").load(location.href + " #series_table");
                   } 
                   else if(response == 500)
                   {
                      swal("Error!", "Something went wrong", "error");
                   }
                   else if(response == 404)
                   {
                      swal("404!", "Region not found", "error");
                   }                       
                }
          });
        }
      });
 })
 $(document).on('click','.delete_season_btn',function(e){

    e.preventDefault();
 
    var id = $(this).val();
 
    //alert(id);
 
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax
          ({
                method: "POST",
                url: "code.php",
                data: {
                    'season_id':id,
                    'delete_season_btn': true,
                },
                success: function(response){ 
    
                   if (response == 200) 
                   {
                      swal("Success!", "Content type deleted successfully", "success");
                      $("#season_table").load(location.href + " #season_table");
                   } 
                   else if(response == 500)
                   {
                      swal("Error!", "Something went wrong", "error");
                   }
                   else if(response == 404)
                   {
                      swal("404!", "Region not found", "error");
                   }                       
                }
          });
        }
      });
 })
 $(document).on('click','.delete_episode_btn',function(e){

  e.preventDefault();

  var id = $(this).val();

  //alert(id);

  swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover !",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax
        ({
              method: "POST",
              url: "code.php",
              data: {
                  'episode_id':id,
                  'delete_episode_btn': true,
              },
              success: function(response){ 
  
                 if (response == 200) 
                 {
                    swal("Success!", "Content type deleted successfully", "success");
                    $("#episode_table").load(location.href + " #episode_table");
                 } 
                 else if(response == 500)
                 {
                    swal("Error!", "Something went wrong", "error");
                 }
                 else if(response == 404)
                 {
                    swal("404!", "Region not found", "error");
                 }                       
              }
        });
      }
    });
})