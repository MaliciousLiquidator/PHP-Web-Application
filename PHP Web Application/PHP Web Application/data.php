<?php $polls = array (
  'poll1' => 
  array (
    'id' => 'poll1',
    'question' => 'Would you like FREE snacks on the university campus?',
    'options' => 
    array (
      0 => 'Yes',
      1 => 'No',
    ),
    'isMultiple' => false,
    'createdAt' => '2022-12-04',
    'deadline' => '2022-12-12',
    'answers' => 
    array (
      'Yes' => 2,
      'No' => 0,
    ),
    'voted' => 
    array (
      0 => 'userid1',
      1 => 'userid2',
    ),
  ),
  'poll2' => 
  array (
    'id' => 'poll2',
    'question' => 'What kind of snacks would you like?',
    'options' => 
    array (
      0 => 'Potato chips',
      1 => 'Peanuts',
      2 => 'Chocolate bars',
      3 => 'Cookies',
    ),
    'isMultiple' => true,
    'createdAt' => '2022-12-05',
    'deadline' => '2024-12-13',
    'answers' => 
    array (
      'Potato chips' => 3,
      'Peanuts' => 4,
      'Chocolate bars' => 3,
      'Cookies' => 2,
    ),
    'voted' => 
    array (
      0 => 'userid1',
      1 => 'userid2',
      2 => 'userid3',
      3 => 'Ahmad',
    ),
  ),
); $users = array (
  'userid1' => 
  array (
    'id' => 'userid1',
    'username' => 'admin',
    'email' => 'email1@email.hu',
    'password' => 'admin',
    'isAdmin' => true,
  ),
  'userid2' => 
  array (
    'id' => 'userid2',
    'username' => 'user2',
    'email' => 'email2@email.hu',
    'password' => 'user2',
    'isAdmin' => false,
  ),
  'userid3' => 
  array (
    'id' => 'userid3',
    'username' => 'user3',
    'email' => 'email3@email.hu',
    'password' => 'user3',
    'isAdmin' => false,
  ),
  'Ahmad' => 
  array (
    'email' => 'asifaminahmad@gmail.com',
    'password' => 'Ahmad2003',
    'isAdmin' => false,
  ),
);