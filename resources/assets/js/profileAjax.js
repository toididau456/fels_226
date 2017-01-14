var url = 'http://localhost/Project-Framgia/fels_226/public/';
/*Ajax Profile*/
     //get activities
 $('#sidebar-profile>a:first-child').click(function(event) {
     var id = $(this).attr('id');
     $.get(url + 'ajaxActivities/'+id, function (data) {
         $('#sidebar-main').html(data);
     });
 });
 $(document).on("click", "#user-activities-paginate a", function(event) {
     event.preventDefault();
     $.get($(this).attr("href"), function (data) {
         $('#sidebar-main').html(data);
     });
 });
 $(document).on("click", "#user-paginate a", function(event) {
     event.preventDefault();
     $.get($(this).attr("href"), function (data) {
         $('#sidebar-main').html(data);
     });
 });
 //get User Follwing
 $('#sidebar-profile>a:nth-child(2), #profile-status>li:first-child>a').click(function (event) {
     var id = $(this).attr('id');
     $.get(url + 'ajaxProfile/'+id+'/'+1, function (data) {
         $('#sidebar-main').html(data);
     });
 });
 //get User Follower
 $('#profile-status>li:nth-child(2)>a').click(function (event) {
     var id = $(this).attr('id');
     $.get(url + 'ajaxProfile/'+id+'/'+2, function (data) {
         $('#sidebar-main').html(data);
     });
 });
 //get User
 $('#sidebar-profile>a:last-child').click(function (event) {
     var id = $(this).attr('id');
     $.get(url + 'ajaxProfile/'+id, function (data) {
         $('#sidebar-main').html(data);
     });
 }); 
 