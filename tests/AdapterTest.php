<?php

use vector\PMCAdapter\PMCAdapter;

class AdapterTest extends PHPUnit_Framework_TestCase{

    /**
     * @var PMCAdapter
     */
    private $adapter;
    private $settings;

    protected function setUp()
    {
        parent::setUp();
        $this->settings = require __DIR__ . '/data/settings.php';
        $this->adapter = new PMCAdapter( $this->settings['app_name'], $this->settings['email'] );
    }

    public function testGetPaper(){
        $result = $this->adapter->lookupPMCID( 3539452 );

        self::assertEquals( "The Development and Activity-Dependent Expression of Aggrecan in the Cat Visual Cortex", $result->getTitle() );
        self::assertEquals( 7, count( $result->getAuthors() ) );
        self::assertEquals( "Cerebral Cortex (New York, NY)", $result->getJournalName() );
        self::assertEquals( "2012 Feb 23", $result->getPublicationDate() );
        self::assertEquals( true, $this->adapter->wasSuccessful() );
    }

    public function testBad(){
        $result = $this->adapter->lookupPMCID( "" );
        self::assertEquals( PMCAdapter::BAD_REQUEST, $result );
        self::assertEquals( false, $this->adapter->wasSuccessful() );
    }

    public function testNotFound(){
        $result = $this->adapter->lookupPMCID( 999999 );
        self::assertEquals( PMCAdapter::NOT_FOUND, $result );
        self::assertEquals( false, $this->adapter->wasSuccessful() );
    }

    public function testInvalid(){
        $result = $this->adapter->lookupPMCID( "not-an-id" );
        self::assertEquals( PMCAdapter::INVALID_ID, $result );
        self::assertEquals( false, $this->adapter->wasSuccessful() );
    }
}
