<?php

class Calendar_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function get_hijri_year()
	{
		$this->db->select('dq_years.hijri_year');
		$this->db->where('dq_years.ac_year',$this->ac_year);
		$hijri_year = $this->db->get('dq_years')->row()->hijri_year;
		return substr($hijri_year,0,4);
	}

	function max_id()
	{
		$this->db->select_max('id');
		$this->db->where('year', $this->get_hijri_year());
		return $this->db->get('calendar')->result();
	}

	function get_max_date()
	{
		$max_id = $this->max_id();
		$this->db->select('*');
		$this->db->where('id', $max_id[0]->id);
		return $this->db->get('calendar')->result();
	}

	public function monthly_date()
	{
		$hijri_year = $this->get_hijri_year();

		$this->db->where('calendar.year',$hijri_year);
		$this->db->where("Qm_date REGEXP '....-..-01'");
		return $this->db->get('calendar')->result();
	}

	public function last_monthly_dates()
	{
		$qmdate = $this->input->post('Qm_date');

		$hijri_year = $this->get_hijri_year();

		$this->db->select('calendar.Qm_date,calendar.Sh_date');
		$this->db->where('calendar.year',$hijri_year);
		$this->db->like("Qm_date",$qmdate);
		return $this->db->get('calendar')->result();
	}

	public function change_date()
	{
		$qmdate = $this->input->post('Qm_date');
		$day = $this->input->post('date');

		$date = $qmdate.'-'.'30';
		$q = $this->db->get_where('calendar',['Qm_date'=>$date]);

		//30 tarikh thi, or user ne 30 select ki
		if ($q->num_rows() > 0 && $day == '30')
		{
			$this->session->set_flashdata('error_msg','تبدیلی نہیں ہوئی');
			redirect('Calendar');
		}

		//29 thi, or user ne 29 select ki
		if ($q->num_rows() == 0 && $day == '29')
		{
			$this->session->set_flashdata('error_msg','تبدیلی نہیں ہوئی');
			redirect('Calendar');
		}

		//30 tarikh thi, or user ne 29 select ki
		if ($q->num_rows() > 0 && $day == '29')
		{
			//***get start shamsi date
			$get_date = $this->db->get_where('calendar',['Qm_date'=>$qmdate.'-'.$day])->row()->Sh_date;
			$start_date_sh = date('Y-m-d',strtotime($get_date)+86400);
			//*************************
			$date_explode = explode('-',$qmdate);
			$year = $date_explode[0];
			$month = $date_explode[1];
			if ($month == '12')
			{
				$year++;
				$month = '01';
			}
			else
			{
				$month++;
				$month = (strlen($month) == 1) ? '0' . $month : $month;
			}

			$start_date = $year.'-'.$month.'-01';

			$Post_date_last = $this->get_max_date();
			//Deleting dates
			$delete = $this->delete_dates_after($qmdate.'-'.$day);

			if ($delete)
			{
				$this->generate_calendar($Post_date_last,$start_date,$start_date_sh);
			}
		}

		//29 thi, or user ne 30 select ki
		if ($q->num_rows() == 0 && $day == '30')
		{
			//***get start shamsi date
			$get_date = $this->db->get_where('calendar',['Qm_date'=>$qmdate.'-29'])->row()->Sh_date;
			$start_date_sh = date('Y-m-d',strtotime($get_date)+86400);
			//*************************
			$date_explode = explode('-',$qmdate);
			$year = $date_explode[0];
			$month = $date_explode[1];

			$start_date = $year.'-'.$month.'-30';
			$Post_date_last = $this->get_max_date();

			//Deleting dates
			$delete = $this->delete_dates_after($qmdate.'-29');
			if ($delete)
			{
				$this->generate_calendar($Post_date_last,$start_date,$start_date_sh);
			}
		}
	}

	public function generate_calendar($Post_date_last,$start_date,$start_date_sh)
	{
		$Post_date_day = substr($Post_date_last[0]->Sh_date, 8, 2);
		$Post_date_month = substr($Post_date_last[0]->Sh_date, 5, 3);
		$Post_date_year = substr($Post_date_last[0]->Sh_date, 0, 5);
		$Post_batch = substr($Post_date_last[0]->Qm_date, 2, 2);
		$Post_date_day++;
		$Post_date_day = (strlen($Post_date_day) == 1) ? '0' . $Post_date_day : $Post_date_day;
		$Post_date = $Post_date_year . $Post_date_month . $Post_date_day;

		$Sh_date_to_Start = $start_date_sh;
		//$Sh_date_to_Start = $Post_date;

		$qm_batch_start = $Post_batch;//$_POST['batch'];
		$qm_batch_end = $qm_batch_start + 1;

		$sh_batch_start = substr($Sh_date_to_Start, 2, 2);
		$sh_batch_end = $sh_batch_start + 1;

//		echo $qm_batch_start . ' - ' . $qm_batch_end . '<br>';
//		echo $sh_batch_start . ' - ' . $sh_batch_end;

		$qmday = array('01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30);
		$qmmonth = array('01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12);
		$qmyear = array('14' . $qm_batch_start, '14' . $qm_batch_end);

		$check = 'false';
		for ($a = 0; $a < count($qmyear); $a++) {
			for ($b = 0; $b < count($qmmonth); $b++) {
				for ($c = 0; $c < count($qmday); $c++) {
					$qmdate[] = $qmyear[$a] . "-" . $qmmonth[$b] . "-" . $qmday[$c];
				}
			}
		}

		$shday = array('01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31);
		$shmonth = array('01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12);
		$shyear = array('20' . $sh_batch_start, '20' . $sh_batch_end);
		$shDayName = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

		for ($a = 0; $a < count($shyear); $a++) {
			for ($b = 0; $b < count($shmonth); $b++) {
				for ($c = 0; $c < count($shday); $c++) {
					if ($b == 1 && $c == 28) {
						if ($shyear[$a] == '2016' || $shyear[$a] == '2020' || $shyear[$a] == '2024' || $shyear[$a] == '2028' || $shyear[$a] == '2032') {
						} else continue 2;
					} elseif ($b == 1 && $c == 29 && ($shyear[$a] == '2016' || $shyear[$a] == '2020' || $shyear[$a] == '2024' || $shyear[$a] == '2028' || $shyear[$a] == '2032')) {
						continue 2;
					} elseif (($b == 3 || $b == 5 || $b == 8 || $b == 10) && $c == 30) {
						continue 2;
					}
					$sh_date = $shyear[$a] . "-" . $shmonth[$b] . "-" . $shday[$c];
					$shdate[] = $sh_date;
				}
			}
		}
		$sh_start = array_search($Sh_date_to_Start, $shdate);

		$Qm_date_to_Start = $start_date;
		$qm_start = array_search($Qm_date_to_Start, $qmdate);

		$b = 0;
		for ($d = 0; $d < count($qmdate); $d++) {
			$dates[$b]['id'] = '';
			$b++;
			if ($b > 353) {
				break;
			}
		}

		$b = 0;
		$w = 0;
		for ($a = $qm_start; $a < count($qmdate); $a++) {
			$dates[$b]['Qm_date'] = ($qmdate[$a]);
			if ($w == 7) {
				$w = 0;
			}
			if ($dates[$b]['Qm_date'][8] . $dates[$b]['Qm_date'][9] == '30' || $dates[$b]['Qm_date'][8] . $dates[$b]['Qm_date'][9] == '01') {
				$dates[$b]['day'] = 'y';
			} else {
				$dates[$b]['day'] = 'n';
			}
			if ($b > 352) {
				break;
			}
			$b++;
			$w++;
		}

		$b = 0;
		for ($c = $sh_start; $c < count($shdate); $c++) {
			if (!empty($dates[$b]['Qm_date'])) {
				$dates[$b]['Sh_date'] = ($shdate[$c]);
				$dates[$b]['IsActive '] = 1;
				$dates[$b]['year'] = $qmyear[0];
				$b++;
			}
			if ($b > 353) {
				break;
			}
		}

		$check = $this->save_data($dates);

		if ($check) {
			$this->session->set_flashdata('success_msg','Done');
			redirect('Calendar', 'refresh');
		} else {
			$this->session->set_flashdata('error_msg','Error');
			redirect('Calendar', 'refresh');
		}
	}

	public function delete_dates_after($date)
	{
		$this->db->where('year',$this->get_hijri_year());
		$this->db->where("Qm_date >",$date);
		if($this->db->delete('calendar'))
		{
			return true;
		}
	}

    public function save_data($HDate)
    {
    	$year_end_date = $this->db->get_where('year_setup',['year'=>$this->get_hijri_year()])
									->row()->end_date;

		foreach ($HDate as $date)
		{
			$this->db->set('year',$this->get_hijri_year());
			$this->db->insert('calendar',$date);

			//***Stop at financial year end************
			if ($date['Sh_date'] == $year_end_date) break;
		}

		if($this->db->affected_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
    }

    public function getAllIds($from,$to)
    {
        $this->db->select('*');
        $this->db->where('id >=', $from);
        $this->db->where('id <=', $to);
        return $this->db->get('calendar')->result();
    }

    public function getHijriDate($qmdate)
    {
        $this->db->select('*');
        $this->db->where('Sh_date', $qmdate);
        return $this->db->get('calendar')->result();
    }

    public function getGeoDate($Qmdate)
    {
        $this->db->select('*');
        $this->db->where('Qm_date', $Qmdate);
        return $this->db->get('calendar')->result();
    }

    public function getLastInserted()
    {
        $this->db->select_max('id');
        return $this->db->get('calendar')->result();
    }

    public function update($NewDates,$lenOfIds,$InsertDate,$change = '')
    {
        for ($i = 0; $i < $lenOfIds; $i++){
            if ($change == '1'){                    //  -1
                if($i != 1){
                    $data = array('Qm_date' => $NewDates[$i]['Qm_date'],
                        'day' => $NewDates[$i]['day']);
                    $this->db->where('id', $NewDates[$i]['id']);
                    $this->db->update('calendar', $data);
                }
            }else{                                  //  +1
                $data = array(
                    'Qm_date' => $NewDates[$i]['Qm_date'],
                    'day' => $NewDates[$i]['day']
                );
                $this->db->where('id', $NewDates[$i]['id']);
                $this->db->update('calendar', $data);
            }
        }
        if ($change == '1'){
            if($this->db->affected_rows() > 0){
                $this->db->delete('calendar', array('id' => $InsertDate));
                if($this->db->affected_rows() > 0){
                    return true;
                }else{
                    return false;
                }
            }
            else{
                return false;
            }
        }else{
            if($this->db->affected_rows() > 0){
                    return true;
            }
            else{
                return false;
            }
        }
    }

    public function update_Day($id,$day)
    {
        $this->db->set('day',$day);
        $this->db->where('id',$id);
        $this->db->update('calendar');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function min_id()
    {
        $this->db->select_min('id');
        $this->db->where('year', $this->currentYear);
        return $this->db->get('calendar')->result();
    }

	function get_min_date()
	{
		$min_id = $this->min_id();
		$this->db->select('Sh_date');
		$this->db->where('id', $min_id[0]->id);
		return $this->db->get('calendar')->result();
	}

	public function get_date($date)
	{
		$this->db->select('Qm_date');
		$this->db->where('Sh_date', $date);
		return $this->db->get('calendar')->result();
	}

}
