<html>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" type='text/css'>
<link rel="stylesheet" href="style.css">


<?php
require __DIR__ . '/connectto_new_schema.php';
$conn = connecttoDB();

function func1()
{
    echo "hello world";
}

?>
<br>
<?php
if (isset($_POST["lname"]) && $_POST["lname"] !== '') {
    $fname = "'" . $_POST["fname"] . "'";
    $lname = "'" . $_POST["lname"] . "'";
    $addr = "'" . $_POST["addr"] . "'";
    $city = "'" . $_POST["city"] . "'";

    $sqlreq = 'INSERT INTO new_schema.people (FNAME, LNAME, ADDR, CITY) VALUES (' . $fname . ',' . $lname . ',' . $addr . ',' . $city . ');';
    $result = $conn->query($sqlreq);
    if ($result)
        echo "New record created successfully";
    else
        echo "Error: " . $sqlreq . "<br>" . $conn->error;
} else
    echo "A last name is required!";

?>


<body>

    <form action="" method='post'>
        <table style='text-align: right'>
            <tr>
                <td>
                    FName:
                </td>
                <td>
                    <input type='text' name='fname'>
                </td>
            </tr>
            <tr>
                <td>
                    *LName:
                </td>
                <td>
                    <input type='text' name='lname'>
                </td>
            </tr>
            <tr>
                <td>
                    Address:
                </td>
                <td>
                    <input type='text' name='addr'>
                </td>
            </tr>
            <tr>
                <td>
                    City:
                </td>
                <td>
                    <input type='text' name='city'>
                </td>
            </tr>
            <tr>
                <td>
                    img:
                </td>
                <td>
                    <input type='text' name='img' disabled=true>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type='submit' value='CREATE' />
                </td>
            </tr>
        </table>
        <input type='hidden' name='count' value='0'>
    </form>

    <hr>
    <br>

    <form action="" method='POST'>
        <input style='width: 3rem' type='number' name='count' value='0' />
        # of records to <input type='submit' value='READ' />
    </form>

    <form action="" method='POST'>
        <table>
            <tr>
                <th>ID</th>
                <th>FName</th>
                <th>LName</th>
                <th style="padding-right: 7rem">Addr</th>
                <th>City</th>
                <th>Img</th>
            </tr>

            <?php
            if (isset($_POST["count"])) {
                $count = $_POST["count"];
                if ($count < 0)
                    return;
                $sqlreq = "SELECT * FROM new_schema.people LIMIT $count;";
                $result = $conn->query($sqlreq);
                if ($result->num_rows > 0)
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td>' . $row["ID"] . "</td><td>" . $row["FNAME"] . "</td><td>" . $row["LNAME"] . "</td><td>" . $row["ADDR"] . "</td><td>" . $row["CITY"] . "</td>";
                        echo '</td><td>' . $row["IMG"] . '</td>';
                        echo '</tr>';
                    }
            }
            ?>
        </table>
    </form>

    <hr>
    <br>

    <?php
        if (isset($_POST["uplname"])) {
            $fname = $_POST["upfname"];
            $lname = $_POST["uplname"];
            $addr = $_POST["upaddr"];
            $city = $_POST["upcity"];
            $id = $_POST["upid"];

            $sqlreq = "UPDATE new_schema.people
                                SET FNAME='$fname', LNAME='$lname', ADDR='$addr', CITY='$city'
                            WHERE ID = $id";
            $conn = connecttoDB();
            $result = $conn->query($sqlreq);
            if ($result)
                echo "Record updated successfully";
            else
                echo "Error updating record: " . $conn->error;
        }
    ?>
    <label>UPDATE</label>
    <form action="" method='POST'>
        ID: <input style='width: 2rem' type='number' name='updateidnumber'>
        <input type='submit' value='PICK'>
        <?php

        // echo '<input type="hidden" name="updatefname" "value="' . $updatefname . '">';
        // echo '<input type="hidden" name="updatelname" "value="' . $updatelname . '">';
        // echo '<input type="hidden" name="updateaddr" "value="' . $updateaddr . '">';
        // echo '<input type="hidden" name="updatecity" "value="' . $updatecity . '">';
        ?>
    </form>

    <form action="" method='POST'>
        <table>
            <tr>
                <!-- <th>ID</th> -->
                <th>FName</th>
                <th>LName</th>
                <th style="padding-right: 7rem">Addr</th>
                <th>City</th>
                <th>Img</th>
            </tr>
            <?php
            if (isset($_POST["updateidnumber"])) {
                $id = $_POST["updateidnumber"];
                $sqlreq = "SELECT * FROM new_schema.people WHERE ID = $id";
                $result = $conn->query($sqlreq);
                if ($result->num_rows > 0)
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo "<td><input type='text'" . 'value="' . $row['FNAME'] . '"' . 'name="upfname"' . "></td>";
                        echo "<td><input type='text'" . 'value="' . $row['LNAME'] . '"' . 'name="uplname"' . "></td>";
                        echo "<td><input type='text'" . 'value="' . $row['ADDR'] . '"' . 'name="upaddr"' . "></td>";
                        echo "<td><input type='text'" . 'value="' . $row['CITY'] . '"' . 'name="upcity"' . "></td>";
                        echo "</tr>";
                        echo '<input type="hidden" name="upid" value='. $id .'>';
                    }
            }
            ?>
        </table>
        <input type='submit' value='UPDATE' name='updatedatabase'>
    </form>


</body>

</html>