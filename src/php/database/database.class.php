<?php

// Create this file yourself, it contains database connection information
require_once(ROOT_DIR . "/classes/database_conn_info.php");

class DBConnection {

    public static $conn_info;
    public static $connection;
    public static $sql;

    // ALPHABETICAL ORDER (or is it?)
    public static $table_dungeon = "dungeon";

    public static function db_connect() {
        DBConnection::$sql = new mysqli(
                DBConnection::$conn_info->host,
                DBConnection::$conn_info->user,
                DBConnection::$conn_info->pw,
                DBConnection::$conn_info->db) or die('Cannot connect to database!');

        if (DBConnection::$sql->connect_errno) {
            die("Connect failed: " . DBConnection::$sql->error);
        }
        DBConnection::$sql->query('SET CHARACTER SET utf8');
        // mysqli_select_db($this->db) or die('Cannot select database!'); // $this->sql,
    }

    /**
     * Performs a query on the database.
     * @param type $query The query to execute.
     * @return type The result of the executed query.
     */
    public static function query($query) {
        $result = DBConnection::$sql->query($query);

        DBConnection::check_query($query);

        return $result;
    }

	public static function check_query($query){
		if (DBConnection::$sql->errno != 0) {
			debug_print_backtrace();
			die("<br><br>Query <br><br>'" . $query . "' <br><br>failed: " . DBConnection::$sql->error);
		}
	}

    public static function db_disconnect() {
        // if ($this->sql != null)
        // mysqli_close($this->sql);
    }

    public function __destruct() {
        DBConnection::db_disconnect();
    }
}

// Init the connection info
DBConnection::$conn_info = new DBConnectionInfo();
?>