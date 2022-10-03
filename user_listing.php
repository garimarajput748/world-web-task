<?php
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="table-responsive container mt-5">
        <a type="button" class="btn btn-success float-end" href="index.php">Add New User</a>
        <h1>User Listing page :: </h1><hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User name</th>
                    <th>Firstname</th>
                    <th>Gender</th>
                    <th>Country</th>
                    <th>Address</th>
                    <th>Hobby</th>
                </tr>
            </thead>
            <tbody> <?php
                    $sql = "SELECT * FROM user_master";
                    $result = $conn->query($sql);
                    if (isset($result) && $result->num_rows > 0) {
                        // output data of each row
                        $count = 0;
                        while ($row = $result->fetch_assoc()) {
                            $gender_label = ($row['gender'] == "M") ? "Male" : "Female";
                            echo '<tr>
                                    <td>' . $count++ . '</td>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['firstname'] . '</td>
                                    <td>' . $gender_label . '</td>
                                    <td>' . $row['country'] . '</td>
                                    <td>' . $row['address'] . '</td>
                                    <td>' . implode(" ", json_decode($row['hobby'], true)) . '</td>
                                    </tr>';
                        }
                    } else {
                        echo "<tr><td>No record found </td></tr>";
                    }
                    ?> </tbody>
        </table>
</body>

</html>