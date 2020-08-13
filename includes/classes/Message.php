<?php
class Message {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function getMostRecentUser() {
		$userLoggedIn = $this->user_obj->getUsername();

		$query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC LIMIT 1");

		if(mysqli_num_rows($query) == 0)
			return false;

		$row = mysqli_fetch_array($query);
		$user_to = $row['user_to'];
		$user_from = $row['user_from'];

		if($user_to != $userLoggedIn)
			return $user_to;
		else 
			return $user_from;
	}

	public function sendMessage($user_to, $body, $date) {

		if($body != "") {
			$userLoggedIn = $this->user_obj->getUsername();
            $query = mysqli_query($this->con, "INSERT INTO messages VALUES('', '$user_to', '$userLoggedIn', '$body', '$date', 'no', 'no', 'no','')");
		}
	}

	public function getMessages($otherUser) {
        $userLoggedIn = $this->user_obj->getUsername();
		$data = "";

		$query = mysqli_query($this->con, "UPDATE messages SET opened='yes' WHERE user_to='$userLoggedIn' AND user_from='$otherUser'");

        $get_messages_query = mysqli_query($this->con, "SELECT * FROM messages WHERE (user_to='$userLoggedIn' AND user_from='$otherUser') OR (user_from='$userLoggedIn' AND user_to='$otherUser')");
        
    while($row = mysqli_fetch_array($get_messages_query)) {
			$user_to = $row['user_to'];
			$user_from = $row['user_from'];
            $body = $row['body'];
			$id = $row['id'];
            $imagePath = $row['image'];
            $test = explode('.', $imagePath);
            $ext = end($test);
            // if ($imagePath!="") {
            if ($ext=="jpg" || $ext=="png" || $ext=="jpeg" || $ext=="bmp") {
            $imageDiv="<div class='postedImage rounded border'>
            <a href='$imagePath' download>
                <img class='rounded' src='$imagePath' >
            </a>
            </div>";
            }else {
            if ($ext=="pdf" || $ext=="dwg") {                
                $imageDiv="<div class='postedImage'>
                <a href='$imagePath' download>Download File</a>
                </div>";
                
            }else{
                 $imageDiv="";
            }
        }
			// $imagePath = $row['proj_file_name'];
			$uploaded_on= $row['date'];
			
// 			if($imagePath != "") {
// 				$imageDiv = "<div class='postedImage'>                               
                
//                 <a name='' id=''  role='button' style='float:right' class='btn btn-danger' 
//                 href=''>Download File</a>
// <br>
// </div>
// <br>";
// }else {
// $imageDiv ="";
// }
//ternary operator
        // $user_logged_in="<div>$userLoggedIn</div>";
        // $button = "<span class='deleteButton' onclick='deleteMessage($id, this)'>x</span>";
        if($imageDiv == ""){
            $div_top = ($user_to == $userLoggedIn) ? "<div class='row'><div class='col px-4 py-2'><div class='float-left rounded-pill bg-primary text-white p-2 px-4'>" : "<div class='row'><div class='col px-4 py-2'><div class='float-right rounded-pill bg-primary text-white p-2 px-4'>";
        $data = $data . $div_top . $body . $imageDiv . "</div></div></div>";
        } else {
            $div_top = ($user_to == $userLoggedIn) ? "<div class='row'><div class='col px-1 py-2'><div class='float-left text-white p-2 px-4'>" : "<div class='row'><div class='col px-1 py-2'><div class='float-right text-white p-2 px-4'>";
            $data = $data . $div_top . $imageDiv . "</div></div></div>";
        }
        // $data = $data .$imageDiv. $div_top . $button . $body . "</div><br><br>";

    }
    return $data;
    }
    
   public function getLatestMessage($userLoggedIn, $user2) {
    $details_array = array();

    $query = mysqli_query($this->con, "SELECT body, user_to, date FROM messages WHERE (user_to='$userLoggedIn' AND
    user_from='$user2') OR (user_to='$user2' AND user_from='$userLoggedIn') ORDER BY id DESC LIMIT 1");

    $row = mysqli_fetch_array($query);
    $sent_by = ($row['user_to'] == $userLoggedIn) ? "They said: " : "You said: ";

    //Timeframe
    $date_time_now = date("Y-m-d H:i:s");
    $start_date = new DateTime($row['date']); //Time of post
    $end_date = new DateTime($date_time_now); //Current time
    $interval = $start_date->diff($end_date); //Difference between dates
    if($interval->y >= 1) {
    if($interval->y == 1) {
    $time_message = $interval->y . " yr ago"; //1 year ago
    $time_msg_abbr = $interval->y . " yr";
    }
    else
    $time_message = $interval->y . " yrs ago"; //1+ year ago
    }
    else if ($interval->m >= 1) {
    if($interval->d == 0) {
    $days = " ago";
    }
    else if($interval->d == 1) {
    $days = $interval->d . " day ago";
    }
    else {
    $days = $interval->d . " days ago";
    }


    if($interval->m == 1) {
    $time_message = $interval->m . " month". $days;
    }
    else {
    $time_message = $interval->m . " months". $days;
    }

    }
    else if($interval->d >= 1) {
    if($interval->d == 1) {
    $time_message = "Yesterday";
    }
    else {
    $time_message = $interval->d . " days ago";
    }
    }
    else if($interval->h >= 1) {
    if($interval->h == 1) {
    $time_message = $interval->h . " hr ago";
    }
    else {
    $time_message = $interval->h . " hrs ago";
    }
    }
    else if($interval->i >= 1) {
    if($interval->i == 1) {
    $time_message = $interval->i . " min ago";
    }
    else {
    $time_message = $interval->i . " mins ago";
    }
    }
    else {
    if($interval->s < 30) { $time_message="Just now" ; } else { $time_message=$interval->s . " seconds ago";
        }
        }

        array_push($details_array, $sent_by);
        array_push($details_array, $row['body']);
        array_push($details_array, $time_message);

        return $details_array;
        }

