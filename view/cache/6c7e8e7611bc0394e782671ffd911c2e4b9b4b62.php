<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo e($pageTitle); ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/<?php echo e($appName); ?>/assets/img/favicon.ico" rel="icon">
  <link href="/<?php echo e($appName); ?>/assets/img/favicon.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/<?php echo e($appName); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/<?php echo e($appName); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/<?php echo e($appName); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/<?php echo e($appName); ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/<?php echo e($appName); ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/<?php echo e($appName); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/<?php echo e($appName); ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="/<?php echo e($appName); ?>/assets/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/<?php echo e($appName); ?>/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/css/shepherd.css"/>

  <style>
    #loading-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.1);
      z-index: 9999;
    }

    #loading-indicator {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 50px;
      height: 50px;
      border: 8px dotted green;
      border-radius: 50%;
      border-top: 8px solid #e74c3c;
      animation: spin 1s linear infinite;
    }

    @keyframes  spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .shepherd-modal {
      background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
      
    }

    .shepherd-content {
      color: #075E54; /* White text color */
    }

    .shepherd-buttons {
      margin-top: 20px; /* Add spacing between buttons */
    }

    .shepherd-button {
      background-color: #075E54; /* Blue button color */
      color: #fff; /* White text color */
      border-radius: 5px; /* Rounded corners */
      padding: 4px 8px; /* Padding for buttons */
      margin-right: 10px; /* Add spacing between buttons */
    }

    .shepherd-button:hover {
      background-color: #075E54; /* Darker blue on hover */
    }
  </style>

</head>