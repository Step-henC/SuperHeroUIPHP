<?php 


require_once 'Superheromodel.php';

$id = "";
$name = "";
$firstName = "";
$lastName = "";
$place = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {

    if(!isset($_GET["id"])) {
        header("location: /SuperHeroUI.PHP/index.php");
        exit;
    }

    $id = $_GET["id"];

function curl_get_content($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

//Get is the default action. Other curl_opts need CURLOPT_POST

$url = "https://localhost:7046/api/SuperHero/$id";

$row = curl_get_content($url);
    if(!$row) {
        header("location: /SuperHeroUI.PHP/index.php");
        exit;
    }
$temporaryHero = json_decode($row, true);

     $id= $temporaryHero["id"];
     $name = $temporaryHero["name"];
     $firstName = $temporaryHero["firstName"];
     $lastName = $temporaryHero["lastName"];
     $place = $temporaryHero["place"];
}
else {

    // Update Data of client with POST method
    $id = $_POST["id"];
    $name = $_POST["name"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $place = $_POST["place"];


    function curl_set_content($url, $data)
    {
      $ch = curl_init($url);

      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      if ($data)
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    //   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      
      $result = curl_exec($ch);

      if(!$result) {
        echo("Connection failure!");
    }
      curl_close($ch);
      return $result;
    }

    do {


        if ( empty($name) || empty($firstName) || empty($lastName) || empty($place) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        $hero = new SuperHero($id, $name, $firstName, $lastName, $place);

    
        $result = curl_set_content("https://localhost:7046/api/SuperHero/", json_encode($hero));

            echo $result;
        //check if query exe was successfull 
        if (!$result) {
            $errorMessage = "Invalid query: ";
        }

        $successMessage = "Client added correctly";

        header("location: /SuperHeroUI.PHP/index.php");
        exit;

    } while (false);


}



?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>My Shop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css
">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container my-5">
            <h2>Manage Client</h2>


            <?php 
            if ( !empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'> 
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                
                ";
            }
            
            ?>


<form method="post">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                        <div class="clo-sm-6">  
                            <input type="text" class="form-control" name="name" value="<?php echo $name?>"> 
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">First Name</label>
                        <div class="clo-sm-6">  
                            <input type="text" class="form-control" name="firstName" value="<?php echo $firstName?>"> 
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Last Name</label>
                        <div class="clo-sm-6">  
                            <input type="text" class="form-control" name="lastName" value="<?php echo $lastName?>"> 
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Place</label>
                        <div class="clo-sm-6">  
                            <input type="text" class="form-control" name="place" value="<?php echo $place?>"> 
                        </div>
                </div>


                <?php
                   if ( !empty($successMessage)) {
                    echo "
                    <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'> 
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>
                    </div>
                    ";
                }
                ?>


                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                        <div class="col-sm-3 d-grid"> 
                            <a class="btn btn-outline-primary" href="/SuperHeroUI.PHP/index.php" role="button">Cancel</a>
                             </div> 

                </div>

            </form> <!-- action not really needed since form is submitted on same page -->
            </div>
  </body>
</html>