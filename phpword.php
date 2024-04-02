<?php

require 'vendor/autoload.php';

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

// Установка настроек
Settings::setOutputEscapingEnabled(true);

$phpWord = new \PhpOffice\PhpWord\PhpWord();

//Установка шрифта
$phpWord->setDefaultFontName('Times New Roman');

$section = $phpWord->addSection();

$fontHeaderStyle = array('color'=>'8B4513', 'size' => 15, 'bold' => true, 'italic' => true);
$fontNameStyle = array('color'=>'2F4F4F', 'size' => 11, 'bold' => true);
$fontAfterNameStyle = array('color' => '191970');
$fontBreakStyle = array('spaceAfter' => 100, 'borderBottomSize' => 1, 'borderBottomColor' => '0000FF');

// Заголовок
$section->addText('Резюме', array('color'=>'800000', 'size' => 25, 'bold' => true, 'italic' => true));
$section->addTextBreak(2, null, $fontBreakStyle);

// Информация о соискателе
$section->addTextBreak();
$section->addText('Информация:', $fontHeaderStyle);
$section->addTextBreak();

$section->addText('Фотография:', $fontNameStyle);
$section->addText('${file}');
$section->addTextBreak();

$section->addText('ФИО:', $fontNameStyle);
$section->addText('${name}', $fontAfterNameStyle);
$section->addText('Email:', $fontNameStyle);
$section->addText('${email}', $fontAfterNameStyle);
$section->addText('Телефон:', $fontNameStyle);
$section->addText('${phone}', $fontAfterNameStyle);
$section->addTextBreak(1, null, $fontBreakStyle);

// Образование
$section->addTextBreak();
$section->addText('Образование:', $fontHeaderStyle);
$section->addTextBreak();

$table = $section->addTable();
$table->addRow();
$table->addCell(2000)->addText('Университет', $fontNameStyle);
$table->addCell(2000)->addText('Специальность', $fontNameStyle);
$table->addCell(2000)->addText('Год окончания', $fontNameStyle);

$table->addRow();
$table->addCell()->addText('${university}', $fontAfterNameStyle);
$table->addCell()->addText('${speciality}', $fontAfterNameStyle);
$table->addCell()->addText('${year_of_ending}', $fontAfterNameStyle);
$section->addTextBreak(1, null, $fontBreakStyle);

// Опыт работы
$section->addTextBreak();
$section->addText('Опыт работы:', $fontHeaderStyle);
$section->addTextBreak();

$table = $section->addTable();
$table->addRow();
$table->addCell(2000)->addText('Компания', $fontNameStyle);
$table->addCell(2000)->addText('Должность', $fontNameStyle);
$table->addCell(2000)->addText('Годы', $fontNameStyle);

$table->addRow();
$table->addCell()->addText('${company}', $fontAfterNameStyle);
$table->addCell()->addText('${job_title}', $fontAfterNameStyle);
$table->addCell()->addText('${years}', $fontAfterNameStyle);
$section->addTextBreak(1, null, $fontBreakStyle);

// О себе
$section->addTextBreak();
$section->addText('О себе:', $fontHeaderStyle);
$section->addText('${about}', $fontAfterNameStyle);

// Сохранение документа
$filename = 'resume.docx';

$objWriter = IOFactory::createWriter($phpWord);
$objWriter->save($filename);

echo "Резюме успешно создано и сохранено в файле $filename" . PHP_EOL;