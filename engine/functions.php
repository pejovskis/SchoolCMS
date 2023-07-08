<?php

//Display the user info to the Menu
function displayMainMenuUserInfo()
{

    $statusName = "";
    $status = "";

    switch ($_SESSION['status_level']) {
        case 1:
            $statusName = "Student Main Menu";
            $status = "Student";
            break;
        case 2:
            $statusName = "Teacher Main Menu";
            $status = "Teacher";
            break;
        case 9:
            $statusName = "Super User Main Menu";
            $status = "Super";
            break;
    }

    echo '<h1 class="bg-dark text-white p-3 rounded-5">' . $statusName . '</h1>' .
        '<h2> Logged in as: </h2>' .
        '<h3>' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '</h3> 
        <h4> - ' . $status  . ' - </h4>';
}

//Display the log out Button
function btnLogOut()
{
    if (isset($_POST['logout'])) {
        session_destroy();
        //redirect to log in menu
        echo '<script>alert(' . "User " . $_SESSION['name']  . " successfully logged out." . ')</script>';
        header('Location: ../../index.php');
        exit;
    }
}

//Back To Main Menu
function btnBackToMainMenu()
{

    $link = '../../index.php';

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        if ($_SESSION['status_level'] >= 1) {
            $link = '../sites/main-menu.php';
        }
    }

    echo '<a class="btn-cancel" href="' . $link . '">back</a>';
}

function deleteExerciseContent($exerciseId)
{
    require '../engine/db-conn-aufgabe.php';

    // Perform the delete operation
    $query = "DELETE FROM aufgabe WHERE id = " . $exerciseId;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $conn->close();
}

function btnDeleteExercise()
{
    require '../engine/db-conn-aufgabe.php';
    if (isset($_GET['id'])) {
        $exerciseId = $_GET['id'];

        // Fetch data for $row from the database
        $query = "SELECT * FROM aufgabe WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $exerciseId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($_SESSION['id'] === $row['added_by'] || $_SESSION['status_level'] > 2) {
                echo '<button class="btn-cancel" name="delete" type="submit" value="delete"> DELETE </button>';
            }
        }
    }
}

function addCategoryToDb()
{

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!empty($_POST['category'])) {
            $category = $_POST['category'];

            require 'db-conn-aufgabe.php';

            //insert new -kategorie- into the db
            $query = "INSERT INTO category (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $category);

            try {
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('New Category added successfully!')</script>";
                }
            } catch (Throwable $e) {
                echo "<script>alert('Error uploading the Category!')</script>";
            }
            mysqli_close($conn);
        } else {
            echo '<script>alert("No empty fields are allowed!.");</script>';
        }
    }
}

function addSubjectToDb()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Take 'fach' from the form
        if (!empty($_POST['fach'])) {
            $fach = $_POST['fach'];
            require 'db-conn-aufgabe.php';

            // Insert new 'fach' into the database
            $query = "INSERT INTO fach (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $fach);

            // Throw out alert status
            try {
                mysqli_stmt_execute($stmt);
                echo '<script>alert("Success!");</script>';
            } catch (Throwable $e) {
                echo '<script>alert("Failed.");</script>';
            }
            mysqli_close($conn);
        } else {
            echo '<script>alert("No empty fields are allowed!");</script>';
        }
    }
}

function addExerciseContentToDb()
{
    require '../engine/db-conn-aufgabe.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Process form submission
        $aufgabe_name = $_POST['aufgabe-name'];
        $beschreibung = $_POST['beschreibung'];
        $hinweis = $_POST['hinweis'];
        $fach = $_POST['fach'];
        $kategorie = $_POST['kategorie'];
        $new_kategorie = isset($_POST['new-kategorie']) ? $_POST['new-kategorie'] : null;
        $new_fach = isset($_POST['new-fach']) ? $_POST['new-fach'] : null;
        $current_date = date('Y-m-d');

        // Retrieve the file details
        $excercise_file_name = $_FILES['excercise-file']['name'];
        $excercise_file_tmp = $_FILES['excercise-file']['tmp_name'];

        if (!empty($excercise_file_tmp)) {
            $excercise_file_data = file_get_contents($excercise_file_tmp);
        } else {
            $excercise_file_data = null;
        }

        $current_userId = intval($_SESSION['id']);

        // If new category is selected, change the main variable $kategorie
        // because this one is inserted into the specific table in the database first and bound in the query later
        if ($new_kategorie) {
            $query = "INSERT INTO category (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $new_kategorie);
            mysqli_stmt_execute($stmt);
            $kategorie = $new_kategorie;
        }

        // Same for $fach as for $kategorie
        if ($new_fach) {
            $query = "INSERT INTO fach (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $new_fach);
            mysqli_stmt_execute($stmt);
            $fach = $new_fach;
        }

        try {
            // Insert the new exercise in the 'aufgabe' table
            $query = "INSERT INTO aufgabe (name, beschreibung, hinweis, fach, kategorie, add_date, added_by, pdf_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssssssss', $aufgabe_name, $beschreibung, $hinweis, $fach, $kategorie, $current_date, $current_userId, $excercise_file_data);

            // Set empty fields as NULL
            if (empty($aufgabe_name)) $aufgabe_name = NULL;
            if (empty($beschreibung)) $beschreibung = NULL;
            if (empty($hinweis)) $hinweis = NULL;
            if (empty($fach)) $fach = NULL;
            if (empty($kategorie)) $kategorie = NULL;

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('New exercise added successfully!')</script>";
            } else {
                echo "<script>alert('Error uploading the exercise')</script>";
            }
            mysqli_close($conn);
        } catch (Exception $e) {
            echo '<script>alert("Upload Failed!")</script>';
        }
    }
}


