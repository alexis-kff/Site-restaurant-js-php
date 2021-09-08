<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    

    

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    
   
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <?php
        require_once('../-include/-init.php');
        $result = $bdd->query("SELECT id, nom	,email ,tel	,lieux	,date_reservation	,nbr_couvert	,note	,heure ,date_enregistrement FROM reservation");
        echo '<p class="font-italic text-center">Nombre de reservation total : <strong class="badge badge-success bg-warning">' . $result->rowCount() . '</strong></p>';
        ?>
        
      </div>

      <h2>Réservation total</h2>
      <?php
      if(isset($_GET['action']) && $_GET['action'] == 'suppression')
      {
          $deleteResa = $bdd->prepare("DELETE FROM reservation WHERE id = :id");
          $deleteResa->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
          $deleteResa->execute();
      
          $validDelete = "<p class='col-md-2 mx-auto rounded bg-success text-white text-center p-2'>La réservation<strong>ID$_GET[id]</strong> a été supprimé avec succès !</p>";
      }

      if(isset($_GET['action']) && $_GET['action'] == 'confirm')
      {
          $infoClientForMail = $bdd->query("SELECT email, nom, date_reservation, heure, FROM reservation WHERE id = :id"); 
          //sendMail();
          $status = 1;
          $insert = $bdd->prepare("INSERT INTO reservation status VALUES :status WHERE id = :id");
          $insert->bindValue(':status', $status, PDO::PARAM_INT); 
          $insert->execute();
              
          $validSend = "<p class='col-md-2 mx-auto rounded bg-success text-white text-center p-2'>Un mail de comfirmation de réservation à <strong>$infoClientForMail[nom]</strong> le <strong>$infoClientForMail[date_reservation]</strong> à <strong>$infoClientForMail[heure]</strong> a été envoyé avec succès !</p>";
      }
        
        echo '<table class="table table-bordered text-center"><tr>';
        // La boucle FOR tourne autant de fois que l'on a selectionné de colonne via la requete SELECT (columnCount())
        for($i = 0; $i < $result->columnCount(); $i++)
        {
            // getColumnMeta($i) permet de recolter les méta données de chaque colonne (primary key, unique key, nom de la colonne etc...)
            // $colonne receptionne un ARRAY avec les informations d'une colonne par tour de boucle
            $colonne = $result->getColumnMeta($i);
            // echo '<pre>'; print_r($colonne); echo '</pre>';
        
            if($colonne['name'] == 'id')
                echo '<th>ID</th>';
            else
                echo "<th>" . strtoupper($colonne['name']) . "</th>"; // on stock le nom de chaque colonne dans des cellule <th> du tableau
        }
        echo '</tr>';
        // $membre receptionne un ARRAY avec les données d'1 membre par tour de boucle
        while($resa = $result->fetch(PDO::FETCH_ASSOC))
        {
            // echo '<pre>'; print_r($membre); echo '</pre>';
            echo '<tr>';
        
                foreach($resa as $key => $value)
                {
                    
                        echo "<td>$value</td>";
                    
                    
                }
                echo "<td><a href='?action=modification&id=$resa[id]' class='btn btn-dark'>Edit</a></td>";
                echo "<td><a href='?action=suppression&id=$resa[id]' class='btn btn-danger' onclick='return(confirm(\"En êtes vous certain ?\"))'>Supp</a></td>";
        
            echo '</tr>';
        }
        echo '</table>';

      ?>



      <h2>Réservation du jour</h2>
      <?php
      $today = date('Y-m-d');
      $resaDuJour = $bdd->query("SELECT id, nom	,email ,tel	,lieux	,date_reservation	,nbr_couvert	,note	,heure ,date_enregistrement FROM reservation WHERE date_reservation = '$today'");
      echo '<p class="font-italic text-center">Nombre de reservation total : <strong class="badge badge-success bg-warning">' . $resaDuJour->rowCount() . '</strong></p>';
      echo '<table class="table table-bordered text-center"><tr>';
       // La boucle FOR tourne autant de fois que l'on a selectionné de colonne via la requete SELECT (columnCount())
       for($i = 0; $i < $resaDuJour->columnCount(); $i++)
       {
           // getColumnMeta($i) permet de recolter les méta données de chaque colonne (primary key, unique key, nom de la colonne etc...)
           // $colonne receptionne un ARRAY avec les informations d'une colonne par tour de boucle
           $colonne = $resaDuJour->getColumnMeta($i);
           // echo '<pre>'; print_r($colonne); echo '</pre>';
       
           if($colonne['name'] == 'id')
               echo '<th>ID</th>';
           else
               echo "<th>" . strtoupper($colonne['name']) . "</th>"; // on stock le nom de chaque colonne dans des cellule <th> du tableau
       }
       echo '</tr>';
        while($r = $resaDuJour->fetch(PDO::FETCH_ASSOC))
        {

           // echo '<pre>'; print_r($r); echo '</pre>';
            echo '<tr>';
               if($r){
                foreach($r as $key => $value)
                {
                    
                        echo "<td>$value</td>";
                    
                    
                }
                echo "<td><a href='?action=confirm&id=$resa[id]' class='btn btn-dark'>COMFIRM</a></td>";
                echo "<td><a href='?action=suppression&id=$resa[id]' class='btn btn-danger' onclick='return(confirm(\"En êtes vous certain ?\"))'>Supp</a></td>";
        
            echo '</tr>';
              }else{
                echo "<p>Aucunne réservation ce jour</p>";
              }
        }
       echo '</table>';
      ?>

    

      <h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td>ipsum</td>
              <td>dolor</td>
              <td>sit</td>
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td>consectetur</td>
              <td>adipiscing</td>
              <td>elit</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td>nec</td>
              <td>odio</td>
              <td>Praesent</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>libero</td>
              <td>Sed</td>
              <td>cursus</td>
              <td>ante</td>
            </tr>
            <tr>
              <td>1,004</td>
              <td>dapibus</td>
              <td>diam</td>
              <td>Sed</td>
              <td>nisi</td>
            </tr>
            <tr>
              <td>1,005</td>
              <td>Nulla</td>
              <td>quis</td>
              <td>sem</td>
              <td>at</td>
            </tr>
            <tr>
              <td>1,006</td>
              <td>nibh</td>
              <td>elementum</td>
              <td>imperdiet</td>
              <td>Duis</td>
            </tr>
            <tr>
              <td>1,007</td>
              <td>sagittis</td>
              <td>ipsum</td>
              <td>Praesent</td>
              <td>mauris</td>
            </tr>
            <tr>
              <td>1,008</td>
              <td>Fusce</td>
              <td>nec</td>
              <td>tellus</td>
              <td>sed</td>
            </tr>
            <tr>
              <td>1,009</td>
              <td>augue</td>
              <td>semper</td>
              <td>porta</td>
              <td>Mauris</td>
            </tr>
            <tr>
              <td>1,010</td>
              <td>massa</td>
              <td>Vestibulum</td>
              <td>lacinia</td>
              <td>arcu</td>
            </tr>
            <tr>
              <td>1,011</td>
              <td>eget</td>
              <td>nulla</td>
              <td>Class</td>
              <td>aptent</td>
            </tr>
            <tr>
              <td>1,012</td>
              <td>taciti</td>
              <td>sociosqu</td>
              <td>ad</td>
              <td>litora</td>
            </tr>
            <tr>
              <td>1,013</td>
              <td>torquent</td>
              <td>per</td>
              <td>conubia</td>
              <td>nostra</td>
            </tr>
            <tr>
              <td>1,014</td>
              <td>per</td>
              <td>inceptos</td>
              <td>himenaeos</td>
              <td>Curabitur</td>
            </tr>
            <tr>
              <td>1,015</td>
              <td>sodales</td>
              <td>ligula</td>
              <td>in</td>
              <td>libero</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
