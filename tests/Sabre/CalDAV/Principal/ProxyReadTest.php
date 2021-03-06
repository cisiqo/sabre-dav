<?php

namespace Sabre\CalDAV\Principal;
use Sabre\DAVACL;

class ProxyReadTest extends \PHPUnit_Framework_TestCase {

    protected $backend;

    function getInstance() {

        $backend = new DAVACL\PrincipalBackend\Mock();
        $principal = new ProxyRead($backend, array(
            'uri' => 'principal/user',
        ));
        $this->backend = $backend;
        return $principal;

   }

    function testGetName() {

        $i = $this->getInstance();
        $this->assertEquals('calendar-proxy-read', $i->getName());

    }
    function testGetDisplayName() {

        $i = $this->getInstance();
        $this->assertEquals('calendar-proxy-read', $i->getDisplayName());

    }

    function testGetLastModified() {

        $i = $this->getInstance();
        $this->assertNull($i->getLastModified());

    }

    /**
     * @expectedException Sabre\DAV\Exception\Forbidden
     */
    function testDelete() {

        $i = $this->getInstance();
        $i->delete();

    }

    /**
     * @expectedException Sabre\DAV\Exception\Forbidden
     */
    function testSetName() {

        $i = $this->getInstance();
        $i->setName('foo');

    }

    function testGetAlternateUriSet() {

        $i = $this->getInstance();
        $this->assertEquals(array(), $i->getAlternateUriSet());

    }

    function testGetPrincipalUri() {

        $i = $this->getInstance();
        $this->assertEquals('principal/user/calendar-proxy-read', $i->getPrincipalUrl());

    }

    function testGetGroupMemberSet() {

        $i = $this->getInstance();
        $this->assertEquals(array(), $i->getGroupMemberSet());

    }

    function testGetGroupMembership() {

        $i = $this->getInstance();
        $this->assertEquals(array(), $i->getGroupMembership());

    }

    function testSetGroupMemberSet() {

        $i = $this->getInstance();
        $i->setGroupMemberSet(array('principals/foo'));

        $expected = array(
            $i->getPrincipalUrl() => array('principals/foo')
        );

        $this->assertEquals($expected, $this->backend->groupMembers);

    }
}
