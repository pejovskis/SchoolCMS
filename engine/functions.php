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
        echo '<script>window.location.href = "../../index.php";</script>';
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
    require '../engine/db-conn-exercises.php';

    // Perform the delete operation
    $query = "DELETE FROM exercise WHERE id = " . $exerciseId;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $conn->close();
}

function btnDeleteExercise()
{
    require '../engine/db-conn-exercises.php';
    if (isset($_GET['id'])) {
        $exerciseId = $_GET['id'];

        // Fetch data for $row from the database
        $query = "SELECT * FROM exercise WHERE id = ?";
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

            require 'db-conn-exercises.php';

            //insert new -category- into the db
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
        // Take 'subject' from the form
        if (!empty($_POST['subject'])) {
            $subject = $_POST['subject'];
            require 'db-conn-exercises.php';

            // Insert new 'subject' into the database
            $query = "INSERT INTO subject (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $subject);

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
    require '../engine/db-conn-exercises.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Process form submission
        $exercise_name = $_POST['exercise-name'];
        $description = $_POST['description'];
        $hint = $_POST['hint'];
        $subject = $_POST['subject'];
        $category = $_POST['category'];
        $new_category = isset($_POST['new-category']) ? $_POST['new-category'] : null;
        $new_subject = isset($_POST['new-subject']) ? $_POST['new-subject'] : null;
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

        // If new category is selected, change the main variable $category
        // because this one is inserted into the specific table in the database first and bound in the query later
        if ($new_category) {
            $query = "INSERT INTO category (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $new_category);
            mysqli_stmt_execute($stmt);
            $category = $new_category;
        }

        // Same for $subject as for $category
        if ($new_subject) {
            $query = "INSERT INTO subject (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $new_subject);
            mysqli_stmt_execute($stmt);
            $subject = $new_subject;
        }

        try {
            // Insert the new exercise in the 'exercise' table
            $query = "INSERT INTO exercise (name, description, hint, subject, category, add_date, added_by, pdf_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssssssss', $exercise_name, $description, $hint, $subject, $category, $current_date, $current_userId, $excercise_file_data);

            // Set empty fields as NULL
            if (empty($exercise_name)) $exercise_name = NULL;
            if (empty($description)) $description = NULL;
            if (empty($hint)) $hint = NULL;
            if (empty($subject)) $subject = NULL;
            if (empty($category)) $category = NULL;

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


function pullCategoryFromDb(&$categoryOptions)
{
    require 'db-conn-exercises.php';

    $query = "SELECT name FROM category";
    $result = mysqli_query($conn, $query);

    //Get -category- from db and populate $categoryOptions array
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categoryOptions[] = $row['name'];
        }
    }

    mysqli_close($conn);
}

function pullSubjectFromDb(&$subjectOptions)
{
    require 'db-conn-exercises.php';

    $query = "SELECT name FROM subject";
    $result = mysqli_query($conn, $query);

    // Get -subject- from db and populate $subjectOptions array
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $subjectOptions[] = $row['name'];
        }
    }

    mysqli_close($conn);
}

function filterSubject()
{
    global $subjectOptions;
    foreach ($subjectOptions as $subjectOption) :
        echo '<option value="' . $subjectOption . '">' . $subjectOption . '</option>';
    endforeach;
}

function filterCategory()
{
    global $categoryOptions;
    foreach ($categoryOptions as $categoryOption) :
        echo '<option value="' . $categoryOption . '">' . $categoryOption . '</option>';
    endforeach;
}

//Pull subjects and categories from the database and populate the respective arrays
$subjectOptions = [];
pullSubjectFromDb($subjectOptions);

$categoryOptions = [];
pullCategoryFromDb($categoryOptions);

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
        echo '<script>window.location.href = "../sites/main-menu.php";</script>';
    }
}

//Check if authorized user is logged in
function redirectCheckUserLogIn()
{
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        //false- result:
        echo '<script>window.location.href = "unauthorized.php";</script>';
        exit;
    }
}

