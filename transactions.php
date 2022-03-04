<?php
function dbtransactions($query){
    /* Tell mysqli to throw an exception if an error occurs */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    include 'connectDB.php';

    /* Start transaction */
    mysqli_begin_transaction($link);

    // Turn autocommit off
    mysqli_autocommit($link,FALSE);

    // Insert some values
    $queryresult=mysqli_query($link,$query);

        // Commit transaction
    if (!mysqli_commit($link)){
    $link->rollback();
    return false;
    }

    mysqli_close($link);
    return $queryresult;
}
?>
