<?php
//  i want to create a file called availablepetinformation.json that holds all the information of the pets that are available for adoption then i want to read that file and display it on the website depending on the type of pet that is selected through the form that the user fills out on the website
//this is the data that i want to store in the json file
$data  = [
    [
    'pet' => 'dog',
    'breed' => 'Labrador',
    'age' => '3',
    'gender' => 'female ',
    'Suitable for small children' => 'yes',
    'Can go along with other cats and dogs' => 'yes',

    ],
    [
    'pet' => 'dog',
    'breed' => 'Poodle',
    'age' => '2',
    'gender' => 'male',
    'Suitable for small children' => 'yes',
    'Can go along with other cats and dogs' => 'yes',
    ],
    [
    'pet' => 'dog',
    'breed' => 'Bulldog',
    'age' => '5',
    'gender' => 'male' ,
    'Suitable for small children' => 'no',
    'Can go along with other cats and dogs' => 'no',
    ],
    [
    'pet' => 'dog',
    'breed' => 'Golden Retriever',
    'age' => '4',
    'gender' => 'female',
    
    'Suitable for small children' => 'yes',
    'Can go along with other cats and dogs' => 'yes',
    ],
    [
    'pet' => 'dog',
    'breed' => 'Pug',
    'age' => '2',
    'gender' => 'male',
    'Suitable for small children' => 'no',
    'Can go along with other cats and dogs' => 'no',
    ],
];

    $errors = [];
    var_dump($_SERVER['REQUEST_METHOD']);
// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the form data
$type = $_POST['pet'];
$breed = $_POST['breed'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$suitableForSmallChildren = isset($_POST['suitableForSmallChildren']) ? $_POST['suitableForSmallChildren'] : null;
$canGoAlongWithOtherCatsAndDogs = isset($_POST['canGoAlongWithOtherCatsAndDogs']) ? $_POST['canGoAlongWithOtherCatsAndDogs'] : null;
    // validate the type field
    if (empty($type)) {
        $errors['type'] = 'Pet type is required';
    }

    // validate the breed field
    if (empty($breed)) {
        $errors['breed'] = 'Breed is required';
    }

    // validate the age field
    if (empty($age)) {
        $errors['age'] = 'Age is required';
    }

    // validate the gender field
    if (empty($gender)) {
        $errors['gender'] = 'Gender is required';
    } elseif ($gender !== 'Male' && $gender !== 'Female') {
        $errors['gender'] = 'Gender must be either Male or Female';
    }
        if(empty($friendly)){
            $errors['friendly'] = 'Friendly is required';
        }elseif($friendly !== 'Yes' && $friendly !== 'No'){
            $errors['friendly'] = 'Friendly must be either Yes or No';
        }
    // check if there are any validation errors
    if (empty($errors)) {
        // validation passed, process the form data
        // read the contents of the file
        // get the form data
   

    // define the filter criteria
    $criteria = [
        // only include entries that match the specified type
        ['key' => 'pet', 'value' => $type],
        
        // only include entries that match the specified breed
        ['key' => 'breed', 'value' => $breed],
        
        // only include entries that match the specified age
        ['key' => 'age', 'value' => $age],
        
        // only include entries that match the specified gender
        ['key' => 'gender', 'value' => $gender],
        
        // only include entries that match the specified suitability for small children
        ['key' => 'Suitable for small children', 'value' => $suitableForSmallChildren],
        
        // only include entries that match the specified compatibility with other cats and dogs
        ['key' => 'Can go along with other cats and dogs', 'value' => $canGoAlongWithOtherCatsAndDogs],];
    $jsonData = file_get_contents('availablepetinformation.json');
    // decode the JSON data
    $data = json_decode($jsonData, true);
    // loop through the data and find the pet type that matches the user's selection
   // filter the data to only include entries that match all the specified criteria
   $filteredData = array_filter($data, function ($entry) use ($criteria) {
    foreach ($criteria as $criterion) {
        if (isset($criterion['value']) && (!isset($entry[$criterion['key']]) || $entry[$criterion['key']] !== $criterion['value'])) {
            return false;
        }
    }
    return true;
});
    }

  /*  foreach ($filteredData as $entry) {
        echo '<h2>' . htmlspecialchars($entry['breed']) . '</h2>';
        echo '<ul>';
        echo '<li class="desc"><strong>Age: ' . htmlspecialchars($entry['age']) . ' years</strong></li>';
        echo '<li class="desc"><strong>Gender: ' . htmlspecialchars($entry['gender']) . '</strong></li>';
        if (isset($entry['Suitable for small children'])) {
            echo '<li class="desc"><strong>Suitable for small children: '
               . htmlspecialchars($entry['Suitable for small children'])
               . '</strong></li>';
        }
        if (isset($entry['Can go along with other cats and dogs'])) {
            echo '<li class="desc"><strong>Can go along with other cats and dogs: '
               . htmlspecialchars($entry['Can go along with other cats and dogs'])
               . '</strong></li>';
        }
        echo '</ul>';
        echo '<button class="interested-button">Interested</button>';
    }
    */
}
?>
<!-- define the form -->
<form id="form" method="post">
  <!-- form fields -->
  <input type="submit" value="Submit">
</form>

<!-- define a container to hold the filtered data -->
<div id="dataContainer"></div>

<!-- define a template for the filtered data -->

<!-- define a container to hold the filtered data -->
<script>
// check if the form has been submitted
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
  // hide the form
  document.querySelector('#form').style.display = 'none';

  // display the filtered data in the desired format
  const dataContainer = document.querySelector('#dataContainer');
  <?php foreach ($filteredData as $entry): ?>
    const breedHeading = document.createElement('h2');
    breedHeading.textContent = <?php echo json_encode($entry['breed']); ?>;
    dataContainer.appendChild(breedHeading);

    const petList = document.createElement('ul');
    dataContainer.appendChild(petList);

    const ageItem = document.createElement('li');
    ageItem.className = 'desc';
    ageItem.innerHTML = '<strong>Age: <?php echo htmlspecialchars($entry['age']); ?> years</strong>';
    petList.appendChild(ageItem);

    const genderItem = document.createElement('li');
    genderItem.className = 'desc';
    genderItem.innerHTML = '<strong>Gender: <?php echo htmlspecialchars($entry['gender']); ?></strong>';
    petList.appendChild(genderItem);

    if (<?php echo json_encode(isset($entry['Suitable for small children'])); ?>) {
      const suitableForSmallChildrenItem = document.createElement('li');
      suitableForSmallChildrenItem.className = 'desc';
      suitableForSmallChildrenItem.innerHTML =
          '<strong>Suitable for small children: <?php echo htmlspecialchars($entry['Suitable for small children']); ?></strong>';
      petList.appendChild(suitableForSmallChildrenItem);
    }

    if (<?php echo json_encode(isset($entry['Can go along with other cats and dogs'])); ?>) {
      const canGoAlongWithOtherCatsAndDogsItem = document.createElement('li');
      canGoAlongWithOtherCatsAndDogsItem.className = 'desc';
      canGoAlongWithOtherCatsAndDogsItem.innerHTML =
          '<strong>Can go along with other cats and dogs: <?php echo htmlspecialchars($entry['Can go along with other cats and dogs']); ?></strong>';
      petList.appendChild(canGoAlongWithOtherCatsAndDogsItem);
    }

    const interestedButton = document.createElement('button');
    interestedButton.className = 'interested-button';
    interestedButton.textContent = 'Interested';
    dataContainer.appendChild(interestedButton);
    <?php endforeach; ?>
    <?php endif; ?>
</script>
