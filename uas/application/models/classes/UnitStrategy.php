<?php
namespace Bmi\Classes;

abstract class UnitStrategy {
	abstract function calculateBMI($tinggi, $berat);
}