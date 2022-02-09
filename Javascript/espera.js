$(document).ready(function () {
    steps(1);

    setTimeout(() => {
        steps(2);
    }, 1000);
});





function steps(step){
    switch(step){
        case 1:
            $('.progress-line').css('width', '0%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#aaa');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 2:
            $('.progress-line').css('width', '50%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 3:
            $('.progress-line').css('width', '100%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            break;

    }
}