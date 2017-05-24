<?php  

function improvements_to_be_made($arg1,$arg2,$arg3,$willingness,$type_of_funds,$target_market){
	$changes = False;
	if($arg1 != $willingness){
		if($arg1 == 'Yes'){
			echo'It is recommended to hire professional in-order to make market.'."<br><br><br>";
		}else{
			echo'It is recommended not to hire professional in-order to make market.'."<br><br><br>";
		}
		echo'<br>';
		$changes = True;
	}
	//echo "<br><br>".$arg2."---------- ".$type_of_funds."<br><br>";
	if($arg2 != $type_of_funds){
		echo 'It is better to choose your funding type as '.$type_of_funds."<br><br><br>";
		$changes = True;
	}
	if($arg3 != $target_market){
		echo 'It is better to aim at target market :'.$target_market."<br><br><br>";
		$changes = True;
	}
	if(!$changes){
		echo 'All is well & you can happily proceed to set implement your idea for business'."<br><br><br>";
	}
	echo"<br><br><br>";
}

 function q9_analysis($profession,$type_of_comp,$stage_of_startup,$category,$willingness,$type_of_funds,$target_market)
 {  $result=0.0;
 	$occ_count=0;
 	$support=3;
 	$max_r=-1;
 	$sno=-1;
 	$DBconnect = new mysqli("localhost","root","","sample");
 	$max_match_cnt = 0;
 	//$res_arr = array();
 	$arg1="2";
 	$arg2="3";
 	$arg3="4";
// Check connection

	if ($DBconnect->connect_error) 
	{

   		 die("Connection failed: " . $DBconnect->connect_error);

	}

	$checkdata="SELECT * FROM final_info where Category='".$category."'" ;

 	$query=$DBconnect->query($checkdata);

 	if(mysqli_num_rows($query)>0)
    {
 
      	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
		{

 
   			  	 $match_count=0;

					if($profession==$row['Profession'])$match_count++;
					if($type_of_comp=$row['Type of company'])$match_count++;
					if($stage_of_startup==$row['Stage of startup'])$match_count++;
					if($willingness==$row['Willing to hire professional'])$match_count++;
					if($type_of_funds==$row['Type of funding'])$match_count++;
					if($target_market==$row['Target market'])$match_count++;

                    if($row['Rating']>$max_r)
                    {
                    	$max_r=$row['Rating'];
                        $arg1 =  $row['Willing to hire professional'];
                        $arg2 =  $row['Type of funding'];
                        $arg3 =   $row['Target market'];
                        #echo "hai"."<br>";
                    }

                    if($row['Rating']==$max_r)
                    {
                    	if($max_match_cnt < $match_count){
                        	$arg1 =  $row['Willing to hire professional'];
                        	$arg2 =  $row['Type of funding'];
                        	$arg3 =   $row['Target market'];
                        	$max_match_cnt = $match_count;
                    	}
                    	
                    }
					


					if($match_count>=$support)
					{
						//foreach ($row as $key => $value) {
							# code...

						//	echo $value."    ";
						//}
						//echo "<br>";
						

						$result+=($row['Rating']*$match_count);
     				    $occ_count+=$match_count;

					}

 
}

}

improvements_to_be_made($arg1,$arg2,$arg3,$willingness,$type_of_funds,$target_market);
return ($result/$occ_count);
}
 ?>