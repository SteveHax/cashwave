<?php
// Check if form is submitted
if(isset($_POST['submit'])){
    // Connect to MySQL database
    $conn = mysqli_connect('localhost', 'username', 'password', 'database');
    
    // Get the form data
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    $invitationCode = mysqli_real_escape_string($conn, $_POST['invitation']);
    $uniqueCode = mysqli_real_escape_string($conn, $_POST['unique']);
    
    // Form Validation
    // Check if any field is empty
    if(empty($phoneNumber) || empty($password) || empty($confirmPassword) || empty($invitationCode) || empty($uniqueCode)){
        echo "One or more fields are blank. Please fill all the fields before submitting.";
    } else {
        // Check if passwords match
        if($password != $confirmPassword){
            echo "Passwords do not match!";
        } else {
            // Insert sign up details into database
            $sql = "INSERT INTO users (phone_number, password, invitation_code, unique_code) VALUES ('$phoneNumber', '$password', '$invitationCode', '$uniqueCode')";
            $result = mysqli_query($conn, $sql);
            
            // Check if insert was successful
            if($result){
                echo "Sign up successful";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}
?>