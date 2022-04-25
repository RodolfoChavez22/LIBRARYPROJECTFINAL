<style>
    .modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: 200ms ease-in-out;
        border: 1px solid black;
        border-radius: 10px;
        z-index: 10;
        background-color: #E2DFDF;
        width: 700px;
        max-width: 80%;
    }

    .modal.active {
        transform: translate(-50%, -50%) scale(1);
    }

    .modal-header {
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header .title {
        font-size: 1.25rem;
        font-weight: bold;
        width: 100%;
        text-align: center;
    }

    .modal-header .close-button {
        cursor: pointer;
        border: none;
        outline: none;
        background: none;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .modal-body {
        padding: 10px 15px;
        text-align: left;
    }

    .modal-body-image {
        display: inline;
        vertical-align: top;
    }

    .modal-body-text {
        display: inline;
        vertical-align: top;
        margin-left: 10px;
    }

    .modal-button-open {
        cursor: pointer;
        border: none;
        outline: none;
        background: none;
        font-weight: bold;
    }

    #overlay {
        position: fixed;
        opacity: 0;
        transition: 200ms ease-in-out;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0);
        pointer-events: none;
        z-index: 9;
    }

    #overlay.active {
        opacity: 1;
        pointer-events: all;
    }

    #center-content {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    #center {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .button-reserve {
        color: black;
        font-size: 18px;
        cursor: pointer;
        background: #5bad4c;
        font-weight: bold;
        padding: 5px;
        border-radius: 5px;
    }

    .button-reserve:hover {
        background: #529c44;
    }

    .error {
        width: 100%;
        background: red;
        text-align: center;
        padding: 20px;
        border-bottom: 3px solid rgba(0, 0, 0, .15);
    }

    .success {
        width: 100%;
        background: #38B023;
        text-align: center;
        padding: 20px;
        border-bottom: 3px solid rgba(0, 0, 0, .15);
    }

    .search-button {
        background-color: #960C22;
        color: #000;
        cursor: pointer;
        color: white;
        font-weight: bold;
        margin: 0;
        top: 50%;
        padding: 10px 15px;
        text-align: center;
        transition: 200ms;
        box-sizing: border-box;
        border: 0;
        font-size: 24px;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .search-button:not(:disabled):hover,
    .search-button:not(:disabled):focus {
        outline: 0;
        background: #C8102E;
    }

    .search-button:disabled {
        filter: saturate(0.2) opacity(0.5);
        -webkit-filter: saturate(0.2) opacity(0.5);
        cursor: not-allowed;
    }

    .btn {
        background-color: #f4511e;
        border-style: solid;
        border-width: 3px;
        text-align: center;
        margin: 4px 2px;
        opacity: 0.6;
        transition: 0.2s;
        cursor: pointer;
    }

    .btn:hover {
        opacity: 1;
    }

    footer {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>

<?php
include 'connect.php';

$sql = "SELECT book.Name, book.Img FROM book WHERE Deleted_id = 0";

$UID;

if(!empty($_SESSION['User_Status'])) {
    $UID = $_SESSION['User_id'];
}
?>

<?php
include_once 'header.php';
?>

<head2>
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
</head2>

<?php
if (isset($_REQUEST['error'])) {
    $Error = $_REQUEST['error'];
    if ($Error == 1) {
        echo '<h4 class = "error">You must be logged in to reserve books</h4>';
    }
    if ($Error == 2) {
        echo '<h4 class = "error">There was an error reserving your item</h4>';
    }
    if ($Error == 3) {
        echo '<h4 class = "error">You cannot request any more items, please return or cancel a item before requesting anymore</h4>';
    }
    if ($Error == 4) {
        echo '<h4 class = "error">The item you requested is not available at this time</h4>';
    }
}
if (isset($_REQUEST['success'])) {
    $Success = $_REQUEST['success'];
    echo '<h4 class = "success">Your request of: "' . $Success . '" was successful</h4>';
}
?>

<div id="center-content">
    <section style="text-align:center; color:white; padding-top:76px;">
        <form action="find" method="POST">
            <button class="search-button", name="ssearch", id="ssearch" style="border-style: solid; border-width: 3px; border-color: #000;">View Entire Catalog</button>
        </form>
    </section>

    <section style="text-align:center; color:white; padding-top:50px;">
        <h1 style="margin-bottom:10px;">Check out these books before they're gone!</h1>
    </section>

    <div id="center">
        <?php
        include 'connect.php';

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $PageResults = 10;
        $FirstResult = ($page - 1) * $PageResults;
        $num = $FirstResult;

        $sql = "SELECT book.Book_id AS sID, book.Name AS sName, book.Rental_status AS sRental, book.ISBN AS sNum, book.Pages AS sPages, 
                            book.Publisher, book.Publish_date AS sPublished, book.Deleted_id AS dID, book.Img AS sImg, book.Description AS sDescription,
                            publisher.Publisher_id, publisher.Publisher_name AS sPublisher,
                            author.Author_id, GROUP_CONCAT(author.FName), GROUP_CONCAT(author.LName), authorbookjoin.Author_id, authorbookjoin.Book_id,
                            itemtype.Type_id, itemtype.Type_name AS sType, ('dummy') AS eType
                        FROM book
                        INNER JOIN itemtype ON book.Reference_type = itemtype.Type_id
                        INNER JOIN publisher ON book.Publisher = publisher.Publisher_id
                        INNER JOIN authorbookjoin ON book.Book_id = authorbookjoin.Book_id 
                        INNER JOIN author ON authorbookjoin.Author_id = author.Author_id
                        WHERE book.Rental_status>0 
                        GROUP BY sID";

        if (!empty($sql)) {
            $sql = $sql . " ORDER BY sName LIMIT $FirstResult, $PageResults";
        }

        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
        } else {
            $result = mysqli_query($con, $sql);
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $Type = $row['sType'];
            $ID = $row['sID'];
            $Name = $row['sName'];
            $IDNum = $row['sNum'];
            $Pages = $row['sPages'];
            $Publisher = $row['sPublisher'];
            $Published = $row['sPublished'];
            $Rental = $row['sRental'];
            $Img = $row['sImg'];
            $Description = $row['sDescription'];
            $Etype = $row['eType'];
            $Genre = '';
            if ($Type == 'Book') {
                $sql2 = "SELECT book.Book_id, book.Deleted_id,
                            publisher.Publisher_id, publisher.Publisher_name,
                            genre.Genre_id, GROUP_CONCAT(genre.Genre_type SEPARATOR ', ') AS genres, genrebookjoin.Genre_id, genrebookjoin.Book_id
                            FROM book
                            INNER JOIN publisher ON book.Publisher = publisher.Publisher_id
                            INNER JOIN genrebookjoin ON book.Book_id = genrebookjoin.Book_id 
                            INNER JOIN genre ON genrebookjoin.Genre_id = genre.Genre_id
                            WHERE book.Deleted_id=0 AND book.Book_id = $ID
                            GROUP BY book.Book_id";
            }

            $stmt2 = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                echo "SQL statement failed";
            } else {
                $result2 = mysqli_query($con, $sql2);
            }
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $Genre = $row2['genres'];
            }

            if ($Type != 'Electronic') {
                $stmt2 = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                    echo "SQL statement failed";
                } else {
                    $result2 = mysqli_query($con, $sql2);
                }
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $Genre = $row2['genres'];
                }

                $Flist = explode(',', $row['GROUP_CONCAT(author.FName)']);
                $Llist = explode(',', $row['GROUP_CONCAT(author.LName)']);
                $ListName = '';
                $FullName = '';
                for ($x = 0; $x < sizeof($Flist); $x += 1) {
                    $ListName = $ListName . $Flist[$x] . ' ' . $Llist[$x] . ', ';
                    $FullName = $FullName . $Flist[$x] . ' ' . $Llist[$x] . '<br> ';
                }
                $FullName = trim($FullName);
                $FullName = substr($FullName, 0, -1);
                $ListName  = trim($ListName);
                $ListName  = substr($ListName, 0, -1);
            }

            if ($Genre != '') {
                $num += 1;
                echo '<tbody>          
                <img class="btn" id = "' . $num . '" onclick ="content()" src="img/' . $Img . '" width=160 height=240>
                <div class="modal" id="modal' . $num . '">
                    <div class="modal-header">
                        <div class="title">' . $Name . '</div>
                            <button data-close-button class="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <div class = "modal-body-image">
                        <img src="img/' . $Img . '" width=160 height=240 style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; border: 3px solid rgba(0,0,0,.25); border-radius: 5px;">
                </div>
                <div class = "modal-body-text">
                <div style ="display:inline-block;"> 
                    <div style = "color: rgba(0,0,0,.50); display:inline-block;"> 
                        <b>Details</b> 
                        <hr style="width:400px; border-color: rgba(0,0,0,.15); display:inline-block; position: relative; top: -3px;"> </hr>
                    </div> <br>
                    <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">';
                if ($Type != 'Electronic') {
                    echo '<b>Authors:</b> ' . $ListName . '';
                } else {
                    echo '<b>Type:</b> ' . $Etype . '';
                }
                echo '
                    </div><br>
                    <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">';
                if ($Type != 'Electronic') {
                    echo '<b>Publisher:</b> ' . $Publisher . '';
                } else {
                    echo '<b>Brand:</b> ' . $Publisher . '';
                }
                echo '
                    </div><br>
                    <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">';
                if ($Type != 'Electronic') {
                    echo '<b>Published:</b> ' . $Published . '';
                } else {
                    echo '<b>Released:</b> ' . $Published . '';
                }
                echo '
                </div><br>';
                if ($IDNum != 0) {
                    echo '<div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                    <b>ISBN/ISSN:</b> ' . $IDNum . '
                </div><br>
                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                    <b>Pages:</b> ' . $Pages . '
                </div><br>';
                }
                echo '
                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                    <b>Available Copies:</b> ' . $Rental . '
                </div><br>';
                if ($Rental != 0) {
                    echo '<div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                    <button type="button" class = "button-reserve" onclick="location.href=\'reserve?reserve=' . $ID . '&type=' . $Type . '\'">Reserve Now</button>
                </div><br>';
                }
                echo '
                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                    <b>Description:</b><br>
                    <div style="margin-left: 10px;display:inline-block;"><small>' . $Description . '</small></div>
                    </div><br>
                    </div>
                </div>
            </div>
        </div>
    <div id="overlay"></div>
</tbody>';
            }
            $Genre = '';
        }
        echo '</tbody>';
        ?>
    </div>
</div>

<?php
include_once 'footer.php';
?>

<script>
    const openModalButtons = document.querySelectorAll('[data-modal-target]')
    const closeModalButtons = document.querySelectorAll('[data-close-button]')
    const overlay = document.getElementById('overlay')

    openModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.querySelector(button.dataset.modalTarget)
            openModal(modal)
        })
    })

    overlay.addEventListener('click', () => {
        const modals = document.querySelectorAll('.modal.active')
        modals.forEach(modal => {
            closeModal(modal)
        })
    })

    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal')
            closeModal(modal)
        })
    })

    function openModal(modal) {
        if (modal == null) return
        modal.classList.add('active')
        overlay.classList.add('active')
    }

    function closeModal(modal) {
        if (modal == null) return
        modal.classList.remove('active')
        overlay.classList.remove('active')
    }

    function content() {
        const modal = document.querySelector('#modal' + event.srcElement.id)
        openModal(modal)
    }
</script>