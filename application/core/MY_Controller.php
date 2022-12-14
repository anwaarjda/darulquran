<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	/**
	 * '*' all user
	 * '@' logged in user
	 * 'Admin' for admin
	 * 'Editor' for editor group
	 * 'Author' for author group
	 * @var string
	 */
	protected $access = "*";
	public $user_id;
	public $group;
	public $time;
	public $currentYear;

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->hijri_year = $this->session->userdata('hijri_year');

		$this->group = $this->session->userdata('group');
		$this->user_id = $this->session->userdata('user_id');
		$this->ac_year = $this->session->userdata('ac_year');
		$pre_year = substr($this->ac_year,2,2);
		$next_year = substr($this->ac_year,7,2);
		$this->year = $pre_year.$next_year;
		$this->time = date('Y-m-d H:i:s');
    }

	public function Amount($amount='')
	{
		$units = array('صفر', 'ایک','دو', 'تین', 'چار','پانچ', 'چھ', 'سات', 'آٹھ','نو');
		$ropey = ' روپے ';
		$word = '';
		$point_position = strpos($amount,'.');
		if($point_position == null){
			$wholnumber = $amount;

		}else {
			$wholnumber = substr($amount, 0, $point_position);
		}
		$len = strlen($wholnumber);

		if ($len == 1){
			if ($wholnumber[0] != 0){
				$unit = $this->units($wholnumber,$word,$units);
				return $unit.$ropey;
			}
		}elseif ($len == 2){
			if ($wholnumber[0] != 0){
				$ten = $this->tens($wholnumber,$word);
				return $ten.$ropey;
			}else{
				$unit = $this->units($wholnumber,$word,$units);
				return $unit.$ropey;
			}
		}elseif ($len == 3){
			$hunderade = $this->hund($wholnumber,$word,$units);
			return $hunderade.$ropey;
		}elseif ($len == 4){
			$thousand = $this->thousand($wholnumber,$word,$units);
			return $thousand.$ropey;
		}elseif ($len == 5){
			$ten_thousand = $this->ten_thousand($wholnumber,$word,$units);
			return $ten_thousand.$ropey;
		}elseif ($len == 6){
			$lac = $this->lac($wholnumber,$word,$units);
			return $lac.$ropey;
		}elseif ($len == 7){
			$ten_lac = $this->ten_lac($wholnumber,$word,$units);
			return $ten_lac.$ropey;
		}elseif ($len == 8){
			$caroor = $this->caroor($wholnumber,$word,$units);
			return $caroor.$ropey;
		}elseif ($len == 9){
			$ten_caroor = $this->ten_caroor($wholnumber,$word,$units);
			return $ten_caroor.$ropey;
		}elseif ($len == 10){
			$arab = $this->arab($wholnumber,$word,$units);
			return $arab.$ropey;
		}elseif ($len == 11){
			$ten_arab = $this->ten_arab($wholnumber,$word,$units);
			return $ten_arab.$ropey;
		}
		if (!($point_position == null)) {
			$paisy = ' پیسے ';
			$point_position++;
			$fract_part = substr($amount,$point_position);
			if(!($fract_part[0] == 0 && $fract_part[1] == 0)) {
				if($fract_part[0] == 0){
					$unit = $this->units($fract_part, $word, $units);
					return $unit . $paisy;
				}elseif(strlen($fract_part) == 1){
					$fract_part = $fract_part.'0';
					$ten = $this->tens($fract_part, $word);
					return $ten . $paisy;
				}else{
					$ten = $this->tens($fract_part, $word);
					return $ten.$paisy;
				}
			}
		}
	}

	public function units($amount,$word,$units)
	{
		switch ($amount){
//            case 0:
//                $word .= $units[0];
//                break;
			case 1:
				$word .= $units[1];
				break;
			case 2:
				$word .= $units[2];
				break;
			case 3:
				$word .= $units[3];
				break;
			case 4:
				$word .= $units[4];
				break;
			case 5:
				$word .= $units[5];
				break;
			case 6:
				$word .= $units[6];
				break;
			case 7:
				$word .= $units[7];
				break;
			case 8:
				$word .= $units[8];
				break;
			case 9:
				$word .= $units[9];
				break;
		}
		return $word;
	}

	public function tens($amount,$word,$units = null){



		$tens = array(

			'10' => 'دس',

			'11' => 'گیارہ',

			'12' => 'بارہ',

			'13' => 'تیرہ',

			'14' => 'چودہ',

			'15' => 'پندرہ',

			'16' => 'سولہ',

			'17' => 'سترہ',

			'18' => 'اٹھارہ',

			'19' => 'انیس',

			'20' => 'بیس',

			'21' => 'اکیس',

			'22' => 'بائیس',

			'23' => 'تیئیس',

			'24' => 'چوبیس',

			'25' => 'پچیس',

			'26' => 'چھبیس',

			'27' => 'ستائیس',

			'28' => 'اٹھائیس',

			'29' => 'انتیس',

			'30' => 'تیس',

			'31' => 'اکتیس',

			'32' => 'بتیس',

			'33' => 'تینتیس',

			'34' => 'چونتیس',

			'35' => 'پینتیس',

			'36' => 'چھتیس',

			'37' => 'سینتیس',

			'38' => 'اڑتیس',

			'39' => 'انتالیس',

			'40' => 'چالیس',

			'41' => 'اکتالیس',

			'42' => 'بیالیس',

			'43' => 'تینتالیس',

			'44' => 'چوالیس',

			'45' => 'پینتالیس',

			'46' => 'چھیالیس',

			'47' => 'سینتالیس',

			'48' => 'اڑتالیس',

			'49' => 'اننچاس',

			'50' => 'پچاس',

			'51' => 'اکیاون',

			'52' => 'باون',

			'53' => 'ترپن',

			'54' => 'چون',

			'55' => 'پچپن',

			'56' => 'چھپن',

			'57' => 'ستاون',

			'58' => 'اٹھاون',

			'59' => 'انسٹھ',

			'60' => 'ساٹھ',

			'61' => 'اکسٹھ',

			'62' => 'باسٹھ',

			'63' => 'تریسٹھ',

			'64' => 'چوسٹھ',

			'65' => 'پینسٹھ',

			'66' => 'چھیاسٹھ',

			'67' => 'سڑسٹھ',

			'68' => 'اڑسٹھ',

			'69' => 'انہتر',

			'70' => 'ستر',

			'71' => 'اکہتر',

			'72' => 'بہتر',

			'73' => 'تیہتر',

			'74' => 'چوہتر',

			'75' => 'پچہتر',

			'76' => 'چھہتر',

			'77' => 'ستتر',

			'78' => 'اٹھتر',

			'79' => 'اناسى',

			'80' => 'اسى',

			'81' => 'اکیاسى',

			'82' => 'بیاسى',

			'83' => 'تراسى',

			'84' => 'چوراسى',

			'85' => 'پچیاسى',

			'86' => 'چھیاسى',

			'87' => 'ستاسى',

			'88' => 'اٹھاسى',

			'89' => 'نواسى',

			'90' => 'نوے',

			'91' => 'اکیانوے',

			'92' => 'بانوے',

			'93' => 'ترانوے',

			'94' => 'چورانوے',

			'95' => 'پچانوے',

			'96' => 'چھیانوے',

			'97' => 'ستانوے',

			'98' => 'اٹھانوے',

			'99' => 'نناوے',

		);

		switch ($amount){

			case 10:

				$word .= $tens[10];

				break;

			case 11:

				$word .= $tens[11];

				break;

			case 12:

				$word .= $tens[12];

				break;

			case 13:

				$word .= $tens[13];

				break;

			case 14:

				$word .= $tens[14];

				break;

			case 15:

				$word .= $tens[15];

				break;

			case 16:

				$word .= $tens[16];

				break;

			case 17:

				$word .= $tens[17];

				break;

			case 18:

				$word .= $tens[18];

				break;

			case 19:

				$word .= $tens[19];

				break;

			case 20:

				$word .= $tens[20];

				break;

			case 21:

				$word .= $tens[21];

				break;

			case 22:

				$word .= $tens[22];

				break;

			case 23:

				$word .= $tens[23];

				break;

			case 24:

				$word .= $tens[24];

				break;

			case 25:

				$word .= $tens[25];

				break;

			case 26:

				$word .= $tens[26];

				break;

			case 27:

				$word .= $tens[27];

				break;

			case 28:

				$word .= $tens[28];

				break;

			case 29:

				$word .= $tens[29];

				break;

			case 30:

				$word .= $tens[30];

				break;

			case 31:

				$word .= $tens[31];

				break;

			case 32:

				$word .= $tens[32];

				break;

			case 33:

				$word .= $tens[33];

				break;

			case 34:

				$word .= $tens[34];

				break;

			case 35:

				$word .= $tens[35];

				break;

			case 36:

				$word .= $tens[36];

				break;

			case 37:

				$word .= $tens[37];

				break;

			case 38:

				$word .= $tens[38];

				break;

			case 39:

				$word .= $tens[39];

				break;

			case 40:

				$word .= $tens[40];

				break;

			case 41:

				$word .= $tens[41];

				break;

			case 42:

				$word .= $tens[42];

				break;

			case 43:

				$word .= $tens[43];

				break;

			case 44:

				$word .= $tens[44];

				break;

			case 45:

				$word .= $tens[45];

				break;

			case 46:

				$word .= $tens[46];

				break;

			case 47:

				$word .= $tens[47];

				break;

			case 48:

				$word .= $tens[48];

				break;

			case 49:

				$word .= $tens[49];

				break;

			case 50:

				$word .= $tens[50];

				break;

			case 51:

				$word .= $tens[51];

				break;

			case 52:

				$word .= $tens[52];

				break;

			case 53:

				$word .= $tens[53];

				break;

			case 54:

				$word .= $tens[54];

				break;

			case 55:

				$word .= $tens[55];

				break;

			case 56:

				$word .= $tens[56];

				break;

			case 57:

				$word .= $tens[57];

				break;

			case 58:

				$word .= $tens[58];

				break;

			case 59:

				$word .= $tens[59];

				break;

			case 60:

				$word .= $tens[60];

				break;

			case 61:

				$word .= $tens[61];

				break;

			case 62:

				$word .= $tens[62];

				break;

			case 63:

				$word .= $tens[63];

				break;

			case 64:

				$word .= $tens[64];

				break;

			case 65:

				$word .= $tens[65];

				break;

			case 66:

				$word .= $tens[66];

				break;

			case 67:

				$word .= $tens[67];

				break;

			case 68:

				$word .= $tens[68];

				break;

			case 69:

				$word .= $tens[69];

				break;

			case 70:

				$word .= $tens[70];

				break;

			case 71:

				$word .= $tens[71];

				break;

			case 72:

				$word .= $tens[72];

				break;

			case 73:

				$word .= $tens[73];

				break;

			case 74:

				$word .= $tens[74];

				break;

			case 75:

				$word .= $tens[75];

				break;

			case 76:

				$word .= $tens[76];

				break;

			case 77:

				$word .= $tens[77];

				break;

			case 78:

				$word .= $tens[78];

				break;

			case 79:

				$word .= $tens[79];

				break;

			case 80:

				$word .= $tens[80];

				break;

			case 81:

				$word .= $tens[81];

				break;

			case 82:

				$word .= $tens[82];

				break;

			case 83:

				$word .= $tens[83];

				break;

			case 84:

				$word .= $tens[84];

				break;

			case 85:

				$word .= $tens[85];

				break;

			case 86:

				$word .= $tens[86];

				break;

			case 87:

				$word .= $tens[87];

				break;

			case 88:

				$word .= $tens[88];

				break;

			case 89:

				$word .= $tens[89];

				break;

			case 90:

				$word .= $tens[90];

				break;

			case 91:

				$word .= $tens[91];

				break;

			case 92:

				$word .= $tens[92];

				break;

			case 93:

				$word .= $tens[93];

				break;

			case 94:

				$word .= $tens[94];

				break;

			case 95:

				$word .= $tens[95];

				break;

			case 96:

				$word .= $tens[96];

				break;

			case 97:

				$word .= $tens[97];

				break;

			case 98:

				$word .= $tens[98];

				break;

			case 99:
				$word .= $tens[99];
				break;
		}
		return $word;
	}

	public function hund($amount,$word,$units)
	{
		$hundrade = ' سو ';
		if(!($amount[0] == 0)){
			$word = $this->units($amount[0], $word, $units);
			$word .= $hundrade;
		}
		if (!($amount[1] == 0 && $amount[2] == 0)){
			if ($amount[1] == 0){
				$word = $this->units($amount[2],$word,$units);
			}else{
				$ten = $amount[1].$amount[2];
				$word = $this->tens($ten,$word,$units);
			}
		}
		return $word;
	}

	public function thousand($amount,$word,$units)
	{
		$thousand = 'ہزار';
		if(!($amount[0] == 0)){
			$word = $this->units($amount[0],$word,$units);
			$word .= ' '.$thousand;
		}
		if (!($amount[1] == 0 && $amount[2] == 0 && $amount[3] == 0 )){
			$hund = $amount[1].$amount[2].$amount[3];
			$word = $this->hund($hund,$word,$units);
		}
		return $word;
	}

	public function ten_thousand($amount,$word,$units)
	{
		$thousand = 'ہزار';
		if(!($amount[0] == 0 && $amount[1] == 0)){
			$ten_thousand = $amount[0].$amount[1];
			$word = $this->tens($ten_thousand,$word,$units);
			$word .= ' '.$thousand;
		}
		if (!($amount[2] == 0 && $amount[3] == 0 && $amount[4] == 0 )){
			$hund = $amount[2].$amount[3].$amount[4];
			$word = $this->hund($hund,$word,$units);
		}
		return $word;
	}

	public function lac($amount,$word,$units)
	{
		$lac = 'لاکھ ';
		if(!($amount[0] == 0)){
			$word = $this->units($amount[0],$word,$units);
			$word .= ' '.$lac;}
		if (!($amount[1] == 0 && $amount[2] == 0 && $amount[3] == 0  && $amount[4] == 0  && $amount[5] == 0 )){
			if($amount[1] == 0){
				$thousand = $amount[2].$amount[3].$amount[4].$amount[5];
				$word = $this->thousand($thousand,$word,$units);
			}else{
				$ten_thousand = $amount[1].$amount[2].$amount[3].$amount[4].$amount[5];
				//return '<script>alert('.$thousand.')</script>';
				$word = $this->ten_thousand($ten_thousand,$word,$units);
			}
		}
		return $word;
	}

	public function ten_lac($amount,$word,$units)
	{
		$lac = ' لاکھ ';
		if(!($amount[0] == 0 && $amount[1] == 0)){
			$ten_lac = $amount[0].$amount[1];
			$word = $this->tens($ten_lac,$word,$units);
			$word .= $lac;
		}

		if(!($amount[2] == 0 && $amount[3] == 0 && $amount[4] == 0 && $amount[5] == 0 && $amount[6] == 0)){
			if($amount[2] == 0){
				$thousand = $amount[3].$amount[4].$amount[5].$amount[6];
				$word = $this->thousand($thousand,$word,$units);
			}else{
				$ten_thousand = $amount[2].$amount[3].$amount[4].$amount[5].$amount[6];
				$word = $this->ten_thousand($ten_thousand,$word,$units);
			}
		}
		return $word;
	}

	public function caroor($amount,$word,$units)
	{
		$caroor = ' کروڑ ';
		if(!($amount[0] == 0)){
			$word = $this->units($amount[0],$word,$units);
			$word .= $caroor;
		}

		if (!($amount[1] == 0 && $amount[2] == 0 && $amount[3] == 0 && $amount[4] == 0 && $amount[5] == 0 && $amount[6] == 0 && $amount[7] == 0)){
			if($amount[1] == 0){
				$lac = $amount[2].$amount[3].$amount[4].$amount[5].$amount[6].$amount[7];
				$word = $this->lac($lac,$word,$units);
			}else{
				$ten_lac = $amount[1].$amount[2].$amount[3].$amount[4].$amount[5].$amount[6].$amount[7];
				$word = $this->ten_lac($ten_lac,$word,$units);
			}
		}
		return $word;
	}

	public function ten_caroor($amount,$word,$units)
	{
		$caroor = ' کروڑ ';
		if(!($amount[0] == 0 && $amount[1] == 0)){
			$ten_caroor = $amount[0].$amount[1];
			$word = $this->tens($ten_caroor,$word,$units);
			$word .= $caroor;
		}
		if(!($amount[2] == 0 && $amount[3] == 0 && $amount[4] == 0 && $amount[5] == 0 && $amount[6] == 0 && $amount[7] == 0 && $amount[8] == 0 )){
			if($amount[2] == 0) {
				$lac = $amount[3].$amount[4].$amount[5].$amount[6].$amount[7].$amount[8];
				$word = $this->lac($lac,$word,$units);
			}else{
				$ten_lac =  $amount[2].$amount[3].$amount[4].$amount[5].$amount[6].$amount[7].$amount[8];
				$word = $this->ten_lac($ten_lac,$word,$units);
			}
		}
		return $word;
	}

	public function arab($amount,$word,$units)
	{
		$arab = ' ارب ';
		$word = $this->units($amount[0],$word,$units);
		$word .= $arab;
		if(!($amount[1] == 0 && $amount[2] == 0 && $amount[3] == 0 && $amount[4] == 0 && $amount[5] == 0 && $amount[6] == 0 && $amount[7] == 0 && $amount[8] == 0 && $amount[9] == 0)){
			if($amount[1] == 0){
				$caroor = $amount[2].$amount[3].$amount[4].$amount[5].$amount[6].$amount[7].$amount[8].$amount[9];
				$word = $this->caroor($caroor,$word,$units);
			}else{
				$ten_caroor = $amount[1].$amount[2].$amount[3].$amount[4].$amount[5].$amount[6].$amount[7].$amount[8].$amount[9];
				$word = $this->ten_caroor($ten_caroor,$word,$units);
			}
		}
		return $word;
	}

	public function ten_arab($amount,$word,$units)
	{
		$arab = ' ارب ';
		if(!($amount[0] == 0 && $amount[1] == 0)){
			$ten_arab = $amount[0].$amount[1];
			$word = $this->tens($ten_arab,$word,$units);
			$word .= $arab;
		}
		if(!($amount[2] == 0 && $amount[3] == 0 && $amount[4] == 0 && $amount[5] == 0 && $amount[6] == 0 && $amount[7] == 0 && $amount[8] == 0 && $amount[9] == 0 && $amount[10] == 0 )){
			if($amount[2] == 0){
				$caroor = $amount[3].$amount[4].$amount[5].$amount[6].$amount[7].$amount[8].$amount[9].$amount[10];
				$word = $this->caroor($caroor,$word,$units);
			}else{
				$ten_caroor = $amount[2].$amount[3].$amount[4].$amount[5].$amount[6].$amount[7].$amount[8].$amount[9].$amount[10];
				$word = $this->ten_caroor($ten_caroor,$word,$units);
			}
		}
		return $word;
	}
}
