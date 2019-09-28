<?php

require_once('vendor/autoload.php');

use App\models\{Job, Project, Printable};

$job1 = new Job('PHP Developer', 'PHP is an awesome job!!!');
$job1->months = 16;

$job2 = new Job('Python Developer', 'Python is an awesome job!!!');
$job2->months = 24;

$job3 = new Job('Devops', 'Devops is an awesome job!!!');
$job3->months = 32;

$job4 = new Job('Vue Developer', 'Vue is an awesome job!!!');
$job4->months = 24;

$job5 = new Job('Java', 'Java is an awesome job!!!');
$job5->months = 3;

$jobs = [ $job1, $job2, $job3, $job4, $job5 ];

$project1 = new Project('Backend para PHP', 'Se hizo con Framework Laravel');
$project1->months = 5;

$projects = [ $project1];


  function getDuration($months){
    $years = floor ($months / 12);
    $extraMonths = $months % 12;
    if($years == 0){
      return "$extraMonths months";
    }
    if($extraMonths == 0){
      return "$years years";
    }
    return "$years years $extraMonths months";
  }
  
  function printElement(Printable $job) {
    if($job->visible == false) {
      return;
    }
  
    echo '<li class="work-position">';
    echo '<h5>' . $job->getTitle() . '</h5>';
    echo '<p>' . $job->getDescription() . '</p>';
    echo '<p>' . $job->getDurationAsString() . '</p>';
    echo '<strong>Achievements:</strong>';
    echo '<ul>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '</ul>';
    echo '</li>';
  }