function pullCategoryFromDb(&$kategorieOptions)
{
    require 'db-conn-aufgabe.php';

    $query = "SELECT name FROM category";
    $result = mysqli_query($conn, $query);

    //Get -kategorie- from db and populate $kategorieOptions array
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $kategorieOptions[] = $row['name'];
        }
    }

    mysqli_close($conn);
}

function pullSubjectFromDb(&$fachOptions)
{
    require 'db-conn-aufgabe.php';

    $query = "SELECT name FROM fach";
    $result = mysqli_query($conn, $query);

    // Get -fach- from db and populate $fachOptions array
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $fachOptions[] = $row['name'];
        }
    }

    mysqli_close($conn);
}

function filterSubject()
{
    global $fachOptions;
    foreach ($fachOptions as $fachOption) :
        echo '<option value="' . $fachOption . '">' . $fachOption . '</option>';
    endforeach;
}

function filterCategory()
{
    global $kategorieOptions;
    foreach ($kategorieOptions as $kategorieOption) :
        echo '<option value="' . $kategorieOption . '">' . $kategorieOption . '</option>';
    endforeach;
}

//Pull subjects and categories from the database and populate the respective arrays
$fachOptions = [];
pullSubjectFromDb($fachOptions);

$kategorieOptions = [];
pullCategoryFromDb($kategorieOptions);

function checkUserLogin()
{
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        return true;
    } else {
        return false;
    }
}

function redirectLoggedUser()
{
    if (checkUserLogin()) {
        header("Location: ../sites/main-menu.php");
    }
}

//Check if authorized user is logged in
function redirectCheckUserLogIn()
{
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        //false- result:
        header('Location: unauthorized.php');
        exit;
    }
}

function redirectCheckSuperUserLogIn()
{
    //Check if authorized user is logged in
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['status_level'] != 9) {
        //failed results:
        header('Location: unauthorized.php');
        exit;
    }
}

function studentCheck()
{
    return ($_SESSION['$status_level'] === 1);
}

function teacherCheck()
{
    return ($_SESSION['status_level'] === 2);
}

//check super user logged in status function
function superCheck()
{
    return ($_SESSION['status_level'] === 9);
}

function displayExercises()
{

    require 'db-conn-aufgabe.php';

    //Fetch data from the database with filtering
    $query = "SELECT * FROM aufgabe WHERE 1=1";

    //Check -Fach- filter 
    if (!empty($_GET['fach'])) {
        $fach = $_GET['fach'];
        $query .= " AND fach = '$fach'";
    }

    //Check -Kategorie- filter
    if (!empty($_GET['kategorie'])) {
        $kategorie = $_GET['kategorie'];
        $query .= " AND kategorie = '$kategorie'";
    }

    $result = mysqli_query($conn, $query);

    //Check errors
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    //Generate html rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='table-row'>";
        echo "<th scope='row'>" . $row['id'] . "</th>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['beschreibung'] . "</td>";
        echo "<td>" . $row['hinweis'] . "</td>";
        echo "<td>" . $row['fach'] . "</td>";
        echo "<td>" . $row['kategorie'] . "</td>";
        echo "<td>" . $row['add_date'] . "</td>";
        $added_by = intval($row['added_by']);
        echo "<td>" . getName($added_by) . "</td>";
        echo "<td><a class='btn-confirm' href='../engine/download.php?id=" . $row['id'] . "'>Download</a></td>";
        if ($_SESSION['status_level'] === 9) {
            // Super Admin can edit all exercises
            echo "<td><a class='btn-cancel' href='../engine/edit.php?id=" . $row['id'] . "'>Edit</a></td>";
        } else if ($_SESSION['status_level'] === 2 && $_SESSION['id'] === $added_by) {
            // Admin can only edit their own exercises
            echo "<td><a class='btn-cancel' href='../engine/edit.php?id=" . $row['id'] . "'>Edit</a></td>";
        } else if ($_SESSION['status_level'] === 2 && $_SESSION['id'] != $added_by) {
            // Students do not have access to edit
            echo "<td> No Access </td>";
        } else {
            echo "</tr>";
        }
        
        
    }

    mysqli_close($conn);
}

function getName($added_by)
{
    require 'db-conn-userss.php';

    $first_name = '';
    $last_name = '';

    $query = 'SELECT first_name, last_name FROM userss where id="' . $added_by . '";';

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $first_name = strval($row['first_name']);
        $last_name = strval($row['last_name']);
        return $first_name . ' ' . $last_name;
    }
    return 'Unknown';
}

