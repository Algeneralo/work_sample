/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

$(function () {

    //init Scheduler
    let date = new Date();

    // axios.get("/admin/kalender")
    //     .then(function (response) {
    //
    //     })
    //     .catch(function (error) {
    //
    //         console.log(error);
    //     })

    $("#scheduler").kendoScheduler({
        date: date,
        mobile: true,
        views: [
            {
                type: "month",
                selected: true,
            },
            {
                'type': "week",
            },
            {
                type: "day",
                allDaySlot: true,
            },
            {
                type: "agenda",
            },
        ],
        timezone: "Europe/Berlin",
        editable: {
            create: false,
            destroy: false,
            update: false,
            move: false,
            resize: false,
        },
        eventTemplate: $("#event-template").html(),
        dataSource: {
            batch: true,
            transport: {
                read: {
                    url: "/admin/kalender",
                    dataType: "json"
                },
                parameterMap: function (options, operation) {
                    if (operation !== "read" && options.models) {
                        return {models: kendo.stringify(options.models)};
                    }
                }
            }
        },
        resources: [
            {
                field: "id",
                title: "id",
                dataSource: {
                    "transport": {
                        "read": {
                            "url": "/admin/kalender",
                            "dataType": "json",
                            "contentType": "application/json; charset=utf-8"
                        }
                    }
                },

            }
        ]
    });

    //filter scheduler depend on selected employee
    $("#employeesFilter").on("change", function () {
        let selected = $(this).val();
        let scheduler = $("#scheduler").data("kendoScheduler");

        if (selected !== "all")
            scheduler.dataSource.filter({
                operator: function (task) {
                    return task.id == selected;
                }
            });
        else
            scheduler.dataSource.filter({
                operator: function (task) {
                    return true;
                }
            });
    });
});

