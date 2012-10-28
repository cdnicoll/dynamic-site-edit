<?php

/*
@author:    cNicoll
@name:	    
@date:      01-26-10_14-24

RELEASE NOTES:
    [ ] The password stored within the DB _MUST_ be sha1() which has a length of 40 characters
    [ ] The id encryption is md5()
==========================================================================================
@version 1.0 | 01-26-10_14-24
	[ ] Creates an object that will set a cookie and session for the user if they login
	[ ] Check if there is already a cookie in place, if there is grab the information needed
	    for automatic login
	[ ] Gives the user an additional option to store the cookie for up to a month or what the
	    value of REMEMBER_EXPIRE is set to
	[ ] Log the user out upon request, destroying all cookies and sessions.
	
HEADER:
==========================================================================================
public:
	Login()
	getUserId()
	setUserId($id)
private:
	$model
	$errors
	$userId
	$username
	$password
	$cookieExpireTime
	$domain
	$logged
*/

include_once('model.class.php');

define ('SUGAR', 'a5a33aD51');

define('REMEMBER_EXPIRE', 60*60*24*30);		// expire in 30 days (2592000)
define('EXPIRE_DEFAULT', 3600);				// expire in 1 hour
define('EXPIRE_NOW',  -3600);              // expire -1 hour ago

class Login
{
    private $model;
    private $errors = array();
    
    private $userId;
    private $username;
    private $password;
    
    private $cookieExpireTime;
    private $domain;
    
    private $logged;
    
    /*
    * @param
    *	
    * @return
    *	
    * @comment
    * 	Set the default expire times on cookies
	*	Set the Domain (currently not in use)
	*	Set the logged status to FALSE (currently not used)
    * @time
    * 	01-26-10_14-24
    */
    public function Login()
    {
        $this->model = new Model();
        
        $this->setCookieExpireTime(EXPIRE_DEFAULT);
        $this->setDomain('localhost/');
        $this->setLogged(false);
    }
    
    // @return user id
    public function getUserId()
    {
        return $this->userId;
    }
    
    // @param user id
    public function setUserId($id)
    {
        $this->userId = $id;
    }
    
    // @return username
    public function getUserName()
    {
        return $this->username;
    }
    
    // @param username
    public function setUserName($u)
    {
        $this->username = $u;
    }
    
    // @return password
    public function getPassword()
    {
        return $this->password;
    }
    
   // @param password
    public function setPassword($p)
    {
        $this->password = $p;
    }
    
    // @return value of time before cookie expires
    public function getCookieExpireTime()
    {
        return $this->cookieExpireTime;
    }
    
    // @param amount of time for cookie to expire
    public function setCookieExpireTime($time)
    {
        $this->cookieExpireTime = time()+$time;
    }
    
    // @return domain nane
    public function getDomain()
    {
        return $this->domain;
    }
    
    // @param domain nane
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }
    
    // @return bool
    public function getLogged()
    {
        return $this->logged;
    }
    
    // @param bool if ok
    public function setLogged($bool)
    {
        $this->logged = $bool;
    }
    
    // @return error array
    public function getErrors()
    {
        return $this->errors;
    }
        
    /* =====================================================================================================================
    ========================================================================================================================
    ======================================================================================================================== */
 
    /*
    * @param
    *	string 	username
	*	string 	password
	*	bool	remember user
    * @return
    *	bool if user can login
    * @comment
    * 	Creates a session for the user, also sets a cookie to the default value. However
	*	if the user has opt to save their password a cookie is set for the REMEMBER_EXPIRE
    * @time
    * 	01-27-10_13-02
    */
    public function userLogin($username, $password, $remember)
    {
        $user = $this->model->checkLogin($username, $password);
        
        // at least an ID and username. Other fields are optional. PASSWORD IS NOT TO BE SENT
        if (sizeof($user) >= 2) {
            FB::log($user, 'login->userLogin()[user]');
            //session_start();
            
            // set login details
            $this->setUserId($user['user_id']);
            $this->setUserName($user['username']);
            $this->setPassword($password);
            
            // set session
            $_SESSION['user_id'] = md5(SUGAR+$this->getUserID());
            $_SESSION['username'] = $this->getUserName();
            
           //FB::log($_SESSION['user_id'], '$_SESSION[user_id]');
           //FB::log($_SESSION['username'], '$_SESSION[username]');
            // make cookie
            $remember ? $this->setCookieExpireTime(REMEMBER_EXPIRE) : $this->setCookieExpireTime(EXPIRE_DEFAULT);
            setcookie("user_id", md5(SUGAR+$this->getUserID()), $this->getCookieExpireTime(), "/");
            setcookie("username", $this->getUserName(), $this->getCookieExpireTime(), "/");
            
            // return status of logged
            $this->setLogged(true);
            FB::log($this->getLogged(), 'login->userLogin()[logged]');
            return $this->getLogged();
        }
        // error
        $this->setLogged(false);
        
        FB::log($this->getLogged(), 'login->userLogin()[logged]');
        return $this->getLogged();
    }
    
    /*
    * @param
    *	hash value of user id
    *   string username
    * @return
    *   string user password
    * @comment
    * 	connects to the database and gets the password and id of the user supplied
    *   it then adds the SUGAR to the cookie the uses and if statement to check if the
    *   encrypted userid is the same as the one within the parameters. If it is return
    *   the password. 
    * @time
    * 	01-27-10_15-51
    */
    public function checkCookie($userId, $username)
    {
        // get the userid and password, compare the id against the hash key, if its true return the password
        $cookie = $this->model->checkCookie($username);
        FB::log($cookie, 'checkCookie->$cookie');
        FB::log($userId, 'checkCookie->$userId');
        FB::log($username, 'checkCookie->$username');
        $db_cookie_id = (sizeof($cookie) > 0 ? SUGAR+$cookie['user_id'] : 0);
        
        
        if (md5($db_cookie_id) == $userId) {
            return $cookie['password'];
        }
    }
    
    /*
    * @param
    *	
    * @return
    *	@bool true once script has executed
    * @comment
    * 	unset all the data
    *   destroy the session
    *   destroy the cookies
    * @time
    * 	01-27-10_13-57
    */
    public function userLogout()
    {
        // reset user data
        $this->setUserId("");
        $this->setUserName("");
        $this->setPassword("");
        $this->setCookieExpireTime(EXPIRE_NOW);
        $this->setLogged(false);
        
        // destroy sessions
		session_unset();
		session_destroy();
		
		// destroy cookies
		setcookie("user_id", $this->getUserID(), $this->getCookieExpireTime(),"/");
        setcookie("username", $this->getUserName(), $this->getCookieExpireTime(),"/");
		
		return true;
    }
}

?>