<?php

namespace Tests\Helper;

use Tests\TestCase;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;

class HelperTest extends TestCase
{

    public function testArrayToString()
    {

        $array = [
            "This",
            "is",
            "a",
            "comma",
            "delimited",
            "list"
        ];

        $this->assertEquals("This, is, a, comma, delimited, list. ", Helpers::arrayToString($array));

    }

    public function testGetCalledClassNameOnly()
    {

        $this->assertEquals("HelperTest", Helpers::getCalledClassNameOnly(get_called_class()));

    }

    public function testRemoveUrlProtocol()
    {

        $urlWithProtocol = "https://mws.amazonservices.com";

        $this->assertEquals("mws.amazonservices.com", Helpers::removeUrlProtocol($urlWithProtocol));

    }

    public function testDD()
    {

        $message = "Howdy!";

        Helpers::dd($message);

        $this->expectOutputString("<br><pre>Howdy!</pre><br>");

    }

    public function testDDXml()
    {

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= "<note>
                    <to>Tove</to>
                    <from>Jani</from>
                    <body>Don't forget me this weekend!</body>
                    <heading>Reminder</heading>
                </note>";

        Helpers::ddXml($xml);

        $this->expectOutputString("<br><pre>&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;&lt;note&gt;
                    &lt;to&gt;Tove&lt;/to&gt;
                    &lt;from&gt;Jani&lt;/from&gt;
                    &lt;body&gt;Don't forget me this weekend!&lt;/body&gt;
                    &lt;heading&gt;Reminder&lt;/heading&gt;
                &lt;/note&gt;</pre>");

    }

}