function redirectCheckSuperUserLogIn()
{
    //Check if authorized user is logged in
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['status_level'] != 9) {
        //failed results:
        echo '<script>window.location.href = "unauthorized.php";</script>';
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
    require 'db-conn-exercises.php';

    $query = "SELECT * FROM exercise WHERE 1=1";

    if (!empty($_GET['subject'])) {
        $subject = $_GET['subject'];
        $query .= " AND subject = '$subject'";
    }

    if (!empty($_GET['category'])) {
        $category = $_GET['category'];
        $query .= " AND category = '$category'";
    }

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $isMobile = false;

    // Check if the user agent is a mobile device
    if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android/i', $_SERVER['HTTP_USER_AGENT'])) {
        $isMobile = true;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='table-row'>";
        
        if (!$isMobile) {
            echo "<th scope='row'>" . $row['id'] . "</th>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['hint'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['add_date'] . "</td>";
            $added_by = intval($row['added_by']);
            echo "<td>" . getName($added_by) . "</td>";
            echo "<td><a class='btn-confirm' href='../engine/download.php?id=" . $row['id'] . "'>Download</a></td>";
        }
        
        if ($_SESSION['status_level'] === 9 || ($_SESSION['status_level'] === 2 && $_SESSION['id'] === $added_by)) {
            echo "<td><a class='btn-cancel' href='../engine/edit.php?id=" . $row['id'] . "'>Edit</a></td>";
        } else if ($_SESSION['status_level'] === 2 && $_SESSION['id'] != $added_by) {
            echo "<td>No Access</td>";
        }
        
        if ($isMobile) {
            echo "<td>Exercise id: " . $row['id'] . "</td>";
            echo "<td>Name: " . $row['name'] . "</td>";
            echo "<td>description: " . $row['description'] . "</td>";
            echo "<td>hint: " . $row['hint'] . "</td>";
            echo "<td>subject: " . $row['subject'] . "</td>";
            echo "<td>category: " . $row['category'] . "</td>";
            echo "<td>Datum: " . $row['add_date'] . "</td>";
            $added_by = intval($row['added_by']);
            echo "<td>Added From: " . getName($added_by) . "</td>";
            echo "<td><a class='btn-confirm' href='../engine/download.php?id=" . $row['id'] . "'>Download</a></td>";
        }
        
        echo "</tr>";
    }

    mysqli_close($conn);
}



function getName($added_by)
{
    require 'db-conn-users.php';

    $first_name = '';
    $last_name = '';

    $query = 'SELECT first_name, last_name FROM user where id="' . $added_by . '";';

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

    include 'db-conn-exercises.php';

    //Fetch -subject- options
    $subjectOptionsQuery = "SELECT DISTINCT subject FROM exercise";
    $subjectOptionsResult = mysqli_query($conn, $subjectOptionsQuery);
    $subjectOptions = array();
    while ($subjectOption = mysqli_fetch_assoc($subjectOptionsResult)) {
        $subjectOptions[] = $subjectOption['subject'];
    }

    // Fetch -category- 
    $categoryOptionsQuery = "SELECT DISTINCT category FROM exercise";
    $categoryOptionsResult = mysqli_query($conn, $categoryOptionsQuery);
    $categoryOptions = array();
    while ($categoryOption = mysqli_fetch_assoc($categoryOptionsResult)) {
        $categoryOptions[] = $categoryOption['category'];
    }
}

function userLogIn()
{

    require 'db-conn-users.php';
    //Form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM user WHERE email=?";

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

                    echo '<script>window.location.href = "../sites/main-menu.php";</script>';

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
    require 'db-conn-users.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the form is submitted

        if (isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['first-name']) &&
            isset($_POST['last-name']) &&
            isset($_POST['status-level'])) {
            
            // Form fields are set, proceed with the validation
            
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];
            $status_level = $_POST['status-level'];

            // Check for empty fields
            if (empty($email) || empty($password) || empty($first_name) || empty($last_name) || empty($status_level)) {
                echo '<script>alert("Please fill in all required fields.")</script>';
            } else {
                // Insert the new user in -users- sql
                $query = "INSERT INTO user (email, password, first_name, last_name, status_level) VALUES (?, ?, ?, ?, ?)";
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
    }

    // Close the db connection
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
    echo '<a href="../sites/add-subject.php" class="btn-menu" href="../sites/add-subject.php">Add Subject</a>';
}

function inputAddSubject()
{
    echo '<div>
          <label for="new-subject">New Subject</label>
          <input name="new-subject" type="text"
            placeholder="Create New Subject">
        </div>';
}

function getExerciseDetails($exerciseId)
{
    require '../engine/db-conn-exercises.php';

    $query = "SELECT * FROM exercise WHERE id = ?";
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
        echo '<script>window.location.href = "exercises.php";</script>';
    } else if ($_SESSION['id'] != $row['added_by']  && $_SESSION['status_level'] === 2) {
        echo '<script>window.location.href = "exercises.php";</script>';
    }
}

function displayNewSubjectField()
{
    echo '<label for="new-subject">New Subject</label>
          <input name="new-subject" type="text"
            placeholder="Create New Subject">';
}

function displayNewCategoryField()
{
    echo '<label for="new-category">New Category</label>
          <input name="new-category" type="text" class="form-control"
            placeholder="Create New Category">';
}
