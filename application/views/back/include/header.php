<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Welcome to MyApp</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php  echo base_url('asset/style.css')?>">

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" ></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"  ></script>

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-whtie border-bottom">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo base_url(); ?>category">Category</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo base_url(); ?>product">Product</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo base_url(); ?>transc">Transaction</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo base_url(); ?>report">Report</a>
			</li>
		</ul>
		<ul class="navbar-nav col-md-1">
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo base_url(); ?>dashboard/signoutact">Sign Out</a>
			</li>
		</ul>
	</div>
	
	</nav>

