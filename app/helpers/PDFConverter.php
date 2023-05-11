<?php

require_once 'Docraptor/vendor/autoload.php';
require_once APP_ROOT . '/models/Common.php';

function convert($type, $file) : array {

    $timestamp = time();
    $commonModel = new Common();
    $key = $commonModel->apiKey()->key;
    $docraptor = new DocRaptor\DocApi();

    $docraptor->getConfig()->setUsername($key);

    try {
        $doc = new DocRaptor\Doc();
        $doc->setTest(true); # test documents are free but watermarked
        $doc->setDocumentType("pdf");
//        $file = file_get_contents('../public/documents/mrf/mrf-'.$type.'-'.$timestamp.'.html');
        $doc->setDocumentContent($file);
        $doc->setName("mrf-".$type."-".$timestamp.".pdf"); # help you find a document later
        $prince_options = new DocRaptor\PrinceOptions();
        $doc->setPrinceOptions($prince_options);
        $prince_options->setMedia("screen"); # @media "screen' or 'print' CSS

        $response = $docraptor->createDoc($doc);

        # createDoc() returns a binary string
        file_put_contents('../public/documents/mrf/mrf-'.$type.'-'.$timestamp.'.pdf', $response);

        $commonModel->apiKeyUpdate($key);

        return [true, "mrf-".$type."-".$timestamp.".pdf"];

    } catch (DocRaptor\ApiException $error) {
        echo $error . "\n";
        echo $error->getMessage() . "\n";
        echo $error->getCode() . "\n";
        echo $error->getResponseBody() . "\n";
    }

    return [false, false];

}

