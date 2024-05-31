<?php
include "FileManager.php";

try {
    $rootDir = __DIR__;
    $currentDir = isset($_GET['dir']) ? $_GET['dir'] : '';
    $fileManager = new FileManager($rootDir, $currentDir);
    $items = $fileManager->getItems();
} catch (Exception $e) {
    die($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Manager</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        /* General body styling */
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 i {
            color: #cfa262;
        }

        /* Main container for file manager */
        .file-manager {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }

        /* Flexbox container for items */
        .file-manager__items {
            list-style-type: none;
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
            padding: 0;
            margin: 0;
        }

        /* Styling for directory items */
        .file-manager__item--dir {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Link styling inside directory items */
        .file-manager__item--dir a {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }

        .file-manager__item--dir a .fa-solid,
        .file-manager__item--file .fa-solid {
            font-size: 35px;
        }

        .file-manager__item--dir a .fa-solid {
            color: #FFC36E;
        }

        .file-manager__item--dir a .fa-solid:hover {
            color: #cfa262;
        }

        .file-manager__item--file .fa-solid {
            color: #8f8e8d;
        }
    </style>
</head>
<body>

<!-- Main container for file manager -->
<div class="file-manager">
    <!-- Header section -->
    <h1>File Manager</h1>
    <h2>Current Directory: <?php
        echo ($fileManager->getCurrentDir() === 'Main') ? '<i class="fa-solid fa-folder-closed"></i> ' : '<i class="fa-regular fa-folder-open"></i> ';
        echo $fileManager->getCurrentDir();
        ?> </h2>

    <!-- Container for file items -->
    <div class="file-manager__items">
        <!-- Parent directory link, if not at top directory -->
        <?php if (!$fileManager->checkTopDir()): ?>
            <div class="file-manager__item file-manager__item--parent">
                <a href="?dir=<?php echo urlencode($fileManager->getParentDir()); ?>">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </a>
            </div>
        <?php endif; ?>

        <!-- Iterate through items and display directories and files -->
        <?php foreach ($items as $item): ?>
            <?php if ($item['type'] === 'dir'): ?>
                <div class="file-manager__item file-manager__item--dir">
                    <a href="?dir=<?php echo urlencode($item['path']); ?>">
                        <i class="fa-solid fa-folder-closed"></i>
                        <div>
                            <?php echo htmlspecialchars($item['name']); ?>
                        </div>
                    </a>
                </div>
            <?php else: ?>
                <div class="file-manager__item file-manager__item--file">
                    <i class="fa-solid fa-file"></i>
                    <div>
                        <?php echo htmlspecialchars($item['name']); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
