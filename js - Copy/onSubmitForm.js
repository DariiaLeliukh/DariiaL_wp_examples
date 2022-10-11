jQuery(function($){
    $('#disclaimer').bind('submit', function(e){

        var choiceChecked = $(this).find('input[name="choice"]').is(':checked');

        e.preventDefault(); //you are just opening a window or alerting.. no submit!
    
        if (!choiceChecked) {
            alert ('You did not check the "I agree" option.');
        } else {
            window.open ("https://www.volgistics.com/ex/portal.dll/ap?AP=1055052534");
        }

    });
});
