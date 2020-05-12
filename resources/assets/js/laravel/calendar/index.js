/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

$(function () {

    //init Scheduler
    let date = new Date();


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
                dateHeaderTemplate: kendo.template("<span class='k-link k-nav-day'>#=kendo.toString(date, 'd')#</span>")
            },
            {
                type: "day",
                allDaySlot: true,
                dateHeaderTemplate: kendo.template("<span class='k-link k-nav-day'>#=kendo.toString(date, 'd')#</span>")
            },
            {
                type: "agenda",
            },
        ],
        // timezone: "Europe/Berlin",
        editable: {
            create: false,
            destroy: false,
            update: false,
            move: false,
            resize: false,
        },
        timezone: "Etc/UTC",
        eventTemplate: $("#event-template").html(),
        dataSource: {
            batch: true,
            transport: {
                read: {
                    url: "https://demos.telerik.com/kendo-ui/service/tasks",
                    dataType: "jsonp"
                },
                update: {
                    url: "https://demos.telerik.com/kendo-ui/service/tasks/update",
                    dataType: "jsonp"
                },
                create: {
                    url: "https://demos.telerik.com/kendo-ui/service/tasks/create",
                    dataType: "jsonp"
                },
                destroy: {
                    url: "https://demos.telerik.com/kendo-ui/service/tasks/destroy",
                    dataType: "jsonp"
                },
                parameterMap: function (options, operation) {
                    if (operation !== "read" && options.models) {
                        return {models: kendo.stringify(options.models)};
                    }
                }
            },
            schema: {
                model: {
                    id: "taskId",
                    fields: {
                        taskId: {from: "TaskID", type: "number"},
                        title: {from: "Title", defaultValue: "No title", validation: {required: true}},
                        start: {type: "date", from: "Start"},
                        end: {type: "date", from: "End"},
                        startTimezone: {from: "StartTimezone"},
                        endTimezone: {from: "EndTimezone"},
                        description: {from: "Description"},
                        recurrenceId: {from: "RecurrenceID"},
                        recurrenceRule: {from: "RecurrenceRule"},
                        recurrenceException: {from: "RecurrenceException"},
                        ownerId: {from: "OwnerID", defaultValue: 1},
                        isAllDay: {type: "boolean", from: "IsAllDay"}
                    }
                }
            },
            filter: {
                logic: "or",
                filters: [
                    {field: "ownerId", operator: "eq", value: 1},
                    {field: "ownerId", operator: "eq", value: 2}
                ]
            }
        },
        // {
        // batch: true,
        // transport: {
        //     read: {
        //         url: "/admin/kalender/data",
        //         dataType: "json",
        //         beforeSend: function (req) {
        //             req.setRequestHeader('X-CSRF-Token', document.head.querySelector('meta[name="csrf-token"]').getAttribute("content"));
        //         }
        //     },
        //     update: {
        //         url: "/admin/kalender",
        //         dataType: "json",
        //         method: "put",
        //         beforeSend: function (req) {
        //             req.setRequestHeader('X-CSRF-Token', document.head.querySelector('meta[name="csrf-token"]').getAttribute("content"));
        //         }
        //     },
        //     create: {
        //         url: "/admin/kalender",
        //         dataType: "json",
        //         method: "post",
        //         beforeSend: function (req) {
        //             req.setRequestHeader('X-CSRF-Token', document.head.querySelector('meta[name="csrf-token"]').getAttribute("content"));
        //         }
        //     },
        //     destroy: {
        //         url: "/admin/kalender",
        //         dataType: "json",
        //         method: "delete",
        //         beforeSend: function (req) {
        //             req.setRequestHeader('X-CSRF-Token', document.head.querySelector('meta[name="csrf-token"]').getAttribute("content"));
        //         }
        //     },
        //     parameterMap: function (options, operation) {
        //         if (operation !== "read" && options) {
        //             return {models: kendo.stringify(options)};
        //         }
        //     }
        // },
        //     parameterMap: function(options, operation) {
        //         if (operation !== "read" && options.models) {
        //             return {models: kendo.stringify(options.models)};
        //         }
        //     }
        // },


        // schema: {
        //     model: {
        //         id: "id",
        //         fields: {
        //             id: {from: "id", type: "number"},
        //             title: {from: "title"},
        //             start: {type: "date", from: "start"},
        //             end: {type: "date", from: "end"},
        //             description: {from: "description"},
        //             recurrenceId: {from: "recurrenceId"},
        //             recurrenceRule: {from: "recurrenceRule"},
        //             recurrenceException: {from: "recurrenceException"},
        //             service_id: {from: "service_id", validation: {required: true}},
        //             employee_id: {from: "employee_id", validation: {required: true}},
        //             customer_id: {from: "customer_id", validation: {required: true}},
        //         }
        //     }
        // },
        // },
        resources: [
            {
                field: "ownerId",
                title: "Owner",
                dataSource: [
                    {text: "Alex", value: 1, color: "#FFB84A"},
                    {text: "Bob", value: 2, color: "#8CCDC2"},
                    {text: "Charlie", value: 3, color: "#7571D7"}
                ]
            }
        ]
    });

    //filter scheduler depend on selected employee
    $("#event-filter").on("change", function () {
        let selected = $(this).val();
        let scheduler = $("#scheduler").data("kendoScheduler");

        // if (selected !== "all")
        //     scheduler.dataSource.filter({
        //         operator: function (task) {
        //             return task.employee_id == selected;
        //         }
        //     });
        // else
        //     scheduler.dataSource.filter({
        //         operator: function (task) {
        //             return true;
        //         }
        //     });
    });
});

