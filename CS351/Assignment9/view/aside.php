<?php

?>

<aside> 
    <ul>
        <?php foreach ($categories as $category): ?>
        <?php
            $name = $category['category_name'];
            $action = strtolower($name);
        ?>
        
        <li> 
            <a class ="button" href="./index.php?action=<?= urlencode($action) ?>">
                <?= htmlspecialchars($name) ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</aside>

