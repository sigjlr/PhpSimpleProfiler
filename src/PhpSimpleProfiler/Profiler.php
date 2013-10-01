<?php
namespace PhpSimpleProfiler;

/**
 * 
 * Profiler class record the data of varius step of the script
 */
class Profiler{
	
	/**
	 * Start time 
	 * @var float
	 */
	private $startTime;
	
	
	/**
	 * End time of last recorded step 
	 * @var float
	 */
	private $previousEndTime;
	

	/**
	 * Global execution time
	 * @var float
	 */
	private $cpuTime;
	
		
	/**
	 * Array of statistic data
	 * @var Array
	 */
	private $stat = array();
	
	
	/**
	 * Type of memory measured (true->engine php, false->only script) default = false
	* @var bool
	 */
	private $real_usage;
	
	
	/**
	 * Initialize profiler
	 * 
	 * @param bool $realUsage 
	 */
	public function __construct($realUsage  = false){
		$now = explode(' ', microtime());
		$this->startTime = $now[1] + $now [0];
		$this->previousEndTime = $this->startTime;
		$this->real_usage = $realUsage;
		$this->start();
	}
	
	
	/**
	 * First statistical record
	 * @param string $message Description of current step (optional)
	 */
	public function start($message = 'Initial state'){
		$this->record($message);
	}
	
	
	/**
	 * Last statistical record
	 * @param string $message Description of current step (optional)
	 */
	public function stop($message = 'Final state'){
		$this->record($message);
		$end = explode(' ', microtime());
		$this->cpuTime = ($end[1]+$end[0]) - $this->startTime;
	}
	
	
	/**
	 * Record profile data for an application step
	 * 
	 * @param string $message Description of current step (optional)
	 */
	public function record($message = ''){
		$end = explode(' ', microtime());
		$cpu_time = ($end[1]+$end[0]) - $this->previousEndTime;	
		
		$this->stat[] = array('time' => time(), 
										 'info' => $message, 
										 'memory_usage' => memory_get_usage($this->real_usage),
										 'execution_time' => $cpu_time
										 );
										 
		$this->previousEndTime=$end[1]+$end[0];
	}
	
	
	/**
	 * Return peak memory usage
	 */
    public function getPeakMemoryUsage() {
    	return memory_get_peak_usage($this->real_usage);
    }
	
	
	/**
	 * Return statistical array
	 */
    public function getStat() {
    	return $this->stat;
    }
	
	
	/**
	 * Return cpuTime
	 */
    public function getTotalTime() {
    	return $this->cpuTime;
    }
	
}