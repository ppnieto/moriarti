<?php

class Message {
	private $code;
	private $result;
	private $dispatchTime;

	public function __construct($code,$data=null) {
		$this->code = $code;
		$time_start = microtime(true);

		Moriarti::dispatch($this,$data);
		$time_end = microtime(true);
		//Subtract the two times to get seconds
		$time = $time_end - $time_start;
		file_put_contents(__DIR__ . '/messages.log',$this->code . ' - ' . $time . "\r\n",FILE_APPEND );
	}

	public function getCode() {
		return $this->code;
	}

	public function getResult() {
		return $this->result;
	}

	public function setResult($rslt) {
		$this->result = $rslt;
	}

	public function setDispatchTime($t) {
		$this->dispatchTime = $t;
	}

	public function getDispatchTime() {
		return $this->dispatchTime;
	}
}

?>
