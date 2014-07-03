<?php

function generateAuthToken() {
    // token format = uniqid - md5 ( time ) - random number
    $p1 = uniqid();
    $p2 = md5(time());
    $p3 = mt_rand();
    $token = sprintf("%s-%s-%s", $p1, $p2, $p3);

    return $token;
}


function responseObject() {
    $registry = Registry::instance();
    return $registry->get( 'response' );
}


function connectionObject() {
    $registry = Registry::instance();
    return $registry->get('connection');
}


/**
 * Retrieves a variable from $_REQUEST array
 * @param string    name of variable      required
 * @param string    default value of variable in case it is missing from request      optional
 */
function get_var( $param, $default_value = null ) {
    if( isset( $_REQUEST[$param]) && trim($_REQUEST[$param] )!="" ) {
        return $_REQUEST[$param];
    } else {
        return $default_value;
    }
}


/**
 * Retrieve a row from db using given table, column name and its value
 * @param $table string table name
 * @param $col string will SELECT these columns, value can be * for all columns
 * @param $key string for use in WHERE clause
 * @param $val string value of $key
 */
function db_row( $table, $col, $key = "", $val = "" ) {
    // get connection object from registry
    $conn = connectionObject();

    $qry = 'SELECT ' . $col . ' FROM ' . $table ;

    if( $key != "" && $val != "" ) {
        $qry .= ' WHERE ' . $key . ' = :val';
    }

    $stmt = $conn->prepare( $qry );
    if( $key != "" && $val != "" ) {
        $stmt->bindParam( ':val', $val );
    }

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function db_rows_paged( $table, $col, $key = "", $val = "", $page = 1, $per_page = 10 ) {
    // get connection object from registry
    $conn = connectionObject();

    // set basic select query
    $qry = 'SELECT ' . $col . ' FROM ' . $table ;

    // bind parameters if given
    if( $key != "" && $val != "" ) {
        $qry .= ' WHERE ' . $key . ' = :val';
    }

    // Add paging
    $page_from = ( $page - 1 ) * $per_page ;
    $page_to     = $page * 10;
    $qry .= sprintf(' LIMIT %s, %s', $page_from, $page_to);

    $stmt = $conn->prepare( $qry );
    if( $key != "" && $val != "" ) {
        $stmt->bindParam( ':val', $val );
    }
}
