<?php
    session_start();
    if(!(isset($_SESSION["auth"]) && !empty($_SESSION["auth"]) && $_SESSION["admin"] )){
        header("Location: index.php");
    }else{
        $nome_utente=$_SESSION["auth"];
        
    if(isset($_POST["stato"])&&!empty($_POST["stato"]))
		$stato=$_POST["stato"];
	else
		$stato=1;
    
    if(isset($_POST["id_utente"]))
        $id_utente=$_POST["id_utente"];
    }
    switch ($stato)
    {
            case 1:
            $nome_pagina_label="Elenco utenti del sistema"; break;
            case 2:
            $nome_pagina_label="Inserimento nuovo utente nel sistema"; break;
            case 3:
            $nome_pagina_label="Inserimento nuovo utente nel sistema"; break;
            case 4:
            $nome_pagina_label="Modifica dell'utente"; break;
             case 5:
            $nome_pagina_label="Modifica dell'utente"; break;
            case 7:
            $nome_pagina_label="Eliminazione di un utente"; break;
    }
?>

<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Pannello Gestione Utenti</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-green.min.css" />
    <link rel="stylesheet" href="styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
      <script>
	function passa_a(valore_stato, valore_utente)
	{
		document.getElementById("stato").value=valore_stato;
        document.getElementById("id_utente").value=valore_utente;
		document.getElementById("forma").submit();
	}
</script>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title" ><?php echo $nome_pagina_label?></span>
          <div class="mdl-layout-spacer"></div>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="images/user.jpg" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span id='nome_utente_label'><?php echo $nome_utente ?></span>
            <div class="mdl-layout-spacer"></div>
            </div>
        </header>
          
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
         
<button onclick='passa_a(1);' class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
  Elenco utenti
</button>
            <a class="mdl-navigation__link"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation"></i></a>         
<button onclick='passa_a(2);' class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
  Inserisci Nuovo Utente
