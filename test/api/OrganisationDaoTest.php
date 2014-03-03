<?php

require_once 'PHPUnit/Autoload.php';
require_once __DIR__.'/../../api/vendor/autoload.php';
\DrSlump\Protobuf::autoload();
require_once __DIR__.'/../../api/DataAccessObjects/BadgeDao.class.php';
require_once __DIR__.'/../../api/DataAccessObjects/OrganisationDao.class.php';
require_once __DIR__.'/../../api/DataAccessObjects/UserDao.class.php';
require_once __DIR__.'/../../Common/lib/ModelFactory.class.php';
require_once __DIR__.'/../UnitTestHelper.php';


class OrganisationDaoTest extends PHPUnit_Framework_TestCase
{
    
    public function testInsertOrg()
    {
        UnitTestHelper::teardownDb();
        
        $org = UnitTestHelper::createOrg();
        
        // Success
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $this->assertEquals($org->getName(), $insertedOrg->getName());
        $this->assertEquals($org->getBiography(), $insertedOrg->getBiography());
        $this->assertEquals($org->getHomePage(), $insertedOrg->getHomePage());
    }
    
    public function testUpdateOrg()
    {
        UnitTestHelper::teardownDb();
        
        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        
        $insertedOrg->setName("Updated Name");
        $insertedOrg->setBiography("Updated Bio");
        $insertedOrg->setHomePage("http://www.updatedhomepage.org");
        
        // Success
        $updatedOrg = OrganisationDao::insertAndUpdate($insertedOrg);
        $this->assertInstanceOf("Organisation", $updatedOrg);
        $this->assertNotNull($updatedOrg->getId());
        $this->assertEquals($insertedOrg->getName(), $updatedOrg->getName());
        $this->assertEquals($insertedOrg->getBiography(), $updatedOrg->getBiography());
        $this->assertEquals($insertedOrg->getHomePage(), $updatedOrg->getHomePage());
        
    }
    
    public function testGetOrg()
    {
        UnitTestHelper::teardownDb();
        
        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();
        
        // Success
        $resultFoundOrg = OrganisationDao::getOrg($orgId, null, null, null);
        $this->assertInstanceOf("Organisation", $resultFoundOrg[0]);
        
        // Failure
        $resultFoundOrgFailure = OrganisationDao::getOrg(99, null, null, null);
        $this->assertNull($resultFoundOrgFailure);
        
        // Success
        $resultFoundOrgByName = OrganisationDao::getOrg($orgId, $org->getName(), null, null);
        $this->assertInstanceOf("Organisation", $resultFoundOrgByName[0]);
        
        // Failure
        $resultFoundOrgByNameFailure = OrganisationDao::getOrg($orgId, "x", null, null);
        $this->assertNull($resultFoundOrgByNameFailure);
        
        $resultFoundOrgByBio = OrganisationDao::getOrg($orgId, null, null, $org->getBiography());
        $this->assertInstanceOf("Organisation", $resultFoundOrgByBio[0]);
        
        $resultFoundOrgByHomePage = OrganisationDao::getOrg($orgId, null, $org->getHomePage(), null);
        $this->assertInstanceOf("Organisation", $resultFoundOrgByHomePage[0]);
        
        $resultFoundOrgByAll = OrganisationDao::getOrg(
            $orgId,
            $org->getName(),
            $org->getHomePage(),
            $org->getBiography()
        );
        $this->assertInstanceOf("Organisation", $resultFoundOrgByAll[0]);
        
        $org2 = UnitTestHelper::createOrg(null, "Organisation 2", "Organisation 2 Bio", "http://www.organisation2.org");
        $insertedOrg2 = OrganisationDao::insertAndUpdate($org2);
        $this->assertInstanceOf("Organisation", $insertedOrg2);
        
        $resultFoundAllOrgs = OrganisationDao::getOrg(null, null, null, null);
        $this->assertCount(2, $resultFoundAllOrgs);
        foreach ($resultFoundAllOrgs as $org) {
            $this->assertInstanceOf("Organisation", $org);
        }
        
        // Failure
        $resultNoOrgFound = OrganisationDao::getOrg(99, null, null, null);
        $this->assertNull($resultNoOrgFound);
    }
    
    public function testRequestMembership()
    {
        UnitTestHelper::teardownDb();

        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();
     
        $user = UnitTestHelper::createUser();
        $insertedUser = UserDao::save($user);
        $this->assertInstanceOf("User", $insertedUser);
        $this->assertNotNull($insertedUser->getId());
        $userId = $insertedUser->getId();
        
        // Success
        $resultRequestMembership = OrganisationDao::requestMembership($userId, $orgId);
        $this->assertEquals("1", $resultRequestMembership);

        //Failure
        $resultRequestMembershipFail = OrganisationDao::requestMembership($userId, $orgId);
        $this->assertEquals("0", $resultRequestMembershipFail);
    }
    
