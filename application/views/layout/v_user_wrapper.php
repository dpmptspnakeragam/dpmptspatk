<?php
// Pemanggilan proteksi mencegah search URL
$this->lib_login->protection_url();

// Pemanggilan template dan diurutkan
require_once('v_user_header.php');
require_once('v_user_navbar_sidebar.php');
require_once('v_content.php');
require_once('v_user_footer.php');