</button>
<a class="mdl-navigation__link"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation"></i></a>     
          <a class="mdl-navigation__link" href="logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Logout</a>
            
          <div class="mdl-layout-spacer"></div>
        </nav>
      </div>
         <main class="mdl-layout__content mdl-color--grey-100">
             <div class="mdl-grid demo-content">
                 <?php 
                 if($stato!=1 && $stato!=7)
                 {
                     
                     echo('<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing"><div class="demo-updates mdl-card mdl-shadow--2dp">');
                 }
                 
                 ?>
            
   <form name='forma' id='forma' method='post'>
	<input type='hidden' name='stato' id='stato' >
   <input type='hidden' name='id_utente' id='id_utente'>
    <?php
	switch($stato)
	{
		
		case 1://1 - elenco utenti
				
				if (($handle = fopen("utenti.csv", "r"))) 
					{
                     echo('<table class="mdl-data-table mdl-js-data-table  ">
                     <thead>
                            <tr>
                            <th class="mdl-data-table__cell--non-numeric">Username</th>
                            <th class="mdl-data-table__cell--non-numeric">Password</th>
                            <th class="mdl-data-table__cell--non-numeric">Tipo di utente</th>
                            <th class="mdl-data-table__cell--non-numeric">Gestione</th>
                            </tr>
                            </thead>
                              <tbody>');
                    $id=0;
					while ($riga = fgetcsv($handle, 1000, ";")) 
						{
							   echo('<tr><th class="mdl-data-table__cell--non-numeric" >'.$riga[0].'</th><th class="mdl-data-table__cell--non-numeric">'.$riga[1].'</th><th class="mdl-data-table__cell--non-numeric" >'.$riga[2]."</th><th><button  onclick='passa_a(4,".$id.");' class='mdl-button mdl-js-button mdl-button--accent'>Modifica</button><button onclick='passa_a(7,".$id.");' class='mdl-button mdl-js-button mdl-button--accent'>Elimina</button></th></tr>");
                        $id++;
						}
					fclose($handle);
                    echo("</tbody></table><br/><br/>");
					}		
				else{
                    $error="Si è verificato un errore, non riesco ad aprire il file!";
					echo("<span class='mdl-layout-title' style='color:red;'>$error</span>");
                }
                    
            
				break;
		case 2: //2 - nuovo utente
            
           echo "<main  class='mdl-layout__content'><div  class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Creazione nuovo utente</h2></div><div class='mdl-card__supporting-text'><form  name='inserimento_utente' id='inserimento_utente' action='' method='post'><div class='mdl-textfield mdl-js-textfield'><input id='username' name='username' placeholder='Username' type='text' class='mdl-textfield__input'/><label class='mdl-textfield__label' for='username'>Username</label></div><div class='mdl-textfield mdl-js-textfield'><input id='password' name='password' placeholder='**********' type='text' class='mdl-textfield__input' /><label class='mdl-textfield__label' for='userpass'>Password</label></div><input type='radio' name='user_type' value='A'> Adminstrator<br><input type='radio' name='user_type' value='U' checked> User<br><div class='mdl-card__actions mdl-card--border'><button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' onclick='passa_a(3);'>Conferma Inserimento</button></div></form></div></div></main>";
            break;
            
		case 3:
				//echo("INSERIMENTO EFFETTIVO NEL FILE...<br/>");
               if (($streamf = fopen("utenti.csv", "r")))
                {
                    $trovato = false;
                    while ($riga = fgetcsv($streamf, 1000, ";")) 
                    {
                        if($_POST["username"]==$riga[0])
                        {
                            $trovato=true;
                        }
                        
                    }
                    fclose($streamf);
                }else{
                    $error="Si è verificato un errore, non riesco ad aprire il file!";
                    echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Creazione nuovo utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
                }

           if($trovato) {
               $error="Si è verificato un errore, il nuovo utente esiste già!";
                echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Creazione nuovo utente</h2></div><div class='mdl-card__supporting-text'>
                                <form  name='inserimento_utente' id='inserimento_utente' action='' method='post'>
                                
					           <span class='mdl-layout-title' style='color:red;'>$error</span><div class='mdl-textfield mdl-js-textfield'><input id='username' value='$_POST[username]' name='username' placeholder='Username' type='text' class='mdl-textfield__input'/><label class='mdl-textfield__label' for='username'>Username</label></div><div class='mdl-textfield mdl-js-textfield'><input value='$_POST[password]' id='password' name='password' placeholder='**********' type='text' class='mdl-textfield__input' /><label class='mdl-textfield__label' for='userpass'>Password</label></div><input type='radio' name='user_type' value='A'> Adminstrator<br><input type='radio' name='user_type' value='U' checked> User<br><div class='mdl-card__actions mdl-card--border'><button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' onclick='passa_a(3);'>Conferma Inserimento</button></div></form></div></div></main>";
           } else {
                                    
            if (($handle = fopen("utenti.csv", "a"))) 
					{
                        if(isset($_POST["username"])&&!empty($_POST["username"]))
                        {
                            if(isset($_POST["password"])&&!empty($_POST["password"]))
                            {
                                $new_line = "\n".$_POST["username"] .';' . $_POST["password"].';'.$_POST["user_type"];
                                fwrite($handle,$new_line);
                                
                                $error="Utente salvato correttamente!";
					           echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Creazione nuovo utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
                                
                            }
                            else{
                                $error="Password mancante!";
                                
                                echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Creazione nuovo utente</h2></div><div class='mdl-card__supporting-text'>
                                <form  name='inserimento_utente' id='inserimento_utente' action='' method='post'>
                                
					           <span class='mdl-layout-title' style='color:red;'>$error</span><div class='mdl-textfield mdl-js-textfield'><input id='username' value='$_POST[username]' name='username' placeholder='Username' type='text' class='mdl-textfield__input'/><label class='mdl-textfield__label' for='username'>Username</label></div><div class='mdl-textfield mdl-js-textfield'><input id='password' name='password' placeholder='**********' type='text' class='mdl-textfield__input' /><label class='mdl-textfield__label' for='userpass'>Password</label></div><input type='radio' name='user_type' value='A'> Adminstrator<br><input type='radio' name='user_type' value='U' checked> User<br><div class='mdl-card__actions mdl-card--border'><button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' onclick='passa_a(3);'>Conferma Inserimento</button></div></form></div></div></main>";
                                
                            }
                        }
                        else{
                            $error="Username mancante!";
                            
                            echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'>
                            <div class='mdl-card__title mdl-color--primary mdl-color-text--white'>
                            <h2 class='mdl-card__title-text'>Creazione nuovo utente</h2></div>
                            <div class='mdl-card__supporting-text'>
                            <form  name='inserimento_utente' id='inserimento_utente' action='' method='post'>
                            <span class='mdl-layout-title' style='color:red;'>$error</span>
                            <div class='mdl-textfield mdl-js-textfield'><input id='username' name='username' placeholder='Username' type='text' class='mdl-textfield__input'/><label class='mdl-textfield__label' for='username'>Username</label></div><div class='mdl-textfield mdl-js-textfield'><input  value='$_POST[password]' id='password' name='password' placeholder='Password' type='text' class='mdl-textfield__input' /><label class='mdl-textfield__label' for='userpass'>Password</label></div><input type='radio' name='user_type' value='A'> Adminstrator<br><input type='radio' name='user_type' value='U' checked> User<br><div class='mdl-card__actions mdl-card--border'><button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' onclick='passa_a(3);'>Conferma Inserimento</button></div></form></div></div></main>";
                        }
					   fclose($handle);
                } else {
					$error="Si è verificato un errore, non riesco ad aprire il file!";
					 echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Creazione nuovo utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
                }
               }
				break;
    
        case 4:
            if (($handle = fopen("utenti.csv", "r")))
            {
                $k=0;
                $avanti = true;
                while ($riga = fgetcsv($handle, 1000, ";")) 
                {
                    if($k==$id_utente)
                    {
                        $username_utente_da_modificare = $riga[0];
                        $password_utente_da_modificare = $riga[1];
                        $tipo_utente_da_modificare = $riga[2];
                        $avanti = false;
                    }
                    $k++;
                }
                fclose($handle);
            }else{
                $error="Si è verificato un errore, non riesco ad aprire il file!";
					 echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Creazione nuovo utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
            }
            
            echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Creazione nuovo utente</h2></div><div class='mdl-card__supporting-text'><form  name='inserimento_utente' id='inserimento_utente' action='' method='post'><div class='mdl-textfield mdl-js-textfield'><label class='mdl-textfield__label' for='username'>Username:</label></div><div class='mdl-textfield mdl-js-textfield'><label class='mdl-textfield__label' for='username' style='color:black;'>$username_utente_da_modificare</label></div><div class='mdl-textfield mdl-js-textfield'><input id='password' value='$password_utente_da_modificare' name='password'  type='text' class='mdl-textfield__input' /><label class='mdl-textfield__label' for='userpass'>Password</label></div>";
            if($tipo_utente_da_modificare == "A"){
                    echo ('<input type="radio" name="user_type" value="A" checked> Adminstrator<br>');
                    echo ('<input type="radio" name="user_type" value="U"> User<br>');
            }else{
                echo ('<input type="radio" name="user_type" value="A" > Adminstrator<br>');
                echo ('<input type="radio" name="user_type" value="U" checked> User<br>');  
            }
                    echo "<div class='mdl-card__actions mdl-card--border'><button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' onclick='passa_a(5,$id_utente);'>Conferma Inserimento</button></div></form></div></div></main>";
            
            break;
            
        case 5:
            //echo("SALVATAGGIO DELLA MODIFICA EFFETTIVO NEL FILE...<br/>");
            //echo("ESITO<br/><br/><br/>");
            if (($handle = fopen("utenti.csv", "r"))) {
                  
                    if(isset($_POST["password"])&&!empty($_POST["password"]))
                    {
                         if (($newfile = fopen("new_utenti.csv", "w"))) 
                         {
                            $i=0;
                            while ($riga = fgetcsv($handle, 1000, ";")) 
                            {
                                if($i==$id_utente)
                                {
                                    $new_line = $riga[0] .';'.$_POST["password"].';'.$_POST["user_type"]."\n"; 
                                }
                                else{
                                    $new_line = $riga[0] .';' . $riga[1].';'.$riga[2]."\n";
                                }
                                fwrite( $newfile, $new_line);
                                $i++;
                            }   
                             
                         $stat = fstat($newfile);
                        ftruncate($newfile, $stat['size']-1);
                         fclose($newfile);
                             fclose($handle);
                             unlink ("utenti.csv");
                             rename("new_utenti.csv","utenti.csv");
                             
                             $error="Utente modificato correttamente!";
					       echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Modifica utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
                            
                         }
                        else{
                            $error="Si è verificato un errore, non riesco ad aprire il file di appoggio!";
					 echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Modifica utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
                        }
                    }
                    else{
                        $error="Password mancante!";
                       	 echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Modifica utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";

            }
                }		
				else {
					$error="Si è verificato un errore, non riesco ad aprire il file!";
					 echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Modifica utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
                }
            break;
            case 7://7 - Eliminazione EFFETTIVA NEL FILE
            //echo("ESITO <br/><br/><br/>");
            
            if(isset($_POST["id_utente"])){
            if ($handle = fopen("utenti.csv", "r")) 
            {
                     if (($newfile = fopen("new_utenti.csv", "w"))) 
                     {
                        $i=0;
                        while ($riga = fgetcsv($handle, 1000, ";")) 
                        {
                            if($i==$id_utente)
                            {
                                
                            }else{
                                $line = $riga[0] .';' . $riga[1].';'.$riga[2]."\n";
                                fwrite( $newfile, $line);
                            }
                            $i++;
                        }
                         $stat = fstat($newfile);
                        ftruncate($newfile, $stat['size']-1);
                        fclose($newfile); 
                         
                         $error="Utente eliminato correttamente.";
					 echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Cancellazione utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
                         
                     } else {
                        $error="Si è verificato un errore, non riesco ad aprire il file di appoggio!";
					 echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Cancellazione utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
                    }
                    fclose($handle);
                    unlink ("utenti.csv");
                    rename("new_utenti.csv","utenti.csv");
            }else {
					$error="Si è verificato un errore, non riesco ad aprire il file.";
					 echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Cancellazione utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
                }
            }else{
                $error="Si è verificato un errore, non so quale utente eliminare!";
					 echo " <main class='mdl-layout__content'><div class='mdl-card mdl-shadow--6dp'><div class='mdl-card__title mdl-color--primary mdl-color-text--white'><h2 class='mdl-card__title-text'>Cancellazione utente</h2></div><div class='mdl-card__supporting-text'><span class='mdl-layout-title' style='color:red;'>$error</span></div></div></main>";
            }
            break;
	}  
       if($stato!=1 && $stato!=7)
                 {
                     echo('</div></div>');
                 } 
    ?>
       </div>
             </form>
        </main>
        
      <a href="https://github.com/intradiegopa/crud-file" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white">Vedi i file sorgenti</a>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
          </div>
  </body>
</html>