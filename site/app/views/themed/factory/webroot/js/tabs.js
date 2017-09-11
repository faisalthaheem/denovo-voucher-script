/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	$(".menu > li").click(function(e){
		switch(e.target.id){
			case "recentVoucher":
				//change status & style menu
				$("#recentVoucher").addClass("active");
				$("#topViewedDiscounts").removeClass("active");
				$("#merchantDirectory").removeClass("active");
				//display selected division, hide others
				$("div.recentVoucher").fadeIn();
				$("div.topViewedDiscounts").css("display", "none");
				$("div.merchantDirectory").css("display", "none");
			break;
			case "topViewedDiscounts":
				//change status & style menu
				$("#recentVoucher").removeClass("active");
				$("#topViewedDiscounts").addClass("active");
				$("#merchantDirectory").removeClass("active");
				//display selected division, hide others
				$("div.topViewedDiscounts").fadeIn();
				$("div.recentVoucher").css("display", "none");
				$("div.merchantDirectory").css("display", "none");
			break;
			case "merchantDirectory":
				//change status & style menu
				$("#recentVoucher").removeClass("active");
				$("#topViewedDiscounts").removeClass("active");
				$("#merchantDirectory").addClass("active");
				//display selected division, hide others
				$("div.merchantDirectory").fadeIn();
				$("div.recentVoucher").css("display", "none");
				$("div.topViewedDiscounts").css("display", "none");
			break;
			
			case "hotOffers":
				//change status & style menu
				$("#hotOffers").addClass("active");
				$("#mostLikedRetailers").removeClass("active");
				$("#mostViewedRecently").removeClass("active");
				//display selected division, hide others
				$("div.hotOffers").fadeIn();
				$("div.mostLikedRetailers").css("display", "none");
				$("div.mostViewedRecently").css("display", "none");
			break;
			case "mostLikedRetailers":
				//change status & style menu
				$("#hotOffers").removeClass("active");
				$("#mostLikedRetailers").addClass("active");
				$("#mostViewedRecently").removeClass("active");
				//display selected division, hide others
				$("div.mostLikedRetailers").fadeIn();
				$("div.hotOffers").css("display", "none");
				$("div.mostViewedRecently").css("display", "none");
			break;
			case "mostViewedRecently":
				//change status & style menu
				$("#hotOffers").removeClass("active");
				$("#mostLikedRetailers").removeClass("active");
				$("#mostViewedRecently").addClass("active");
				//display selected division, hide others
				$("div.mostViewedRecently").fadeIn();
				$("div.hotOffers").css("display", "none");
				$("div.mostLikedRetailers").css("display", "none");
			break;
		}
		//alert(e.target.id);
		return false;
	});
});