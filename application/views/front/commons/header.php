<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BeYoou</title>
    <link href="<?php echo base_url('public/') ?>img/fav.png" rel="icon" type="icon/image">
    <link href="<?php echo base_url('public/') ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/') ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/') ?>css/hamburgers.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="<?php echo base_url('public/') ?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url('public/') ?>css/media.css" rel="stylesheet">

</head>

<body data-session="<?php echo $this->session->userdata('unique_id'); ?>">
    <div class="loader"></div>