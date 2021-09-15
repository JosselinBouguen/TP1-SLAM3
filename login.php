<?php
session_start();
?>

<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="login.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='submit'>
             <?php
                $cpt=0;
                if(isset($_POST["username"]) && isset($_POST["password"])){
                    $usr=$_POST["username"];
                    $_SESSION["usr"]=$usr;
                    $mdp=$_POST["password"];
                }
                try {
                    $dbh = new PDO('mysql:host=localhost;dbname=slam3-tp1','root', '');
                    foreach($dbh->query('SELECT login,mdp from user') as $row) {
                          if(isset($_POST["username"]) && isset($_POST["password"])){  
                            if($row['login']==$usr && $row['mdp']==$mdp){
                                echo 'Bonjour '.$usr."!";
                                header("Location: /connecter.php");
                                exit;
                            }elseif ($row['login']!=$usr) {
                               header("Location: /inscription.php");
                            }elseif ($row['mdp']!=$mdp) {
                               echo '<p style="color:red">Mot de passe incorect<p>';
                               exit;
                            }
                            $cpt++;
                            }
                    }
                    $dbh = null;
                    } catch (PDOException $e) {
                        print "Erreur !: " . $e->getMessage() . "<br/>";
                        die();
                }

    
               /* $bdd = new PDO('mysql:host=localhost;dbname=slam3-tp1', 'root', '');
                if($bdd!=null){
                    echo 'ok';*/
                
                ?>
            </form>
        
        </div>
    </body>
</html>