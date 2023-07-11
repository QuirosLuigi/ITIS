<!DOCTYPE html>
<html>
<head>
    <title>Stock View</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar">
    <ul class="navbar-nav">
        <li class="logo"> <!-- Logo -->
            <a href="<?php echo "ownerhome.php"; ?>" class="nav-link">
                <span class="link-text">Restoran</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M61.1 224C45 224 32 211 32 194.9c0-1.9 .2-3.7 .6-5.6C37.9 168.3 78.8 32 256 32s218.1 136.3 223.4 157.3c.5 1.9 .6 3.7 .6 5.6c0 16.1-13 29.1-29.1 29.1H61.1zM144 128a16 16 0 1 0 -32 0 16 16 0 1 0 32 0zm240 16a16 16 0 1 0 0-32 16 16 0 1 0 0 32zM272 96a16 16 0 1 0 -32 0 16 16 0 1 0 32 0zM16 304c0-26.5 21.5-48 48-48H448c26.5 0 48 21.5 48 48s-21.5 48-48 48H64c-26.5 0-48-21.5-48-48zm16 96c0-8.8 7.2-16 16-16H464c8.8 0 16 7.2 16 16v16c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V400z"/>
                </svg>
            </a>
        </li>
        <li class="nav-item"> <!-- Input Stock Purchased -->
            <a href="<?php echo "stockpurchased.php"; ?>" class="nav-link">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 1C0.447715 1 0 1.44772 0 2C0 2.55228 0.447715 3 1 3H3.20647L5.98522 14.9089C6.39883 16.6816 7.95486 17.9464 9.76471 17.9983V18H17.5874C19.5362 18 21.2014 16.5956 21.5301 14.6747L22.7857 7.33734C22.9947 6.11571 22.0537 5 20.8143 5H5.72686L4.97384 1.77277C4.86824 1.32018 4.46475 1 4 1H1ZM6.19353 7L7.9329 14.4545C8.14411 15.3596 8.95109 16 9.88058 16H17.5874C18.5618 16 19.3944 15.2978 19.5588 14.3373L20.8143 7H6.19353Z" fill="#000000"></path>
                <path d="M8 23C9.10457 23 10 22.1046 10 21C10 19.8954 9.10457 19 8 19C6.89543 19 6 19.8954 6 21C6 22.1046 6.89543 23 8 23Z" fill="#000000"></path>
                <path d="M19 23C20.1046 23 21 22.1046 21 21C21 19.8954 20.1046 19 19 19C17.8954 19 17 19.8954 17 21C17 22.1046 17.8954 23 19 23Z" fill="#000000"></path>
            </g>
            </svg>
                <span class="link-text">Input Stocks Purchased</span>
            </a>
        </li>
        <li class="nav-item"> <!-- Input Expired Ingredient -->
            <a href="<?php echo "expiredstock.php"; ?>" class="nav-link">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 1C0.447715 1 0 1.44772 0 2C0 2.55228 0.447715 3 1 3H3.20647L5.98522 14.9089C6.39883 16.6816 7.95486 17.9464 9.76471 17.9983V18H17.5874C19.5362 18 21.2014 16.5956 21.5301 14.6747L22.7857 7.33734C22.9947 6.11571 22.0537 5 20.8143 5H5.72686L4.97384 1.77277C4.86824 1.32018 4.46475 1 4 1H1ZM6.19353 7L7.9329 14.4545C8.14411 15.3596 8.95109 16 9.88058 16H17.5874C18.5618 16 19.3944 15.2978 19.5588 14.3373L20.8143 7H6.19353Z" fill="#000000"></path>
                <path d="M8 23C9.10457 23 10 22.1046 10 21C10 19.8954 9.10457 19 8 19C6.89543 19 6 19.8954 6 21C6 22.1046 6.89543 23 8 23Z" fill="#000000"></path>
                <path d="M19 23C20.1046 23 21 22.1046 21 21C21 19.8954 20.1046 19 19 19C17.8954 19 17 19.8954 17 21C17 22.1046 17.8954 23 19 23Z" fill="#000000"></path>
            </g>
            </svg>
                <span class="link-text">Input Expired Ingredient</span>
            </a>
        </li>
        <li class="nav-item"> <!-- Input Manual Stock Count -->
            <a href="<?php echo "manstockcount.php"; ?>" class="nav-link">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier"> <path d="M9 7H15" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M15 17V14" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M15 11H15.01" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12 11H12.01" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9 11H9.01" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9 14H9.01" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12 14H12.01" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12 17H12.01" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9 17H9.01" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M5 7C5 5.11438 5 4.17157 5.58579 3.58579C6.17157 3 7.11438 3 9 3H12H15C16.8856 3 17.8284 3 18.4142 3.58579C19 4.17157 19 5.11438 19 7V12V17C19 18.8856 19 19.8284 18.4142 20.4142C17.8284 21 16.8856 21 15 21H12H9C7.11438 21 6.17157 21 5.58579 20.4142C5 19.8284 5 18.8856 5 17V12V7Z" stroke="#000000" stroke-width="2" stroke-linejoin="round"></path> 
                </g>
            </svg>
            <span class="link-text">Input Manual Stock Count</span>
            </a>
        </li>
        <li class="nav-item"> <!-- View Stock -->
            <a href="viewstock.php" class="nav-link">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path d="M9 13H15" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M3 6.5C3 6.03534 3 5.80302 3.03843 5.60982C3.19624 4.81644 3.81644 4.19624 4.60982 4.03843C4.80302 4 5.03534 4 5.5 4H12H18.5C18.9647 4 19.197 4 19.3902 4.03843C20.1836 4.19624 20.8038 4.81644 20.9616 5.60982C21 5.80302 21 6.03534 21 6.5V6.5V6.5C21 6.96466 21 7.19698 20.9616 7.39018C20.8038 8.18356 20.1836 8.80376 19.3902 8.96157C19.197 9 18.9647 9 18.5 9H12H5.5C5.03534 9 4.80302 9 4.60982 8.96157C3.81644 8.80376 3.19624 8.18356 3.03843 7.39018C3 7.19698 3 6.96466 3 6.5V6.5V6.5Z" stroke="#000000" stroke-width="2" stroke-linejoin="round"></path>
                <path d="M4 9V15.9999C4 17.8856 4 18.8284 4.58579 19.4142C5.17157 19.9999 6.11438 19.9999 8 19.9999H9H15H16C17.8856 19.9999 18.8284 19.9999 19.4142 19.4142C20 18.8284 20 17.8856 20 15.9999V9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </g>
            </svg>
                <span class="link-text">View Stock</span>
            </a>
        </li>
        <li class="nav-item"> <!-- Logout -->
            <a href="logout.php" class="nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
            </svg>
                <span class="link-text">Log Out
                </span>
            </a>
        </li>
    </ul>
</nav>
<div class="stockview">
<h1>Stock View</h1>
    <div class="content">
        <table>
            <tr>
                <th scope="col">Ingredient</th>
                <th scope="col">Quantity</th>
                <th scope="col">Measurement</th>
            </tr>
            <tbody>
            <?php 
            $DBConnect = mysqli_connect("localhost", "root", "") or die ("Unable to Connect". mysqli_error());
            $db = mysqli_select_db($DBConnect, 'itisdev_db');
                $query = mysqli_query($DBConnect, "SELECT i.ingredientName, i.quantity, u.unitName FROM ingredient i JOIN unit u ON i.unitID=u.unitID");
                while($retrieve = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td> <?= $retrieve['ingredientName']?></td>
                <td><?= $retrieve['quantity']?></td>
                <td><?= $retrieve['unitName']?></td>
            </tr>
            <?php 
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>