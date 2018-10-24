<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    session_start();
    include("$root/components/header.php");
    include("$root/components/scripts/functions.php");
?>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            
            <tr class="heading">
                <td>
                    Item
                </td>
                <td>
                    Qty
                </td>
                <td>
                    Price
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Website design
                </td>
                <td>
                    1
                </td>
                <td>
                    $300.00
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Hosting (3 months)
                </td>
                <td>
                    1
                </td>
                <td>
                    $75.00
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Domain name (1 year)
                </td>
                <td>
                    1
                </td>
                <td>
                    $10.00
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Total: $385.00
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
