<?php

require_once 'Docraptor/vendor/autoload.php';

function convert($type, $file) : array {

    $timestamp = time();
    $docraptor = new DocRaptor\DocApi();

//    $docraptor->getConfig()->setUsername("_0IKFO-OmL9kY950nHSb");       // samiducooray@gmail.com
//    $docraptor->getConfig()->setUsername("d6TPLczmi8u9G5PI05cU");       // saminducooray@gmail.com
//    $docraptor->getConfig()->setUsername("69sjFFsGxKX2bNYTTAdr"); // utubemusix0214@gmail.com
//    $docraptor->getConfig()->setUsername("j5kbNCLjn_7ULEGCecf4"); // revoncooray@gmail.com
//    $docraptor->getConfig()->setUsername("V0NNLM7JhMBDxrlkUXRg"); // senuracooray@gmail.com
//    $docraptor->getConfig()->setUsername("kwgTUzFdoUh120QnN4Ru"); // romancooray@gmail.com

    $docraptor->getConfig()->setUsername("67UZqeN5jR_P6Mv7shiJ"); // ramalcooray@gmail.com

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

        return [true, "mrf-".$type."-".$timestamp.".pdf"];

    } catch (DocRaptor\ApiException $error) {
        echo $error . "\n";
        echo $error->getMessage() . "\n";
        echo $error->getCode() . "\n";
        echo $error->getResponseBody() . "\n";
    }

    return [false, false];

}

