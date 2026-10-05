<?php

$servidores = [
    "apache"   => "Apache",
    "nginx"    => "Nginx",
    "iis"      => "IIS",
    "tomcat"   => "Tomcat"
];
$roles = [
    "admin"    => "Admin",
    "engineer" => "Engineer",
    "manager"  => "Manager",
    "guest"    => "Guest"
];
$servicios = [
    "mail"        => "Mail",
    "payroll"     => "Payroll",
    "selfservice" => "Self-service"
];

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username = $password = $city = $role = "";
$server = "apache";
$sso = [];
$usernameErr = $passwordErr = $cityErr = $serverErr = $roleErr = $ssoErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    $username = test_input($_POST["username"] ?? "");
    if ($username === "") {
        $usernameErr = "Username is required";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $usernameErr = "Only letters, numbers and underscores allowed";
    }

    $password = test_input($_POST["password"] ?? "");
    if ($password === "") {
        $passwordErr = "Password is required";
    }

    $city = test_input($_POST["city"] ?? "");
    if ($city !== "" && !preg_match("/^[\p{L} ]+$/u", $city)) {
        $cityErr = "Only letters and white space allowed";
    }

   
    $server = test_input($_POST["server"] ?? "");
    if (!isset($servidores[$server])) {
        $serverErr = "Select a valid web server";
    }


    $role = test_input($_POST["role"] ?? "");
    if ($role !== "" && !isset($roles[$role])) {
        $roleErr = "That role does not exist";
        $role = "";
    }


    if (isset($_POST["sso"]) && is_array($_POST["sso"])) {
        foreach ($_POST["sso"] as $valor) {
            $valor = test_input($valor);
            if (isset($servicios[$valor])) {
                $sso[] = $valor;
            } else {
                $ssoErr = "Invalid option selected";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novell Services Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4" style="max-width: 540px;">
    <h2>Novell Services Login</h2>
    <p><span class="text-danger">* required field</span></p>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="mb-3">
            <label for="username" class="form-label">Username: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="username" name="username"
                   placeholder="Enter username" value="<?php echo $username; ?>">
            <span class="text-danger"><?php echo $usernameErr; ?></span>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password: <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="Enter password" value="<?php echo $password; ?>">
            <span class="text-danger"><?php echo $passwordErr; ?></span>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City of employment:</label>
            <input type="text" class="form-control" id="city" name="city"
                   placeholder="Enter city" value="<?php echo $city; ?>">
            <span class="text-danger"><?php echo $cityErr; ?></span>
        </div>

        <div class="mb-3">
            <label for="server" class="form-label">Web Server:</label>
            <select class="form-select" id="server" name="server">
                <?php foreach ($servidores as $valor => $texto) { ?>
                    <option value="<?php echo $valor; ?>" <?php if ($server === $valor) echo "selected"; ?>><?php echo $texto; ?></option>
                <?php } ?>
            </select>
            <span class="text-danger"><?php echo $serverErr; ?></span>
        </div>

        <div class="mb-3">
            <p class="mb-1">Please specify your role:</p>
            <?php foreach ($roles as $valor => $texto) { ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="role-<?php echo $valor; ?>" name="role"
                           value="<?php echo $valor; ?>" <?php if ($role === $valor) echo "checked"; ?>>
                    <label class="form-check-label" for="role-<?php echo $valor; ?>"><?php echo $texto; ?></label>
                </div>
            <?php } ?>
            <span class="text-danger"><?php echo $roleErr; ?></span>
        </div>

        <div class="mb-3">
            <p class="mb-1">Single Sign-on to the following:</p>
            <?php foreach ($servicios as $valor => $texto) { ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sso-<?php echo $valor; ?>" name="sso[]"
                           value="<?php echo $valor; ?>" <?php if (in_array($valor, $sso)) echo "checked"; ?>>
                    <label class="form-check-label" for="sso-<?php echo $valor; ?>"><?php echo $texto; ?></label>
                </div>
            <?php } ?>
            <span class="text-danger"><?php echo $ssoErr; ?></span>
        </div>

        <button type="submit" class="btn btn-primary mb-4">Submit</button>
    </form>
</div>
</body>
</html>