<?php

class Job{
    private $title;
    public $description;
    public $visible = true;
    public $months;

    public function __construct($title, $description) {
        $this->setTitle($title);
        $this->description = $description;
    }

    public function setTitle($t) {
        if($t == '') {
            $this->title = 'N/A';
        } else {
            $this->title = $t;
        }
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
      
        return "$years years $extraMonths months";
    }
}

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

$jobs = [
    $job1, $job2, $job3, $job4, $job5
    // [
    //   'title' => 'PHP Developer',
    //   'description' => 'PHP is an awesome job!!!',
    //   'visible' => true,
    //   'months' => 16
    // ],
    // [
    //   'title' => 'Python Dev',
    //   'description' => 'Python is an awesome job!!!',
    //   'visible' => true,
    //   'months' => 14
    // ],
    // [
    //   'title' => 'Devops',
    //   'description' => 'Devops is an awesome job!!!',
    //   'visible' => true,
    //   'months' => 5
    // ],
    // [
    //   'title' => 'Vue Dev',
    //   'description' => 'Vue is an awesome job!!!',
    //   'visible' => true,
    //   'months' => 24
    // ],
    // [
    //   'title' => 'Java Dev',
    //   'description' => 'Java is an awesome job!!!',
    //   'visible' => true,
    //   'months' => 3
    // ]
  ];

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
  
  function printJob($job) {
    if($job->visible == false) {
      return;
    }
  
    echo '<li class="work-position">';
    echo '<h5>' . $job->getTitle() . '</h5>';
    echo '<p>' . $job->description . '</p>';
    echo '<p>' . $job->getDurationAsString() . '</p>';
    echo '<strong>Achievements:</strong>';
    echo '<ul>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
    echo '</ul>';
    echo '</li>';
  }