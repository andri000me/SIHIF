<?php
	$this->load->view('master/header', array('title' => $title));
	$this->load->view('master/'.$navbar);
	$this->load->view($content);
	$this->load->view('master/footer');