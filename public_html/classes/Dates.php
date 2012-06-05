<?
	
/**
 * 
 * ����� ������ ������ �� ����� ���� ������ ������ �����
 * �� ������� ������ �� ������
 *
 */
	class myDates
	{
		public $current_jewish_year;
		public $current_jewish_date;
		public $current_jewisht_month;
		function __construct()
		{
			$heb_date = jdtojewish(gregoriantojd(date('m'),date('d'),date('Y')));
			list($this->current_jewish_month, $this->current_jewish_date, $this->current_jewish_year) = explode('/',$heb_date);
			
		}
		/**
		 * 
		 * ������� ����� ���� ����� ����� ������ �� ����� ���� 
		 * ��� ���� ���
		 * @param $selected_year ���� ������ 
		 * @param $selected_month ����� �����
		 * @param $selected_day ���� �����
		 * @return �������� ������ ������ ���� ���� ������
		 */
		static function hebraw_date_select_control($selected_year,$selected_month,$selected_day)
		{
			$years = myDates::year(-1,2);
			$months = myDates::month();
			$days  = myDates::days();
			$output .= '<div class="hebraw-date">';	
				$output .= Utils::generate_select_box($days,'select-date days','���','days','',$selected_day);
				$output .= Utils::generate_select_box($months,'select-date month','����','month','',$selected_month);
				$output .= Utils::generate_select_box($years,'select-date years','���','years','',$selected_year);
			$output .='</div>';
			return $output;	
		}
		
		/**
		 * 
		 * ������� ������ ����� ������ ������ ������ ������ ����� ����� ����
		 * @param string $year ���
		 * @param string $month ����
		 * @param string $day ���
		 * @return string ������ �� ������
		 */
		static function fromHebToDb($year,$month =0 ,$day =0 )
		{
			$dates = Utils::giveMeMyDates();
			$month_g = $month == 0 ? $dates->current_jewish_month  : $month;
			$day_g = $day == 0 ? $dates->current_jewish_date: $day;
			if ($year != 0){
				
				$jdtounix = jdtounix(jewishtojd ( $month_g , $day_g, $year ));
				
				$year_n = date('Y',$jdtounix);
				$month_n = $month == 0 ? '00' : Utils::add_zero_for_single_number(date('m',$jdtounix));
				$day_n = $day == 0 ? '00' :   Utils::add_zero_for_single_number(date('d',$jdtounix));
				
				return $year_n.$month_n.$day_n;
			}else {
				return 0;
			}
		}
		/**
		 * 
		 * �������� ����� ����� ����� ����� ����
		 * ����� �� ��� ���� ���
		 * 
		 * @param  string $num ���� ��� ����� ����
		 * @return array ������ �� ���,���� ,���
		 */
		static function fromDbToHeb($num)
		{
			//$arr = new Array();
			//echo $num;
			$y= substr($num,0,4);
			$m = ( substr($num,4,2) > 10 ?  substr($num,4,2)  : substr($num,5,1) );
			$d = (substr($num,6,2) > 10 ? substr($num,6,2) : substr($num,7,1) );
			//$date = date('Y-m-d',mktime(0,0,0,$m,$d,$y));
			//list($year,$month,$day) = explode('-',$date);
			$m_fixed = $m == 0 ? 1 : $m;
			$d_fixed = $d == 0 ? 1 : $d;
			 
			$heb_date = gregoriantojd($m_fixed,$d_fixed,$y);
			
			$value = explode('/',jdtojewish($heb_date));
			$arr['year'] = $value[2];
			$arr['month'] = $m == 0 ? 0 : $value[0];
			$arr['day'] = $d == 0 ? 0 : $value[1];
			return $arr;
		}
		/**
		 * ������� ������ ������ ������� ����� ������ ���� 
		 * ������� ����� ���� ���� ���� ������
		 * Date format 2011-08-30 23:49:05
		 * @param string $date ������ ������� �����
		 * @param $delimiter �� �����
		 * @return formatted string ����� ����
		 */
		static function fromDbToHeb2($date,$delimiter = '-')
		{
			$arr = explode(' ',$date);
			$res = explode($delimiter,$arr[0]);
			if ($res[1] < 10)
				$res[1] = substr($res[1],1,1);
			if($res[2] < 10 )
				$res[2] = substr($res[2],1,1);
			return   myDates::hebDateFormat($res[0],$res[1],$res[2]);
		}
		
		/**
		 * 
		 * ������� ������ ����� ����� 
		 * ������� ����� ����
		 * @param $year ���
		 * @param $month ����
		 * @param $day ���
		 */
		static function hebDateFormat($year,$month,$day)
		{
			return jdtojewish(gregoriantojd($month,$day,$year),true);
		}
		/**
		 * 
		 * ������� ������ ������ ������� ����� 
		 * ������� �� ���� ���� ���� ������
		 * @param string $date
		 */
		static function timeFormat($date)
		{
			$arr = explode(' ',$date);
			return '���: ' . $arr[1];
			
		}
		/**
		 * 
		 * ������� ������ ��� ���� ������ 
		 * ��� ���
		 * @param int $age
		 */
		static function calcAge($age)
		{
			if($age != "")
				return date('Y') - $age;	
			else
				return "";
				
		}
		/**
		 * 
		 * ������� ������ ��� ��� ��� ����
		 * @param int $year
		 */
		static function deCalcAge($year)
		{
			if ($year !=""){
				return date('Y') - $year;
			}else{
				return "";
			}
		}
		/**
		 * 
		 * �������� ������ ���� �� ���� ��� ��� ���� �����
		 */
		static function days() 
		{
			return  array ( "0"=>"���",
				"1" => "�", 
				"2" => "�", "3" => "�", "4" => "�", "5" => "�", "6" => "�", "7" => "�", "8" => "�", "9" => "�", "10" => "�", "11" => "��", "12" => "��", "13" => "��", "14" => "��", "15" => "��", "16" => "��", "17" => "��", "18" => "��", "19" => "��", "20" => "�", "21" => "��", "22" => "��", "23" => "��", "24" => "��", "25" => "��", "26" => "��", "27" => "��", "28" => "��", "29" => "��", "30" => "�"
				);
		}
		/**
		 * 
		 * �������� ������ ���� �� ������ ��� ���� ��� �����
		 */
		static function month() 
		{
			$mydates = Utils::giveMeMyDates();
			$res[0] = '����';
			$y =date('Y');
			$d = date('d');
			for($i =1 ;$i< 14;$i++){
				$heb_date = jewishtojd ( $i , 1 , $mydates->current_jewish_year );
				$value = explode('/',jdtojewish($heb_date));
				$label = explode(' ',jdtojewish($heb_date,true));
			
				$res[$value[0]] = $label[1];
			}
			$res['7'] = "'���";
		 	ksort($res);
			return $res;
			/*return array( "0" => "����",
				"1" => "����", "2" => "����", "3" => "�����", "4" => "����", "5" => "��", "6" => "����", "7" => "����", "8" => "������", "9" => "����", "10" => "���", "11" => "���", "12" => "���", "13" => "'��� �");*/
		}
		
		/**
		 * 
		 * �������� ������ ���� �� ���� ��� ���� ��� �����
		 */
		static function year ($start = 0  , $end = 60) 
		{
		/*	$res =  array ( "0" => "���",
"1940" => "���", "1941" => "����", "1942" => "����", "1943" => "����", "1944" => "����", "1945" => "����", "1946" => "����", "1947" => "����", "1948" => "����", "1949" => "����", "1950" => "����", "1951" => "�����", "1952" => "�����", "1953" => "�����", "1954" => "�����", "1955" => "�����", "1956" => "�����", "1957" => "�����", "1958" => "�����", "1959" => "�����", "1960" => "����", "1961" => "�����", "1962" => "�����", "1963" => "�����", "1964" => "�����", "1965" => "�����", "1966" => "�����", "1967" => "�����", "1968" => "�����", "1969" => "�����", "1970" => "����", "1971" => "�����", "1972" => "�����", "1973" => "�����", "1974" => "�����", "1975" => "�����", "1976" => "�����", "1977" => "�����", "1978" => "�����", "1979" => "�����", "1980" => "����", "1981" => "�����", "1982" => "�����", "1983" => "�����", "1984" => "�����", "1985" => "�����", "1986" => "�����", "1987" => "�����", "1988" => "�����", "1989" => "�����", "1990" => "����", "1991" => "�����", "1992" => "�����", "1993" => "�����", "1994" => "�����", "1995" => "�����", "1996" => "�����", "1997" => "�����", "1998" => "�����", "1999" => "�����", "2000" => "����", "2001" => "�����", "2002" => "�����", "2003" => "�����", "2004" => "�����");
			$res[2005] = "�����"; 
			$res[2006] = "�����";
			$res[2007] = "�����";
			$res[2008]= "�����";
			$res[2009]= "�����";
			$res[2010]= "����";
			$res[2011]= "�����";
			$res[2012]= "�����";
			$res[2013]= "�����";
			$res[2014]= "�����";
			$res[2015]= "�����";
			return $res;*/
			$res[0] = '���';
			$year = date('Y');
			$year = $year - $start;
			for ($i = 0;$i <= $end ;$i++ ){
				$heb_year = gregoriantojd(date('m'),date('d'),$year);
				$value = explode('/',jdtojewish($heb_year));
				$label = explode(' ',jdtojewish($heb_year,true));
				$res[$value[2]] = $label[2];
				$year--;
			}
			return $res;
		}
		/**
		 * 
		 * ������� ������� ���� �� ����
		 */
		static function time()
		{
			$time = array();
			for($i = 8; $i <= 24;$i++)
			{
				$time[$i.':00'] = $i.':00';
				$time[$i.':30'] = $i.':30';
			}
			return $time;	
		}
		/**
		 * 
		 * ������� ������ ����� ������ ������ ���� 
		 * ������ ���� ����� ����� ��� ����
		 * @param serialized string $field
		 */
		static function unserialize_date_time_field($field)
		{
			$years = myDates::year();
			$months = myDates::month();
			$days  = myDates::days();
			$date_array =  unserialize($field);
			return array ('time_string' => $date_array['time'],
							'date_string' => $days[$date_array['days']].'\' '.$months[$date_array['month']].' '.$years[$date_array['years']] ) ;
		}
	}
?>