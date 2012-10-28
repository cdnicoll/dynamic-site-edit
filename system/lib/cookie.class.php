<?php
/*
@author:    cNicoll
@name:	    
@date:      01-28-10_14-11

RELEASE NOTES: "this cookie has class..."
==========================================================================================
@version 1.0 | 01-28-10_14-11
    Returns information on a cookie, that is if there is one set.

HEADER:
==========================================================================================
public:

private:

*/

class Cookie {
    
    private $cookieInfo = array();
    private $userId;
    private $username;
    private $password;
    private $logged;
    
    public function Cookie()
    {
        $this->setUserId("");
        $this->setUsername("");
        $this->setPassword("");
        $this->setLogged(false);

        if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
            $this->setUserId($_COOKIE['user_id']);       // md5 user id stored within cookie
            $this->setUsername($_COOKIE['username']);    // user name stored within cookie
            $this->setPassword("*****");                // fake key sent to browser if cookies are set
        }
        
        $this->setCookieInfo($this->getUserId(), $this->getUsername(), $this->getPassword(), $this->getLogged());
    }
    
    // @return cookie information
    public function getCookieInfo()
    {
        return $this->cookieInfo;
    }
    
    // @param userid, username, password, logged for the cookie array
    public function setCookieInfo($userId, $userName, $password, $logged)
    {
        $this->cookieInfo = array(
            "user_id" => $userId,
            "username" => $userName,
            "password" => $password,
            "logged" => $logged
        );
    }
    
    // @return userid
    public function getUserId()
    {
        return $this->userId;
    }
    
    // @param userid
    public function setUserId($id)
    {
        $this->userId = $id;
    }
    
    // @return username
    public function getUsername()
    {
        return $this->username;
    }
    
    // @param username
    public function setUserName($username)
    {
        $this->username = $username;
    }
    
    // @return password
    public function getPassword()
    {
        return $this->password;
    }
    
    // @param password
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    // @return password
    public function getLogged()
    {
        return $this->logged;
    }
    
    // @param password
    public function setLogged($logged)
    {
        $this->logged = $logged;
    }
    
}

?>