var savedTabsViewBridge = function (presenterPath) {
    window.rhubarb.viewBridgeClasses.Tabs.apply(this, arguments);
};

savedTabsViewBridge.prototype = new window.rhubarb.viewBridgeClasses.Tabs();
savedTabsViewBridge.prototype.constructor = tabsPresenter;

savedTabsViewBridge.prototype.attachEvents = function () {
    $('.save', this.element).click(function () {
        var response = prompt("Enter a descriptive name");

        if (response) {
            self.raiseServerEvent("SaveTab", response);
        }
    });

    window.rhubarb.viewBridgeClasses.Tabs.prototype.attachEvents.apply(this, arguments);
};

window.rhubarb.viewBridgeClasses.SavedTabsViewBridge = savedTabsViewBridge;