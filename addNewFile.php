<?php

require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

$uploadDir = __DIR__;
$newFile = 'new_resume.docx';

$uploadFile = $uploadDir . '\\' . basename($_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$university = $_POST['university'];
$speciality = $_POST['speciality'];
$yearOfEnding = $_POST['year_of_ending'];
$company = $_POST['company'];
$jobTitle = $_POST['job_title'];
$years = $_POST['years'];
$about = $_POST['about'];

$document = new TemplateProcessor('resume.docx');

$document->setImageValue('file', array('path' => $uploadFile, 'width' => 120, 'height' => 120, 'ratio' => false));
$document->setValue('name', $name);
$document->setValue('email', $email);
$document->setValue('phone', $phone);
$document->setValue('university', $university);
$document->setValue('speciality', $speciality);
$document->setValue('year_of_ending', $yearOfEnding);
$document->setValue('company', $company);
$document->setValue('job_title', $jobTitle);
$document->setValue('years', $years);
$document->setValue('about', $about);

$document->saveAs($newFile);

// Имя файла
$fileName = $newFile;

// Посылаем заголовки
header("Content-Type: application/octet-stream");
header("Accept-Ranges: bytes");
header("Content-Disposition: attachment; filename=$fileName");

readfile($fileName);

unlink($uploadFile);
unlink($newFile);