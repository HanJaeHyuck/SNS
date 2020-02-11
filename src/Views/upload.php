<?php

header("Content-Type: application/json");

$file = $_FILES['file'];

move_uploaded_file($file['tmp_name'], "./newfile/". $file['name']);

echo json_encode(['success'=>true, 'name'=>$file['name']]);
