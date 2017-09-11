    jQuery(function(){
    	jQuery("[title]").mbTooltip({ // also $([domElement]).mbTooltip
          opacity : 1.0,       //opacity
          wait:600,           //before show
          cssClass:"default",  // default = default
          timePerWord:20,      //time to show in milliseconds per word
          hasArrow:true,                 // if you whant a little arrow on the corner
          hasShadow:true,
          imgPath:"/theme/factory/img/jquery.mbtooltip/",
          anchor:"mouse", //or "parent" you can ancor the tooltip to the mouse  or to the element
          shadowColor:"black", //the color of the shadow
          mb_fade:200 //the time to fade-in
        });	
    });