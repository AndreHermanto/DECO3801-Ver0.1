<?php
session_start(); //store the values posted into session
$_SESSION['gender'] = $gender = $_POST['gender'];
$_SESSION['ageRange'] = $ageRange = $_POST['ageRange'];
$_SESSION['nationality'] = $nationality = $_POST['nationality'];
$_SESSION['education'] = $education = $_POST['education'];
$_SESSION['language'] = $language = $_POST['language'];
$_SESSION['religion'] = $religion = $_POST['religion'];
$_SESSION['salary'] = $salary = $_POST['salary'];
$_SESSION['employment'] = $employment = $_POST['employment'];
$_SESSION['children'] = $children = $_POST['children'];
$_SESSION['flag'] = "go"; //set a flag for the main page
header("Location: index.php");//redirect to main page

?> 