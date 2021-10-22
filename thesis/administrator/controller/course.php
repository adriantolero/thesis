<?php

	session_start();
	include_once "../CRUD/course.php";
	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="getCourse"){
			echo $crud->getCourse($_POST["search"]);
		}

		else if($_POST["function"]=="createCourse"){
			echo $crud->createCourse($_POST["course"]);
		}

		else if($_POST["function"]=="getCourseInfo"){
			echo json_encode($crud->getCourseInfo($_POST["i_course_id"]));
		}

		else if($_POST["function"]=="updateCourse"){
			echo $crud->updateCourse($_POST["i_course_id"],$_POST["course"]);
		}

		else if($_POST["function"]=="deleteCourse"){
			echo $crud->deleteCourse($_POST["i_course_id"]);
		}

		else if($_POST["function"]=="getMajor"){
			echo $crud->getMajor($_POST["i_course_id"],$_POST["search"]);
		}

		else if($_POST["function"]=="createMajor"){
			echo $crud->createMajor($_POST["i_course_id"],$_POST["major"]);
		}

		else if($_POST["function"]=="getMajorInfo"){
			echo json_encode($crud->getMajorInfo($_POST["i_mid"]));
		}

		else if($_POST["function"]=="updateMajor"){
			echo $crud->updateMajor($_POST["i_mid"],$_POST["major"]);
		}

		else if($_POST["function"]=="deleteMajor"){
			echo $crud->deleteMajor($_POST["i_mid"]);
		}

	}

?>