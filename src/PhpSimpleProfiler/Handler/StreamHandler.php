<?php
namespace PhpSimpleProfiler\Handler;

/**
 * Return the data of profiler as a string.
 * 
 * This handler is intended to print profile data in a log file
 */
class StreamHandler extends  AbstractHandler{
	
	/**
	 * Printing function.
	 */
	public function printData(\PhpSimpleProfiler\Profiler $profiler){
		$statistics = $profiler->getStat();
		
		$strToLog = "\n\n";
    	foreach ($statistics as $satistic) {
	    	$strToLog .=  "Time: " . $satistic['time'] . 
	              " | Memory Usage: " . $this->byteFormat($satistic['memory_usage'], 'MB') . 
	              " | execution_time: " . $satistic['execution_time'] .
				  " | Info: " . $satistic['info'];
	   		$strToLog .= "\n";
    	}
    	$strToLog .= "\n";
   		$strToLog .= "Peak of memory usage: " . $this->byteFormat($profiler->getPeakMemoryUsage(), 'MB');
    	$strToLog .= "\n\n";
    	$strToLog .= "CPU elaboration time: " . $profiler->getTotalTime();
    	$strToLog .= "\n\n";
		
		return $strToLog;
	}
	
	public function returnData(){
		return true;
	}
}