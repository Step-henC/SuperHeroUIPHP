<?php 

require_once 'Superheromodel.php';


$id= 0; //db handles Id, we just need to save an integer
$name = "";
$firstName = "";
$lastName = "";
$place = "";

$errorMessage = "";
$successMessage = "";

if ( isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $place = $_POST["place"];



    do {
        if ( empty($name) || empty($firstName) || empty($lastName) || empty($place) ) {
            $errorMessage = "All the fields are required";
            break;
        }
// if(empty($_SERVER['CONTENT_TYPE']))
// { 
//   $_SERVER['CONTENT_TYPE'] = "application/x-www-form-urlencoded"; 
// }
      

        function curl_create_content($url, $data)
        {
          $ch = curl_init($url);

          echo $data;

        curl_setopt($ch, CURLOPT_URL, $url);
    
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "accept: text/plain",
            "Content-Type: application/json"
        ]);
        if ($data)
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

          $result = curl_exec($ch);
          $errors = curl_error($ch);
           if(!$result) {
            echo $errors;
         }
          curl_close($ch);
          return $result;
        }

        $hero = new SuperHero($id, $name, $firstName, $lastName, $place);

        

        $curlResult = curl_create_content("https://localhost:7046/api/SuperHero/add", json_encode($hero));


        //check if query exe was successfull 
        if (!$curlResult) {
            $errorMessage = "Invalid query: ";
        }

        //add new client to database
        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Client added correctly";

        // header("location: /SuperHeroUI.PHP/index.php");
        // exit;

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

            <form method="POST"> <!-- capitlizing Post made a difference -->
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
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                        <div class="col-sm-3 d-grid"> 
                            <a class="btn btn-outline-primary" href="/SuperHeroUI.PHP/index.php" role="button">Cancel</a>
                             </div> 

                </div>

            </form> <!-- action not really needed since form is submitted on same page -->

        </div>
  
        
      
    </body>
</html>