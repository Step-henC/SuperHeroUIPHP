<?php 

require_once 'Superheromodel.php';


$id= "";
$name = "";
$firstName = "";
$lastName = "";
$place = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $firstName = $_POST["lastName"];
    $lastName = $_POST["lastName"];
    $place = $_POST["place"];


    do {
        if ( empty($id) || empty($name) || empty($firstName) || empty($lastName) || empty($place) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        function curl_create_content($url, $data)
        {
          $ch = curl_init($url);

          curl_setopt($ch, CURLOPT_URL, $url);
          //curl_setopt($ch, CURLOPT_HTTPHEADER, 
          //array(
        //     'Host: http://localhost/SuperHeroUI.PHP/createHero.php',
        //     'Content-Type: application/x-www-form-urlencoded',
        // ));
        curl_setopt($ch, CURLOPT_POST, true);
        if ($data)
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
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

        $hero = new SuperHero($id, $name, $firstName, $lastName, $place);


        $curlResult = curl_create_content('https://localhost:7046/api/SuperHero/', json_encode($hero));


        //check if query exe was successfull 
        if (!$curlResult) {
            $errorMessage = "Invalid query:";
        }

        //add new client to database
        $id = "";
        $name = "";
        $email = "";
        $phone = "";
        $address = "";

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
            <h2>New Hero</h2>


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
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Id</label>
                        <div class="clo-sm-6">  <!-- have to add an id for this db -->
                            <input type="text" class="form-control" name="id" value="<?php echo $id?>"> 
                        </div>
                </div>
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