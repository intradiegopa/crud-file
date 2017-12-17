<?php
// inizializzazione della sessione
    session_start();
// se la sessione di autenticazione 
// è già impostata non sarà necessario effettuare il login
// e il browser verrà reindirizzato alla pagina di scrittura dei post
// controllo sul parametro d'invio

    if( isset($_SESSION["auth"]) && !empty($_SESSION["auth"]) ){
        if( $_SESSION["admin"] )
            header("Location: admin.php");
        else
            header("Location: utente.php");
    }else if(isset($_POST['submit']) && (trim($_POST['submit']) == "Login"))
    { 
      // controllo sui parametri di autenticazione inviati
      if( !isset($_POST['username']) || $_POST['username']=="" )
      {
        $error="Attenzione! Inserire lo username.";
      }
      elseif( !isset($_POST['password']) || $_POST['password'] =="")
      {
        $error="Attenzione! Inserire la password.";
      }
      else {
        //validazione dei parametri tramite filtro per le stringhe
        $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
        $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
    
        if (($handle = fopen("utenti.csv", "r"))) 
        {
            // ricerca nel file della riga dell'utente
            $loggato=false;
            while ($riga = fgetcsv($handle, 1000, ";")) 
            {
                if($riga[0]==$username && $riga[1]==$password)
                {
                    $loggato = true;
                    $tipo = $riga[2];
                }
            }   
            if($loggato){
                $_SESSION["auth"] = $username;
                
                if($tipo == 'A'){
                    
                    $_SESSION["admin"] = true;
                    // reindirizzamento alla pagina amministrazione in caso di successo
                    header("Location: admin.php");
                }
                else {
                    $_SESSION["admin"] = false;
                    // reindirizzamento alla pagina utente in caso di successo
                    header("Location: utente.php");
                }

            } else {
                // autenticazione fallita torna indietro alla login page
                $error="Username  o Password errata!";
            }   
           fclose($handle);
        } 
      }
    }
  // form per l'autenticazione
      ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-green.min.css" />
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

	<meta name="viewport" content="width=device-width">
	
	
	<style>
		.mdl-layout {
			align-items: center;
		  justify-content: center;
		}
		.mdl-layout__content {
			padding: 24px;
			flex: none;
		}
	
	</style>
    <script>
    document.getElementById("password").addEventListener("keydown", function(event) 
    {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("submit").click();
    }
        
    });
    function focusF(){
            document.getElementById("username").focus();
        }
    </script>
</head>

<body onload="focusF();">
<div class="mdl-layout mdl-js-layout mdl-color--grey-100">
	<main class="mdl-layout__content">
		<div class="mdl-card mdl-shadow--6dp">
			<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
				<h2 class="mdl-card__title-text">Login App Gestione Utenti</h2>
			</div>
	  	<div class="mdl-card__supporting-text">
				<form action="" method="post">
                    <p>demo: prego utilizzare username [admin] password [admin].</p>
					<span style='color:red;'><?php echo $error; ?></span>
					<div class="mdl-textfield mdl-js-textfield">
						<input id="username" name="username" placeholder="Username" type="text" class="mdl-textfield__input"/>
						<label class="mdl-textfield__label" for="username">Username</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield">
						<input id="password" name="password" placeholder="**********" type="password" class="mdl-textfield__input" />
						<label class="mdl-textfield__label" for="userpass">Password</label>
					</div>
                    
			<div class="mdl-card__actions mdl-card--border">
				<input name="submit" type="submit" value="Login" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
			</div>
            </form>
            </div>
		</div>
	</main>
</div>

</body>
</html>