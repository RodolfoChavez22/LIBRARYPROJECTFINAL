
<style>
      .modal {
        display: none;
        position: fixed;
        z-index: 10;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
      }
      .modal-content {
        margin: 50px auto;
        border: 1px solid #999;
        width: 60%;
        border-radius: 10px;
      }
      
      h3, p {
        margin: 0 0 20px;
        font-weight: 400;
        color: #999;
      }
      span {
        color: #666;
        display: block;
        padding: 0 0 5px;
      }
      form {
        padding: 25px;
        margin: 25px;
        box-shadow: 0 2px 5px #f5f5f5;
        background: #eee;
      }
      input,
      textarea {
        width: 90%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #1c87c9;
        outline: none;
      }
      .query-form button {
        width: 100%;
        padding: 10px;
        border: none;
        background: #960c22;
        font-size: 16px;
        font-weight: 400;
        border-radius: 10px;
        color: #fff;
      }
      button:hover {
        background: #C8102E;
      }
      .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
      }
      .close:hover,
      .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
      }
      button.adv-btn {
        background: none;
        border-top: none;
        outline: none;
        border-right: none;
        border-left: none;
        /* border-bottom: #02274a 1px solid; */
        padding: 0 0 3px 0;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
        text-decoration: none;
      }
      button.adv-btn:hover {
        /* border-bottom: #a99567 1px solid; */
        color: #a99567;
        text-decoration: none;
      }

    


    /* CSS for simple search form */ 


  .search-body{
      overflow: auto;
      position:fixed;
      padding:0;
      margin:0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 80%;
      width: 100%;
      box-sizing: border-box;
      letter-spacing: 0.5px;
  }

  .simple-query-form {
      width: 500px;
      border: 2px solid #54585A;
      padding: 30px;
      background: #ffffff;
      border-radius: 15px;
  }


  .simple-query-form h2 {
      text-align: center;
      margin-bottom: 10px;
  }

  .search-input {
      margin: auto;
  }


  .search-input i {
      color: #54585A;
      margin-left: -40px; 
      cursor: pointer;
  }

  .search-input i span {
      margin-bottom: -3px;
      display: inline-block;
      vertical-align: middle;
  }

  .search-input input {
      display: inline-block;
      border: 2px solid #54585A;
      width: 100%;
      padding: 10px;
      margin: 10px auto;
      margin-bottom: 10px;
      border-radius: 5px; 
  }

  .search-input .input-single{
      display: inline-block;
      border: 2px solid #54585A;
      width: 100%;
      padding: 10px;
      margin: 10px auto;
      margin-bottom: 20px;
      border-radius: 5px; 
  }

  .signup-input .label-single, .search-input .label-single{
      color: #000000;
      font-size: 18px;
      padding: 8px;
  }

  .search-button button {
      background: #960c22;
      padding: 10px;
      width: 435px;
      color: #fff;
      border-radius: 10px;
  }


  .newline-button button {
      background: #C8102E;
      padding: 10px;
      width: 85px;
      color: #fff;
      border-radius: 10px;
      margin: 10px;
      font-size: 13px;
  }

  .checkboxes {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .checkboxes-modal {
    display: flex;
    flex-direction: row;
    width: 400px;
  }


</style>

<!DOCTYPE html>
<html>
  <?php
  include_once 'header.php';
  ?>
  
  <head2>
      <title>Search</title>
      <link rel="stylesheet" href="style.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  </head2>
  <div class="page-content">
    <div class = "search-body">
      <form action="find" method="POST" class="simple-query-form" target="votar">
        <h2>Search Catalog</h2>
        <div class = "search-input">
            <input type="text" name="ssearch" placeholder="Search..." id="ssearch" class="input-single">
            <i><span class="material-icons-outlined" id ="icon" onclick="">search</span></i>
        </div>
        <div class="checkboxes" name="checkboxes">
          <input type="checkbox" id="book-check" name="check[]" value="books" >
          <label for="book"> Books</label>
          <input type="checkbox" id="disk-check" name="check[]" value="disks" >
          <label for="disk"> Disks</label>
          <input type="checkbox" id="journal-check" name="check[]" value="journals" >
          <label for="journal"> Journals</label>
          <input type="checkbox" id="electronic-check" name="check[]" value="electronics" >
          <label for="electronic"> Electronics</label>
        </div>
        <div class = "search-button">
            <button type="submit" name="simple-submit">Search</button>
        </div>        
      </form>
    </div>
  </div>


</html>
<?php
    include_once 'footer.php';
?>

<script>

    // Open Advanced Search Form Popup Functionality

    let modal = document.getElementById("modalOne");

    let popupBtn = document.getElementById("open-popup");

    let closeBtn = document.getElementById("close-popup");

    popupBtn.onclick = function(e) {
        e.preventDefault();
        modal.style.display = "block";
    };
      
    closeBtn.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
    };

    // Add New Row Functionality to Advanced Search Form

    let addRowBtn = document.getElementById("addfield-btn");
    let searchQueryParent = document.getElementById("search-queries");

    let options = document.querySelector(".options");

    addRowBtn.onclick = function(e) {
      let operray = ["AND", "OR", "NOT"];

      let opselect = document.createElement("select");
      opselect.id = "operator-tags";

      searchQueryParent.appendChild(opselect);

      for(let i = 0; i < operray.length; i++) {
        let option = document.createElement("option");
        option.value = operray[i];
        option.text = operray[i];
        opselect.appendChild(option);
      }

      let params = ["Title", "Author", "Genre", "Publisher", "ISBN", "Any Field"];

      let paramdiv = document.createElement("div");
      paramdiv.className = "options";

      let paramSelect = document.createElement("select");
      paramSelect.id = "search-params";
      paramSelect.name = "parameters";

      paramdiv.appendChild(paramSelect);

      searchQueryParent.appendChild(paramdiv);

      for(let i = 0; i < params.length; i++) {
        let option = document.createElement("option");
        option.value = params[i].toLowerCase();
        option.text = params[i];
        paramSelect.appendChild(option);
      }
      paramSelect.selectedIndex = 5;

      let queryinput = document.createElement("input");
      queryinput.setAttribute("type", "text")
      queryinput.className = "query";
      queryinput.placeholder = "search"
      queryinput.name = "query[]"

      searchQueryParent.appendChild(queryinput);

    }

    // Simple Search Box Functionality

    // var state = false;
    // function toggle(){
    //     alert("Search icon clicked");
    // }

</script>