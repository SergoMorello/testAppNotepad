<?php
class appService extends core {
	public function boot() {
		//
	}
	
	public function register() {
		app::singleton('mainClass', function() {
			return new class{
				public function cuteText($text, $size = 100) {
					$value = "";
					$new_size = $size;
					$fullLen = strlen($text);
					for($i = 0; $i < $fullLen; $i++){
						$new_size = $size+$i;
						$nextVal = $fullLen > $new_size ? $text[$new_size] : $text[$fullLen-1];
						if ($fullLen < $new_size OR $nextVal == " ")
							break; 
						if ($nextVal == ")") {
							$new_size++;
							break;
						}
					}
					$value = substr($text, 0, $new_size);
					if ($fullLen > $new_size) {
						$value .= "...";
					}
					return $value;
				}

				public function showDate($value) {
					if (!is_string($value))
						return;
					list($date, $time) = explode(' ', $value);
					list($year, $month, $day) = explode('-', $date);
					list($hour, $minutes, $seconds) = explode(':', $time);

					return $day.'.'.$month.'.'.$year.' в '.$hour.':'.$minutes;
				}
			};
			
		});
	}
}