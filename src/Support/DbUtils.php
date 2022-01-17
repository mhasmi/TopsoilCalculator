<?php

namespace BagsCalculator\Support;

use mysqli;
use BagsCalculator\Config;
use Exception;

class DbUtils
{

	private static ?mysqli $conn = null;

	private static function createConnection(): void
	{
		self::$conn = new mysqli(Config::$dbHost, Config::$dbUsername, Config::$dbPassword, Config::$dbDatabase, Config::$dbPort);
		if (self::$conn->connect_error) {
			throw new \Exception('Error: ' . self::$conn->error  . '<br />Error No: ' . self::$conn->errno . '<br />');
		}
	}
	private static function getConnection(): mysqli
	{
		if (self::$conn == null) {
			self::createConnection();
		}
		return self::$conn;
	}


	public static function query(string $sql): object
	{
		$conn = self::getConnection();
		$query = $conn->query($sql);

		if (!$conn->errno) {
			if ($query instanceof \mysqli_result) {
				$data = [];

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}

				$result = new \stdClass();
				$result->num_rows = $query->num_rows;
				$result->rows = $data;
				$result->succ = true;

				$query->close();

				unset($data);

				return $result;
			} else {
				$result = new \stdClass();
				$result->num_rows = 0;
				$result->rows = array();
				$result->succ = true;

				return $result;
			}
		} else {
			throw new \Exception('Error: ' . $conn->error  . '<br />Error No: ' . $conn->errno . '<br />' . $sql);
		}
	}

	public static function escape(string $value): string
	{
		$conn = self::getConnection();
		return $conn->real_escape_string($value);
	}
}
