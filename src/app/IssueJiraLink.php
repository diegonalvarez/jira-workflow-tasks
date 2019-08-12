<?php

namespace App;

use JiraRestApi\IssueLink\IssueLink;
use JiraRestApi\IssueLink\IssueLinkService;

class IssueJiraLink
{

    public function linkIssue($origin, $destiny, $relation = 'relates to')
    {
        $il = new IssueLink();

        $il->setInwardIssue($origin)
            ->setOutwardIssue($destiny)
            ->setLinkTypeName($relation);

        $ils = new IssueLinkService();

        $ret = $ils->addIssueLink($il);
    }
}
