<?php
namespace Bmi\Classes;

class Bmi {
	protected $height;
	protected $weight;
	protected $strategy;

	public function __construct($height, $weight, UnitStrategy $strategy) {
		$this->height 	= $height;
		$this->weight 	= $weight;
		$this->strategy = $strategy;
	}

    public function calculateBMI($tinggi, $berat){
        $result = $this->strategy->calculateBMI($this->tinggi, $this->berat);
        $result = ($tinggi/100)/(round($berat,2));

        // get description
        $description = $this->getDesc($result);

        $data = array(
            'indeks' => $result,
            'keterangan' => $description
        );

        return $data;
    }

protected function getDesc($result)
{
    $text = '';

    if ($result < 18.5) {
        $text = 'Underweight';
    }
    elseif ($result >= 18.5 && $result < 24.9) {
        $text = 'Normal';
    }
    elseif ($result >= 24.9 && $result < 29.9) {
        $text = 'Overweight';
    }
    elseif ($result >= 30) {
        $text = 'Obese';
    }

    return $text;
}

}