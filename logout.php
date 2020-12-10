<?php
include_once 'data-source/user-session.php';

session_destroy();
header('location: admin-faculty.php');
