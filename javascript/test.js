$(document).ready(function(){



$('span.comment_link').click(function(){
    
    
    // Remove highlighting from every link
    $('span.comment_link').removeClass('active');
    
    // Hide feilkilder
    $('span.error').hide();
       
    
    // Add highlighting to the link clicked
    $(this).addClass('active');
    
    
    // Find out the index of the link clicked
    var index = $("span.comment_link").index(this);
    
    
    // Hide all comments
    $("span.comment").hide();
    
    
    // Show only the comment connected to the link clicked
    $("span.comment").eq(index).show();
    
    
    // Display link to common errors
    
    $('span.error_link').show(); 

    
    
    
    
    
});


$('span.error_link').click(function(){
    
    $(this).hide();
    
    $("span.comment").hide();
     
    $('span.error').show();    
    
});


});