<?php

function is_logged_in() {
  $ci = get_instance();
  if (!$ci->session->userdata("username")) {
    redirect("login");
  }
}

function is_not_logged_in() {
  $ci = get_instance();
  if ($ci->session->userdata("username")) {
    redirect("admin");
  }
}
?>