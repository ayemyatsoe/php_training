<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  'root',
  'db_crud'
) or die(mysqli_erro($mysqli));

?>