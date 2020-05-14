<?php

include_once 'app/Matrix.php';

$matrixA = new Matrix();
$matrixA->fillRandom(3,5);
$matrixB = new Matrix();
$matrixB->fillRandom(3,5);
$matrixC = new Matrix();
$matrixC->fillRandom(3,3);
$matrixD = new Matrix();
$matrixD->fillRandom(5,3);
$matrixE = new Matrix();
$matrixE->fillRandom(3,3);

echo 'MatrixA' . "\r\n" . $matrixA . "\r\n\r\n";
echo 'MatrixB' . "\r\n" . $matrixB . "\r\n\r\n";
echo 'MatrixC' . "\r\n" . $matrixC . "\r\n\r\n";
echo 'MatrixD' . "\r\n" . $matrixD . "\r\n\r\n";
echo 'MatrixE' . "\r\n" . $matrixE . "\r\n\r\n";

echo 'MatrixA + MatrixC' . "\r\n" . $matrixA->add($matrixC) . "\r\n\r\n";
echo 'MatrixA + MatrixB' . "\r\n" . $matrixA->add($matrixB) . "\r\n\r\n";
echo 'MatrixA - MatrixB' . "\r\n" . $matrixA->diff($matrixB) . "\r\n\r\n";
echo 'MatrixC - MatrixE' . "\r\n" . $matrixC->diff($matrixE) . "\r\n\r\n";
echo 'MatrixB * MatrixD' . "\r\n" . $matrixB->mult($matrixD) . "\r\n\r\n";
echo 'MatrixD * MatrixB' . "\r\n" . $matrixD->mult($matrixB) . "\r\n\r\n";
echo 'MatrixC * MatrixE' . "\r\n" . $matrixC->mult($matrixE) . "\r\n\r\n";
