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
    
        <form  method = "get" action="select.php" role="form">
            <div class="col-lg-6">
                
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

$conn=oci_connect("auto","deftones","127.0.0.1/XE");
    //3) Requete SQL
    $select = oci_parse ($conn, "Select * from auto");
    //4) Execution de la requete
    oci_execute($select);
    //5) Analyse et affichage des resultats
    $nbrows = oci_fetch_all($select, $resultats);

    for($i=0; $i < $nbrows; $i++)
        {
        // Champ IDAUTO doit etre en MAJUSCULE
        $IDauto = $resultats['IDAUTO'] [$i];
        $marque = $resultats['MARQUE'] [$i];
        $modele = $resultats['MODELE'] [$i];
        
        
        
        echo $IDauto." ".$marque." ".$modele."</br>";

        }  
    oci_close($conn); 
?> 
