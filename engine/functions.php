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
        '<h3>' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '</h3>' .
        '<h4> - ' . $status . ' - </h4>';
    echo ' ' . displayUserImg() . ' ';
}

//Display Log Out Button
function btnLogOut()
{
    if (isset($_POST['logout'])) {
        session_destroy();
        //redirect to log in menu
        echo '<script>window.location.href = "../../index.php";</script>';
        exit;
    }
}

//Display Back To Main Menu Button
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

//Display Delete Exercise Button
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

//Display Delete User Button
function btnDeleteUser()
{
    require '../engine/db-conn-users.php';
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $query = "SELECT * FROM user WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            echo '<button class="btn-cancel" name="delete" type="submit" value="delete"> DELETE </button>';
        }
    }
}

//Display User Overview Button
function btnAddUseroverview()
{
    echo '<a href="../sites/user-overview.php" class="btn-menu"> User Overview </a>';
}

//Display add exercise Button
function btnAddExercise()
{
    echo '<a href="../sites/add-exercise.php" class="btn-menu" >Add Exercises</a>';
}

//Display add user Button
function btnAddUser()
{
    echo '<a href="../sites/register.php" class="btn-menu">Add User</a>';
}

//Display add category Button
function btnAddCategory()
{
    echo '<a href="../sites/add-category.php" class="btn-menu">Add Category</a>';
}

//Display add subject Button
function btnAddSubject()
{
    echo '<a href="../sites/add-subject.php" class="btn-menu">Add Subject</a>';
}

//Display add new subject input
function inputAddSubject()
{
    echo '<div>
          <label for="new-subject">New Subject</label>
          <input name="new-subject" type="text"
            placeholder="Create New Subject">
        </div>';
}

//Display add new subject input
function displayNewSubjectField()
{
    echo '<label for="new-subject">New Subject</label>
          <input name="new-subject" type="text"
            placeholder="Create New Subject">';
}

//Display add new category input
function displayNewCategoryField()
{
    echo '<label for="new-category">New Category</label>
          <input name="new-category" type="text" class="form-control"
            placeholder="Create New Category">';
}

//Display user img
function displayUserImg()
{
    require '../engine/db-conn-users.php';
    $userId = $_SESSION['id'];
    $query = "SELECT * FROM user WHERE id =" . $userId . ";";
    $stmt = $conn->query($query);
    $result = mysqli_fetch_array($stmt);
    echo '<img class="user-img" src="data:image/jpeg;base64,' . base64_encode($result['user_photo']) . '" alt="Loading Image Failed!"/>';
}

//Display DB users
function displayAllUsers()
{
    require 'db-conn-users.php';
    $query = "SELECT * FROM user WHERE 1=1";
    $stmt = $conn->query($query);
    $isMobile = false;

    //Check if the client is from mobile device
    if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android/i', $_SERVER['HTTP_USER_AGENT'])) {
        $isMobile = true;
    }

    while ($row = mysqli_fetch_array($stmt)) {
        echo "<tr class='table-row'>";

        if (!$isMobile) {
            echo "<th scope='row'>" . $row['id'] . "</th>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['status_level'] . "</td>";
            echo "<td><img class='user-img' src='data:image/jpeg;base64," . base64_encode($row['user_photo']) . "' alt='Loading Image Failed!'/></td>";
        }

        echo "<td><a class='btn-cancel' href='../engine/edit-user.php?id=" . $row['id'] . "'>Edit User</a></td>";

        if ($isMobile) {
            echo "<td>Exercise id: " . $row['id'] . "</td>";
            echo "<td>Name: " . $row['first_name'] . "</td>";
            echo "<td>Description: " . $row['last_name'] . "</td>";
            echo "<td>Hint: " . $row['email'] . "</td>";
            echo "<td>Subject: " . $row['status_level'] . "</td>";
            echo "<td><img class='user-img' src='data:image/jpeg;base64," . base64_encode($row['user_photo']) . "' alt='Loading Image Failed!'/></td>";
        }

        echo "</tr>";
    }

    mysqli_close($conn);
}

