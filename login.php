<?php
session_start();
// Revisa si hay un mensaje de error en la URL
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
// Revisa si hay un mensaje de éxito en la URL
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';

// si el usuario ya creo una cuenta, lo rediroge a iniciar sesión
// si pulsa en already have an account lo redirige a iniciar sesión


// Determinar si se está en la acción de login
$islogin = !isset($_GET['action']) || $_GET['action'] == 'login';

// Incluir el archivo de configuración de Google
require_once './vendor/autoload.php';
require_once './config.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectURI);
$client->addScope("email");
$client->addScope("profile");

$client->setPrompt('select_account');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        <?php $islogin ? 'Login': 'Registro';?>
    </title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/registro.css?v=<?php echo time(); ?>" />
</head>

<body>
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>
                    <?php echo $islogin ? 'Login' : 'Registro';  ?>
                </span>
            </div>
            <!-- Mensaje de error  o mensaje de exito -->
            <?php if ($error || $success): ?>
            <div class="<?php echo $error ? 'error' : 'success'; ?>">
                <?php echo $error ? $error : $success; ?>
            </div>
            <?php endif; ?>

            <!-- Formulario de registro -->
            <form
                action="<?php echo $islogin ? './handlers/procesarFormulario.php' :  './handlers/procesarRegistro.php';?>"
                method="post">
                <div class="input_box">
                    <input type="text" name="username" id="user" class="input-field" required />
                    <label for="user" class="label">Username</label>
                    <i class="bx bx-user icon"></i>
                </div>
                <?php if (!$islogin): ?>
                <div class="input_box">
                    <input type="email" name="email" id="email" class="input-field" required />
                    <label for="email" class="label">Email</label>
                    <i class="bx bx-envelope icon"></i>
                </div>
                <?php endif; ?>
                <div class="input_box">
                    <input type="password" name="passwd" id="pass" class="input-field" required />
                    <label for="pass" class="label">Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <?php if (!$islogin): ?>
                <div class="input_box">
                    <input type="password" name="passwd_confirm" id="confirm_pass" class="input-field" required />
                    <label for="confirm_pass" class="label">Confirm Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <?php endif; ?>
                <div class="input_box">
                    <input type="submit" value="<?php echo $islogin ? 'Login' : 'Register'  ?>" class="input_submit" />
                </div>
            </form>
            <div class="input_box">
            <a href="<?php echo $client->createAuthUrl(); ?>" class="a_google">
            <button class="button">
                        <svg data-testid="geist-icon" height="16" stroke-linejoin="round" viewBox="0 0 16 16" width="16"
                            style="color: currentcolor;">
                            <path
                                d="M8.15991 6.54543V9.64362H12.4654C12.2763 10.64 11.709 11.4837 10.8581 12.0509L13.4544 14.0655C14.9671 12.6692 15.8399 10.6182 15.8399 8.18188C15.8399 7.61461 15.789 7.06911 15.6944 6.54552L8.15991 6.54543Z"
                                fill="#4285F4"></path>
                            <path
                                d="M3.6764 9.52268L3.09083 9.97093L1.01807 11.5855C2.33443 14.1963 5.03241 16 8.15966 16C10.3196 16 12.1305 15.2873 13.4542 14.0655L10.8578 12.0509C10.1451 12.5309 9.23598 12.8219 8.15966 12.8219C6.07967 12.8219 4.31245 11.4182 3.67967 9.5273L3.6764 9.52268Z"
                                fill="#34A853"></path>
                            <path
                                d="M1.01803 4.41455C0.472607 5.49087 0.159912 6.70543 0.159912 7.99995C0.159912 9.29447 0.472607 10.509 1.01803 11.5854C1.01803 11.5926 3.6799 9.51991 3.6799 9.51991C3.5199 9.03991 3.42532 8.53085 3.42532 7.99987C3.42532 7.46889 3.5199 6.95983 3.6799 6.47983L1.01803 4.41455Z"
                                fill="#FBBC05"></path>
                            <path
                                d="M8.15982 3.18545C9.33802 3.18545 10.3853 3.59271 11.2216 4.37818L13.5125 2.0873C12.1234 0.792777 10.3199 0 8.15982 0C5.03257 0 2.33443 1.79636 1.01807 4.41455L3.67985 6.48001C4.31254 4.58908 6.07983 3.18545 8.15982 3.18545Z"
                                fill="#EA4335"></path>
                        </svg>
                        <?php if($islogin):?>
                        <span>Sign in with Google</span>
                        <?php else: ?>
                        <span>Register with Google</span>
                        <?php endif; ?>
                    </button>
                </a>
            </div>

            <div class="login-footer">
                <?php if ($islogin): ?>
                <a href="?action=register">Create an account</a>
                <?php else: ?>
                <a href="?action=login">Already have an account?</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>