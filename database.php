<?
require_once "creds.php";
require_once "mailjet.php";

$con = new mysqli("198.71.225.61",$user,$password, "socialUnion");

function addUser($fname, $lname, $username, $password, $emailID, $googleID, $youtubeID, $twitterID) {
    global $con;
    removeRequest($emailID);
    $bytes = openssl_random_pseudo_bytes(8, $cstrong);
    $salt  = bin2hex($bytes);
    $encPwd = crypt($password, $salt);
    $q= $con->prepare("insert into users 
        (fname, lname, username, password, salt, emailID, googleID, youtubeID, twitterID)
        values
            (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
    
    $q->bind_param('sssssssss', $fname, $lname, $username, $encPwd, $salt, $emailID, $googleID, $youtubeID, $twitterID);
    $q->execute();
    
}

function signIn($username, $password) {
    global $con;
    $q = $con->prepare("select id, username, password, salt, emailID from users where username = ?");
    
    $q->bind_param('s', $username);
    $q->execute();
    $result=$q->get_result();
    $array = $result->fetch_array();
    $salt  = $array[3];
    $uPass = $array[2];
    //removeRequest($r[4]);
    $encPwd = crypt($password, $salt);
    $retArr = array();
    
    if ($uPass == $encPwd) {
        $retArr[] = $array[0];
        $retArr[] = $array[1];
    }
    return $retArr;
}

function getUser($username) {
    global $con;
    $q= $con->prepare("select fname, lname, emailID, googleID, youtubeID, twitterID from users where username = ?");
    $q->bind_param('s', $username);
    $q->execute();
    $result=$q->get_result();
    return $result->fetch_array();
}

function addRequest($requester, $requestee) {
    global $con;
    $q= $con->prepare("insert into requests (requester, requestee) values (?,?)");
    $q->bind_param('ss', $requester, $requestee);
    $q->execute();
    $msg = "Hello! The user ".$requester." has is a member of the Social Union family and would like to invite you to have fun, socialize and have good time with us!";
    sendEmail($requestee, '', $msg);
}

function removeRequest($requestee) {
    global $con;
    $q = $con->prepare("select requests.requester, users.emailID 
        from requests
        inner join users
        on users.username = requests.requester
        where requestee = ?");
    $q->bind_param('s', $requestee);
    $q->execute();
    $result = $q->get_result();
    while ($r=$result->fetch_array()) {
		$msg = "Hello ".$requester." We're happy to announce that ".$requestee." who you invited to Social Union has just     joined!!";
        sendEmail($r[1], $r[0], $msg);
	}
    
    $q= $con->prepare(" delete from requests where requestee = ?");
    $q->bind_param('s', $requestee);
    $q->execute();
}

function addFollowing($follower, $followee) {
    global $con;
    $q= $con->prepare("insert into followings (follower, followee) values (?,?)");
    $q->bind_param('ss', $follower, $followee);
    $q->execute();
}

function getFollowing($follower) {
    global $con;
    $q = $con->prepare("select followee from followings where follower = ?");
    $q->bind_param('s', $follower);
    $q->execute();
    $result = $q->get_result();
    return $result->fetch_array();
}

?>