 
$(document).ready(function () {
			function toggleSidebar(side) {
				if (side !== "left" && side !== "right") {
					return false;
				}
				var left = $("#sidebar-left"),
					right = $("#sidebar-right"),
					content = $("#content"),
					openSidebarsCount = 0,
					contentClass = "";
				
				// toggle sidebar
				if (side === "left") {
					left.toggleClass("collapsed");
				} else if (side === "right") {
					right.toggleClass("collapsed");
				}
				
				// determine number of open sidebars
				if (!left.hasClass("collapsed")) {
					openSidebarsCount += 1;
				}
				
				if (!right.hasClass("collapsed")) {
					openSidebarsCount += 1;
				}
				
				// determine appropriate content class
				if (openSidebarsCount === 0) {
					contentClass = "col-md-12";
				} else if (openSidebarsCount === 1) {
					contentClass = "col-md-10";
				} else {
					contentClass = "col-md-8";
				}
				
				// apply class to content
				content.removeClass("col-md-12 col-md-10 col-md-8")
					   .addClass(contentClass);
			}
			$(".toggle-sidebar-left").click(function () {
				toggleSidebar("left");
				
				return false;
			});
			$(".toggle-sidebar-right").click(function () {
				toggleSidebar("right");
				
				return false;
			});

			$("#nl1").click(function () {
				$("#nl2").show();
				
			});
			$("#nr1").click(function () {
				$("#nr2").show();
				
			});
			$("#nl2").click(function () {
				$("#nl2").hide();
			});

			$("#nr2").click(function () {
				$("#nr2").hide();
			});

			// $("#nr1").click(function () {
			// 	$("#nl1").click(function () {
			// 		$("#nr2").hide();
			// 		$("#nr3").show();
			// 	});
		
			// });
			
			// $("#nr3").click(function () {
			// 	$("#nr3").hide();
				
			// });
		});