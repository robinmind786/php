<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8" />
  <title>PHP Form Validation with Vanilla JavaScript</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <div class="container">
      <h2 class="text-center mt-4 mb-2">PHP Form Validation with Vanilla JavaScript</h2>
      
      <span id="message"></span>
      <form id="sample_form">
        <div class="card">
          <div class="card-header">Sample Form</div>
          <div class="card-body">
            <div class="form-group">
              <label>Name <span class="text-danger">*</span></label>
              <input type="text" name="name" id="name" class="form-control form_data" />
              <span id="name_error" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label>E-mail <span class="text-danger">*</span></label>
              <input type="text" name="email" id="email" class="form-control form_data" />
              <span id="email_error" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label>Website <span class="text-danger">*</span></label>
              <input type="text" name="website" id="website" class="form-control form_data" />
              <span id="website_error" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label>Comment <span class="text-danger">*</span></label>
              <textarea name="comment" id="comment" cols="40" rows="5" class="form-control form_data"></textarea>
              <span id="comment_error" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label>Gender <span class="text-danger">*</span></label>
              <select name="gender" id="gender" class="form-control form_data">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <span id="gender_error" class="text-danger"></span>
            </div>
          </div>
          <div class="card-footer">
            <button type="button" name="submit" id="submit" class="btn btn-primary" onclick="save_data(); return false;">Save</button>
          </div>
        </div>
    </form>
    <br />
    <br />
    </div>
    <script>
      function save_data() {
        var form_element = document.getElementsByClassName('form_data');
        var form_data = new FormData();
        var i;
        for(i = 0; i < form_element.length; i++) {
          form_data.append(form_element[i].name, form_element[i].value);
        }
        document.getElementById('submit').disabled = true;
        document.getElementById('submit').innerHTML = 'Sending...';
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'action.php');
        xhttp.send(form_data);
        xhttp.onreadystatechange = function() {
          if(xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById('submit').disabled = false;
            document.getElementById('submit').innerHTML = 'Save';
            var response = JSON.parse(xhttp.responseText);
            if(response.success != '') {
              document.getElementById('sample_form').reset();
              document.getElementById('message').innerHTML = response.success;
              setTimeout(function(){
                document.getElementById('message').innerHTML = '';
              }, 2000);
              document.getElementById('name_error').innerHTML = '';
              document.getElementById('email_error').innerHTML = '';
              document.getElementById('website_error').innerHTML = '';
              document.getElementById('comment_error').innerHTML = '';
              document.getElementById('gender_error').innerHTML = '';
            } else {
              document.getElementById('name_error').innerHTML = response.name_error;
              document.getElementById('email_error').innerHTML = response.email_error;
              document.getElementById('website_error').innerHTML = response.website_error;
              document.getElementById('comment_error').innerHTML = response.comment_error;
              document.getElementById('gender_error').innerHTML = response.gender_error;
            }
          }
        }
      }
    </script>
</body>
</html>

