// My Script 
$(function(){
    
    // Categories
    $('#close').click(function(){
        $('.open').css("display","none");
        $('#box0').css("display","block");
    });
    
    $('#ada').click(function(e){
        e.preventDefault();
        $('#box0').css("display","none");
        $('#box1').css("display","block");
    });
    $('#cso').click(function(e){
        e.preventDefault();
        $('#box0').css("display","none");
        $('#box2').css("display","block");
    });
    $('#t').click(function(e){
        e.preventDefault();
        $('#box0').css("display","none");
        $('#box3').css("display","block");
    });
    $('#db').click(function(e){
        e.preventDefault();
        $('#box0').css("display","none");
        $('#box4').css("display","block");
    });
    $('#pqt').click(function(e){
        e.preventDefault();
        $('#box0').css("display","none");
        $('#box5').css("display","block");
    });
    $('#se').click(function(e){
        e.preventDefault();
        $('#box0').css("display","none");
        $('#box6').css("display","block");
    });
    
    
    // Log In
    $("#tosign").click(function(){
        window.location.href = 'signup.php';
    });
    
    // Sign Up
    $('#tolog').click(function(){
        window.location.href = "login.php";
    });

    
});