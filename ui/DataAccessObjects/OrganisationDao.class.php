<?php

require_once __DIR__."/../../Common/lib/APIHelper.class.php";

class OrganisationDao
{
    private $client;
    private $siteApi;
    
    public function __construct()
    {
        $this->client = new APIHelper(Settings::get("ui.api_format"));
        $this->siteApi = Settings::get("site.api");
    }
    
    public function getOrganisation($id)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/$id";
        $ret = $this->client->call("Organisation", $request);
        return $ret;
    }
    
    public function getOrganisationByName($name)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/getByName/$name";
        $ret = $this->client->call("Organisation", $request);
        return $ret;       
    }
    
    public function searchForOrgByName($name)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/searchByName/$name";
        $ret = $this->client->call(array("Organisation"), $request);
        return $ret;       
    }
    
    public function getOrganisations()
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs";
        $ret = $this->client->call(array("Organisation"), $request);
        return $ret;
    }

    public function getOrgProjects($orgId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/$orgId/projects";
        $ret = $this->client->call(array("Project"), $request);
        return $ret;
    }

    public function getOrgArchivedProjects($orgId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/$orgId/archivedProjects";
        $ret = $this->client->call(array("ArchivedProject"), $request);
        return $ret;
    }

    public function getOrgBadges($orgId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/$orgId/badges";
        $ret = $this->client->call(array("Badge"), $request);
        return $ret;
    }

    public function getOrgMembers($orgId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/$orgId/members";
        $ret = $this->client->call(array("User"), $request);
        return $ret;
    }

    public function getMembershipRequests($orgId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/$orgId/requests";
        $ret = $this->client->call(array("MembershipRequest"), $request);
        return $ret;
    }

    public function getOrgTasks($orgId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/$orgId/tasks";
        $ret = $this->client->call(array("Task"), $request);
        return $ret;
    }

    public function isMember($orgId, $userId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/isMember/$orgId/$userId";
        $ret = $this->client->call(null, $request);
        return $ret;
    }

    public function createOrg($org, $userId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs";
        $ret = $this->client->call("Organisation", $request, HttpMethodEnum::POST, $org);
        $this->createOrgAdmin($ret->getId(), $userId);
        return $ret;
    }

    public function updateOrg($org)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/{$org->getId()}";
        $ret = $this->client->call("Organisation", $request, HttpMethodEnum::PUT, $org);
        return $ret;
    }

    public function deleteOrg($orgId)
    {
        $request = "{$this->siteApi}v0/orgs/$orgId";
        $this->client->call(null,$request, HttpMethodEnum::DELETE);
    }

    public function createMembershipRequest($orgId, $userId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/$orgId/requests/$userId";
        $ret = $this->client->call(null, $request, HttpMethodEnum::POST);
        return $ret;
    }

    public function acceptMembershipRequest($orgId, $userId)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/orgs/$orgId/requests/$userId";
        $this->client->call(null, $request, HttpMethodEnum::PUT);
    }

    public function rejectMembershipRequest($orgId, $userId)
    {
        $request = "{$this->siteApi}v0/orgs/$orgId/requests/$userId";
        $this->client->call(null, $request, HttpMethodEnum::DELETE);
    }
    
    public function createOrgAdmin($orgId, $userId)
    {
        $request = "{$this->siteApi}v0/orgs/$orgId/admin/$userId";
        $this->client->call(null, $request, HttpMethodEnum::PUT);
    }
}
