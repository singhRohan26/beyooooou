var Event = function () {
    this.__construct = function () {
//        this.loader();
        this.frontloader();
        this.tooltip();
        this.commonForm();
        this.imageCommonForm();
        this.imageCommonForm1();
        this.delLanguage();
        this.child();
        this.superchild();
        this.delcategory();
        this.categoryFilter();
        this.doCategoryFilter();
        this.getLanguage();
        this.superchildcat();
        this.delService();
        this.delServices();
        this.postWishlist();
        this.addtocart();
        this.delCoupon();
        this.removeCart();
        this.scheduling();
        this.CartRemove();
        this.shopFilter();
        this.popular_filter_form();
        this.delchild();
        this.delsuperchild();
        
    };

//    this.loader = function () {
//        $(document).ready(function () {
//            $(".loader-admin").fadeOut("slow");
//        });
//    };

     this.frontloader = function () {
        $(document).ready(function () {
//            alert("hello")
            $(".loader").fadeOut("slow");
        });
    };
    
    this.tooltip = function () {
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    };

    this.commonForm = function () {
        $(document).on('submit', '#dologin,#changepass,#aboutus,#addlanguage,#privacy,#superchildcategory,#childcategory,#manage_lang,#register_form,#login_form,#addPartnerForm,#forgot_link,#childcategory1,#partnerchangepass,#user_chngpass,#addservice,#addservicesss,#addcoupon,#apply_coupon,#book,#addReview', function (evt) { 
            
            evt.preventDefault();
            $(".loader").fadeIn("slow");
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
               
                $(".loader").fadeOut("slow");
                $(".errr_gen").remove();
                $(".form-group > .text-danger").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parent(".mb-3, " + " .form-group").after('<span class="text-danger errr_gen">' + out.errors[i] + '</span>');
                    }
                    return true;
                }
                if (out.result === -3) {
                    $("#subcategory_name").parents(".input-field").append('<span class="text-danger">' + out.error_msg_tkn + '</span>');
                }
                if (out.result === -1) {
                    
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>';
                    $(".error_msg").removeClass('alert-danger alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $(".error_msg").html(message + out.msg);
                    $(".error_msg").fadeOut(2000);
                }
                if (out.result === -2) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>';
                    $(".error_msg").removeClass('alert-danger alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $(".error_msg").html(message + out.msg);
                    $(".error_msg").fadeOut(5000);
                    window.setTimeout(function () {
                        window.location.href = out.url;
                    }, 2000);
                }
                if (out.result === 1) {
                    
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>';
                    $(".error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                    $(".error_msg").html(message + out.msg);
                    $(".error_msg").fadeOut(5000);
                    if (out.url !== undefined) {
                        window.setTimeout(function () {
                            window.location.href = out.url;
                        }, 2000);
                    }
                }
                if (out.result === 3) {
                    $('#loginModal').modal('hide');
                    $('#signingUp').modal('show');
                }
                if (out.result === 4) {
                    $('#signupModal').modal('hide');
                    $('#signingUp').modal('show');
                }
            });
        });
    };

    this.imageCommonForm = function () {
        $("#image-common-form,#profile-form,#addpost_form,#addcategory,#addsubcategory,#shopProfile,#profile_form").submit(function (evt) {
            evt.preventDefault();
            $(".loader").fadeIn("slow");
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                success: function (out) {
                    $(".loader").fadeOut("slow");
                    $(".input-field > .error").remove();
                    $(".form-group > .text-danger").remove();
                    if (out.result === 0) {
                        for (var i in out.errors) {
                            $("#" + i).parents(".input-field, " + " .form-group").append('<span class="text-danger">' + out.errors[i] + '</span>');
                            $("#" + i).focus();
                        }
                        if (out.err) {
                            $("#category_id").append('<span class="text-danger">' + out.err + '</span>');
                        }
                        if (out.errCountry) {
                            $("#country_id").parents(".input-field, " + " .form-group").append('<span class="text-danger">' + out.errCountry + '</span>');
                        }
                        if (out.errCountryManu) {
                            $("#country_manu_id").parents(".input-field, " + " .form-group").append('<span class="text-danger">' + out.errCountryManu + '</span>');
                        }
                        if (out.errCities) {
                            $("#city_id").parents(".input-field, " + " .form-group").append('<span class="text-danger">' + out.errCities + '</span>');
                        }
                    }
                    if (out.result === -4) {

                        $("#city_id").parent(".input-field, " + " .form-group").append('<span class="text-danger">' + out.errCountry + '</span>');
                        $("#city_id").focus();
                    }
                    if (out.result === -5) {

                        $("#city_id").parent(".input-field, " + " .form-group").append('<span class="text-danger">' + out.errCountryy + '</span>');
                        $("#city_id").focus();
                    }
                    if (out.result === -1) {

                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>';
                        $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }
                    if (out.result === -2) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>';
                        $("#error_msg").removeClass('alert-danger alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        window.setTimeout(function () {
                            window.location.href = out.url;
                        }, 1000);
                    }
                    if (out.result === 1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>';
                        $("#error_msg").removeClass('alert-danger').addClass('alert alert-success alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(5000);
                        window.setTimeout(function () {
                            window.location.href = out.url;
                        }, 2000);
                    }
                }
            });
        });
    };

    this.imageCommonForm1 = function () {
        $("#image-common-form1").submit(function (evt) {
            evt.preventDefault();
            $(".loader").fadeIn("slow");
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (out) {
                    $(".loader").fadeOut("slow");
                    $(".form-group1 > .error").remove();
                    $(".form-group1 > .text-danger").remove();
                    if (out.result === 0) {
                        for (var i in out.errors) {
                            $("#" + i).parents(".form-group1").append('<span class="text-danger">' + out.errors[i] + '</span>');
                            $("#" + i).focus();
                        }
                        if (out.err) {
                            $("#category_id").parents(".form-group1").append('<span class="text-danger">' + out.err + '</span>');
                        }
                        if (out.errCountry) {
                            $("#country_id").parents(".form-group1").append('<span class="text-danger">' + out.errCountry + '</span>');
                        }
                        if (out.errCountryManu) {
                            $("#country_manu_id").parents(".form-group1").append('<span class="text-danger">' + out.errCountryManu + '</span>');
                        }
                        if (out.errCities) {
                            $("#city_id").parents(".form-group1").append('<span class="text-danger">' + out.errCities + '</span>');
                        }
                    }
                    if (out.result === -4) {
                        $("#city_id").parents(".form-group1").append('<span class="text-danger">' + out.errCountry + '</span>');
                        $("#city_id").focus();
                    }
                    if (out.result === -5) {

                        $("#city_id").parents(".form-group1").append('<span class="text-danger">' + out.errCountryy + '</span>');
                        $("#city_id").focus();
                    }
                    if (out.result === -1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>';
                        $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }
                    if (out.result === -2) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>';
                        $("#error_msg").removeClass('alert-danger alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        $("#error_msg").fadeOut(2000);
                        window.setTimeout(function () {
                            window.location.href = out.url;
                        }, 1000);
                    }
                    if (out.result === 1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>';
                        $("#error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                        // $("#error_msg").fadeOut(5000);
                        window.setTimeout(function () {
                            window.location.href = out.url;
                        }, 2000);
                    }
                }
            });
        });
    };

     this.delLanguage = function(){
    $(document).on('click', '.delLang', function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
            title: "Do you really want to Delete this Language?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
        });
    });
};
    
    this.delCoupon = function(){
      $(document).on('click', '.delcoupon', function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
            title: "Do you really want to Delete this Coupon?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
        });
    });   
        
    };
    
   this.removeCart = function(){
      $(document).on('click', '.removeCoupon', function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
            title: "Do you really want to remove this Service from your Cart?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
        });
    });   
        
    };
    
    
    this.delcategory = function(){
    $(document).on('click', '.delcategory', function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
            title: "Do you really want to Delete this Category?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
        });
    });
};
    
   this.delService = function(){
        $(document).on('click', '.delservice', function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
            title: "Do you really want to Delete this Service?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
        });
    });
        
    };
    
    this.delchild = function(){
      $(document).on('click', '.delchildcategory', function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
            title: "Do you really want to Delete this Category?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
        });
    });  
    };
    
    this.delsuperchild = function(){
      $(document).on('click', '.delSuperchildcategory', function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
            title: "Do you really want to Delete this Category?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
        });
    });  
    };
    
    this.delServices = function(){
        $(document).on('click', '.delservices', function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
            title: "Do you really want to Delete this Service?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
        });
    });
    };
    
    this.child = function(){
        
        $(document).on('change', '#category', function(){
        var category = $(this).val();
        var url = $(this).data('url');
        $.ajax({
            type: "POST",
            url: url,
            data: 'category_id=' + category,
            success: function(html) {
                $('#subcategory').html(html);
            }
        });
        return false;
    });
    }
    
    this.superchild = function(){
        
        $(document).on('change', '#subcategory', function(){
        var category = $(this).val();
        var url = $(this).data('url');
        $.ajax({
            type: "POST",
            url: url,
            data: 'subcategory_id=' + category,
            success: function(html) {
                $('#childcategory').html(html);
            }
        });
        return false;
    });
    }
    
    this.superchildcat = function(){
        $(document).on('change', '#childcategory', function(){
            var category = $(this).val();
        var url = $(this).data('url');
        $.ajax({
            type: "POST",
            url: url,
            data: 'childcat_id=' + category,
            success: function(html) {
                $('#superchild').html(html);
            }
        });
        return false;
            });
        
    }
    
     this.categoryFilter = function () {
        var url = $("#category_wrapper").data('url');
        $.post(url, function (res) {
            $("#category_wrapper").html(res.content_wrapper);
        })
    }
     
     this.doCategoryFilter = function () {
        $(document).on('click', '#categoryFilter', function (evt) {
            evt.preventDefault();
            
            var url = $(this).attr("href");
            $.post(url, function (out) {
                if (out.result === 1) {
                    $('#category_wrapper').html(out.content_wrapper);
                }
            });

        });
    };
    
    this.getLanguage = function () {
      $(document).on('change', '#getLanguage', function (evt) {
        evt.preventDefault();  
          var url = $(this).data("url");
          var val = $(this).val();
          $.post(url, {val : val}, function (out) {
                   location.reload();
            });
      });
        
    };
    
    this.postWishlist = function () {
        $(document).on('click', '.wish_heart', function (evt) {
            evt.preventDefault();
            if ($("body").data("session") != "") {
                if ($(this).children('i').hasClass('heartColor')) {
                    $(this).children('i').removeClass('heartColor');
                } else {
                    $(this).children('i').addClass('heartColor');
                }
                var cls = $(this).children('i');
                var url = $(this).attr('href');
                $.post(url, '', function(out)  {
                    if (out.result === 1) {
                        if ($(cls).hasClass("heartColor")) {
                            $(".wishBox").fadeIn();
                            $(".wishBox span").html("Added to your wishlist!. ");
                            $(".wishBox").fadeOut(2000);
                        } else {
                            $(".wishBox").fadeIn();
                            $(".wishBox").fadeOut(2000);
                            $(".wishBox span").html("Removed from your wishlist!. ");
                        }
                    }
                });
            } else{
                $(".wishBox").fadeIn();
                $(".wishBox").fadeOut(2000);
                $(".wishBox span").html("Please Login First to Add to your Wishlist.");
            }
        });
    };
    
    this.addtocart = function () {
      $(document).on('click', '.cart', function (evt) {
        evt.preventDefault();
           var url = $(this).attr('href');
                $.post(url, '', function(out)  {
                    if (out.result === 1) {
          swal("Service Added to Cart", "", "success")
              window.setTimeout(function () {
                            location.reload();
                        }, 2000);          
                    }
           });
                
        });
    };
    
    this.scheduling = function () {
        var open_time;
        var close_time = $('#close_time').val();
        var clos_time = '';
        var ope_time = '';
        $(document).on('change', '#date', function () {
            $('#time').val('');
            var booking_date = $(this).val();
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth() + 1;
            var today_date = (d < 10 ? '0' + d : d) + "-" + (m < 10 ? '0' + m : m) + "-" + date.getFullYear();
            if (booking_date === today_date) {
                open_time = $('#curr_time').val();
            } else {
                open_time = $('#open_time').val();
            }
            if (booking_date === '') {
                $("#time").attr("disabled", true);
            } else {
                $("#time").attr("disabled", false);
            }

            $('#time').clockTimePicker({
                minimum: open_time.toString(),
                maximum: close_time.toString(),
                interval: 15,
                showDuration: true
            });
            $('#time').css('display','block');
        });
    };
 
    this.CartRemove = function () {
        $(document).on('click', '.cart_sec', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
                swal({
                    title: "If you select this service, your Previous Service will be Discarded",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.post(url, function(res){
                            if(res.result === 1){
                                location.reload();
                            }
                        })
                    }
                });
        })
    }
    
    this.shopFilter = function () {
        var url = $("#shop_wrapper").data('url');
        var service = $("#categ").val();
        var location = $("#service").val();
        var date = $("#date").val();
        $.post(url, {location : location, service : service, date : date}, function (res) {           
            $("#shop_wrapper").html(res.content_wrapper);
            
        })
    }
    
    this.popular_filter_form = function () {
        $(document).on('submit', '#shop_filter', function (evt) {
            evt.preventDefault();

            var url = $(this).attr("action");
            
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $('.error').remove();

                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parent(".viewForm").append('<span class="error text-danger "><p style="text-align : left;">' + out.errors[i] + '</p></span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {

                }
                if (out.result === 1) {
                    $('#shop_wrapper').html(out.content_wrapper);
                }
            });

        });
        $(document).on('submit', '#form_front_page_filter', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                if (out.result === 1) {
                    window.location.href=out.url;
                }
            });

        });
    };

    this.__construct();
};
var obj = new Event();
