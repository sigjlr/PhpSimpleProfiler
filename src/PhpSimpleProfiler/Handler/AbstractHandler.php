<?php
namespace PhpSimpleProfiler\Handler;


class AbstractHandler implements IHandler{

	/**
	 * Printing function.
	 * Must be override in child classes 
	 */	
	public function printData(\PhpSimpleProfiler\Profiler $profiler){}

	
	/**
	 * If false the handler manage directly the data to the output, else return a the data as result of printData function
	 */	
	public function returnData(){}
	
		
	/**
	 * Formatting function
	 * 
	 * @param string $bytes Value in bytes
	 * @param string $unit (optional) Unit of measure
	 * @param string $decimals (optional) Number of decimal to log
	 * 
	 * @return string 	
	 */
	protected function byteFormat($bytes, $unit = '', $decimals = 2) {
		$units = array('B' => 0, 
							   'KB' => 1,
							   'MB' => 2,
							   'GB' => 3,
							   'TB' => 4,
							   'PB' => 5,
							   'EB' => 6,
							   'ZB' => 7,
							   'YB' => 8
							  );

		$value = 0;
		
		if ($bytes > 0) {
			// If wrong prefix given, generate automatic prefix by bytes 
			if (!array_key_exists($unit, $units)) {
				$pow = floor(log($bytes)/log(1024));
				$unit = array_search($pow, $units);
			}

			// Calculate byte value by prefix
			$value = ($bytes/pow(1024,floor($units[$unit])));
		}

		// If decimals is not numeric or decimals is less than 0 then set default value
		if (!is_numeric($decimals) || $decimals < 0) {
			$decimals = 2;
		}

		// Format output
		return sprintf('%.' . $decimals . 'f '.$unit, $value);
	}
}