    public function testAcceptMembershipRequest()
    {
        UnitTestHelper::teardownDb();

        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();
   
        $user = UnitTestHelper::createUser();
        $insertedUser = UserDao::save($user);
        $this->assertInstanceOf("User", $insertedUser);
        $this->assertNotNull($insertedUser->getId());
        $userId = $insertedUser->getId();
        
        $resultRequestMembership = OrganisationDao::requestMembership($userId, $orgId);
        $this->assertEquals("1", $resultRequestMembership);
                
        // Success
        $resultAcceptMembership = OrganisationDao::acceptMemRequest($orgId, $userId);
        $this->assertEquals("1", $resultAcceptMembership);
        
        $user2 = UnitTestHelper::createUser(null, "User 2", "User 2 Bio", "user2@test.com");
        $insertedUser2 = UserDao::save($user2);
        $this->assertInstanceOf("User", $insertedUser2);
        $this->assertNotNull($insertedUser2->getId());
        $userId2 = $insertedUser2->getId();
        
        //Assert that a user who did not request membership can be added to the org. This is valid, the example
        //use case is an (org) admin adding the user to the org.
        $resultAcceptMembershipNoReq = OrganisationDao::acceptMemRequest($orgId, $userId2);
        $this->assertEquals("1", $resultAcceptMembershipNoReq);
    }
    
    public function testIsMember()
    {
        UnitTestHelper::teardownDb();
        
        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();

        $user = UnitTestHelper::createUser();
        $insertedUser = UserDao::save($user);
        $this->assertInstanceOf("User", $insertedUser);
        $this->assertNotNull($insertedUser->getId());
        $userId = $insertedUser->getId();
      
        // Failure
        $resultIsMemberFailure = OrganisationDao::isMember($orgId, $userId);
        $this->assertEquals("0", $resultIsMemberFailure);
        
        $resultRequestMembership = OrganisationDao::requestMembership($userId, $orgId);
        $this->assertEquals("1", $resultRequestMembership);
        
        $resultAcceptMembership = OrganisationDao::acceptMemRequest($orgId, $userId);
        $this->assertEquals("1", $resultAcceptMembership);
        
        // Success
        $resultIsMember = OrganisationDao::isMember($orgId, $userId);
        $this->assertEquals("1", $resultIsMember);
    }
    
    public function testGetOrgByUser()
    {
        UnitTestHelper::teardownDb();

        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();

        $user = UnitTestHelper::createUser();
        $insertedUser = UserDao::save($user);
        $this->assertInstanceOf("User", $insertedUser);
        $this->assertNotNull($insertedUser->getId());
        $userId = $insertedUser->getId();
        
        $resultRequestMembership = OrganisationDao::requestMembership($userId, $orgId);
        $this->assertEquals("1", $resultRequestMembership);
        
        $resultAcceptMembership = OrganisationDao::acceptMemRequest($orgId, $userId);
        $this->assertEquals("1", $resultAcceptMembership);
        
        // Success
        $resultFoundOrgByUser = OrganisationDao::getOrgByUser($userId);
        $this->assertInstanceOf("Organisation", $resultFoundOrgByUser);
        
        // Failure
        $resultFoundOrgByUserFailure = OrganisationDao::getOrgByUser(999);
        $this->assertNull($resultFoundOrgByUserFailure);
    }
    
    public function testGetOrgMembers()
    {
        UnitTestHelper::teardownDb();
        
        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();
     
        $user = UnitTestHelper::createUser();
        $insertedUser = UserDao::save($user);
        $this->assertInstanceOf("User", $insertedUser);
        $this->assertNotNull($insertedUser->getId());
        $userId = $insertedUser->getId();
        
        $resultRequestMembership = OrganisationDao::requestMembership($userId, $orgId);
        $this->assertEquals("1", $resultRequestMembership);
        
        $resultAcceptMembership = OrganisationDao::acceptMemRequest($orgId, $userId);
        $this->assertEquals("1", $resultAcceptMembership);
        
        $user2 = UnitTestHelper::createUser(null, "User 2", "User 2 Bio", "user2@test.com");
        $insertedUser2 = UserDao::save($user2);
        $this->assertInstanceOf("User", $insertedUser2);
        $this->assertNotNull($insertedUser2->getId());
        $userId2 = $insertedUser2->getId();
        
        $resultRequestMembership2 = OrganisationDao::requestMembership($userId2, $orgId);
        $this->assertEquals("1", $resultRequestMembership2);
        
        $resultAcceptMembership2 = OrganisationDao::acceptMemRequest($orgId, $userId2);
        $this->assertEquals("1", $resultAcceptMembership2);
        
        // Success
        $resultOrgMembers = OrganisationDao::getOrgMembers($orgId);
        $this->assertCount(2, $resultOrgMembers);
        foreach ($resultOrgMembers as $member) {
            $this->assertInstanceOf("User", $member);
        }
        
        // Failure
        $resultOrgMembersFailure = OrganisationDao::getOrgMembers(999);
        $this->assertNull($resultOrgMembersFailure);
    }
    

