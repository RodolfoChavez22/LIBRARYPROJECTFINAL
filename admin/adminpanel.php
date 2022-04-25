<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
<?php
    include_once '../header.php'
?>
<div class="page-content" style = "background: #E3E1E1;">
    <section class="container">
        <div class ="side-bar" id="sidebar">
            <div class="dash-title">
                <b>Admin Panel</b>
            </div>
            <div class="list">
                <div class ="icon-divider">
                    <div class="icons" onclick="location.href='dashboard';"><p>Dashboard</p></div>
                </div>
                <div class ="icon-divider">
                    <div class="icons" onclick="location.href='books';"><p>Books</p></div>
                </div>
                <div class ="icon-divider">
                    <div class="icons" onclick="location.href='journals';"><p>Journals</p></div>
                </div>
                <div class ="icon-divider">
                    <div class="icons" onclick="location.href='disks';"><p>Disks</p></div>
                </div>
                <div class ="icon-divider">
                    <div class="icons" onclick="location.href='electronics';"><p>Electronics</p></div>
                </div>
                <div class ="icon-divider">
                    <div class="icons" onclick="location.href='users';"><p>Users</p></div>
                </div>
                <div class ="icon-divider">
                    <div class="icons" onclick="location.href='loans';"><p>Loans</p></div>
                </div>
                <div class ="icon-divider">
                    <div class="icons" onclick="location.href='request';"><p>Requests</p></div>
                </div>
                <div class ="icon-divider">
                    <div class="icons" onclick="location.href='restore';"><p>Restore</p></div>
                </div>
            </div>
        </div>