//Delete Exercise
function deleteExerciseContent($exerciseId)
{
    require '../engine/db-conn-exercises.php';
    $query = "DELETE FROM exercise WHERE id = " . $exerciseId;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $conn->close();
}

//Delete User
function deleteUserContent($userId)
{
    require '../engine/db-conn-users.php';
    $query = "DELETE FROM user WHERE id = " . $userId;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $conn->close();
}

//Insert Category in DB
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

//Insert Subject in DB 
function addSubjectToDb()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Take -subject- from the form
        if (!empty($_POST['subject'])) {
            $subject = $_POST['subject'];
            require 'db-conn-exercises.php';

            // Insert new -subject- into the database
            $query = "INSERT INTO subject (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $subject);

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

//Insert the Exercise Content in DB
function addExerciseContentToDb()
{
    require '../engine/db-conn-exercises.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $exercise_name = $_POST['exercise-name'];
        $description = $_POST['description'];
        $hint = $_POST['hint'];
        $subject = $_POST['subject'];
        $category = $_POST['category'];
        $new_category = isset($_POST['new-category']) ? $_POST['new-category'] : null;
        $new_subject = isset($_POST['new-subject']) ? $_POST['new-subject'] : null;
        $current_date = date('Y-m-d');
        $excercise_file_name = $_FILES['excercise-file']['name'];
        $excercise_file_tmp = $_FILES['excercise-file']['tmp_name'];

        //File empty?
        if (!empty($excercise_file_tmp)) {
            $excercise_file_data = file_get_contents($excercise_file_tmp);
        } else {
            $excercise_file_data = null;
        }

        $current_userId = intval($_SESSION['id']);

        //If new category is selected, change the main variable -category-
        //because this one is inserted into the specific table in the database first and bound in the query later
        if ($new_category) {
            $query = "INSERT INTO category (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $new_category);
            mysqli_stmt_execute($stmt);
            $category = $new_category;
        }

        //Same for -subject- as for -category-
        if ($new_subject) {
            $query = "INSERT INTO subject (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $new_subject);
            mysqli_stmt_execute($stmt);
            $subject = $new_subject;
        }

        try {
            //Query prepare & execute
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

//Retrieve Category from DB
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

//Retrieve Subject from DB
function pullSubjectFromDb(&$subjectOptions)
{
    require 'db-conn-exercises.php';
    $query = "SELECT name FROM subject";
    $result = mysqli_query($conn, $query);
    // Get -subject- from db and initialize $subjectOptions array
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $subjectOptions[] = $row['name'];
        }
    }

    mysqli_close($conn);
}

//Display Subject Options
function filterSubject()
{
    global $subjectOptions;
    foreach ($subjectOptions as $subjectOption) :
        echo '<option value="' . $subjectOption . '">' . $subjectOption . '</option>';
    endforeach;
}

//Display Category Options
function filterCategory()
{
    global $categoryOptions;
    foreach ($categoryOptions as $categoryOption) :
        echo '<option value="' . $categoryOption . '">' . $categoryOption . '</option>';
    endforeach;
}

//Pull subjects and categories from the database and initialize the respective arrays
$subjectOptions = [];
pullSubjectFromDb($subjectOptions);
$categoryOptions = [];
pullCategoryFromDb($categoryOptions);

//Check If User is logged in
function checkUserLogin()
{
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        return true;
    } else {
        return false;
    }
}

//Redirect the logged in user to main menu
function redirectLoggedUser()
{
    if (checkUserLogin()) {
        echo '<script>window.location.href = "../sites/main-menu.php";</script>';
    }
}

//Redirect unathorized user, prevent access to the protected sites
function redirectCheckUserLogIn()
{
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        //false- result:
        echo '<script>window.location.href = "unauthorized.php";</script>';
        exit;
    }
}

//Redirect unathorized user, prevent access to the protected sites (Super User!!!)
function redirectCheckSuperUserLogIn()
{
    //Check if authorized user is logged in
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['status_level'] != 9) {
        //failed results:
        echo '<script>window.location.href = "unauthorized.php";</script>';
        exit;
    }
}

