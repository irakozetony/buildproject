<?php

require "../database/dbconnection.php";

if(isset($_GET['user']))
{
$user=$_GET['user'];
}
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    ob_start();
    include(dirname(__FILE__).'/res/specific.php');
    $content = ob_get_clean();

    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        ob_end_clean();
        $html2pdf->Output('specific.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }