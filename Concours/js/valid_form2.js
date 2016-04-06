$(document).ready(function() {  
  
    var all = {};
    all["login"] = false;
    all["password"] = false;
    all["email"] = false;
 
    $("#login").keyup((function(){
        if(!$("#login").val().match(/^[a-zA-Z0-9]{3,24}$/)){
            if(arguments.length) {
                $("#login").next("#pseudobox").show().text("Entrer un login alphanumérique entre 3 et 24 caractères").attr('class', 'non_libre');
            }
            all["login"] = false;
            check();
        }  
        else{
            check_availability('login');
        }
        return arguments.callee;
    })());
 
    $("#email").keyup((function(){
        if(bonmail($('#email').val()) == false){
            if(arguments.length) {
                $("#mailbox").text("Votre e-mail n'est pas valide").attr('class', 'non_libre');
            }
            all["email"] = false;
            check();                                                                     
        }
        else if(bonmail($('#email').val())){
            check_availability('mail');
        }
        return arguments.callee;
    })());
 
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
            all["password"] = true;
            check();
        } else if (!pass.val() && !pass_conf.val()){
            $('#mdpbox').text(" ").attr('class', '');
            all["password"] = false;
            check();
        }else{
            $('#mdpbox').text("Mot de passe non identiques !").attr('class', 'non_libre');
            all["password"] = false;
            check();
        };
    } 
       
    $("#envoyer")[0].disabled = true;
    var str = "";
    for(var i in all) {
      str+=i+":"+all[i]+"\n";
    }

    function check() {
        var ok = true;
        for(var i in all) {
            ok = ok && all[i];
            console.log(i, all[i]);
        }
        $("#envoyer")[0].disabled = !ok;
    }

    function check_availability(what){  
        if (what == "login") {
            var username = $('#login').val();  
        
            $.post("php/script.php", { username: username },  
                function(resultLog){  
                    if(resultLog == 1){ 
                        all["login"] = true;
                        $("#pseudobox").text("Votre login est valide").attr('class', 'libre');
                        check();
                    }else{    
                        all["login"] = false; 
                        $("#pseudobox").text("Votre login n'est pas valide ou déjà utilisé").attr('class', 'non_libre');
                        check();
                    }  
            });
        } else if (what == "mail"){
            var mail = $('#email').val();  
        
            $.post("php/script.php", { mail: mail },  
                function(resultMail){  
                    if(resultMail == 1){ 
                        all["email"] = true;
                        $("#mailbox").text("Votre e-mail est valide").attr('class', 'libre');
                        check();
                    }else{    
                        all["email"] = false;
                        $("#mailbox").text("Votre e-mail n'est pas valide ou déjà utilisé").attr('class', 'non_libre');
                        check();
                    }  
            });
        }
    }

    function bonmail(mailteste){
        var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

        return(reg.test(mailteste));
    }
});  