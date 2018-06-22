$(document).ready(function() {
    $('.no-submit').on('click', function(e) {
        // Prevent the default action of the clicked item. In this case that is submit
        e.preventDefault();
        return false;
    }); 
});