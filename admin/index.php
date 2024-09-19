<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="giris.css">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>
<body class="bg" >
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!------ Include the above in your HEAD tag ---------->

<!--sss
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
<div class="container">
	<div class="card card-container">
		<!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
        <h4 style="color:#307353;">Yönetici Bilgilerinizi Giriniz</h4>
        <?php $sifredurum=$_GET['sifre'];
        if ($sifredurum=='no'){
            echo'<div><h5 style="color:red;">Kullanıcı Bilgilerinizi Kontrol Ediniz..</h5></div>';
        }
        if (isset($_GET['dogrulama'])){
            echo '<div><h5 style="color:red;">Google Doğrulaması Boş Bırakılamaz..</h5></div>';
        }
        ?>

		<p id="profile-name" class="profile-name-card"></p>
		<form class="form-signin" action="admin/islem/islem.php" method="POST">
			<span id="reauth-email" class="reauth-email"></span>
			<input type="text" id="inputEmail" class="form-control" placeholder="Kullanıcı Adı" name="admin_adi" required autofocus>
			<input type="password" id="inputPassword" class="form-control" placeholder="Şifre" name="admin_sifre" required>
			<input type="email" id="inputPassword" class="form-control" placeholder="Mail Adresiniz" >
			<input type="date" id="inputPassword" class="form-control" placeholder="Şifre" ><br>
            <div class="g-recaptcha " data-sitekey="6Lf5QtsUAAAAAIU5wRvdwlpo7lr7dRFtkx7UJ5Qp"></div>
            <style>
                iframe{
                    width: 270px!important;
                }
            </style>
			<button class="btn btn-lg btn-primary btn-block btn-signin" name="giris" type="submit">Giriş</button>
		</form><!-- /form -->
	</div><!-- /card-container -->
</div><!-- /container -->
</body>

<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
</html>