      public function getConvos() {
        $userLoggedIn = $this->user_obj->getUsername();
        $return_string = "";
        $convos = array();

        $query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR
        user_from='$userLoggedIn' ORDER BY id DESC");

        while($row = mysqli_fetch_array($query)) {
        $user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];

        if(!in_array($user_to_push, $convos)) {
        array_push($convos, $user_to_push);
        }
        }
        foreach($convos as $username) {
        $user_found_obj = new User($this->con, $username);
        $latest_message_details = $this->getLatestMessage($userLoggedIn, $username);

        $dots = (strlen($latest_message_details[1]) >= 30) ? "..." : "";
        $split = str_split($latest_message_details[1], 30);
        $split = $split[0] . $dots;

        // $return_string .= "<a href='messages.php?u=$username'>
        // <div class='user_found_messages pl-2 pt-2'>
        //         <img src='" . $user_found_obj->getProfilePic() . "' style='border-radius: 5px; margin-right: 5px;height:50px;width:50px;'>
        //         " . $user_found_obj->getFirstAndLastName() ."
        //         <span class='timestamp_smaller' id='grey'> <br>" . $latest_message_details[2] . "</span>
        //         <p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . " </p>
        //     </div><hr>
        // </a>";
        $return_string .= "
    <a class='text-decoration-none' href='messages.php?u=$username'>
        <div class='each-chat border-top row py-2'>
            <div class='col-2 pl-1 col-md-2 m-auto'>
                <img width='60px' height='60px' class='img-profile p-1 rounded-circle'
                src='" . $user_found_obj->getProfilePic() . "'>
            </div>
            <div class='col-10 pl-4 pr-0 col-md-10 m-auto'>
                <div class='row'>
                    <div class='col-8'>
                        <b>" . $user_found_obj->getFirstAndLastName() ."</b>
                    </div>
                    <div class='col-4'>
                        <abbr class='inbox-timestamp text-decoration-none text-gray-600' title='" . $latest_message_details[2] . "'>" . $latest_message_details[2] . "</abbr>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        <p class='inbox-msg text-gray-800' style='margin: 0;'>". $split . " </p>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </a>";
        }
        return $return_string;
        }

    public function getConvosDropdown($data, $limit) {

        $page = $data['page'];
        $userLoggedIn = $this->user_obj->getUsername();
        $return_string = "<h6 class='dropdown-header'>Message Center</h6>";
        $convos = array();

        if($page == 1)
        $start = 0;
        else
        $start = ($page - 1) * $limit;

        $set_viewed_query = mysqli_query($this->con, "UPDATE messages SET viewed='yes' WHERE user_to='$userLoggedIn'");

        $query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR
        user_from='$userLoggedIn' ORDER BY id DESC");

        while($row = mysqli_fetch_array($query)) {
        $user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];

        if(!in_array($user_to_push, $convos)) {
        array_push($convos, $user_to_push);
        }
        }

        $num_iterations = 0; //Number of messages checked
        $count = 1; //Number of messages posted

        foreach($convos as $username) {

        if($num_iterations++ < $start) continue; if($count> $limit)
            break;
            else
            $count++;


            $is_unread_query = mysqli_query($this->con, "SELECT opened FROM messages WHERE user_to='$userLoggedIn' AND
            user_from='$username' ORDER BY id DESC");
            $row = mysqli_fetch_array($is_unread_query);
            $style = ($row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";


            $user_found_obj = new User($this->con, $username);
            $latest_message_details = $this->getLatestMessage($userLoggedIn, $username);

            $dots = (strlen($latest_message_details[1]) >= 12) ? "..." : "";
            $split = str_split($latest_message_details[1], 12);
            $split = $split[0] . $dots;

            $return_string .= "<a class='dropdown-item d-flex align-items-center' href='messages.php?u=$username'>
            <div class='dropdown-list-image mr-3'>
            <img class='rounded-circle' src='" . $user_found_obj->getProfilePic() . "' alt=''>
            <div class='status-indicator bg-success'></div>
          </div>
          <div class='font-weight-bold'>
            <div class='text-truncate'>" . $latest_message_details[0] . $split . "</div>
            <div class='small text-gray-500'>" . $user_found_obj->getFirstAndLastName() ." · 58m</div>
          </div>
        </a>";
            }



            //If posts were loaded
            if($count > $limit)
            $return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input
                type='hidden' class='noMoreDropdownData' value='false'>";
            else
            $return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'>
            <p style='text-align: center;' class='text-center border p-2 m-0 small text-gray-500'>No more messages to load!</p>";
            return $return_string;
            }

           public function getUnreadNumber() {
            $userLoggedIn = $this->user_obj->getUsername();
            $query = mysqli_query($this->con, "SELECT * FROM messages WHERE viewed='no' AND user_to='$userLoggedIn'");
            return mysqli_num_rows($query);
            }

            }

            ?>
