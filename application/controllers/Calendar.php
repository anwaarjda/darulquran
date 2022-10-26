<?php

class Calendar extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Calendar_Model');
		date_default_timezone_set('Asia/Karachi');
	}

	public function index()
	{
		$data['monthly_dates'] = $this->Calendar_Model->monthly_date();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('calendar/calendar', $data);
		$this->load->view('layout/footer');
	}

	public function last_monthly_dates()
	{
		$data['last_monthly_dates'] = $this->Calendar_Model->last_monthly_dates();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('calendar/monthly_calendar', $data);
		$this->load->view('layout/footer');
	}

	public function save()
	{
		$this->Calendar_Model->change_date();

		$qm_date_day = substr($last_date[0]->Qm_date, 8, 2);
		$qm_date_month = substr($last_date[0]->Qm_date, 5, 3);
		$qm_date_year = substr($last_date[0]->Qm_date, 0, 5);
		$qm_date_day++;
		$qm_date_day = (strlen($qm_date_day) == 1) ? '0' . $qm_date_day : $qm_date_day;
		$Post_qm_date = $qm_date_year . $qm_date_month . $qm_date_day;


		$sh_date_day = substr($last_date[0]->Sh_date, 8, 2);
		$sh_date_month = substr($last_date[0]->Sh_date, 5, 3);
		$sh_date_year = substr($last_date[0]->Sh_date, 0, 5);
		$Post_batch = substr($last_date[0]->Sh_date, 2, 2);
		$sh_date_day++;
		$sh_date_day = (strlen($sh_date_day) == 1) ? '0' . $sh_date_day : $sh_date_day;
		$Post_sh_date = $sh_date_year . $sh_date_month . $sh_date_day;

		$Qm_date_to_Start = $Post_qm_date;//$_POST['date'];
		echo $Qm_date_to_Start . '<br>';

		$Sh_date_to_Start = $Post_sh_date;//$_POST['date'];
		echo $Sh_date_to_Start . '<br>';

		$sh_batch_start = $Post_batch;//$_POST['batch'];
		$sh_batch_end = $sh_batch_start + 1;

		$qm_batch_start = substr($Qm_date_to_Start, 2, 2);
		$qm_batch_end = $qm_batch_start + 1;

		echo $qm_batch_start . ' - ' . $qm_batch_end . '<br>';
		echo $sh_batch_start . ' - ' . $sh_batch_end;

		$qmday = array('01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30);
		$qmmonth = array('01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12);
		$qmyear = array('14' . $qm_batch_start, '14' . $qm_batch_end);

		$check = 'false';
		for ($a = 0; $a < count($qmyear); $a++)
		{
			for ($b = 0; $b < count($qmmonth); $b++)
			{
				for ($c = 0; $c < count($qmday); $c++)
				{
					if ($c == 30 && $check == 'false' && $b % 2 == 0)
					{
						$check = 'true';
						continue;
					}
					else
					{
						$check = 'false';
					}
					$qmdate[] = $qmyear[$a] . "-" . $qmmonth[$b] . "-" . $qmday[$c];
				}
			}
		}
		$qm_start = array_search($Qm_date_to_Start, $qmdate);

		$Qm_year = $qmyear[0];
//		$qm_start = array_search($Qm_date_to_Start, $qmdate);

		$shday = array('01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31);
		$shmonth = array('01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12);
		$shyear = array('20' . $sh_batch_start, '20' . $sh_batch_end);
		$shDayName = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

		for ($a = 0; $a < count($shyear); $a++)
		{
			for ($b = 0; $b < count($shmonth); $b++)
			{
				for ($c = 0; $c < count($shday); $c++)
				{
					if ($b == 1 && $c == 28)
					{
						if ($shyear[$a] == '2016' || $shyear[$a] == '2020' || $shyear[$a] == '2024' || $shyear[$a] == '2028' || $shyear[$a] == '2032')
						{
						}
						else continue 2;
					}
					elseif ($b == 1 && $c == 29 && ($shyear[$a] == '2016' || $shyear[$a] == '2020' || $shyear[$a] == '2024' || $shyear[$a] == '2028' || $shyear[$a] == '2032'))
					{
						continue 2;
					}
					elseif (($b == 3 || $b == 5 || $b == 8 || $b == 10) && $c == 30)
					{
						continue 2;
					}
					$shdate[] = $shyear[$a] . "-" . $shmonth[$b] . "-" . $shday[$c];
				}
			}
		}
		$sh_start = array_search($Sh_date_to_Start, $shdate);

//		$b = 0;
//		for ($d = 0; $d < count($qmdate); $d++) {
//			$dates[$b]['id'] = '';
//			$b++;
//			if ($b > 353) {
//				break;
//			}
//		}

		$b = 0;
		$w = 0;
		for ($a = $qm_start; $a < count($qmdate); $a++)
		{
			$dates[$b]['Qm_date'] = ($qmdate[$a]);
			if ($w == 7)
			{
				$w = 0;
			}
			if ($dates[$b]['Qm_date'][8] . $dates[$b]['Qm_date'][9] == '30' || $dates[$b]['Qm_date'][8] . $dates[$b]['Qm_date'][9] == '01')
			{
				$dates[$b]['day'] = 'y';
			}
			else
			{
				$dates[$b]['day'] = 'n';
			}
			if ($b > 352)
			{
				break;
			}
			$b++;
			$w++;
		}

		$b = 0;
		$w = 0;
		for ($a = $sh_start; $a < count($shdate); $a++)
		{
			$dates[$b]['Sh_date'] = ($shdate[$a]);
			if ($w == 7)
			{
				$w = 0;
			}
			if ($dates[$b]['Sh_date'][8] . $dates[$b]['Sh_date'][9] == '30' || $dates[$b]['Sh_date'][8] . $dates[$b]['Sh_date'][9] == '01')
			{
				$dates[$b]['day'] = 'y';
			}
			else
			{
				$dates[$b]['day'] = 'n';
			}
			if ($b > 352)
			{
				break;
			}
			$b++;
			$w++;
		}

		$b = 0;
		for ($c = $sh_start; $c < count($shdate); $c++)
		{
			if ($dates[$b]['Qm_date'] !== null)
			{
				$dates[$b]['Sh_date'] = ($shdate[$c]);
				$dates[$b]['IsActive '] = 1;
				$dates[$b]['year'] = $Qm_year;
				$b++;
			}
			if ($b > 353)
			{
				break;
			}
		}
		$check = $this->Calendar_Model->save_data($dates);
		if ($check)
		{
			echo "<script>alert('Success');</script>";
			redirect('Calendar', 'refresh');
		}
		else
		{
			echo "<script>alert('Failed');</script>";
			redirect('Calendar', 'refresh');
		}
	}

	public function update($change)
	{
//		$date = date('Y-m-d');
		$last_date = $this->Calendar_Model->delete_old_calendar();

		$Hdates = $this->CalendarModel->getHijriDate($last_date);
		$Qmrecord = array(
			'id' => $Hdates[0]->id,
			'Qm_date' => $Hdates[0]->Qm_date,
			'day' => $Hdates[0]->day
		);
		$lastInserteds = $this->CalendarModel->getLastInserted();
		$lastId = $lastInserteds[0]->id;

		$Hids = $this->CalendarModel->getAllIds($Qmrecord['id'], $lastId);
		$lenOfIds = sizeof($Hids);

		if ($change == '1')
		{
			foreach ($Hids as $Hid)
			{
				$id[] = $Hid->id - 1;
				$Qmdate[] = $Hid->Qm_date;
				$day[] = $Hid->day;
			}
			$QmDay = substr($Qmrecord['Qm_date'], 8);
			$QmMonth = (int)substr($Qmrecord['Qm_date'], 5, 7);
			$QmYear = substr($Qmrecord['Qm_date'], 0, 4);
			if ($QmMonth == 12)
			{
				$QmMonth = 1;
			}
			else
			{
				$QmMonth++;
			}

			if ($QmDay == '30')
			{
				$NewQmDay = '01';
				if ($QmMonth == 10 || $QmMonth == 11 || $QmMonth == 12)
				{
					$NewQmMonth = $QmMonth;
				}
				else
				{
					$NewQmMonth = '0' . $QmMonth;
				}
				$NewQmYear = $QmYear;
				$NewQmDate = $NewQmYear . '-' . $NewQmMonth . '-' . $NewQmDay;

				$myDate[0] = array(
					'id' => $Qmrecord['id'],
					'Qm_date' => $NewQmDate,
					'day' => 'n',
					'IsActive' => '1'
				);
				for ($i = 1; $i < $lenOfIds; $i++)
				{
					if ($i != 1)
					{
						$myDate[$i] = array(
							'id' => $id[$i],
							'Qm_date' => $Qmdate[$i],
							'day' => $day[$i],
							'IsActive' => '1'
						);
					}
				}
				$dId = $id[$i - 1] + 1;
//                print_r($myDate);
//                exit();
				$result = $this->CalendarModel->update($myDate, $lenOfIds, $dId, $change);
				if ($result)
				{
					echo "<script>alert('Success');</script>";
					redirect(site_url('Dashboard'), 'refresh');
				}
				else
				{
					echo "<script>alert('Failed');</script>";
					redirect('Dashboard', 'refresh');
				}
			}
			else
			{
				$this->CalendarModel->update_Day($Qmrecord['id'], 'n');
				echo "<script>alert('Date is Already Set');</script>";
				redirect('Dashboard', 'refresh');
			}
		}
		if ($change == '30')
		{
			foreach ($Hids as $Hid)
			{
				$id[] = $Hid->id + 1;
				$Qmdate[] = $Hid->Qm_date;
				$day[] = $Hid->day;
			}

			$QmDay = substr($Qmrecord['Qm_date'], 8);
			$QmMonth = (int)substr($Qmrecord['Qm_date'], 5, 7);
			$QmYear = substr($Qmrecord['Qm_date'], 0, 4);
			if ($QmMonth == 01)
			{
				$QmMonth = 12;

			}
			else
			{
				$QmMonth--;
			}
			if ($QmDay == '01')
			{
				$NewQmDay = '30';
				if ($QmMonth == 10 || $QmMonth == 11 || $QmMonth == 12)
				{
					$NewQmMonth = $QmMonth;
				}
				else
				{
					$NewQmMonth = '0' . $QmMonth;
				}
				$NewQmYear = $QmYear;
				$NewQmDate = $NewQmYear . '-' . $NewQmMonth . '-' . $NewQmDay;

				$myDate[0] = array(
					'id' => $Qmrecord['id'],
					'Qm_date' => $NewQmDate,
					'day' => 'n'
				);
				$check = 0;
				for ($i = 1; $i < $lenOfIds; $i++)
				{
					if (substr($Qmdate[$i - 1], 8) == '01' && $check == 0)
					{
						$myDate[$i] = array(
							'id' => $id[$i - 1],
							'Qm_date' => $Qmdate[$i - 1],
							'day' => 'n',
						);
						$check = 1;
					}
					else
					{
						$myDate[$i] = array(
							'id' => $id[$i - 1],
							'Qm_date' => $Qmdate[$i - 1],
							'day' => $day[$i - 1],
						);
					}
				}
				$geodate = $this->CalendarModel->getGeoDate('1438-08-15');
				$geoday = (int)substr($geodate[0]->Sh_date, 8);
				$geoday++;
				$NewDate = array(
					'Qm_date' => '1438-08-15',
					'Sh_date' => '2017-09-' . $geoday,
					'day' => 'n',
				);
				$result = $this->CalendarModel->update($myDate, $lenOfIds, $NewDate);
				if ($result)
				{
					echo "<script>alert('Success');</script>";
					redirect('Dashboard', 'refresh');
				}
				else
				{
					echo "<script>alert('Failed');</script>";
					redirect('Dashboard', 'refresh');
				}
			}
			else
			{
				$this->CalendarModel->update_Day($Qmrecord['id'], 'n');
				echo "<script>alert('Date is Already Set');</script>";
				redirect('Dashboard', 'refresh');
			}
		}
	}

	public function getMaxDate()
	{
		$data = $this->CalendarModel->get_max_date();
		$date = array('date' => $data[0]->Sh_date);
		echo json_encode($date);
	}

	public function getMinDate()
	{
		$data = $this->CalendarModel->get_min_date();
		$date = array('date' => $data[0]->Sh_date);
		echo json_encode($date);
	}

	public function get_date($dates)
	{
		$data = $this->Calendar_Model->get_date($dates);

		if (!empty($data[0]))
		{
			$date = array('date' => $data[0]->Qm_date);
			echo json_encode($date);
		}
	}

}
