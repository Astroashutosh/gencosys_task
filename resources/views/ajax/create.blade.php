<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>
<body>
    <form id="ajaxForm" enctype="multipart/form-data">
        @csrf
        Name<input type="text" name="name">
        Email<input type="text" name="email">
        Age<input type="text" name="age">
        Picture<input type="file" name="picture">
        <button id="btnSubmit">Submit</button>
    </form>
     <h1 id="output"></h1>
  <script>
      $(document).ready(function () {
          $('#ajaxForm').submit(function (e) {
              e.preventDefault();
            //   var form=$("#ajaxForm")[0];
              var formData = new FormData(this);
             
              $("#btnSubmit").prop("disabled", true);

              $.ajax({
                  type: 'POST',
                  url: '{{ route('ajaxSubmit') }}',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function (response) {
                    //   alert(response.message);
                    $("#output").text(response.message);
                      $("#btnSubmit").prop("disabled", false);
                      $("input").val("");
                  },
                  error: function (error) {
                      console.log(error.responseText);
                      $("#btnSubmit").prop("disabled", false);
                  }
              });
          });
      });
  </script>

</body>
</html>