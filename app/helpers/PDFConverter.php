<?php

require_once 'Docraptor/vendor/autoload.php';

function convert() : string {

    $docraptor = new DocRaptor\DocApi();

//    $docraptor->getConfig()->setUsername("_0IKFO-OmL9kY950nHSb");       // samiducooray@gmail.com
    $docraptor->getConfig()->setUsername("d6TPLczmi8u9G5PI05cU");       // saminducooray@gmail.com
    try {
        $doc = new DocRaptor\Doc();
        $doc->setTest(true); # test documents are free but watermarked
        $doc->setDocumentType("pdf");
        $file = file_get_contents(APP_ROOT . '\views\templates\mrfCreated.html');
        $doc->setDocumentContent($file);
        $doc->setName("Output.pdf"); # help you find a document later
        $prince_options = new DocRaptor\PrinceOptions();
        $doc->setPrinceOptions($prince_options);
        $prince_options->setMedia("screen"); # @media 'screen' or 'print' CSS

        $response = $docraptor->createDoc($doc);

        # createDoc() returns a binary string
        file_put_contents("Output.pdf", $response);

        return "Successful";

    } catch (DocRaptor\ApiException $error) {
        echo $error . "\n";
        echo $error->getMessage() . "\n";
        echo $error->getCode() . "\n";
        echo $error->getResponseBody() . "\n";
    }

    return "Error";

}

