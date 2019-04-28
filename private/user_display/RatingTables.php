<?php

class RatingTables
{
	public function __construct() {}
	
	
	public function getAveLabRating($tutorial_lab_id, $mdb_control)
	{
		$conroller = $mdb_control->getController("tutorial_lab_rating");
		$rating_list = array();
		$rating_list = $conroller->getByAttribute("tutorial_lab_id", $tutorial_lab_id);
		$total = 0;
		$num_ratings = 0;
		$ave_rating = 0;
		
		if(isset($rating_list))
		{
			$num_ratings = count($rating_list);
			
			for($j = 0; $j < $num_ratings; $j++)
			{
				$total += $rating_list[$j]->get_rating();
			}
			
			if($num_ratings > 0) { $ave_rating = $total/$num_ratings; }
		}
		
		$rating_info = array();
		$rating_info['num'] = $num_ratings;
		$rating_info['ave'] = $ave_rating;
		
		return $rating_info;
	}


	public function getAveSectionRating($section_id, $mdb_control)
	{
		$conroller = $mdb_control->getController("section_rating");
		$rating_list = array();
		$rating_list = $conroller->getByAttribute("section_id", $section_id);
		$total = 0;
		$num_ratings = 0;
		$ave_rating = 0;
		
		if(isset($rating_list))
		{
			$num_ratings = count($rating_list);
			
			for($j = 0; $j < $num_ratings; $j++)
			{
				$total += $rating_list[$j]->get_rating();
			}
			
			if($num_ratings > 0) { $ave_rating = $total/$num_ratings; }
		}
		
		$rating_info = array();
		$rating_info['num'] = $num_ratings;
		$rating_info['ave'] = $ave_rating;
		
		return $rating_info;
	}


	public function outputStars($rating_info)
	{
		$ave_rating = $rating_info['ave'];
		$stars = floor($ave_rating);	
		$max_rating = 5;
		$num_ratings = $rating_info['num'];
		$pretty_ave = number_format($ave_rating, 2);
		
		echo "<h2>Average of $num_ratings ratings is $pretty_ave stars.</h2>";
		
		for($i = 0; $i < $stars; $i++)
		{
			echo "<span class='fa fa-star full-star green'></span>";
		}
		
		if($stars < $ave_rating)
		{
			echo "<span class='fas fa-star-half-alt star green'></span>";
			$stars++;
		}
		
		for($i = $stars; $i < $max_rating; $i++)
		{
			echo "<span class='far fa-star star green'></span>";
		}	
	}
	
	
	public function outputStars_SingleRating($rating)
	{
		$stars = floor($rating);	
		$max_rating = 5;
		
		for($i = 0; $i < $stars; $i++)
		{
			echo "<span class='fa fa-star full-star green'></span>";
		}
		
		if($stars < $rating)
		{
			echo "<span class='fas fa-star-half-alt star green'></span>";
			$stars++;
		}
		
		for($i = $stars; $i < $max_rating; $i++)
		{
			echo "<span class='far fa-star star green'></span>";
		}	
	}
	
	
	public function averageTimeToComplete($tutorial_lab_id, $mdb_control)
	{
		$homework_list = array();
		$conroller = $mdb_control->getController("homework_view");		
		$homework_list = $conroller->getByAttribute("tutorial_lab_id", $tutorial_lab_id);
		$num_homework = count($homework_list);
		$num_submitted = 0;
		$total_hours = 0;
		
		for($i = 0; $i < $num_homework; $i++)
		{
			$date_submitted = $homework_list[$i]->get_date_submitted();
			
			if(isset($date_submitted))
			{
				$num_submitted++;
				$total_hours += $homework_list[$i]->get_hours();
			}
		}
		
		$ave_hours = 0;
		
		if($num_submitted > 0)
		{
			$ave_hours = $total_hours / $num_submitted;
		}
		
		if(is_numeric($ave_hours)) 
		{ 
			$ave_hours = number_format($ave_hours, 2); 
		}
		
		return $ave_hours;
	}
	
	
	public function displayFullLabRatings($tutorial_lab_id, $tutorial_lab_name, $mdb_control)
	{
		$rating_list = array();
		$conroller = $mdb_control->getController("tutorial_lab_rating");					
		$rating_list = $conroller->getByAttribute("tutorial_lab_id", $tutorial_lab_id);
		
		if(isset($rating_list))
		{
			for($i = 0; $i < count($rating_list); $i++)
			{
				$member_id = $rating_list[$i]->get_member_id();
				$date_posted = $rating_list[$i]->get_date_posted();
				$rating = $rating_list[$i]->get_rating();
				$comments = $rating_list[$i]->get_comments();
				//$flag = $rating_list[$i]->get_flag_for_review();
				
				$member = $mdb_control->getController("member")->getByPrimaryKey("member_id", $member_id);
				$first_name = $member->get_first_name();
				$last_name = $member->get_last_name();
				$member_type = $member->get_member_type();
				
				echo "<article class='lab-rating'>
						<h2>Tutorial Lab $tutorial_lab_id : $tutorial_lab_name</h2>";
		
				switch ($member_type)
				{
					case "professor":
						echo "Professor : $first_name $last_name";
						break;
					case "administrator":
						echo "Administrator : $first_name $last_name";
						break;
					case "student":
						echo "Student : $first_name $last_name";
						break;
				}
				
				echo "<br>";
				
				$this->outputStars_SingleRating($rating);				
				
				echo "<p>Rating: $rating Stars</p>";
				
				if(isset($comments)) { echo "<p class='rating-comments'> $comments <p>"; }
						
				echo "</article><br>";
			}
		}
		else
		{
			echo "No ratings yet.";
		}
		
	}
	
	

}


?>