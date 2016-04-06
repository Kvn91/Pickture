$(document).ready(function() {  
  
    var min_chars = 3;  
    
    var error_longueur = 'Login trop court !';  
    var search = 'Recherche...';
    
    var pass, pass_conf, login_ok, mdp_ok, mail_ok;



    
    $('input[name="password_confirm"]').keyup( function(){
        test_mdp();
    });
    
    $('input[name="password"]').keyup( function() {
        test_mdp();
    });
    
    function test_mdp(){
        pass = $('input[name="password"]');
        pass_conf = $('input[name="password_confirm"]');
    
        if (pass.val() == pass_conf.val() && pass.val()) {
            $('#mdpbox').text("Mot de passe ok !").attr('class', 'libre');
            mdp_ok = true;
        } else if (!pass.val() && !pass_conf.val()){
            $('#mdpbox').text(" ").attr('class', '');
        }else{
            $('#mdpbox').text("Mot de passe non identiques !").attr('class', 'non_libre');
            mdp_ok = false;
        };
    } 
    
    
    $('#login').keyup(function(){   
        if($('#login').val().length < min_chars){  
            $('#pseudobox').html(error_longueur).attr('class', 'non_libre');
            login_ok = false;  
        }else{
            $('#pseudobox').html(search);
            check_availability("login");  
        }  
    });

    $('#email').keyup(function(){   
        if(bonmail($('#email').val()) == false){
            console.log(bonmail($('#email').val()));
            $('#mailbox').html("Email non valide").attr('class', 'non_libre');
            mail_ok = false;
        }else{
            $('#mailbox').html(search);
            check_availability("mail");  
        }  
    });

    function bonmail(mailteste){
        var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

        return(reg.test(mailteste));
    }
    
    
    function check_availability(what){  
        if (what == "login") {
            var username = $('#login').val();  
        
            $.post("php/script.php", { username: username },  
                function(resultLog){  
                    if(resultLog == 1){ 
                        $('#pseudobox').html(username + ' est libre').attr('class', 'libre');
                        login_ok = true;
                    }else{    
                        $('#pseudobox').html(username + " n'est PAS libre").attr('class', 'non_libre');
                        login_ok = false;  
                    }  
            });
        } else if (what == "mail"){
            var mail = $('#email').val();  
        
            $.post("php/script.php", { mail: mail },  
                function(resultMail){  
                    if(resultMail == 1){ 
                        $('#mailbox').html(mail + ' est libre').attr('class', 'libre');
                        mail_ok = true;  
                    }else{    
                        $('#mailbox').html(mail + " n'est PAS libre").attr('class', 'non_libre');
                        mail_ok = false;  
                    }  
            });
        }

        console.log(login_ok);
    }

    if (login_ok && mdp_ok && mail_ok) {
        $('#envoyer').removeAttr("disabled");
    };
});  