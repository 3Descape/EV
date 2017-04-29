require('./bootstrap');
window.$ = window.jQuery = require('jquery');


// $(document).ready(function(){
//             var scroll_pos = 0;
//             $(document).scroll(function() {
//                 scroll_pos = $(this).scrollTop();
//                 if(scroll_pos < $('#über_uns').height()){
//                   $("body").removeClass('bg-dark');
//                 }
//                 if(scroll_pos > $('#über_uns').height()) {
//                     $("body").addClass('bg-dark');
//                 } if (scroll_pos > $('#über_uns').height() + $('#vorstand').height()) {
//                     $("body").removeClass('bg-dark');
//                 } if (scroll_pos > $('#über_uns').height() + $('#vorstand').height() + $('#elternvertreterInnen').height()) {
//                     $("body").addClass('bg-dark');
//                 }
//             });
//         });
