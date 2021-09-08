<?php
require_once('-include/-init.php');
require_once('-include/-header.php');
require_once('-include/nav2.php');
?>

<div class="container">
  <div class="row">
    <div class="col-md-5  block-form rounded">
      <div class="row  d-flex justify-content-center">
        <div class="col-md-10">
      
           
            <h3 class="text-white text-center mt-5">Bienvenue</h3>
            <p class="text-white text-center mt-3">Lorem ipsum dolor, sit amet consectetur 
              adipisicing elit. Aliquid, quasi ad porro praesentium
              temporibus officiis? Esse, aliquam ex assumenda labore aspernatur quia impedit rerum 
              itaque tempora aperiam. Cumque, porro sint!
            </p>
            <h2 class="mt-5 text-center text-white">Reservations</h2>
            
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <form action="" method="POST" id="form-reservation" class="mt-5 text-white">
  
        <input type="text" name="nom" class="form-control text-center rounded-pill" placeholder="NOM">
        <input type="text" name="email" class="form-control text-center  mt-4 rounded-pill" placeholder="EMAIL">
        <input type="text" name="tel" class="form-control text-center  mt-4 rounded-pill" placeholder="TEL">

        <div class="form-row">
            <input type="number" name="nbr_couvert" class=" mt-4 rounded-pill text-center col" placeholder="personnes">
            <div class="input-group col mt-4  text-center">
              <select class="custom-select rounded-pill" id="inputGroupSelect02" name="lieux">
                <option selected>Lieux</option>
                <option value="interieur">Interieur</option>
                <option value="exterieur">Exterieur</option>
              </select>
            </div>
            <?php if(isset($errorLieux)) echo $errorLieux; ?>
        </div>

        <div class="form-row">
            <input type="date" name="date_reservation" class="form-control rounded-pill mt-4 col">
              <div class="input-group col mt-4 text-center">
                <select id="" class="rounded-pill custom-select col" name="heure">
                      <option value="">heure</option>
                      <option value="12H">12H</option>
                      <option value="12H30">12H30</option>
                      <option value="13H">13H</option>
                      <option value="13H30">13H30</option>
                      <option value="14H">14H</option>
                      <option value="14H30">14H30</option>
                      <option value="">-------</option>
                      <option value="19H">19H</option>
                      <option value="19H30">19H30</option>
                      <option value="20H">20H</option>
                      <option value="20H30">20H30</option>
                      <option value="21H">21H</option>
                      <option value="21H30">21H30</option>
                      <option value="22H">22H</option>
                </select>
              </div>
              <?php if(isset($errorHeure)) echo $errorHeure; ?>
        </div>
        <input type="textarea" name="note" class="form-control text-center rounded-pill mt-4" placeholder="demande special">
        <button type="submit" class="rounded-pill mt-4 btn btn-dark btn-lg btn-block">envoyer</button>

            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
function active($url)
{
    if($_SERVER['PHP_SELF'] == $url)
    {
        echo ' active';
    }
     }   //echo $_SERVER['PHP_SELF'];
extract($_POST);
if($_POST){

  if(isset($lieux)){
    $errorLieux = "<p class='font-italic text-danger'>veuillez indiquer l'heure de la reservation</p>";// ici on stock un message d'erreur dans une variable mais a aucun moment ici on ne l'affiche (pas de echo)
    $error = true;
  }

  if(isset($heure)){
    $errorHeure = "<p class='font-italic text-danger'>veuillez indiquer le lieux de la reservation</p>";// ici on stock un message d'erreur dans une variable mais a aucun moment ici on ne l'affiche (pas de echo)
    $error = true;
  }
print_r($_POST);
  $date_enregistrement = Date("Y-m-d H:i:s");
  $status = 0;
  $insert = $bdd->prepare("INSERT INTO reservation (nom, email, tel, date_reservation, lieux, nbr_couvert, note, heure, date_enregistrement, status) VALUES (:nom, :email, :tel, :date_reservation, :lieux, :nbr_couvert, :note, :heure, :date_enregistrement, :status)");
        $insert->bindValue(':nom', $nom, PDO::PARAM_STR);
        $insert->bindValue(':email', $email, PDO::PARAM_STR);
        $insert->bindValue(':tel', $tel, PDO::PARAM_STR);
        $insert->bindValue(':date_reservation', $date_reservation, PDO::PARAM_STR);
        $insert->bindValue(':lieux', $lieux, PDO::PARAM_STR);
        $insert->bindValue(':nbr_couvert', $nbr_couvert, PDO::PARAM_INT);
        $insert->bindValue(':note', $note, PDO::PARAM_STR);
        $insert->bindValue(':heure', $heure, PDO::PARAM_STR);
        $insert->bindValue(':date_enregistrement', $date_enregistrement, PDO::PARAM_STR);
        $insert->bindValue(':status', $status, PDO::PARAM_INT);
        $insert->execute();
       //header("Location:Accueil.php?ajout=valid");
}
?>
<?php
require_once('-include/-footer.php');

?>