function exerciseFilter()
{

    include 'db-conn-aufgabe.php';

    //Fetch -Fach- options
    $fachOptionsQuery = "SELECT DISTINCT fach FROM aufgabe";
    $fachOptionsResult = mysqli_query($conn, $fachOptionsQuery);
    $fachOptions = array();
    while ($fachOption = mysqli_fetch_assoc($fachOptionsResult)) {
        $fachOptions[] = $fachOption['fach'];
    }

    // Fetch -Kategorie- 
    $kategorieOptionsQuery = "SELECT DISTINCT kategorie FROM aufgabe";
    $kategorieOptionsResult = mysqli_query($conn, $kategorieOptionsQuery);
    $kategorieOptions = array();
    while ($kategorieOption = mysqli_fetch_assoc($kategorieOptionsResult)) {
        $kategorieOptions[] = $kategorieOption['kategorie'];
    }
}

function userLogIn()
{

    require 'db-conn-userss.php';
    //Form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM userss WHERE email=?";

        //SQL Injection protect
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        //Query Successfull
        if ($result) {
            // Check User Exists
            if (mysqli_num_rows($result) == 1) {
                //Fetch User Data
                $row = mysqli_fetch_assoc($result);
                //Check if password correct and create the session array
                if (password_verify($password, $row['password'])) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['logged_in'] = true;
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['status_level'] = $row['status_level'];

                    header('Location: ../sites/main-menu.php');

                    exit;
                } else {
                    //Wrong password
                    echo '<script>alert("Invalid password")</script>';
                }
            } else {
                //User does not exist
                echo '<script>alert("User not found")</script>';
            }
        } else {
            //Query Error
            echo '<script>alert("Error executing query")</script>';
        }
    }
}

function addNewUser()
{
    require 'db-conn-userss.php';

    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['status-level'])) {
        // Retrieve form data
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $status_level = $_POST['status-level'];

        // Check for empty fields
        if (empty($email) || empty($password) || empty($first_name) || empty($last_name) || empty($status_level)) {
            echo '<script>alert("Please fill in all required fields.")</script>';
            exit;
        }

        // Check if a file was uploaded
        if (isset($_FILES['profile-image']) && $_FILES['profile-image']['error'] === UPLOAD_ERR_OK) {
            // Retrieve the file details
            $image_file_name = $_FILES['profile-image']['name'];
            $image_file_tmp = $_FILES['profile-image']['tmp_name'];
            $image_file_type = $_FILES['profile-image']['type'];

            // Read the file content
            $image_data = file_get_contents($image_file_tmp);

            // Insert the new user with the image data
            $query = "INSERT INTO userss (email, password, first_name, last_name, status_level, user_photo) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssb", $email, $password, $first_name, $last_name, $status_level, $image_data);

            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("New user registered successfully")</script>';
            } else {
                echo '<script>alert("Error registering new user")</script>';
            }
        } else {
            // Insert the new user without an image
            $query = "INSERT INTO userss (email, password, first_name, last_name, status_level) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $email, $password, $first_name, $last_name, $status_level);

            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("New user registered successfully")</script>';
            } else {
                echo '<script>alert("Error registering new user")</script>';
            }
        }
    } else {
        echo '<script>alert("Please fill all the fields!")</script>';
    }

    // Close the database connection
    mysqli_close($conn);
}




function btnAddExercise()
{
    echo '<a href="../sites/add-exercise.php" class="btn-menu" href="">Add Exercises</a>';
}

function btnAddUser()
{
    echo '<a href="../sites/register.php" class="btn-menu" href="../sites/register.php">Add User</a>';
}

function btnAddCategory()
{
    echo '<a href="../sites/add-category.php" class="btn-menu" href="../sites/add-category.php">Add Category</a>';
}

function btnAddSubject()
{
    echo '<a href="../sites/add-subject.php" class="btn-menu" href="../sites/add-fach.php">Add Subject</a>';
}

function inputAddSubject()
{
    echo '<div>
          <label for="new-fach">New Subject</label>
          <input name="new-fach" type="text"
            placeholder="Create New Subject">
        </div>';
}

function getExerciseDetails($exerciseId)
{
    require '../engine/db-conn-aufgabe.php';

    $query = "SELECT * FROM aufgabe WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $exerciseId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return null;
    }

    mysqli_close($conn);
}

function checkIfEditPosible($row)
{
    if ($_SESSION['id'] != $row['added_by'] && $_SESSION['status_level'] < 2) {
        header('Location: exercises.php');
    } else if ($_SESSION['id'] != $row['added_by']  && $_SESSION['status_level'] === 2) {
        header('Location: exercises.php');
    }
}

function displayNewSubjectField()
{
    echo '<label for="new-fach">New Subject</label>
          <input name="new-fach" type="text"
            placeholder="Create New Subject">';
}

function displayNewCategoryField()
{
    echo '<label for="new-category">New Category</label>
          <input name="new-category" type="text" class="form-control"
            placeholder="Create New Category">';
}
