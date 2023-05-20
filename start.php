<?php

?>


<!DOCTYPE <!DOCTYPE html>

<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css
">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <form action="login.php" method="POST"> <!-- capitlizing Post made a difference -->
            <h2>Login</h2>
            <?php if(isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET['error']; ?></p>
          <?php  } ?>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">User Name</label>
                        <div class="clo-sm-6">  
                            <input type="text" class="form-control" placeholder="User Name" name="uname"> 
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Password</label>
                        <div class="clo-sm-6">  
                            <input type="password" class="form-control" name="password" placeholder="Password"> 
                        </div>
                </div>
               
                
                </div>
                <button type="submit">Submit</button>
    </form>
        
        <script src="" async defer></script>
    </body>
</html>