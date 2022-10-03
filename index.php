<?php

$submit = false;
if(isset($_GET['message'])) $message = $_GET['message'];
if (isset($_POST['submit_form']) && $_POST['submit_form'] === "save") {

    $username = $firstname = $gender = $country = $address = $hobby = '';
    $submit = true;
    if (!empty($_POST['username']))  $username = $_POST['username'];
    if (!empty($_POST['firstname'])) $firstname = $_POST['firstname'];
    if (!empty($_POST['gender']))    $gender   = $_POST['gender'];
    if (!empty($_POST['country']))   $country  = $_POST['country'];
    if (!empty($_POST['address']))   $address  = $_POST['address'];
    if (!empty($_POST['hobby']))     $hobby    = $_POST['hobby'];
    if (!(empty($username) || empty($firstname) ||  empty($gender)  || empty($country) ||  empty($address) ||  empty($hobby))) {
        require_once("db.php");
        
        $hobby  = json_encode($hobby);
        $sql = "INSERT INTO `user_master` ( `username`, `firstname`, `address`, `gender`, `hobby`, `country`) VALUES ('$username', '$firstname','$address', '$gender','$hobby', '$country');";
        if ($conn->query($sql) === TRUE) {
            $message =  "New record created successfully";
            header("Location: index.php?message =$message ");

        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add New User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h4 class="mt-5">Add User:</h4>
        <?php if (isset($message)) {
            echo '<div class="alert">
                        <strong>' . $message . '</strong>
                    </div>';
        }
        ?>

        <form action="" method="POST">
            <div class="mb-3 mt-3">
                <label for="UserName" class="form-label">User Name:</label>
                <input type="text" class="form-control" placeholder="Enter UserName" name="username" value="<?php if (($submit) && !empty($username)) echo $username; ?>">
                <?php if (($submit) && empty($username)) echo '<span class="text-danger">Field is required</span>'; ?>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text" class="form-control" placeholder="Enter Firstname" name="firstname" value="<?php if (($submit) && !empty($firstname)) echo $firstname; ?>">
                <?php if (($submit) && empty($firstname)) echo '<span class="text-danger">Field is required</span>'; ?>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" placeholder="Enter Address" name="address"><?php if (($submit) && !empty($address)) echo $address; ?></textarea>
                <?php if (($submit) && empty($address)) echo '<span class="text-danger">Field is required</span>'; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender:</label>
                <label class="form-label">
                    <input type="radio" name="gender" value="M" <?php if (($submit) && !empty($gender) && $gender == "M") echo 'checked'; ?>>
                    Male
                </label>
                <label class="form-label ">
                    <input type="radio" name="gender" value="F" <?php if (($submit) && !empty($gender) && $gender == "F") echo 'checked'; ?>>
                    Female
                </label>
                <?php if (($submit) && empty($gender)) echo '<span class="text-danger">Field is required</span>'; ?>
            </div>
            <div class="mb-3">
                <select class="form-select" name="country">
                    <option <?php if (($submit) && !empty($country) && $country == "") echo 'selected'; ?> value="">Select Country</option>
                    <option <?php if (($submit) && !empty($country) && $country == "IN") echo 'selected'; ?> value="IN">India</option>
                    <option <?php if (($submit) && !empty($country) && $country == "USA") echo 'selected'; ?> value="USA">United State of America </option>
                    <option <?php if (($submit) && !empty($country) && $country == "UK") echo 'selected'; ?> value="UK">United Kingdom </option>
                    <option <?php if (($submit) && !empty($country) && $country == "SA") echo 'selected'; ?> value="SA">South Africa</option>
                </select>
                <?php if (($submit) && empty($country)) echo '<span class="text-danger">Field is required</span>'; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Hobbies:</label>
                <label class="form-label">
                    <input type="checkbox" name="hobby[]" value="Cricket" <?php if (($submit) && !empty($hobby[0])) echo "checked"; ?>>
                    Cricket
                </label>
                <label class="form-label ">
                    <input type="checkbox" name="hobby[]" value="Chess" <?php if (($submit) && !empty($hobby[1])) echo "checked"; ?>>
                    Chess
                </label>
                <label class="form-label ">
                    <input type="checkbox" name="hobby[]" value="Football" <?php if (($submit) && !empty($hobby[2])) echo "checked"; ?>>
                    Football
                </label>
                <label class="form-label ">
                    <input type="checkbox" name="hobby[]" value="Music" <?php if (($submit) && !empty($hobby[3])) echo "checked"; ?>>
                    Music
                </label>
                <?php if (($submit) && empty($hobby)) echo '<span class="text-danger">Field is required</span>'; ?>
            </div>
            <button type="submit" class="btn btn-primary" name="submit_form" value="save">Submit</button>
            <a type="button" class="btn btn-success" href="user_listing.php">View Users</a>
        </form>
    </div>
</body>

</html>