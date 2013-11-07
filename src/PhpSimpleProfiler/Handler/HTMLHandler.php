<?php
namespace PhpSimpleProfiler\Handler;

/**
 * Return the data of profiler as an HTML table into the div element #PHPSimpleProfiler.
 * 
 * This handler is intended to show data into a web page
 */
class HTMLHandler extends  AbstractHandler{
	
	/**
	 * Printing function.
	 */
	public function printData(\PhpSimpleProfiler\Profiler $profiler){
		$statistics = $profiler->getStat();
		
		$strHead = "<table><thead><tr>";
		$strHead .= "<th>Time</th>";
		$strHead .= "<th>Memory Usage</th>";
		$strHead .= "<th>Execution Time</th>";
		$strHead .= "<th>Info</th>";
		$strHead .= "</tr></thead>";
        
		$strBody = "<tbody>";
    	foreach ($statistics as $satistic) {
    		$strBody .= "<tr>";
	    	$strBody .= "<td>".$satistic['time']."</td>";
	        $strBody .= "<td>".$this->byteFormat($satistic['memory_usage'], 'MB')."</td>";
	        $strBody .= "<td>".$satistic['execution_time']."</td>";
			$strBody .= "<td>". $satistic['info']."</td>";
			$strBody .= "</tr>";
    	}
		$strBody .= "</tbody></table>";
    	
    	$strFooter ='';
   		$strFooter .= "Peak of memory usage: " . $this->byteFormat($profiler->getPeakMemoryUsage(), 'MB');
    	$strFooter .= "<p>";
    	$strFooter .= "CPU elaboration time: " . $profiler->getTotalTime();

		
		return "<div id='PHPSimpleProfiler'>".$strHead.$strBody.$strFooter."</div>";
	}
	
	public function returnData(){
		return true;
	}
}



