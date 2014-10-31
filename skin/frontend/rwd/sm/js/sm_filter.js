(function ($) {
	$(document).ready(function () {
		$(".col-left.sidebar.col-left-first").on('click', '.block-layered-nav a', function () {
			return $(this).smFilterAjax();
		});

	    $(".dropdown-panel a").on("click", function () {
	    	return $(this).smFilterAjax();
	    });
	});

	$.fn.smFilterAjax = function () {
		var link = $(this).attr('href');
		if (link) {
			if (window.ajaxFlag) {
				alert('Please waiting complete ajax loading')
				return false;
			} else {
				window.ajaxFlag = true;
				$('body').addClass('wait');
				$.ajax({
					url: link,
					type: 'GET',
					dataType: 'json',
					success: function (data) {
						$(".col-left.sidebar.col-left-first").html(data.layer);
						$(".col-main .category-products").html(data.listing);
						$('body').removeClass('wait');
						$(".custom-dropdown").dropdown();
						$(".dropdown-panel a").on("click", function () {
							return $(this).smFilterAjax();
						});
						window.ajaxFlag = false;
					},
					error: function () {
						$(".col-left.sidebar.col-left-first").removeClass('ajax_load');
						$(".col-main .category-products").removeClass('ajax_load');
						alert('Error!! We sorry about the problem!');
						window.ajaxFlag = false;
					}
					});
			}
			return false;
		};
	};
}(jQuery));