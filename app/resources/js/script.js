
$(function () {


    // $('.flash_message').fadeIn(1000, function () {
    //     $(this).delay(3000).fadeOut(1500);
    // });


    $('.flash_message').delay(3000).queue(function () {
        $(this).addClass('flash_active');
    });


});

// window.addEventListener("beforeunload", function (e) {
//     var confirmationMessage = "入力内容を破棄します。";
//     e.returnValue = confirmationMessage;
//     return confirmationMessage;
// });