//Check if Student is Logged In
function studentCheck()
{
    return ($_SESSION['$status_level'] === 1);
}

//Check if teacher is Logged In
function teacherCheck()
{
    return ($_SESSION['status_level'] === 2);
}

//Check if Super User is Logged In
function superCheck()
{
    return ($_SESSION['status_level'] === 9);
}

//Display Exercise Content
function displayExercises()
{
    require 'db-conn-exercises.php';
    $query = "SELECT * FROM exercise WHERE 1=1";

    //Subject filter
    if (!empty($_GET['subject'])) {
        $subject = $_GET['subject'];
        $query .= " AND subject = '$subject'";
    }

    //Category filter
    if (!empty($_GET['category'])) {
        $category = $_GET['category'];
        $query .= " AND category = '$category'";
    }

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    //Set mobile screen bool
    $isMobile = false;

    //Check if the client is on mobile device and display the table in the right format
    if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android/i', $_SERVER['HTTP_USER_AGENT'])) {
        $isMobile = true;
    }

    //Display the table according to the screen
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

        //If authorized teacher or Super User is logged in, display the *EDIT button
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

//Get the String name and last name from the added_by column from DB, using the exercise ID 
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

//Subject & Category Filters in ../sites/exercises.php
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

//User Log In Function
function userLogIn()
{
    require 'db-conn-users.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM user WHERE email=?";

        //Query prepare, execute & retrieve data
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            //Check If The User Exists
            if (mysqli_num_rows($result) == 1) {
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

//Add new User to DB
function addNewUser()
{
    require 'db-conn-users.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['first-name']) &&
            isset($_POST['last-name']) &&
            isset($_POST['status-level']) && in_array($_POST['status-level'], ['student', 'teacher', 'super'])
        ) {
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];
            $status_level = $_POST['status-level'];
            switch($status_level) {
                case 'student':
                    $status_level = 1;
                    break;
                case 'teacher':
                    $status_level = 2;
                    break;
                case 'super':
                    $status_level = 9;
                    break;
            }
            $profile_image_file = $_FILES['profile-image']['name'];
            $profile_image_tmp = $_FILES['profile-image']['tmp_name'];

            //Check if img is empty and fill it with null if it is
            if (!empty($profile_image_tmp)) {
                $profile_image_data = file_get_contents($profile_image_tmp);
            } else {
                $profile_image_data = null;
            }

            //Check if Email already Exists
            $query = "SELECT * FROM user where email=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                echo '<script>alert("Email already Exists.")</script>';
                mysqli_close($conn);
                return;
            } 

            //Check for empty fields
            if (empty($email) || empty($password) || empty($first_name) || empty($last_name) || empty($status_level)) {
                echo '<script>alert("Please fill in all required fields.")</script>';
            } else {
                //Insert the new user in -users- DB
                $query = "INSERT INTO user (email, password, first_name, last_name, status_level) VALUES (?, ?, ?, ?, ?)";
                if ($profile_image_data !== null) {
                    $query = "INSERT INTO user (email, password, first_name, last_name, status_level, user_photo) VALUES (?, ?, ?, ?, ?, ?)";
                }
                $stmt = mysqli_prepare($conn, $query);
                if ($profile_image_data !== null) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $email, $password, $first_name, $last_name, $status_level, $profile_image_data);
                } else {
                    mysqli_stmt_bind_param($stmt, "sssss", $email, $password, $first_name, $last_name, $status_level);
                }

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

//Retrieve the exercise Details from the Exercise site
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

//Check if Exercise Edit is possible (Teacher/Super User)
function checkIfEditPosible($row)
{
    if ($_SESSION['id'] != $row['added_by'] && $_SESSION['status_level'] < 2) {
        echo '<script>window.location.href = "exercises.php";</script>';
    } else if ($_SESSION['id'] != $row['added_by']  && $_SESSION['status_level'] === 2) {
        echo '<script>window.location.href = "exercises.php";</script>';
    }
}