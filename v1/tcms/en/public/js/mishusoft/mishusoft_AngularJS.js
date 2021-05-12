let root = window.location;

let Mishu = angular.module('Mishu', []);

Mishu.directive('fileModel', [
    '$parse',
    function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;

                element.bind('change', function () {
                    scope.$apply(function () {
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }
]);

// Register the 'myCurrentTime' directive factory method.
// We inject $interval and dateFilter service since the factory method is DI.
Mishu.directive('myCurrentTime', [
    '$interval',
    'dateFilter',
    function ($interval, dateFilter) {
        // return the directive link function. (compile function not needed)
        return function (scope, element, attrs) {
            var format,   // date format
                stopTime; // so that we can cancel the time updates

            // used to update the UI
            function updateTime() {
                element.text(dateFilter(new Date(), format));
            }

            // watch the expression, and update the UI on change.
            scope.$watch(attrs.myCurrentTime, function (value) {
                format = value;
                updateTime();
            });

            stopTime = $interval(updateTime, 1000);

            // listen on DOM destroy (removal) event, and cancel the next UI update
            // to prevent updating time after the DOM element was removed.
            element.on('$destroy', function () {
                $interval.cancel(stopTime);
            });
        }
    }
]);

Mishu.controller('ExampleController', [
    '$scope',
    function ($scope) {
        $scope.date_format = 'MM/dd/yyyy h:mm:ss a';
    }
]);

Mishu.controller('MishuDataController', ['$scope', '$location', '$http', '$interval',
    function ($scope, $location, $http, $interval) {
        /* variable deceleration here*/
        var autoUpdate;

        /*default of angular function set here*/
        $scope.code = null;
        $scope.response = null;
        $scope.upload = true;
        $scope.btnName = "Save";
        $scope.POSTbtnName = "Publish";
        $scope.btnNameforModule = "Upload";
        $scope.checked = "false";
        $scope.checkedbox_messageforModule = "Upload";
        $scope.checkedbox_message = "Create new";
        $scope.security_code = 1;
        $scope.hostaddress = "http://" +  $location.host() + "/framework/sytem"; // web host url
        //$scope.hostaddress = $location.absUrl();
        $scope.RefeshBtnName = "Refresh";

        /*default or auto call angular function call here*/
        //$scope.startUpdate();

        $scope.webURI = function () {
            $http.get("/app/webURI")
                .then(
                    function (response) {
                        $scope.hostaddress = response.data;
                    },
                    function (response) {
                        alert("The application web url not found.");
                    });
        };

        //$scope.webURI();

        $scope.startUpdate = function () {
            if ($scope.RefeshBtnName = "Refresh") {
                $scope.RefeshBtnName = "Stop";
                // Don't start a new autoUpdate if we are already autoUpdating
                if (angular.isDefined(autoUpdate))
                    return;
                autoUpdate = $interval(function () {
                    /*$scope.viewModules();
                     $scope.viewMenus();
                     $scope.viewAppearanceData();
                     $scope.viewThemes();*/
                    $scope.viewActivities();
                    $scope.viewmyActivities();
                    /* $scope.viewRoles();
                     $scope.viewPermissions();
                     $scope.viewRolePermissions(role);
                     $scope.viewApps();
                     $scope.viewSiteInfo();
                     $scope.viewCategories();
                     $scope.viewUserPanel();*/
                }, 100);
            } else {
                if ($scope.RefeshBtnName = "Stop") {
                    if (angular.isDefined(autoUpdate)) {
                        $interval.cancel(autoUpdate);
                        autoUpdate = undefined;
                        $scope.RefeshBtnName = "Refresh";
                    }
                }
            }
        };

        /*Secure Zone Module*/
        $scope.viewModules = function () {
            $http.get($scope.hostaddress + "securezone/modules/getModules")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.data = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.uploadFile = function () {
            var file = $scope.md_name;
            var uploadUrl = $scope.hostaddress + "securezone/modules/uploader";
            if ($scope.md_name == null) {
                alert("Error: No file selected.");
            } else {
                var fd = new FormData();
                fd.append('file', file); /*if you add more argument, add as like this*/
                $http.post(uploadUrl, fd,
                    {
                        transformRequest: angular.identity,
                        headers: {
                            'Content-Type': undefined,
                            'Process-Data': false
                        }
                    })
                    .then(function (response) {
                            alert(response.data);
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
                $scope.viewModules();
            }
        };

        $scope.addModule = function () {
            $http.post($scope.hostaddress + "securezone/modules/addModule",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.md_id,
                    'name': $scope.md_name,
                    'status': $scope.md_status,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.md_id = null;
                        $scope.md_name = null;
                        $scope.md_status = null;
                        $scope.upload = true;
                        $scope.update = false;
                        $scope.checked = "false";
                        $scope.checkedbox_messageforModule = "Upload";
                        $scope.btnName = "Upload";
                        $scope.viewModules();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetModule = function () {
            $scope.md_id = null;
            $scope.md_name = null;
            $scope.md_status = null;
            $scope.upload = true;
            $scope.update = false;
            $scope.checked = "false";
            $scope.checkedbox_messageforModule = "Upload";
            $scope.btnName = "Upload";
            $scope.viewModules();
        };

        $scope.updateModule = function (md_id, md_name, md_status) {
            $scope.md_id = md_id;
            $scope.md_name = md_name;
            $scope.md_status = md_status;
            $scope.upload = false;
            $scope.update = true;
            $scope.checked = "checked";
            $scope.checkedbox_messageforModule = "Edit";
            $scope.btnName = "Update";
        };

        $scope.deleteModule = function (md_id) {
            if (!confirm("Are you sure you want to delete?")) {
                return false;
            } else {
                $http.post($scope.hostaddress + "securezone/modules/deleteModule",
                    {'id': md_id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewModules();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            }
        };

        $scope.viewMenus = function () {
            $http.get($scope.hostaddress + "securezone/index/getAdminMenus")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.data = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.viewAppearanceData = function () {
            $http.get($scope.hostaddress + "securezone/index/getAppearanceData")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.AppearanceData = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
            $http.get($scope.hostaddress + "securezone/index/getThemes")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.themes = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.saveAppearance = function (id, bgc_name, dtheme_name) {
            $http.post($scope.hostaddress + "securezone/index/saveAppearance",
                {
                    'security_code': $scope.security_code,
                    'id': id,
                    'bgc_name': bgc_name,
                    'dtheme_name': dtheme_name,
                    'btnName': 'Update'
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.bgc_name = null;
                        $scope.dtheme_name = null;
                        $scope.viewAppearanceData();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.viewThemes = function () {
            $http.get($scope.hostaddress + "securezone/index/getThemes")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.themes = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.viewActivities = function () {
            $http.get($scope.hostaddress + "securezone/index/getActivities")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.Activities = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.viewmyActivities = function () {
            $http.get($scope.hostaddress + "user/index/getmyActivities")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.myActivities = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.addMenuItem = function () {
            $http.post($scope.hostaddress + "securezone/index/addItem",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.am_id,
                    'name': $scope.am_name,
                    'title': $scope.am_title,
                    'icon': $scope.am_icon,
                    'url': $scope.am_url,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.am_id = null;
                        $scope.am_name = null;
                        $scope.am_title = null;
                        $scope.am_icon = null;
                        $scope.am_url = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.btnName = "Save";
                        $scope.viewMenus();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetMenuItem = function () {
            $scope.am_id = null;
            $scope.am_name = null;
            $scope.am_title = null;
            $scope.am_icon = null;
            $scope.am_url = null;
            $scope.checked = "false";
            $scope.checkedbox_message = "Create new";
            $scope.btnName = "Save";
            $scope.viewMenus();
        };

        $scope.updateMenuItem = function (am_id, am_name, am_title, am_url,
                                          am_icon) {
            $scope.am_id = am_id;
            $scope.am_name = am_name;
            $scope.am_title = am_title;
            $scope.am_url = am_url;
            $scope.am_icon = am_icon;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.btnName = "Update";
        };

        $scope.deleteMenuItem = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post($scope.hostaddress + "securezone/index/deleteItem",
                    {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewMenus();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        $scope.viewRoles = function () {
            $http.get($scope.hostaddress + "appmanager/getRoles")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.data = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.addRole = function () {
            $http.post($scope.hostaddress + "securezone/roles/addRole",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.id_role,
                    'name': $scope.role,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.id_role = null;
                        $scope.role = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.btnName = "Save";
                        $scope.viewRoles();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetRole = function () {
            $scope.id_role = null;
            $scope.role = null;
            $scope.checked = "false";
            $scope.checkedbox_message = "Create new";
            $scope.btnName = "Save";
            $scope.viewRoles();
        };

        $scope.updateRole = function (id_role, role) {
            $scope.id_role = id_role;
            $scope.role = role;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.btnName = "Update";
        };

        $scope.deleteRole = function (id_role) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post($scope.hostaddress + "securezone/roles/deleteRole",
                    {'id': id_role})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewRoles();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        $scope.viewPermissions = function () {
            $http.get($scope.hostaddress + "securezone/permissions/getPermissionsAll")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.data = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.addPermission = function () {
            $http.post($scope.hostaddress + "securezone/permissions/addPermission",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.id,
                    'name': $scope.permission,
                    'key': $scope.key,
                    'PKID': $scope.PKID,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.id = null;
                        $scope.permission = null;
                        $scope.key = null;
                        $scope.PKID = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.btnName = "Save";
                        $scope.viewPermissions();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetPermission = function () {
            $scope.id = null;
            $scope.permission = null;
            $scope.key = null;
            $scope.PKID = null;
            $scope.checked = "false";
            $scope.checkedbox_message = "Create new";
            $scope.btnName = "Save";
            $scope.viewPermissions();
        };

        $scope.updatePermission = function (id, name, key, PKID) {
            $scope.id = id;
            $scope.permission = name;
            $scope.key = key;
            $scope.PKID = PKID;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.btnName = "Update";
        };

        $scope.viewRolePermissions = function (role) {
            $http.get($scope.hostaddress +
                "securezone/permissions/getRolesPermissions/" + role)
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.data = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
            $http.get($scope.hostaddress + "securezone/permissions/getRole/" + role)
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.role = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.updateRolePermission = function (role, permission, value) {
            $http.post($scope.hostaddress +
                "securezone/permissions/updateRolePermission",
                {
                    'security_code': $scope.security_code,
                    'role': role,
                    'permission': permission,
                    'value': value,
                    'btnName': 'Update'
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.viewRolePermissions(role);
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.deletePermission = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post($scope.hostaddress +
                    "securezone/permissions/deletePermission",
                    {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewPermissions();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        $scope.deleteRolePermission = function (role, permission) {
            if (confirm("Are you sure you want to ignore this?")) {
                $http.post($scope.hostaddress +
                    "securezone/permissions/deleteRolePermission",
                    {'role': role, 'permission': permission})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewRolePermissions(role);
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        $scope.viewApps = function () {
            $http.get($scope.hostaddress + "securezone/apps/getApps")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.data = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
            $http.get($scope.hostaddress + "securezone/modules/getModules")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.modules = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.addApp = function () {
            $http.post($scope.hostaddress + "securezone/apps/addApp",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.app_id,
                    'name': $scope.app_name,
                    'icon': $scope.app_icon,
                    'url': $scope.app_url,
                    'status': $scope.app_status,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.app_id = null;
                        $scope.app_name = null;
                        $scope.app_icon = null;
                        $scope.app_url = null;
                        $scope.app_status = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.btnName = "Save";
                        $scope.viewApps();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetApp = function () {
            $scope.app_id = null;
            $scope.app_name = null;
            $scope.app_icon = null;
            $scope.app_url = null;
            $scope.app_status = null;
            $scope.checked = "false";
            $scope.checkedbox_message = "Create new";
            $scope.btnName = "Save";
            $scope.viewApps();
        };

        $scope.updateApp = function (id, name, url, icon, status) {
            $scope.app_id = id;
            $scope.app_name = name;
            $scope.app_url = url;
            $scope.app_icon = icon;
            $scope.app_status = status;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.btnName = "Update";
        };

        $scope.deleteApp = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post($scope.hostaddress + "securezone/apps/deleteApp",
                    {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewApps();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        $scope.viewSiteInfo = function () {
            $http.get($scope.hostaddress + "securezone/site/getSiteInfo")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.data = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.uploadLOGO = function (id) {
            var file = $scope.favicon_image;
            var uploadUrl = $scope.hostaddress + "securezone/site/uploadLOGO/" + id;
            if ($scope.favicon_image == null) {
                $scope.favicon_image = null;
                alert("Error: No file selected.");
            } else {
                var fd = new FormData();
                fd.append('file', file); /*if you add more argument, add as like this*/
                $http.post(uploadUrl, fd,
                    {
                        transformRequest: angular.identity,
                        headers: {
                            'Content-Type': undefined,
                            'Process-Data': false
                        }
                    })
                    .then(function (response) {
                            alert(response.data);
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
                $scope.viewSiteInfo();
            }
        };

        /*User Module*/
        $scope.viewCategories = function () {
            $http.get($scope.hostaddress + "user/dict/getAllCategories")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.data = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.addCategory = function () {
            $http.post($scope.hostaddress + "user/dict/addCategory",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.id,
                    'name': $scope.name,
                    'title': $scope.title,
                    'status': $scope.status,
                    'icon': $scope.icon,
                    'url': $scope.url,
                    'description': $scope.description,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.name = null;
                        $scope.title = null;
                        $scope.status = null;
                        $scope.icon = null;
                        $scope.url = null;
                        $scope.description = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.btnName = "Save";
                        $scope.viewCategories();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetCategory = function () {
            $scope.name = null;
            $scope.title = null;
            $scope.status = null;
            $scope.icon = null;
            $scope.url = null;
            $scope.description = null;
            $scope.checked = "false";
            $scope.checkedbox_message = "Create new";
            $scope.btnName = "Save";
            $scope.viewCategories();
        };

        $scope.updateCategory = function (id, name, title, status, icon, url,
                                          description) {
            $scope.id = id;
            $scope.name = name;
            $scope.title = title;
            $scope.status = status;
            $scope.icon = icon;
            $scope.url = url;
            $scope.description = description;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.btnName = "Update";
        };

        $scope.deleteCategory = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post($scope.hostaddress + "user/dict/deleteCategory", {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewCategories();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        var counter = 0;
        var values = [1, 0];

        $scope.doLike = function (clickEvent) {
            $scope.likeValue = values[counter % values.length];
            counter++;
        };

        $scope.doDislike = function (clickEvent) {
            $scope.DislikeValue = values[counter % values.length];
            counter++;
        };

        $scope.viewUserPanel = function () {
            $http.get($scope.hostaddress + "user/index/getUserInfo")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.UserInfo = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: User Information not found.");
                    });

            $http.get($scope.hostaddress + "user/index/getAllUsersPosts")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.AllUsersPosts = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Posts not found.");
                    });

            $http.get($scope.hostaddress + "user/index/getmyPosts")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.myPosts = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Posts not found.");
                    });
        };

        $scope.addUserPost = function () {
            $http.post($scope.hostaddress + "user/index/addUserPost",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.id,
                    'title': $scope.post_title,
                    'content': $scope.content,
                    'btnName': $scope.POSTbtnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.post_title = null;
                        $scope.content = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.POSTbtnName = "Publish";
                        $scope.viewUserPanel();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.updateUserPost = function (id, title, content) {
            $scope.id = id;
            $scope.post_title = title;
            $scope.content = content;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.POSTbtnName = "Update";
        };

        $scope.deleteUserPost = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post($scope.hostaddress + "user/index/deleteUserPost",
                    {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewUserPanel();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        /*rocket Module*/
        $scope.viewHackTools = function () {
            $http.get($scope.hostaddress + "rocket/index/getHackApps")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.HackTools = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.addHackTool = function () {
            $scope.btnName = $scope.btnName.replace('e', 'ing');
            $http.post($scope.hostaddress + "rocket/index/addHackTool",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.ht_id,
                    'name': $scope.ht_name,
                    'title': $scope.ht_title,
                    'icon': $scope.ht_icon,
                    'url': $scope.ht_url,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.ht_id = null;
                        $scope.ht_name = null;
                        $scope.ht_title = null;
                        $scope.ht_icon = null;
                        $scope.ht_url = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.btnName = "Save";
                        $scope.viewHackTools();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetHackTool = function () {
            $scope.ht_id = null;
            $scope.ht_name = null;
            $scope.ht_title = null;
            $scope.ht_icon = null;
            $scope.ht_url = null;
            $scope.checked = "false";
            $scope.checkedbox_message = "Create new";
            $scope.btnName = "Save";
            $scope.viewHackTools();
        };

        $scope.updateHackTool = function (id, name, title, url, icon) {
            $scope.ht_id = id;
            $scope.ht_name = name;
            $scope.ht_title = title;
            $scope.ht_url = url;
            $scope.ht_icon = icon;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.btnName = "Update";
        };

        $scope.deleteHackTool = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post($scope.hostaddress + "rocket/index/deleteHackTool",
                    {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewHackTools();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        $scope.viewAccessoriesItems = function () {
            $http.get($scope.hostaddress + "rocket/accessories/getAccessoriesItems")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.AccessoriesItems = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.addAccessoriesItems = function () {
            $scope.btnName = $scope.btnName.replace('e', 'ing');
            $http.post($scope.hostaddress + "rocket/accessories/addAccessoriesItems",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.id,
                    'name': $scope.name,
                    'title': $scope.title,
                    'icon': $scope.icon,
                    'url': $scope.url,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.id = null;
                        $scope.name = null;
                        $scope.title = null;
                        $scope.icon = null;
                        $scope.url = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.btnName = "Save";
                        $scope.viewAccessoriesItems();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetAccessoriesItems = function () {
            $scope.id = null;
            $scope.name = null;
            $scope.title = null;
            $scope.icon = null;
            $scope.url = null;
            $scope.checked = "false";
            $scope.checkedbox_message = "Create new";
            $scope.btnName = "Save";
            $scope.viewAccessoriesItems();
        };

        $scope.updateAccessoriesItems = function (id, name, title, url, icon) {
            $scope.id = id;
            $scope.name = name;
            $scope.title = title;
            $scope.url = url;
            $scope.icon = icon;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.btnName = "Update";
        };

        $scope.deleteAccessoriesItems = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post($scope.hostaddress +
                    "rocket/accessories/deleteAccessoriesItems",
                    {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewAccessoriesItems();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        var FakeAppURL = $scope.hostaddress + "rocket/fake/";

        $scope.viewFakeCards = function () {
            $http.get(FakeAppURL + "getFakeCards")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.FakeCards = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.addFakeCard = function () {
            $scope.btnName = $scope.btnName.replace('e', 'ing');
            $http.post(FakeAppURL + "addFakeCard",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.thfc_id,
                    'name': $scope.thfc_name,
                    'title': $scope.thfc_title,
                    'icon': $scope.thfc_icon,
                    'url': $scope.thfc_url,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.thfc_id = null;
                        $scope.thfc_name = null;
                        $scope.thfc_title = null;
                        $scope.thfc_icon = null;
                        $scope.thfc_url = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.btnName = "Save";
                        $scope.viewFakeCards();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetFakeCard = function () {
            $scope.thfc_id = null;
            $scope.thfc_name = null;
            $scope.thfc_title = null;
            $scope.thfc_icon = null;
            $scope.thfc_url = null;
            $scope.checked = "false";
            $scope.checkedbox_message = "Create new";
            $scope.btnName = "Save";
            $scope.viewFakeCards();
        };

        $scope.updateFakeCard = function (id, name, title, url, icon) {
            $scope.thfc_id = id;
            $scope.thfc_name = name;
            $scope.thfc_title = title;
            $scope.thfc_url = url;
            $scope.thfc_icon = icon;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.btnName = "Update";
        };

        $scope.deleteFakeCard = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post(FakeAppURL + "deleteFakeCard", {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewFakeCards();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        $scope.viewNIDCards = function () {
            $http.get(FakeAppURL + "getFakeNIDCards")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.NIDCards = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.ChoosebtnName = "Choose";
        $scope.NIDCardBasic = false;
        $scope.NIDCardAdvance = false;
        $scope.Cancelbtndisable = false;
        $scope.NIDCardBasicbtnName = "Save & Next";
        $scope.NIDCardBasicResetbtnName = "Reset data";
        $scope.NIDCardMoreInfobtnName = "Save & Next";
        $scope.NIDCardMoreInfoResetbtnName = "Reset data";
        $scope.NIDCardAddressInfobtnName = "Save & Preview";
        $scope.NIDCardAddressInfoResetbtnName = "Reset data";

        $scope.goTO = function (url) {
            window.location.replace($scope.hostaddress + url);
        };

        $scope.ChooseOption = function () {
            $scope.ChoosebtnName = "Loading...";
            $scope.Cancelbtndisable = true;
            $http.post(FakeAppURL + "ChooseOption",
                {
                    'security_code': $scope.security_code,
                    'Option1': $scope.NIDCardBasic,
                    'Option2': $scope.NIDCardAdvance,
                    'btnName': "Chosen"
                })
                .then(
                    function (response) {
                        if ($scope.NIDCardBasic == true) {
                            /*$scope.dec_title = "NIDCard Basic option";
                             $scope.dec_url = FakeAppURL + "NIDCardBasic/new/" +
                             response.data + "/";
                             $scope.dec_msg = "This page automatically redirect to certain
                             page. If you want to visit quickly " +
                             "<a href='" + $scope.dec_url + "' title='" +
                             $scope.dec_title + "'>Click here</a>.";*/
                            window.location.replace(FakeAppURL + "NIDCardBasic/" +
                                response.data + "/new/");
                        } else if ($scope.NIDCardAdvance == true) {
                            /*$scope.dec_title = "NIDCard Advance option";
                             $scope.dec_url = FakeAppURL + "NIDCardAdvance/new/" +
                             response.data + "/";
                             $scope.dec_msg = "This page automatically redirect to certain
                             page. If you want to visit quickly " +
                             "<a href='" + $scope.dec_url + "' title='" +
                             $scope.dec_title + "'>Click here</a>.";*/
                            window.location.replace(FakeAppURL + "NIDCardAdvance/" +
                                response.data + "/new/");
                        } else {
                            alert(response.data);
                            $scope.NIDCardBasic = false;
                            $scope.NIDCardAdvance = false;
                            $scope.ChoosebtnName = "Choose";
                            $scope.viewNIDCards();
                        }
                    },
                    function (response) {
                        alert("Page number not found.");
                    });
        };

        $scope.viewNewNIDCardIdNo = function () {
            $http.get(FakeAppURL + "getUniqueNIDCardIdNo")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.NewNIDCardIdNo = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.viewCreatedNIDCardIdNo = function () {
            $http.get(FakeAppURL + "getCreatedNIDCardIdNo")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.NewNIDCardIdNo = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.viewNewNIDCardCeatedTime = function () {
            $http.get(FakeAppURL + "getNewNIDCardCreatedTime")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.NewNIDCardCeatedTime = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.SaveNIDCardBasicData = function (NIDCardIdNo) {
            $scope.NIDCardBasicbtnName = "Saving...";
            $http.post(FakeAppURL + "SaveNIDCardBasicData",
                {
                    'security_code': $scope.security_code,
                    'id': NIDCardIdNo,
                    'name_bangla': $scope.name_bangla,
                    'name_english': $scope.name_english,
                    'father_name_bangla': $scope.father_name_bangla,
                    'mother_name_bangla': $scope.mother_name_bangla,
                    'btnName': $scope.NIDCardBasicbtnName
                })
                .then(
                    function (response) {
                        if (response.data == NIDCardIdNo) {
                            window.location.replace(FakeAppURL + "NIDCardMoreInfo/" +
                                response.data + "/new/");
                        } else {
                            alert(response.data);
                            $scope.name_bangla = null;
                            $scope.name_english = null;
                            $scope.father_name_bangla = null;
                            $scope.mother_name_bangla = null;
                            $scope.NIDCardBasicbtnName = "Save & Next";
                            window.location.replace(FakeAppURL + "NIDCardBasic/" +
                                NIDCardIdNo + "/new/");
                        }
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.ResetNIDCardBasicData = function () {
            //$scope.NIDCardBasicResetbtnName = "Reseting";
            //$scope.NIDCardIdNo = null;
            $scope.name_bangla = null;
            $scope.name_english = null;
            $scope.father_name_bangla = null;
            $scope.mother_name_bangla = null;
            $scope.NIDCardBasicbtnName = "Save & Next";
            $scope.NIDCardBasicResetbtnName = "Reset data";
        };

        $scope.UploadbtnName = "Upload";
        $scope.uploadImage = function (id, file, name) {
            //$scope.UploadbtnName = "Uploading";
            var uploadUrl = FakeAppURL + "uploadImage/" + id;
            if (name == null) {
                alert("Error: No file selected.");
            } else {
                var fd = new FormData();
                fd.append('file', file);
                fd.append('name', name);
                $http.post(uploadUrl, fd,
                    {
                        transformRequest: angular.identity,
                        headers: {'Content-Type': undefined, 'Process-Data': false}
                    })
                    .then(function (response) {
                            alert(response.data);
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            }
        };

        $scope.SaveNIDCardMoreInfoData = function (NIDCardIdNo) {
            $scope.NIDCardMoreInfobtnName = "Saving...";
            $http.post(FakeAppURL + "SaveNIDCardMoreInfoData",
                {
                    'security_code': $scope.security_code,
                    'id': NIDCardIdNo,
                    'dob': $scope.dob,
                    'nidn': $scope.nidn,
                    'btnName': $scope.NIDCardMoreInfobtnName
                })
                .then(
                    function (response) {
                        if (response.data == NIDCardIdNo) {
                            window.location.replace(FakeAppURL + "NIDCardAddressInfo/" +
                                response.data + "/new/");
                        } else {
                            alert(response.data);
                            $scope.dob = null;
                            $scope.nidn = null;
                            $scope.NIDCardMoreInfobtnName = "Save & Next";
                            window.location.replace(FakeAppURL + "NIDCardMoreInfo/" +
                                NIDCardIdNo + "/new/");
                        }
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.ResetNIDCardMoreInfoData = function () {
            //$scope.NIDCardBasicResetbtnName = "Reseting";
            //$scope.NIDCardIdNo = null;
            $scope.dob = null;
            $scope.nidn = null;
            $scope.NIDCardMoreInfobtnName = "Save & Next";
            $scope.NIDCardMoreInfoResetbtnName = "Reset data";
        };

        $scope.SaveNIDCardAddressInfoData = function (NIDCardIdNo) {
            $scope.NIDCardAddressInfobtnName = "Saving...";
            $http.post(FakeAppURL + "SaveNIDCardAddressInfoData",
                {
                    'security_code': $scope.security_code,
                    'id': NIDCardIdNo,
                    'perm': $scope.perm,
                    'pres': $scope.pres,
                    'btnName': $scope.NIDCardAddressInfobtnName
                })
                .then(
                    function (response) {
                        if (response.data == NIDCardIdNo) {
                            window.location.replace(FakeAppURL + "NIDCardAddressInfo/" +
                                response.data + "/new/");
                        } else {
                            alert(response.data);
                            $scope.perm = null;
                            $scope.pres = null;
                            $scope.NIDCardAddressInfobtnName = "Save & Preview";
                            $scope.NIDCardAddressInfoResetbtnName = "Reset data";
                            window.location.replace(FakeAppURL + "NIDCardAddressInfo/" +
                                NIDCardIdNo + "/new/");
                        }
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.ResetNIDCardAddressInfoData = function () {
            //$scope.NIDCardBasicResetbtnName = "Reseting";
            //$scope.NIDCardIdNo = null;
            $scope.perm = null;
            $scope.pres = null;
            $scope.NIDCardAddressInfobtnName = "Save & Preview";
            $scope.NIDCardAddressInfoResetbtnName = "Reset data";
        };

        $scope.ReserveDataCopy = function () {
            $scope.pres = angular.copy($scope.perm);
        };

        $scope.viewNIDCardReserveData = function () {
            $http.get(FakeAppURL + "getNIDCardReserveData")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.NIDCardReserveData = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.viewNIDCardReserveDataDiv = function (step) {
            if (angular.isDefined(step)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataDiv")
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            if (step == 'perm') {
                                return $scope.permDivisionData = response.data;
                            }
                            if (step == 'pres') {
                                return $scope.presDivisionData = response.data;
                            } else {
                                return $scope.DivisionData = response.data;
                            }
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                //console.info("Waiting for get all division of bangladesh.");
            }
        };

        $scope.viewNIDCardReserveDataDist = function (step, div) {
            if (angular.isDefined(div)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataDivBn/" + div)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            $scope.div = response.data;
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
            }

            if (angular.isDefined(step) && angular.isDefined(div)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataDist/" + div)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            if (step == 'perm') {
                                return $scope.permZillaData = response.data;
                            }
                            if (step == 'pres') {
                                return $scope.presZillaData = response.data;
                            } else {
                                return $scope.ZillaData = response.data;
                            }
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                //console.info( "Waiting for get all district from selected division of bangladesh.");
            }
        };

        $scope.viewNIDCardReserveDataPoliceStation = function (step, div, dist) {
            if (angular.isDefined(div) && angular.isDefined(dist)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataDistBn/" + div + "/" + dist)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            $scope.dst = response.data;
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
            }

            if (angular.isDefined(step) && angular.isDefined(div) &&
                angular.isDefined(dist)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataPoliceStation/" + div + "/" + dist)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            if (step == 'perm') {
                                return $scope.permPoliceStationData = response.data;
                            }
                            if (step == 'pres') {
                                return $scope.presPoliceStationData = response.data;
                            } else {
                                return $scope.PoliceStationData = response.data;
                            }
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                //console.info( "Waiting for get all Police Station from selected district of bangladesh.");
            }
        };

        $scope.viewNIDCardReserveDataUnion = function (step, div, dist, plc_sttn) {
            if (angular.isDefined(div) && angular.isDefined(dist) && angular.isDefined(plc_sttn)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataPlcStationBn/" + div + "/" + dist
                    + "/" + plc_sttn)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            $scope.PlcStation = response.data;
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
            }

            if (angular.isDefined(step) && angular.isDefined(div) &&
                angular.isDefined(dist) && angular.isDefined(plc_sttn)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataUnion/" + div + "/" +
                    dist + "/" + plc_sttn)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            if (step == 'perm') {
                                return $scope.permUnionData = response.data;
                            }
                            if (step == 'pres') {
                                return $scope.presUnionData = response.data;
                            } else {
                                return $scope.UnionData = response.data;
                            }
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                // console.info( "Waiting for get all Union from selected Police Station of bangladesh.");
            }
        };

        $scope.viewNIDCardReserveDataPostOffice = function (step, div, dist,
                                                            plc_sttn, union) {
            if (angular.isDefined(div) && angular.isDefined(dist) &&
                angular.isDefined(plc_sttn) && angular.isDefined(union)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataUnionBn/" + div + "/" +
                    dist + "/" + plc_sttn + "/" + union)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            $scope.Uni = response.data;
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
            }


            if (angular.isDefined(step) && angular.isDefined(div) &&
                angular.isDefined(dist) && angular.isDefined(plc_sttn) &&
                angular.isDefined(union)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataPostOffice/" + div + "/" +
                    dist + "/" + plc_sttn + "/" + union)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            if (step == 'perm') {
                                return $scope.permPostOfficeData = response.data;
                            }
                            if (step == 'pres') {
                                return $scope.presPostOfficeData = response.data;
                            } else {
                                return $scope.PostOfficeData = response.data;
                            }
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
               // console.info( "Waiting for get all Post Office from selected Union of bangladesh.");
            }
        };

        $scope.viewNIDCardReserveDataVillage = function (step, division, district,
                                                         police_station, union, post_office) {
            if (angular.isDefined(step) && angular.isDefined(division) &&
                angular.isDefined(district) && angular.isDefined(police_station) &&
                angular.isDefined(union) && angular.isDefined(post_office)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataVillage/" + division + "/" +
                    district + "/" + police_station + "/" + union + "/" + post_office)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            if (step == 'perm') {
                                return $scope.permVillageData = response.data;
                            }
                            if (step == 'pres') {
                                return $scope.presVillageData = response.data;
                            } else {
                                return $scope.VillageData = response.data;
                            }
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
               // console.info( "Waiting for get all Village from selected Post Office of bangladesh.");
            }
        };

        $scope.viewNIDCardReservedataAddress = function (step, division, district,
                                                         police_station, union, post_office, village) {
            if (angular.isDefined(step) && angular.isDefined(division) &&
                angular.isDefined(district) && angular.isDefined(police_station) &&
                angular.isDefined(union) && angular.isDefined(post_office)
                && angular.isDefined(village)) {
                $http.get(FakeAppURL + "getNIDCardReserveDataVillage/" + division + "/" +
                    district + "/" + police_station + "/" + union + "/" + post_office + "/" + village)
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            if (step == 'perm') {
                                return $scope.permAddressData = response.data;
                            }
                            if (step == 'pres') {
                                return $scope.presAddressData = response.data;
                            } else {
                                return $scope.AddressData = response.data;
                            }
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
               // console.info( "Waiting for get all address from selected Village of bangladesh.");
            }
        };
        $scope.viewCountedData = function (step) {
            if (angular.isDefined(step)) {
                $http.get(FakeAppURL + "getCountedNIDCardReserveData")
                    .then(
                        function (response) {
                            $scope.status_code = response.status;
                            if (step == 'perm') {
                                return $scope.permCountedData = response.data;
                            }
                            if (step == 'pres') {
                                return $scope.presCountedData = response.data;
                            } else {
                                return $scope.CountedData = response.data;
                            }
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
               // console.info("Waiting for get all division of bangladesh.");
            }
        };

        $scope.ReserveDatabtnName = "Save";
        $scope.ReserveDataJobStatus = "Save";
        $scope.ReserveDataResetbtnName = "Reset data";


        //$scope.all_division = count($scope.DivisionData);

        /*        $scope.division = '';
         $scope.division_ban = '';
         $scope.viewNIDCardReserveDataDist('home', undefined);
         $scope.district = '';
         $scope.district_ban = '';
         $scope.viewNIDCardReserveDataPoliceStation('home', undefined,
         undefined);
         $scope.police_station = '';
         $scope.police_station_ban = '';
         $scope.viewNIDCardReserveDataUnion('home', undefined, undefined,
         undefined);
         $scope.union = '';
         $scope.union_ban = '';
         $scope.viewNIDCardReserveDataPostOffice('home', undefined,
         undefined, undefined, undefined);
         $scope.post_office = '';
         $scope.post_office_ban = '';
         $scope.village = null;
         $scope.village_ban = null;
         $scope.address = null;
         $scope.address_ban = null;*/

        $scope.SaveReserveDataDivi = function () {
            $scope.ReserveDatabtnName =
                $scope.ReserveDatabtnName.replace('e', 'ing');
            $http.post(FakeAppURL + "SaveReserveDataDivi",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.div_id,
                    'division': $scope.division,
                    'division_ban': $scope.division_ban,
                    'btnName': $scope.ReserveDatabtnName,
                    'JobStatus': $scope.ReserveDataJobStatus
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.div_id = null;
                        $scope.viewNIDCardReserveDataDiv('home');
                        $scope.division = '';
                        $scope.division_ban = '';
                        $scope.new_div = false;
                        $scope.ReserveDatabtnName = "Save";
                        $scope.ReserveDataJobStatus = "Save";
                        $scope.ReserveDataResetbtnName = "Reset data";
                        $scope.viewNIDCardReserveData();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.SaveReserveDataDist = function () {
            $scope.ReserveDatabtnName =
                $scope.ReserveDatabtnName.replace('e', 'ing');
            $http.post(FakeAppURL + "SaveReserveDataDist",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.dist_id,
                    'div': $scope.division,
                    'district': $scope.district,
                    'district_ban': $scope.district_ban,
                    'btnName': $scope.ReserveDatabtnName,
                    'JobStatus': $scope.ReserveDataJobStatus
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.dist_id = null;
                        $scope.viewNIDCardReserveDataDist('home', $scope.division);
                        $scope.district = '';
                        $scope.district_ban = '';
                        $scope.new_dist = false;
                        $scope.ReserveDatabtnName = "Save";
                        $scope.ReserveDataJobStatus = "Save";
                        $scope.ReserveDataResetbtnName = "Reset data";
                        $scope.viewNIDCardReserveData();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.SaveReserveDataPlcStation = function () {
            $scope.ReserveDatabtnName =
                $scope.ReserveDatabtnName.replace('e', 'ing');
            $http.post(FakeAppURL + "SaveReserveDataPlcStation",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.dist_id,
                    'div': $scope.division,
                    'dist': $scope.district,
                    'police_station': $scope.police_station,
                    'police_station_ban': $scope.police_station_ban,
                    'btnName': $scope.ReserveDatabtnName,
                    'JobStatus': $scope.ReserveDataJobStatus
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.ps_id = null;
                        $scope.viewNIDCardReserveDataPoliceStation('home', $scope.division, $scope.district);
                        $scope.police_station = '';
                        $scope.police_station_ban = '';
                        $scope.new_dist = false;
                        $scope.ReserveDatabtnName = "Save";
                        $scope.ReserveDataJobStatus = "Save";
                        $scope.ReserveDataResetbtnName = "Reset data";
                        $scope.viewNIDCardReserveData();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };


        $scope.SaveReserveDataUnion = function () {
            $scope.ReserveDatabtnName =
                $scope.ReserveDatabtnName.replace('e', 'ing');
            $http.post(FakeAppURL + "SaveReserveDataUnion",
                {
                    'security_code': $scope.security_code,
                    'id': $scope.dist_id,
                    'div': $scope.division,
                    'dist': $scope.district,
                    'plc_station': $scope.police_station,
                    'union': $scope.union,
                    'union_ban': $scope.union_ban,
                    'btnName': $scope.ReserveDatabtnName,
                    'JobStatus': $scope.ReserveDataJobStatus
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.uno_id = null;
                        $scope.viewNIDCardReserveDataUnion('home', $scope.division, $scope.district, $scope.police_station);
                        $scope.union = '';
                        $scope.union_ban = '';
                        $scope.new_union = false;
                        $scope.ReserveDatabtnName = "Save";
                        $scope.ReserveDataJobStatus = "Save";
                        $scope.ReserveDataResetbtnName = "Reset data";
                        $scope.viewNIDCardReserveData();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.SaveReserveData = function () {
            $scope.ReserveDatabtnName = $scope.ReserveDatabtnName.replace('e', 'ing');
            $http.post(FakeAppURL + "SaveReserveData",
                {
                    'id': $scope.thfndata_id,
                    'security_code': $scope.security_code,
                    'division': $scope.division,
                    'division_ban': $scope.division_ban,
                    'district': $scope.district,
                    'district_ban': $scope.district_ban,
                    'police_station': $scope.police_station,
                    'police_station_ban': $scope.police_station_ban,
                    'union': $scope.union,
                    'union_ban': $scope.union_ban,
                    'post_office': $scope.post_office,
                    'post_office_ban': $scope.post_office_ban,
                    'village': $scope.village,
                    'village_ban': $scope.village_ban,
                    'address': $scope.address,
                    'address_ban': $scope.address_ban,
                    'btnName': $scope.ReserveDatabtnName,
                    'JobStatus': $scope.ReserveDataJobStatus
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.thfndata_id = null;
                        $scope.viewNIDCardReserveDataDiv('home');
                        $scope.division = '';
                        $scope.division_ban = '';
                        $scope.viewNIDCardReserveDataDist('home', undefined);
                        $scope.district = '';
                        $scope.district_ban = '';
                        $scope.viewNIDCardReserveDataPoliceStation('home', undefined, undefined);
                        $scope.police_station = '';
                        $scope.police_station_ban = '';
                        $scope.viewNIDCardReserveDataUnion('home', undefined, undefined, undefined);
                        $scope.union = '';
                        $scope.union_ban = '';
                        $scope.viewNIDCardReserveDataPostOffice('home', undefined, undefined, undefined, undefined);
                        $scope.post_office = '';
                        $scope.post_office_ban = '';
                        $scope.village = null;
                        $scope.village_ban = null;
                        $scope.address = null;
                        $scope.address_ban = null;
                        $scope.ReserveDatabtnName = "Save";
                        $scope.ReserveDataJobStatus = "Save";
                        $scope.ReserveDataResetbtnName = "Reset data";
                        $scope.viewNIDCardReserveData();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.updateReserveData = function (id, division, division_ban, district, district_ban, police_station,
                                             police_station_ban, union, union_ban, post_office, post_office_ban,
                                             village, village_ban, address, address_ban) {
            $scope.thfndata_id = id;
            $scope.division = division;
            $scope.division_ban = division_ban;
            $scope.viewNIDCardReserveDataDist('home', division);
            $scope.district = district;
            $scope.district_ban = district_ban;
            $scope.viewNIDCardReserveDataPoliceStation('home', division, district);
            $scope.police_station = police_station;
            $scope.police_station_ban = police_station_ban;
            $scope.viewNIDCardReserveDataUnion('home', division, district, police_station);
            $scope.union = union;
            $scope.union_ban = union_ban;
            $scope.viewNIDCardReserveDataPostOffice('home', division, district, police_station, union);
            $scope.post_office = post_office;
            $scope.post_office_ban = post_office_ban;
            $scope.village = village;
            $scope.village_ban = village_ban;
            $scope.address = address;
            $scope.address_ban = address_ban;
            $scope.checked = "checked";
            $scope.new_div = "checked";
            $scope.new_dist = "checked";
            $scope.new_police_station = "checked";
            $scope.new_union = "checked";
            $scope.new_post_office = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.ReserveDatabtnName = "Update";
            $scope.ReserveDataJobStatus = "Update";
            $scope.viewNIDCardReserveData();
        };

        $scope.ResetReserveData = function () {
            //$scope.NIDCardBasicResetbtnName = "Reseting";
            $scope.viewNIDCardReserveDataDiv('home');
            $scope.division = '';
            $scope.division_ban = '';
            $scope.district = '';
            $scope.district_ban = '';
            $scope.police_station = '';
            $scope.police_station_ban = '';
            $scope.post_office = '';
            $scope.post_office_ban = '';
            $scope.village = null;
            $scope.village_ban = null;
            $scope.address = null;
            $scope.address_ban = null;
            $scope.div = null;
            $scope.ReserveDatabtnName = "Save";
            $scope.ReserveDataResetbtnName = "Reset data";
            $scope.viewNIDCardReserveData();
        };

        $scope.deleteReserveData = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post(FakeAppURL + "deleteReserveData", {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewNIDCardReserveData();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };

        $scope.translateEn2Bn = function (number) {
            if (number == '0') {
                return '০';
            }
            else if(number == '1') {
                return '০';
            }
            else if(number == '2') {
                return '০';
            }
            else if(number == '3') {
                return '০';
            }
            else {
                return 'invalid number.'
            }
        };

        /*fb auto tool Module*/
        $scope.viewFbAppItems = function () {
            $http.get($scope.hostaddress + "fbapp/items/getFbAppItems")
                .then(
                    function (response) {
                        $scope.status_code = response.status;
                        $scope.data = response.data;
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.addAutoToolsItem = function () {
            $http.post($scope.hostaddress + "fbapp/items/addAutoToolsItem",
                {
                    'security_code': $scope.security_code,
                    'id' : $scope.id,
                    'name': $scope.item_name,
                    'title': $scope.item_title,
                    'status': $scope.item_status,
                    'icon': $scope.item_icon,
                    'url': $scope.item_url,
                    'description': $scope.item_description,
                    'btnName': $scope.btnName
                })
                .then(
                    function (response) {
                        alert(response.data);
                        $scope.item_name = null;
                        $scope.item_title = null;
                        $scope.item_status = null;
                        $scope.item_icon = null;
                        $scope.item_url = null;
                        $scope.item_description = null;
                        $scope.checked = "false";
                        $scope.checkedbox_message = "Create new";
                        $scope.btnName = "Save";
                        $scope.viewFbAppItems();
                    },
                    function (response) {
                        alert("Error code: " + response.status +
                            ". Message: Data not found.");
                    });
        };

        $scope.resetAutoToolsItem = function () {
            $scope.item_name = null;
            $scope.item_title = null;
            $scope.item_status = null;
            $scope.item_icon = null;
            $scope.item_url = null;
            $scope.item_description = null;
            $scope.checked = "false";
            $scope.checkedbox_message = "Create new";
            $scope.btnName = "Save";
            $scope.viewFbAppItems();
        };

        $scope.updateAutoToolItem = function (id, name, title, status, icon, url, description) {
            $scope.id = id;
            $scope.item_name = name;
            $scope.item_title = title;
            $scope.item_status = status;
            $scope.item_icon = icon;
            $scope.item_url = url;
            $scope.item_description = description;
            $scope.checked = "checked";
            $scope.checkedbox_message = "Edit";
            $scope.btnName = "Update";
        };

        $scope.deleteAutoToolItem = function (id) {
            if (confirm("Are you sure you want to delete?")) {
                $http.post($scope.hostaddress + "fbapp/items/deleteAutoToolsItem", {'id': id})
                    .then(
                        function (response) {
                            alert(response.data);
                            $scope.viewFbAppItems();
                        },
                        function (response) {
                            alert("Error code: " + response.status +
                                ". Message: Data not found.");
                        });
            } else {
                return false;
            }
        };
    }
]);

