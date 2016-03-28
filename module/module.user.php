<?

include_once("constants.php");

//user module & class
//Handles User Login & Registration

Class User {

  //Holds the database object for interacting with the DB
  private $db;

  function __construct($db=NULL){
    if(is_object($db))
    {
        $this->db = $db;
    } else {
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.';charset=UTF8';
        $opt = array(
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->db = new PDO($dsn, DB_USER, DB_PASS, $opt);
    }
  }

  public function register($username,$password,$firstname,$lastname,$address,$email,$phone){
    //sql = "";
    //$stmt = $this->db->prepare(sql);
    //$stmt->execute();
    return $username;
  }

  public function login($name, $pass){

  }

}

?>
