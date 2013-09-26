<?php
namespace PhpSimpleProfiler;


class PhpSimpleProfiler{
	
	/**
	 * Option array:
	 * 	active => true / false  
	 * 	handler =>  IHandler implementation
	 * 	realUsage =>  true / false (true->engine php, false->only script)
	 * 
	 * @var array
	 */
	private $options = array(
									'active' =>true,
									'handler' =>null,
									'realUsage' =>false
									);
	
	
	/**
	 * @var PhpSimpleProfiler\Profiler
	 */
	private $profiler;
	
	
	/**
	 * Initialization of simple profiler with default value
	 * 
	 * @param array $opt (optional) array of option
	 */
	public function __construct($opt = null){
		$this->options['handler'] = new Handler\StreamHandler();	
		
		if($opt != null && is_array($opt)){
			foreach($opt as $o_key=>$o_val){
				$this->setOption($o_key, $o_val);
			}
		}
		
		$this->profiler = new Profiler($this->options['realUsage']);
		
	}
	
	
	/**
	 * Set option if an existing one is given
	 * 
	 * @param string $name option name
	 * @param string $value value to set for the option name
	 */
	public function setOption($name, $value = null){
		if(isset($this->options[$name])){
			$this->options[$name] = $value;
		}
	}
	
	
	/**
	 * Add a record to profile
	 * 
	 * @param string $message (optional) Description of record
	 */
	public function add($message = ''){
		if ($this->options['active'])
			$this->profiler->record($message);
	}
	
	
	/**
	 * Stop the profiler
	 */
	public function stop(){
		if ($this->options['active'])
			$this->profiler->stop();
	}

	
	
	/**
	 * Call printData function of selected handler.
	 */
	public function printData(){
		if ($this->options['active']){
			$result = $this->options['handler']->printData($this->profiler);
		
			if ($this->options['handler']->returnData()){
				return $result;
			}
		}
	}
	
}