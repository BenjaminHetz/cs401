<?php

require_once 'KLogger.php';

class DAO
{
    private $host = "localhost";
    private $db   = "cs401";
    private $user = "bhetz";
    private $pass = "mK1em@go4%i4";
    private $log;

    public function __construct()
    {
        $this->log = new KLogger("/var/log/bookcollector.log", KLogger::WARN);
	}

	public function getConnection()
	{
		$this->log->LogDebug("Attempting Connection to MySQL . . .");
		try {
			$conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
		}
		