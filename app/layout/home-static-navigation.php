<!-- Responsive Navigation Bar -->
<nav class="navbar">
    <ul class="nav-links">
        <?php
        // Loop through the array to create the navigation menu
        foreach ($menu_items as $item => $data) {
            echo '<li><a href="' . $data['link'] . '">' . $data['icon'] . ' ' . $item . '</a></li>';
        }
        ?>
    </ul>
    <div class="search">
        <input type="text" placeholder="Search...">
        <button>SEARCH</button>
    </div>
</nav>



<style>
    /* Basic Styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: #333;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
    align-items: center;
}

.nav-links {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.nav-links li {
    margin: 0 15px;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    display: flex;
    align-items: center;
}

.nav-links a svg {
    margin-right: 8px; /* Space between icon and text */
}

.search input {
    padding: 8px;
    margin-right: 10px;
    border: 1px solid #ccc;
}

.search button {
    padding: 8px 12px;
    background-color: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
}

/* Hover Effect */
.nav-links a:hover {
    color: #ddd;
}

/* Media Query for Responsive Design */
@media screen and (max-width: 768px) {
    .navbar {
        flex-direction: column;
    }

    .nav-links {
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .nav-links li {
        margin: 10px 0;
    }

    .search {
        width: 100%;
        text-align: center;
        margin-top: 10px;
    }
}
</style>