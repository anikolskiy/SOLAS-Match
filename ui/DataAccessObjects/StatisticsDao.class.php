<?php

require_once __DIR__."/../../Common/lib/APIHelper.class.php";

class StatisticsDao
{
    private $client;
    private $siteApi;

    public function __construct()
    {
        $this->client = new APIHelper(Settings::get("ui.api_format"));
        $this->siteApi = Settings::get("site.api");
    }

    public function getStats()
    {
        $ret = null;
        $request = "{$this->siteApi}v0/stats";
        $ret = $this->client->castCall(array("Statistic"), $request);
        return $ret;
    }
    
    public function getStat($stat)
    {
        $ret = null;
        $request = "{$this->siteApi}v0/stats/$stat";
        $ret = $this->client->castCall("Statistic", $request);
        return $ret;
    }
}
