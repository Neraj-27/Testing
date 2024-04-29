
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <img src="img/2.png" alt="Logo">
            </button>
            <div class="sidebar-logo">
                <a href="#">Feast2U</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=1" class="sidebar-link" onclick="loadContentAndSubmitForm('starters.php', 1)">
                    <i class='bx bxs-cookie' ></i>
                    <span>Starters</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=2" class="sidebar-link" onclick="loadContentAndSubmitForm('drinks.php', 2)">
                    <i class='bx bx-beer'></i>                        
                    <span>Drinks & Beverages</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=3" class="sidebar-link" onclick="loadContentAndSubmitForm('breakfast.php', 3)">
                    <i class='bx bxs-bowl-hot'></i>                     
                    <span>Breakfast</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=4" class="sidebar-link" onclick="loadContentAndSubmitForm('lunch.php', 4)">
                    <i class='bx bxs-bowl-rice' ></i>              
                    <span>Lunch</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=5" class="sidebar-link" onclick="loadContentAndSubmitForm('dinner.php', 5)">
                    <i class='bx bxs-dish'></i>
                    <span>Dinner</span>
                </a>
            </li>
        </ul>
    </aside>
    <div class="main p-3">
        <div id="content">
            <!-- Content will be loaded here -->
            <div class="container my-5">
                <div class="card-container" style="display: flex; flex-wrap: nowrap; justify-content: space-between;">
                
                     <?php echo $searchResults; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="selectedCatIdDisplay"></div>

<form id="catIdForm" method="post" action="process_cat_id.php">
    <input type="hidden" name="selectedCatId" id="selectedCatIdInput">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
<script>
    var selectedCatId;

    function loadContentAndSubmitForm(page, cat_id) {
        document.getElementById("selectedCatIdInput").value = cat_id;
        document.getElementById("catIdForm").submit();
        loadContent(page, cat_id);
        document.getElementById("selectedCatIdDisplay").innerText = "Selected Category ID: " + cat_id;
    }

    function updateSelectedCatId(cat_id) {
        document.getElementById("selectedCatIdInput").value = cat_id;
        document.getElementById("catIdForm").submit();
        document.getElementById("selectedCatIdDisplay").innerText = "Selected Category ID: " + cat_id;
    }

    function loadContent(page, cat_id) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", page, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("content").innerHTML = xhr.responseText;
                selectedCatId = cat_id;
            }
        };
        xhr.send();
    }
</script>
<script src="script.js"></script>
