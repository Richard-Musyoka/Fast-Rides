/* ADDING SCROLL EFFECT TO NAVBAR */
$(window).scroll(function() 
{    
    var scroll = $(window).scrollTop();

    if (scroll >= 300) 
    {
        $(".navbar").addClass("sticky-navbar");
        $(".above_navbar").css("display","none");
    }
    else
    {
        $(".navbar").removeClass("sticky-navbar");
        $(".above_navbar").css("display","block");
    }
});

const responsive={
    0:{
        items:1
    },

    320:{
        items:1
    },
    560:{
        items:2
    },
    960:{
        items:3
    }
}