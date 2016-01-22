<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Ajout</a>
                    </li>
                    <li>
                        <a href="update.php">Update</a>
                    </li>
                    <li>
                        <a href="delete.php">Delete</a>
                    </li>
                    <li>
                        <a href="select.php">Select</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<!-- Registration form - START -->
<div class="container">
    <div class="row">
    
            <div class="col-lg-6">
                <div class="form-group">
                    <form>
                    <select name="choix">
                        <?php
//1) Connexion a oracle
$conn=oci_connect("auto","deftones","127.0.0.1/XE");
$select=oci_parse($conn, "select IDAUTO from auto");
oci_execute($select);

$nbrows=oci_fetch_all($select, $resultats);
for($i =0 ; $i < $nbrows ; $i++)
    {
    $IDauto = $resultats['IDAUTO'] [$i];
    echo "<option value = '$IDauto'>$IDauto</option>";
}
oci_close($conn);
?>
                    </select>
                    <input type="submit" name="valid" id="valid" value="VALID" class="btn btn-info pull-right">
                    </form>
                    
    </div>
</div>
<!-- Registration form - END -->

</div>
    </div>
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>
</html>

<?php

if (isset($_REQUEST['valid']))
    {
    $choix = $_REQUEST['choix'];
    //2) Connexion avec oracle
$conn=oci_connect("auto","deftones","127.0.0.1/XE");
    //3) Requete SQL
    $update = oci_parse ($conn, "Select * from auto WHERE IDauto = '$choix'");
    //4) Execution de la requete
    oci_execute($update);
    //5) Analyse et affichage des resultats
    $nbrows = oci_fetch_all($update, $resultats);
    echo "<form>";
    for($i=0; $i < $nbrows; $i++)
        {
        // Champ IDAUTO doit etre en MAJUSCULE
        $IDauto = $resultats['IDAUTO'] [$i];
        $marque = $resultats['MARQUE'] [$i];
        $modele = $resultats['MODELE'] [$i];
        
        echo "<div class='col-lg-6'>";        
        echo "<div class='form-group'>";
        echo  "<div class='input-group'>";
        echo "<input class='form-control' type='text' name='ID' value='$IDauto'>";
        echo "<input class='form-control' type='text' name='marque' value='$marque'>";
        echo "<input class='form-control' type='text' name='modele' value='$modele'>";
        echo "</div>";
        echo "</div>";

        
        }
    echo "<button type='submit' name='ok' value='ok' class='btn btn-info pull-right'>g</button></form>";
    echo "</div>";
}

// Recuperation des donnees pour UPDATE
if(isset($_REQUEST["ok"]))
    {
    $conn=oci_connect("auto","deftones","127.0.0.1/XE");
    //1) Recuperation
    $IDauto=    $_REQUEST ['ID'];
    $marque=    $_REQUEST ['marque'];
    $modele=    $_REQUEST ['modele'];
    
    // Requete SQL UPDATE
    $miseajour = oci_parse($conn,"UPDATE AUTO SET marque='$marque',modele='$modele' WHERE IDauto='$IDauto'");
    
    // Execution de la requete update
    oci_execute($miseajour);  
    oci_commit($conn); 
    
//5)Analyse ou affiche des resultats  
    $rows=oci_num_rows($miseajour);
    if ($rows >0)  
    {   
        echo  $rows." update Effectuee";
    }  
    else  
    {   
        echo "Echec update";  
    }

    //6) Fermeture de la connexion  
    oci_close($conn); 
}
?> 
