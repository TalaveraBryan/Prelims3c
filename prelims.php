<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Student Enrollment Form</title>
  <style>
    .status-passed { color: green; font-weight: bold; }
    .status-failed { color: red; font-weight: bold; }

    /* Green button styling */
    .btn-green {
      background-color: green;
      color: white;
    }
    .btn-green:hover {
      background-color: darkgreen;
    }
  </style>
</head>
<body>
  <div class="container d-flex flex-column align-items-center">
    <h2 class="text-center my-4">Student Enrollment And Grade Processing System</h2>

    <!-- Enrollment Form -->
    <form id="enrollmentForm" action="#" method="post" onsubmit="showGradeForm(event)" class="w-100 w-md-75 w-lg-50">
      <h5>Student Enrollment Form</h5>

      <div class="mb-3">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="age">Age</label>
        <input type="number" id="age" name="age" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Gender:</label>
        <div>
          <input type="radio" id="male" name="gender" value="Male" required checked>
          <label for="male">Male</label>
          <input type="radio" id="female" name="gender" value="Female" required>
          <label for="female">Female</label>
        </div>
      </div>
      <div class="mb-3">
        <label for="course">Course</label>
        <select id="course" name="course" class="form-select" required>
          <option value="" disabled selected>Select a course</option> <!-- Placeholder option -->
          <option value="BSIT">BSIT</option>
          <option value="BSHRM">BSHRM</option>
          <option value="BSBA">BSBA</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-green w-100">Submit Student Information</button>
    </form>

    <!-- Grade Form (Initially Hidden) -->
    <div id="gradeForm" class="w-100 w-md-75 w-lg-50 mt-4" style="display: none;">
      <h5>Enter Grades for: <span id="studentName"></span></h5>
      <form id="gradesForm" action="#" method="post" onsubmit="submitGrades(event)">
        <div class="mb-3">
          <label for="prelim">Prelim</label>
          <input type="number" id="prelim" name="prelim" class="form-control" required min="0" max="100">
        </div>
        <div class="mb-3">
          <label for="midterm">Midterm</label>
          <input type="number" id="midterm" name="midterm" class="form-control" required min="0" max="100">
        </div>
        <div class="mb-3">
          <label for="finals">Finals</label>
          <input type="number" id="finals" name="finals" class="form-control" required min="0" max="100">
        </div>
        <button type="submit" class="btn btn-green w-100">Submit Grades</button>
      </form>
    </div>

    <!-- Student Details Display (Initially Hidden) -->
    <div id="studentDetails" class="w-100 w-md-75 w-lg-50 mt-4" style="display: none;">
      <h3>Student Details</h3>
      <p><b>First Name:</b> <span id="displayFirstName"></span></p>
      <p><b>Last Name:</b> <span id="displayLastName"></span></p>
      <p><b>Age:</b> <span id="displayAge"></span></p>
      <p><b>Gender:</b> <span id="displayGender"></span></p>
      <p><b>Course:</b> <span id="displayCourse"></span></p>
      <p><b>Email:</b> <span id="displayEmail"></span></p>

      <h3>Grades</h3>
      <p><b>Prelim:</b> <span id="displayPrelim"></span></p>
      <p><b>Midterm:</b> <span id="displayMidterm"></span></p>
      <p><b>Finals:</b> <span id="displayFinals"></span></p>

      <h3>Average Grade</h3>
      <p><span id="displayAverage"></span></p>
    </div>
  </div>

  <script>
    let enrollmentData = {};  // Store enrollment data to refill the form later

    // Function to show the grade input form after enrollment
    function showGradeForm(event) {
      event.preventDefault();  // Prevent form submission

      // Store the enrollment data for later use
      enrollmentData = {
        first_name: document.getElementById("first_name").value,
        last_name: document.getElementById("last_name").value,
        age: document.getElementById("age").value,
        gender: document.querySelector('input[name="gender"]:checked').value,
        course: document.getElementById("course").value,
        email: document.getElementById("email").value,
      };

      // Display the student's name in the grade form
      document.getElementById("studentName").innerText = enrollmentData.first_name + " " + enrollmentData.last_name;

      // Hide the enrollment form and show the grade form
      document.getElementById("enrollmentForm").style.display = "none";
      document.getElementById("gradeForm").style.display = "block";
    }

    // Function to submit grades and calculate the average
    function submitGrades(event) {
      event.preventDefault();  // Prevent form submission

      // Get the grade values
      const prelim = parseFloat(document.getElementById("prelim").value);
      const midterm = parseFloat(document.getElementById("midterm").value);
      const finals = parseFloat(document.getElementById("finals").value);

      // Calculate average grade
      const average = (prelim + midterm + finals) / 3;

      // Display the student's details and grades below the enrollment form
      document.getElementById("displayFirstName").innerText = enrollmentData.first_name;
      document.getElementById("displayLastName").innerText = enrollmentData.last_name;
      document.getElementById("displayAge").innerText = enrollmentData.age;
      document.getElementById("displayGender").innerText = enrollmentData.gender;
      document.getElementById("displayCourse").innerText = enrollmentData.course;
      document.getElementById("displayEmail").innerText = enrollmentData.email;
      document.getElementById("displayPrelim").innerText = prelim;
      document.getElementById("displayMidterm").innerText = midterm;
      document.getElementById("displayFinals").innerText = finals;
      document.getElementById("displayAverage").innerText = average.toFixed(2);

      // Add status based on average
      const statusClass = average >= 75 ? 'status-passed' : 'status-failed';
      document.getElementById("displayAverage").classList.add(statusClass);

      // Hide the grade form, show the enrollment form, and display student details
      document.getElementById("gradeForm").style.display = "none";
      document.getElementById("enrollmentForm").style.display = "block";
      document.getElementById("studentDetails").style.display = "block";
    }
  </script>
</body>
</html>
