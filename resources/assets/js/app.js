
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function() {
	$('.nav-left>li>a').click(function (event) {
		$('.navbar-collapse>ul>li').removeClass('active');
		$(this).parent().addClass('active');
	});
	$('#sidebar-profile>a').click(function(event) {
		$('#sidebar-profile>a').removeClass('active');
		$(this).addClass('active');
	});
	//Change active when click status
	$('#profile-status>li>a:first-child, #profile-status>li>a:nth-child(2)').click(function (event) {
		$('#sidebar-profile>a').removeClass('active');
		$('#sidebar-profile>a:nth-child(2)').addClass('active');
	});
	//Change button Follow, Unfollow
	$(document).on('click','#user-box>a:last-child>button.btn', function (event) {
		//Change css
		if($(this).hasClass('btn-info')) {
			$(this).removeClass('btn-info');
			$(this).addClass('btn-danger');
			$(this).html('Follow');
		} else {
			$(this).removeClass('btn-danger');
			$(this).addClass('btn-info');
			$(this).html('Following');
		}
		// Save into database
		var id = $(this).attr('id');
		$.get('http://localhost/Project-Framgia/fels_226/public/ajaxFollow/'+id, function (data) {
		});
	});
});

