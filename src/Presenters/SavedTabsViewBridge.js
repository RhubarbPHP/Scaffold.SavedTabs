var savedTabsViewBridge = function (presenterPath) {
    window.gcd.core.mvp.viewBridgeClasses.Tabs.apply(this, arguments);
};

savedTabsViewBridge.prototype = new window.gcd.core.mvp.viewBridgeClasses.Tabs();
savedTabsViewBridge.prototype.constructor = tabsPresenter;

savedTabsViewBridge.prototype.attachEvents = function () {
    $('.save', this.element).click(function () {
        var response = prompt("Enter a descriptive name");

        if (response) {
            self.raiseServerEvent("SaveTab", response);
        }
    });

    window.gcd.core.mvp.viewBridgeClasses.Tabs.prototype.attachEvents.apply(this, arguments);
};

window.gcd.core.mvp.viewBridgeClasses.SavedTabsViewBridge = savedTabsViewBridge;