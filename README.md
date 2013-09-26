PhpSimpleProfiler
=================

Lightweight php profiler library

##Install
You may install the PhpSimpleProfiler with [Composer](http://getcomposer.org/) (recommended) or manually.


##Usage
This example assumes you are autoloading dependencies using Composer or any other [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) compliant autoloader.

PhpSimpleProfiler available method:

- setOption($name , $value)
	Set the option (if $name is a valid option name) value with the desidered one.
	Available option : 
		'active' (bool) (default = true) If setted to false no profile will recorded 
		'handler' (PhpSimpleProfiler\Handler\IHandler) (default = PhpSimpleProfiler\HandlerStreamHandler) The object that manipulate and return the data
		'realUsage' (bool) (default = false) Set it to TRUE to get the real size of memory allocated from system (all the memory used by the engine php), set it to FALSE to get only the memory used by emalloc() (only script)
	
- add($message)
	Add an entry to the statistical profile.
	
- stop()
	Ends the profiler.
	
- printData()
	Gets the data.
	


###Example
```php
// Create a new PhpSimpleProfiler
$psp = new PhpSimpleProfiler\PhpSimpleProfiler(array('realUsage' =>true));

// Add profiled entry
$psp->add('Before loop');

$y = 0;
for($i = 0; $i<1000; ++$i){
	$y++;	
}

// Add profiled entry
$psp->add('After loop');

// Stop the profiler
$psp->stop();

// Print the result
echo $psp->printData();

// You shold see something like this:
/*
Time: 1380207924 | Memory Usage: 0.75 MB | execution_time: 1.4066696166992E-5 | Info: Initial state
Time: 1380207924 | Memory Usage: 0.75 MB | execution_time: 0.00024199485778809 | Info: Before loop
Time: 1380207924 | Memory Usage: 0.75 MB | execution_time: 0.00027799606323242 | Info: After loop
Time: 1380207924 | Memory Usage: 0.75 MB | execution_time: 1.6927719116211E-5 | Info: Final state

Peak of memory usage: 0.75 MB

CPU elaboration time: 0.00055694580078125
*/


````




##License
The PhpSimpleProfiler is released under the MIT public license