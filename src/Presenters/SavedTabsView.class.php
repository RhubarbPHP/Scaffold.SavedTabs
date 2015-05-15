<?php

/*
 *	Copyright 2015 RhubarbPHP
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace Rhubarb\Scaffolds\SavedTabs\Presenters;

use Rhubarb\Leaf\Presenters\Application\Tabs\SearchResultsTabDefinition;
use Rhubarb\Leaf\Presenters\Application\Tabs\TabsView;

class SavedTabsView extends TabsView
{
    protected function printTab($tab)
    {
        $save = ($tab instanceof SearchResultsTabDefinition) ? '<a href="#" class="ss-icon save" title="Save"><span>Save</span></a>' : '';

        $selected = ($tab->selected) ? " class=\"-is-selected\"" : "";
        print "<li{$selected}><a href='#'>" . $tab->label . $save . "</a></li>";
    }

    protected function getClientSideViewBridgeName()
    {
        return "SavedTabsViewBridge";
    }

    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . "/SavedTabsViewBridge.js";

        return $package;
    }
}