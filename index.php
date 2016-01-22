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
        <form  method = "get" action="index.php" role="form">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="InputName">Enter ID</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="ID" id="ID" placeholder="ID" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="InputEmail">Enter Marque</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="marque" name="marque" placeholder="marque" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="InputEmail">Enter modele</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="modele" name="modele" placeholder="modele" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                
                
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
            </div>
        </form>
        <div class="col-lg-5 col-md-push-1">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <strong><span class="glyphicon glyphicon-ok"></span> Success! Message sent.</strong>
                </div>
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-remove"></span><strong> Error! Please check all page inputs.</strong>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Registration form - END -->

<script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php
//-------- RECUPERATION 1 ---------

//1) Verifier si le bouton submit est initialiser
if (isset($_REQUEST['submit']))
{
        $IDauto=        $_REQUEST ['ID'];
        $marque=    $_REQUEST ['marque'];
        $modele=    $_REQUEST ['modele'];


//2) Connexion a la base de donnees ( inscrire le nom User, le mot de passe User et l'adresse)
$conn=oci_connect("auto","deftones","127.0.0.1/XE");
if(!$conn)
{  
    echo "Echec de Connexion";
} 

    if (!empty($IDauto))
        {
//3) Requete d'insertion 
    $insertion=oci_parse($conn,"insert into auto (IDauto,marque,modele) values ('$IDauto','$marque','$modele')");
    
//4) Execution de la Requete d'insertion  
    oci_execute($insertion);  
    oci_commit($conn); 
    
//5)Analyse ou affiche des resultats  
    $enreg=oci_num_rows($insertion);
    if ($enreg >0)  
    {   
        echo  $enreg." Insertion Effectuee";
    }  
    else  
    {   
        echo "Insertion effectuee";  
    }
        }
    else
        {
        echo "Veuillez remplir le champs ID";
        }
        
    
    //6) Fermeture de la connexion  
    oci_close($conn); 
}
?> 
