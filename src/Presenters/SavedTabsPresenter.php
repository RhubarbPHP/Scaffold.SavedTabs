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

use Rhubarb\Leaf\Presenters\Application\Tabs\SearchPanelTabDefinition;
use Rhubarb\Leaf\Presenters\Application\Tabs\SearchPanelTabsPresenter;
use Rhubarb\Scaffolds\SavedTabs\TabDefinition;

class SavedTabsPresenter extends SearchPanelTabsPresenter
{
    private $_tabSetName;

    public function __construct($tabSetName)
    {
        parent::__construct();

        $this->_tabSetName = $tabSetName;
    }

    protected function inflateTabDefinitions()
    {
        $tabs = [];

        foreach (TabDefinition::find() as $tabDefinition) {
            $tabs[] = new SearchPanelTabDefinition($tabDefinition->TabName, json_decode($tabDefinition->TabSettings, true));
        }

        $parentTabs = parent::inflateTabDefinitions();

        $tabs = array_merge($parentTabs, $tabs);

        return $tabs;
    }


    public function createView()
    {
        return new SavedTabsView();
    }

    protected function configureView()
    {
        parent::configureView();

        $this->view->attachEventHandler("SaveTab", function ($tabName = "") {
            $tabSettings = "";

            $tabs = $this->getInflatedTabDefinitions();

            if (sizeof($tabs) > 0) {
                $tabSettings = json_encode(array_pop($tabs)->data);
            }

            $tab = new TabDefinition();
            $tab->TabSetName = $this->_tabSetName;
            $tab->TabName = $tabName;
            $tab->TabSettings = $tabSettings;
            $tab->save();

            $this->rePresent();
        });
    }
}
