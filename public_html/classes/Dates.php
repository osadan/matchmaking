<?
	
/**
 * 
 * מחלקה שמטפלת בתצוגה של תאריך עברי והמרתו לתאריך לועזי
 * כל המתודות במחלקה הן סטטיות
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
		 * הפונציה יוצרת שלוש תיבות בחירה לבחירה של תאריך עברי 
		 * יום חודש שנה
		 * @param $selected_year השנה הנבחרת 
		 * @param $selected_month החודש הנבחר
		 * @param $selected_day היום הנבחר
		 * @return הפונקציה מחזירה מחרוזת עבור שכבת התצוגה
		 */
		static function hebraw_date_select_control($selected_year,$selected_month,$selected_day)
		{
			$years = myDates::year(-1,2);
			$months = myDates::month();
			$days  = myDates::days();
			$output .= '<div class="hebraw-date">';	
				$output .= Utils::generate_select_box($days,'select-date days','יום','days','',$selected_day);
				$output .= Utils::generate_select_box($months,'select-date month','חודש','month','',$selected_month);
				$output .= Utils::generate_select_box($years,'select-date years','שנה','years','',$selected_year);
			$output .='</div>';
			return $output;	
		}
		
		/**
		 * 
		 * פונקציה שממירה תאריך שמתקבל מתיבות הבחירה לתאריך שנשמר בדאטה בייס
		 * @param string $year שנה
		 * @param string $month חודש
		 * @param string $day יום
		 * @return string מחרוזת של התאריך
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
		 * הפונקציה ממירה תאריך שנשמר בדאטה בייס
		 * למערך של שנה חודש יום
		 * 
		 * @param  string $num מתוך שדה בדאטה בייס
		 * @return array בפורמט של שנה,חודש ,יום
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
		 * פונקציה שמקבלת מחרוזת שמייצגת תאריך בפורמט נתון 
		 * ומחזירה תאריך עברי עבור שכבת התצוגה
		 * Date format 2011-08-30 23:49:05
		 * @param string $date מחרוזת שמייצגת תאריך
		 * @param $delimiter תו מפריד
		 * @return formatted string תאריך עברי
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
		 * פונקציה שמקבלת תאריך לועזי 
		 * ומחזירה תאריך עברי
		 * @param $year שנה
		 * @param $month חודש
		 * @param $day יום
		 */
		static function hebDateFormat($year,$month,$day)
		{
			return jdtojewish(gregoriantojd($month,$day,$year),true);
		}
		/**
		 * 
		 * פונקציה שמקבלת מחרוזת שמייצגת תאריך 
		 * ומחזירה את השעה עבור שכבת התצוגה
		 * @param string $date
		 */
		static function timeFormat($date)
		{
			$arr = explode(' ',$date);
			return 'שעה: ' . $arr[1];
			
		}
		/**
		 * 
		 * פונקציה שמחשבת שנת לידה לועזית 
		 * לפי גיל
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
		 * פונקציה שמחשבת גיל לפי שנת לידה
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
		 * הפונקציה מחזירה מערך של ימים לפי לוח השנה העברי
		 */
		static function days() 
		{
			return  array ( "0"=>"יום",
				"1" => "א", 
				"2" => "ב", "3" => "ג", "4" => "ד", "5" => "ה", "6" => "ו", "7" => "ז", "8" => "ח", "9" => "ט", "10" => "י", "11" => "יא", "12" => "יב", "13" => "יג", "14" => "יד", "15" => "טו", "16" => "טז", "17" => "יז", "18" => "יח", "19" => "יט", "20" => "כ", "21" => "כא", "22" => "כב", "23" => "כג", "24" => "כד", "25" => "כה", "26" => "כו", "27" => "כז", "28" => "כח", "29" => "כט", "30" => "ל"
				);
		}
		/**
		 * 
		 * הפונקציה מחזירה מערך של חודשים לפי הלוח שנה העברי
		 */
		static function month() 
		{
			$mydates = Utils::giveMeMyDates();
			$res[0] = 'חודש';
			$y =date('Y');
			$d = date('d');
			for($i =1 ;$i< 14;$i++){
				$heb_date = jewishtojd ( $i , 1 , $mydates->current_jewish_year );
				$value = explode('/',jdtojewish($heb_date));
				$label = explode(' ',jdtojewish($heb_date,true));
			
				$res[$value[0]] = $label[1];
			}
			$res['7'] = "'אדר";
		 	ksort($res);
			return $res;
			/*return array( "0" => "חודש",
				"1" => "ניסן", "2" => "אייר", "3" => "סיוון", "4" => "תמוז", "5" => "אב", "6" => "אלול", "7" => "תשרי", "8" => "מרחשון", "9" => "כסלו", "10" => "טבת", "11" => "שבט", "12" => "אדר", "13" => "'אדר ב");*/
		}
		
		/**
		 * 
		 * הפונקציה מחזירה מערך של שנים לפי הלוח שנה העברי
		 */
		static function year ($start = 0  , $end = 60) 
		{
		/*	$res =  array ( "0" => "שנה",
"1940" => "התש", "1941" => "התשא", "1942" => "התשב", "1943" => "התשג", "1944" => "התשד", "1945" => "התשה", "1946" => "התשו", "1947" => "התשז", "1948" => "התשח", "1949" => "התשט", "1950" => "התשי", "1951" => "התשיא", "1952" => "התשיב", "1953" => "התשיג", "1954" => "התשיד", "1955" => "התשיה", "1956" => "התשיו", "1957" => "התשיז", "1958" => "התשיח", "1959" => "התשיט", "1960" => "התשכ", "1961" => "התשכא", "1962" => "התשכב", "1963" => "התשכג", "1964" => "התשכד", "1965" => "התשכה", "1966" => "התשכו", "1967" => "התשכז", "1968" => "התשכח", "1969" => "התשכט", "1970" => "התשל", "1971" => "התשלא", "1972" => "התשלב", "1973" => "התשלג", "1974" => "התשלד", "1975" => "התשלה", "1976" => "התשלו", "1977" => "התשלז", "1978" => "התשלח", "1979" => "התשלט", "1980" => "התשמ", "1981" => "התשמא", "1982" => "התשמב", "1983" => "התשמג", "1984" => "התשדמ", "1985" => "התשמה", "1986" => "התשמו", "1987" => "התשמז", "1988" => "התשמח", "1989" => "התשמט", "1990" => "התשנ", "1991" => "התשנא", "1992" => "התשנב", "1993" => "התשנג", "1994" => "התשנד", "1995" => "התשנה", "1996" => "התשנו", "1997" => "התשנז", "1998" => "התשנח", "1999" => "התשנט", "2000" => "התשס", "2001" => "התשסא", "2002" => "התשסב", "2003" => "התשסג", "2004" => "התשסד");
			$res[2005] = "התשסה"; 
			$res[2006] = "התשסו";
			$res[2007] = "התשסז";
			$res[2008]= "התשסח";
			$res[2009]= "התשסט";
			$res[2010]= "התשע";
			$res[2011]= "התשעא";
			$res[2012]= "התשעב";
			$res[2013]= "התשעג";
			$res[2014]= "התשעד";
			$res[2015]= "התשעה";
			return $res;*/
			$res[0] = 'שנה';
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
		 * פונקציה שמחזירה מערך של שעות
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
		 * פונקציה שמקבלת עמודה סדרתית מהדאטה בייס 
		 * ומנתחת אותה למערך שכולל יום ושעה
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