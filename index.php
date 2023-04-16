<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Super Heroes</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class='container my-5'>
            <h2>List of Super Heroes</h2>
             <a class="btn btn-primary" href="/SuperHeroUI.PHP/createHero.php" role="button">Add New Hero!</a>
             <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Place</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php 

function curl_get_contents($url)
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

$url = 'https://localhost:7046/api/SuperHero/';

$responses = curl_get_contents($url);
                    
                    
                    if(!$responses) {
                        echo "Sorry, could not get your heroes";
                    }

                    $heroes = json_decode($responses, true);
                    if (isset($heroes['error'])) {
                        echo "Error: " . $heroes['error'];
                    }
                    
                    foreach ($heroes as $hero) {

                        echo "
                        <tr>
                        <td>$hero[id]</td>
                        <td>$hero[name]</td>
                        <td>$hero[firstName]</td>
                        <td>$hero[lastName]</td>
                        <td>$hero[place]</td>
                        <td>
                        
                        <td>
                        <a class='btn btn-primary btn-sm' href='/SuperHeroUI.PHP/editHero.php?id=$hero[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/SuperHeroUI.PHP/deleteHero.php?id=$hero[id]'>Delete</a>
                    </td>
                </tr>
                        ";
                    }
                    ?>
                </tbody>
             </table>
        </div>
        
      
    </body>
</html>