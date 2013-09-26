<?php
namespace PhpSimpleProfiler\Handler;

/**
 * 
 * Interface for the handler to manage information from profiler
 * 
 */
interface IHandler {
	
	/**
	 * Every handler have to print the statistical data of the profiler 
	 */
	public function printData(\PhpSimpleProfiler\Profiler $profiler);
	//public function printData($profiler);
	
	
	/**
	 * If false the handler manage directly the data to the output, else return a the data as result of printData function
	 */
	public function returnData();
	
}