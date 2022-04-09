
<?php
$to_email = 'darshan.rathod1293@gmail.com';
$subject = "Expense Tracker ...";
$body = " Done ! youu are suucefully created account in expense tracker.....";
$headers = "From: darshan.rathod1293@gmail.com";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style type="text/css" > 
     .container {
        width: 400px;
        margin-left: 500px;
        margin-top: 100px;
        border: 5px;
        border-block-color: black;
        border-radius: 50px
    }



        </style>
</head>
<body  class="container">
<?php
if (mail($to_email, $subject, $body, $headers)) {
    echo '<div   class="alert alert-success" role="alert">
    <h4 class="alert-heading">Well done!</h4>
    <p>You are successfully created the account in the expense tracker </p>
    <hr>
    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
  </div>';
}
 else {
    echo "Email sending failed...";
}
?>
</body>
</html>