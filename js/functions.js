function request(url, data, callback) {
  var httpRequest = new XMLHttpRequest();
  httpRequest.open("POST", url, true);
  var loader = document.createElement("div");
  loader.className = "loader";
  document.body.appendChild(loader);
  httpRequest.addEventListener("readystatechange", function () {
    if (httpRequest.readyState == 4) {
      if (callback) {
        callback(httpRequest.response);
      }
      loader.remove();
    }
  });
  var formdata = data
    ? data instanceof FormData
      ? data
      : new FormData(document.querySelector(data))
    : new FormData();
  httpRequest.send(formdata);
}
function login() {
  request("php/login.php", "#loginForm", function (data) {
    document.getElementById("errors").innerHTML = "";
    switch (data) {
      case "0":
        window.location.href = "/";
        break;
      case "1":
        document.getElementById("errors").innerHTML +=
          '<div class="err">Incorrect email or password</div>';
        break;
      case "2":
        document.getElementById("errors").innerHTML +=
          '<div class="err">Failed to connect to database. Please try again later.</div>';
        break;
      default:
        document.getElementById("errors").innerHTML +=
          '<div class="err">An unknown error occurred. Please try again later.</div>';
    }
  });
}

function register() {
  request("php/register.php", "#registrationForm", function (data) {
    document.getElementById("errors").innerHTML = "";
    try {
      data = JSON.parse(data);
      if (!(data instanceof Array)) {
        throw Exception("bad data");
      }
      for (let i = 0; i < data.length; i++) {
        switch (data[i]) {
          case 0:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Account created successfully!</div>';
            window.location.href = "";
            break;
          case 1:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Invalid first name entered.';
            break;
          case 2:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Invalid last name entered.';
            break;
          case 3:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Invalid email entered.</div>';
            break;
          case 4:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Email domain does not exist</div>';
            break;
          case 5:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Password must contain: <ul><li>At least 8 characters</li><li>At least one lower case letter</li><li>At least one upper case letter</li><li>At least one number</li></ul></div>';
            break;
          case 6:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Passwords do not match. Please re-enter your confirmed password.</div>';
            break;
          case 7:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Failed to create new account. Please try again later.</div>';
            break;
          case 8:
            document.getElementById("errors").innerHTML +=
              '<div class="err">An account with this email already exists</div>';
            break;
          case 9:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Failed to connect to the database. Please try again later.</div>';
            break;
          default:
            document.getElementById("errors").innerHTML +=
              '<div class="err">An unknown error occurred. Please try again later.</div>';
        }
      }
    } catch (error) {
      document.getElementById("errors").innerHTML =
        '<div class="err">An unknown error occurred. Please try again later.</div>';
    }
  });
}

function addProduct() {
  request("php/addProduct.php", "#addProduct", function (data) {
    document.getElementById("errors").innerHTML = "";
    try {
      data = JSON.parse(data);
      if (!(data instanceof Array)) {
        throw Exception("bad data");
      }
      for (let i = 0; i < data.length; i++) {
        switch (data[i]) {
          case 0:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Product added successfully!</div>';
            window.location.href = "/";
            break;
          case 1:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Model is required, max lenght is 100 characters';
            break;
          case 2:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Manufacturer is required, max lenght is 100 characters';
            break;
          case 3:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Category is required, max lenght is 100 characters</div>';
            break;
          case 4:
            document.getElementById("errors").innerHTML +=
              '<div class="err">In Stock should be at least 1 product</div>';
            break;
          case 5:
            document.getElementById("errors").innerHTML +=
              '<div class="err"> Price can not be less than 0</div>';
            break;
          case 6:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Description field is required</div>';
            break;
          case 7:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Failed to add new product. Please try again later.</div>';
            break;
          case 8:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Ups! something went wrong. try again later</div>';
            break;
          case 9:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Uploaded files can be only pictures!<ul><li>jpg</li><li>png</li><li>jpeg</li><li>gif</li><li>pdf</li></ul></div>';
            break;
          default:
            document.getElementById("errors").innerHTML +=
              '<div class="err">An unknown error occurred. Please try again later.</div>';
        }
      }
    } catch (error) {
      document.getElementById("errors").innerHTML =
        '<div class="err">An unknown error occurred. Please try again later.</div>';
    }
  });
}

function UpdateProduct() {
  request("php/updateProduct.php", "#addProduct", function (data) {
    document.getElementById("errors").innerHTML = "";
    try {
      console.log(data);
      data = JSON.parse(data);
      if (!(data instanceof Array)) {
        throw Exception("bad data");
      }
      for (let i = 0; i < data.length; i++) {
        switch (data[i]) {
          case 0:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Product added successfully!</div>';
            window.location.href = "/";
            break;
          case 1:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Model is required, max lenght is 100 characters';
            break;
          case 2:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Manufacturer is required, max lenght is 100 characters';
            break;
          case 3:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Category is required, max lenght is 100 characters</div>';
            break;
          case 4:
            document.getElementById("errors").innerHTML +=
              '<div class="err">In Stock should be at least 1 product</div>';
            break;
          case 5:
            document.getElementById("errors").innerHTML +=
              '<div class="err"> Price can not be less than 0</div>';
            break;
          case 6:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Description field is required</div>';
            break;
          case 7:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Failed to add new product. Please try again later.</div>';
            break;
          case 8:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Ups! something went wrong. try again later</div>';
            break;
          case 9:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Uploaded files can be only pictures!<ul><li>jpg</li><li>png</li><li>jpeg</li><li>gif</li><li>pdf</li></ul></div>';
            break;
            case 11:
            document.getElementById("errors").innerHTML +=
              '<div class="err">Uploaded files can be only pictures!<ul><li>jpg</li><li>png</li><li>jpeg</li><li>gif</li><li>pdf</li></ul></div>';
            break;
          default:
            document.getElementById("errors").innerHTML +=
              '<div class="err">An unknown error occurred. Please try again later.</div>';
        }
      }
    } catch (error) {
      document.getElementById("errors").innerHTML =
        '<div class="err">An unknown error occurred. Please try again later.</div>';
    }
  });
}

function AddToCart(id){
  var formData = new FormData();
  formData.append('id',id);
  request("php/addToCart.php", formData ,function(data){
    console.log(data);
  });

}
function OpenProduct(id){
  window.location.href("product.php?id="+id);
}