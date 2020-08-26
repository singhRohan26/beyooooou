function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
// choose img end 


$(document).ready(function () {
    $('.myAccount').click(function () {
        $('.accountDrop').slideToggle();
    })
});

$(document).on("click", function (event) {
    var $trigger = $(".header");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
        $(".accountDrop").slideUp("fast");
    }
});


$(window).scroll(function () {
    if ($(window).scrollTop() >= 5) {
        $('.header').addClass('fixed_header');
    } else {
        $('.header').removeClass('fixed_header');
    }
});


$(document).ready(function () {
    $('.locationDtl ul li a').mouseenter(function () {
        var locImage = $(this).parent('li').children('img').attr('src');
        $('.locationMap img').attr('src', locImage).fadeIn();

    });
});
//Beyoou Cat Tags
$(document).ready(function () {
//    $('.all').hide();
//    $('.alla').show();
//    $('.clickme').click(function () {
//        var type = $(this).data('type');
//        $('.all').hide();
//        $('.all' + type).fadeIn();
//        $('.clickme').removeClass('active');
//        $(this).addClass('active');
//    });
});

// tab start
$(document).ready(function () {
    $('.payDtl').hide();
    $('.payDtl1').show();
    $('.clicktab').click(function () {
        var type = $(this).data('type');
        $('.payDtl').hide();
        $('.payDtl' + type).fadeIn();
        $('.clicktab').removeClass('active');
        $(this).addClass('active');
    });
});
// tab end


$(document).ready(function () {

    $('.sort').click(function (event) {
        event.stopPropagation();
        $('.filDrop_content').slideToggle();
    });

    $(document).click(function () {
        $('.filDrop_content').slideUp();
    });
});


$('.book_btn a').click(function () {
    $('.choose_sec').show();
});

$('.book_btn').click(function () {
    $(this).find('a').text('SELECTED');
    $(this).find('a').css('background-color', '#fe5a1d').css("color", "#fff").css('border', 'none');
});


// modal start
$('.psd_fwd').click(function () {
    $('.psd_hide').show();
    $('.psd_show').hide();
});
// modal end

// $('.book_btn').hover(function(){
// var book = $(this).find('a').text('selected');
// alert(book);
// });

$(document).ready(function () {
    $(".set > a").on("click", function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).siblings(".content").slideUp(500);
            $(".set > a i").removeClass("fa-caret-down rotate").addClass("fa-caret-down");
        } else {
            $(".set > a i").removeClass("fa-caret-down rotate").addClass("fa-caret-down");
            $(this).find("i").removeClass("fa-caret-down").addClass("fa-caret-down rotate");

            $(".set > a").removeClass("active");
            $(this).addClass("active");
            $(".content").slideUp(500);
            $(this).siblings(".content").slideDown(500);
        }
    });
});


        $(document).on('click', '#product-wishlist-heart', function (evt) {
            evt.preventDefault();
            if ($(this).children('i').hasClass('heartColor')) {
                $(this).children('i').removeClass('heartColor');
            } else {
                $(this).children('i').addClass('heartColor');
            }
              $(".wishBox").fadeIn();
                $(".wishBox").fadeOut(2000);
                $(".wishBox span").html("Added to your wishlist!. ");
        }); 

   
        $(document).on('click', '.removeWishlist', function (evt) {
            evt.preventDefault();
             $(".wishBox").fadeIn();
                $(".wishBox").fadeOut(2000);
                $(".wishBox span").html("Removed from your wishlist!. ");          
        });
  

function copyFun() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");

}

