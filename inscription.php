<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="inscription.php" method="POST">
                <h1>Inscription</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required><br>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="pass" required><br>

                <label><b>Retapez le mot de passe </b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="passwordverif" required><br>

                <label><b>Adresse mail</b></label>
                <input type="email" placeholder="Entrer l'adresse mail" name="mail" required><br>

                <input type="submit" id='submit' value='Valider'>
                   </form>
             <?php
                

                if(isset($_POST["pass"]) && isset($_POST["passwordverif"])){
                	
                   if($_POST["pass"]==$_POST["passwordverif"]){
                   	
                   	$mdp=$_POST["pass"];
                   	$mail=$_POST['mail'];
                   	$usr=$_POST['username'];
                	
                	 try {
	                    $dbh = new PDO('mysql:host=localhost;dbname=slam-jb','root', '');
	                    if(($dbh->query("INSERT INTO user (login,mdp,date_crea,date_acti,id,email) VALUES ('".$usr."','".$mdp."',NOW(),'',NULL,'".$usr."')"))== true) {
	                    	header('Location: login.php');
	                    	echo "ok ";
	  
	                      	}
	                    else{
	                    	echo 'erreur!';
	                    	}
	                    $dbh = null;
	                      } 
	                    catch (PDOException $e) {
	                        print "Erreur !: " . $e->getMessage() . "<br/>";
	                        die();
                			}
                		}
                		else{
                			echo 'Mots de passes différents';
                		}
                	}	    
                ?>
        </div>
    </body>
</html>