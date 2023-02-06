<?php
    include 'db.php';
    
    mysqli_query($link, "SET NAMES utf8 collate utf8_general_ci"); 
    
    $per_page = 10;
    
    if(!isset($_GET['page'])){
        $page = 1;
    } else {
        $page = $_GET['page'];
    }
    $start = ($page-1) * $per_page;

    $query = "SELECT * FROM scramble_words ORDER BY id ASC LIMIT $start, $per_page";
    $result = mysqli_query($link, $query);

    echo '<style>';
    echo 'table {
                width: 80%;
                margin: 0 auto;
                border-collapse: collapse;
                font-weight: 800;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
                font-size: 25;
                }';
    echo 'th, td {
                border: 1px solid black;
                padding: 10px;
                }';
    echo 'th {
                background-color: #f2f2f2;
                }';
    echo '.pagination {
                width: 80%;
                margin: 20px auto;
                text-align: center;
                }';
    echo '.pagination a {
                color: black;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
                }';
    echo '.pagination a.active {
                background-color: #4CAF50;
                color: white;
                }';
    echo '.pagination a:hover:not(.active) {
                background-color: #ddd;
                }';
    echo '</style>';
    echo "<table>";
    echo "<tr><th>Word ID</th><th>Word</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $word = $row['word'];
        
        echo "<tr><td>$id</td><td>$word</td></tr>";
    }
    echo "</table>";

    $query = "SELECT COUNT(id) as total FROM scramble_words";
    
    $result = mysqli_query($link, $query);
    $data = mysqli_fetch_assoc($result);
    $total_page = ceil($data['total'] / $per_page);
    
    echo '<div class="pagination">';
    for($i = 1; $i <= $total_page; $i++){
    	
        if($i == $page){
            echo '<a href="?page=' . $i . '" class="active">' . $i . '</a> ';
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a> ';
        }
    }
    echo '</div>';
    
    mysqli_close($link);
?>