    public function testSearchForOrg()
    {
        UnitTestHelper::teardownDb();
        
        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        
        $org2 = UnitTestHelper::createOrg(null, "Organisation 2", "Organisation 2 Bio", "http://www.organisation2.org");
        $insertedOrg2 = OrganisationDao::insertAndUpdate($org2);
        $this->assertInstanceOf("Organisation", $insertedOrg2);
        
        // Success
        $resultFoundOrgs = OrganisationDao::searchForOrg("organisation");
        $this->assertCount(2, $resultFoundOrgs);
        foreach ($resultFoundOrgs as $foundOrg) {
            $this->assertInstanceOf("Organisation", $foundOrg);
        }
        
        // Failure
        $resultFoundOrgsFailure = OrganisationDao::searchForOrg("x");
        $this->assertNull($resultFoundOrgsFailure);
    }
    
    public function testGetMembershipRequests()
    {
        UnitTestHelper::teardownDb();
        
        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();
    
        $user = UnitTestHelper::createUser();
        $insertedUser = UserDao::save($user);
        $this->assertInstanceOf("User", $insertedUser);
        $this->assertNotNull($insertedUser->getId());
        $userId = $insertedUser->getId();
        
        $resultRequestMembership = OrganisationDao::requestMembership($userId, $orgId);
        $this->assertEquals("1", $resultRequestMembership);
        
        $user2 = UnitTestHelper::createUser(null, "User 2", "User 2 Bio", "user2@test.com");
        $insertedUser2 = UserDao::save($user2);
        $this->assertInstanceOf("User", $insertedUser2);
        $this->assertNotNull($insertedUser2->getId());
        $userId2 = $insertedUser2->getId();
        
        $resultRequestMembership2 = OrganisationDao::requestMembership($userId2, $orgId);
        $this->assertEquals("1", $resultRequestMembership2);
        
        // Success
        $resultGetMembershipRequests = OrganisationDao::getMembershipRequests($orgId);
        $this->assertCount(2, $resultGetMembershipRequests);
        foreach ($resultGetMembershipRequests as $request) {
            $this->assertInstanceOf("MembershipRequest", $request);
        }
        
        // Failure
        $resultGetMembershipRequestsFailure = OrganisationDao::getMembershipRequests(999);
        $this->assertNull($resultGetMembershipRequestsFailure);
        
    }

    public function testRefuseMembershipRequest()
    {
        UnitTestHelper::teardownDb();

        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();
     
        $user = UnitTestHelper::createUser();
        $insertedUser = UserDao::save($user);
        $this->assertInstanceOf("User", $insertedUser);
        $this->assertNotNull($insertedUser->getId());
        $userId = $insertedUser->getId();
        
        $resultRequestMembership = OrganisationDao::requestMembership($userId, $orgId);
        $this->assertEquals("1", $resultRequestMembership);
        
        // Success
        $resultRefuseMembership = OrganisationDao::refuseMemRequest($orgId, $userId);
        $this->assertEquals("1", $resultRefuseMembership);
        
        // Failure
        $resultRefuseMembershipFailure = OrganisationDao::refuseMemRequest($orgId, 999);
        $this->assertEquals("0", $resultRefuseMembershipFailure);
    }
    
    public function testRevokeMembership()
    {
        UnitTestHelper::teardownDb();
        
        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();
   
        $user = UnitTestHelper::createUser();
        $insertedUser = UserDao::save($user);
        $this->assertInstanceOf("User", $insertedUser);
        $this->assertNotNull($insertedUser->getId());
        $userId = $insertedUser->getId();
        
        $resultRequestMembership = OrganisationDao::requestMembership($userId, $orgId);
        $this->assertEquals("1", $resultRequestMembership);
        $resultAcceptMembership = OrganisationDao::acceptMemRequest($orgId, $userId);
        $this->assertEquals("1", $resultAcceptMembership);
        
        // Success
        $resultRevokeMembership = OrganisationDao::revokeMembership($orgId, $userId);
        $this->assertEquals("1", $resultRevokeMembership);
        
        // Failure
        $resultRevokeMembershipFailure = OrganisationDao::revokeMembership($orgId, $userId);
        $this->assertEquals("0", $resultRevokeMembershipFailure);
    }
    
    public function testDelete()
    {
        UnitTestHelper::teardownDb();
    
        //create an organisation and save in DB
        $org = UnitTestHelper::createOrg();
        $insertedOrg = OrganisationDao::insertAndUpdate($org);
        $this->assertInstanceOf("Organisation", $insertedOrg);
        $this->assertNotNull($insertedOrg->getId());
        $orgId = $insertedOrg->getId();
        
        //delete the organisation that was just added
        $deleteOrg = OrganisationDao::delete($orgId);
        $this->assertEquals("1", $deleteOrg); //successfully deleting an org should return 1

        //try to get the org that was deleted back from DB
        $noOrg = OrganisationDao::getOrg($orgId);
        $this->assertNull($noOrg);
        //error_log("SHOULD BE EMPTY ORG RESULT $noOrg"); //was used to test what mySQL returned

        //try to delete an org that is not in the DB
        $deleteOrg = OrganisationDao::delete($orgId);
        $this->assertEquals("0", $deleteOrg); //failing to delete an org because it is not in DB should return 0
    }
}
