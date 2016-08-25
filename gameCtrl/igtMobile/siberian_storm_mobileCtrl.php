<?
require_once('IGTMobileCtrl.php');

class siberian_storm_mobileCtrl extends IGTMobileCtrl {

    protected function startPaytable($request) {
        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "Paytable": {
        "PaytableStatistics": {
            "@description": "Siberian Storm 720 Multiway 3x4x5x4x3",
            "@maxRTP": "96",
            "@minRTP": "92.52",
            "@name": "Siberian Storm",
            "@type": "Slot"
        },
        "PrizeInfo": [{
            "@name": "PrizeInfoLeftRightBaseGame",
            "@strategy": "PayMultiWayLeftRight",
            "Prize": [{
                "@name": "s01",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "1106",
                    "@value": "1000"
                }, {
                    "@count": "4",
                    "@pph": "191",
                    "@value": "150"
                }, {
                    "@count": "3",
                    "@pph": "56",
                    "@value": "50"
                }],
                "Symbol": [{
                    "@id": "s01",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s02",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "320",
                    "@value": "400"
                }, {
                    "@count": "4",
                    "@pph": "64",
                    "@value": "75"
                }, {
                    "@count": "3",
                    "@pph": "18",
                    "@value": "25"
                }],
                "Symbol": [{
                    "@id": "s02",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s03",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "72",
                    "@value": "300"
                }, {
                    "@count": "4",
                    "@pph": "30",
                    "@value": "50"
                }, {
                    "@count": "3",
                    "@pph": "65",
                    "@value": "20"
                }],
                "Symbol": [{
                    "@id": "s03",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s04",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "66",
                    "@value": "125"
                }, {
                    "@count": "4",
                    "@pph": "10",
                    "@value": "30"
                }, {
                    "@count": "3",
                    "@pph": "15",
                    "@value": "15"
                }],
                "Symbol": [{
                    "@id": "s04",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s05",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "44",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "72",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "30",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "s05",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s06",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "111",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "169",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "151",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s06",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s07",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "333",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "19",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "20",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s07",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s08",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "374",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "748",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "56",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s08",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "b01",
                "PrizePay": {
                    "@count": "5",
                    "@pph": "98",
                    "@value": "50"
                },
                "Symbol": {
                    "@id": "b01",
                    "@required": "true"
                }
            }]
        }, {
            "@name": "PrizeInfoRightLeftBaseGame",
            "@strategy": "PayMultiWayRightLeft",
            "Prize": [{
                "@name": "s01",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "1000"
                }, {
                    "@count": "4",
                    "@pph": "233",
                    "@value": "150"
                }, {
                    "@count": "3",
                    "@pph": "55",
                    "@value": "50"
                }],
                "Symbol": [{
                    "@id": "s01",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s02",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "400"
                }, {
                    "@count": "4",
                    "@pph": "432",
                    "@value": "75"
                }, {
                    "@count": "3",
                    "@pph": "75",
                    "@value": "25"
                }],
                "Symbol": [{
                    "@id": "s02",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s03",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "300"
                }, {
                    "@count": "4",
                    "@pph": "84",
                    "@value": "50"
                }, {
                    "@count": "3",
                    "@pph": "21",
                    "@value": "20"
                }],
                "Symbol": [{
                    "@id": "s03",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s04",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "125"
                }, {
                    "@count": "4",
                    "@pph": "97",
                    "@value": "30"
                }, {
                    "@count": "3",
                    "@pph": "72",
                    "@value": "15"
                }],
                "Symbol": [{
                    "@id": "s04",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s05",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "65",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "9",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "s05",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s06",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "7",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "29190",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s06",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s07",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "28",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "118",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s07",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }, {
                "@name": "s08",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "23",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "8",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s08",
                    "@required": "false"
                }, {
                    "@id": "w01",
                    "@required": "false"
                }]
            }]
        }, {
            "@name": "PrizeInfoLeftRightFreeSpin",
            "@strategy": "PayMultiWayLeftRight",
            "Prize": [{
                "@name": "s10",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "219",
                    "@value": "1000"
                }, {
                    "@count": "4",
                    "@pph": "34",
                    "@value": "150"
                }, {
                    "@count": "3",
                    "@pph": "23",
                    "@value": "50"
                }],
                "Symbol": [{
                    "@id": "s10",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s11",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "38",
                    "@value": "400"
                }, {
                    "@count": "4",
                    "@pph": "6",
                    "@value": "75"
                }, {
                    "@count": "3",
                    "@pph": "4",
                    "@value": "25"
                }],
                "Symbol": [{
                    "@id": "s11",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s12",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "29",
                    "@value": "300"
                }, {
                    "@count": "4",
                    "@pph": "29",
                    "@value": "50"
                }, {
                    "@count": "3",
                    "@pph": "12",
                    "@value": "20"
                }],
                "Symbol": [{
                    "@id": "s12",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s13",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "10",
                    "@value": "125"
                }, {
                    "@count": "4",
                    "@pph": "2",
                    "@value": "30"
                }, {
                    "@count": "3",
                    "@pph": "6",
                    "@value": "15"
                }],
                "Symbol": [{
                    "@id": "s13",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s14",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "23",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "3",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "15",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "s14",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s15",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "20",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "28",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "56",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s15",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s16",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "41",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "32",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "15",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s16",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s17",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "58",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "90",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "30",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s17",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "b02",
                "PrizePay": {
                    "@count": "5",
                    "@pph": "131",
                    "@value": "50"
                },
                "Symbol": {
                    "@id": "b02",
                    "@required": "true"
                }
            }]
        }, {
            "@name": "PrizeInfoRightLeftFreeSpin",
            "@strategy": "PayMultiWayRightLeft",
            "Prize": [{
                "@name": "s10",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "1000"
                }, {
                    "@count": "4",
                    "@pph": "40",
                    "@value": "150"
                }, {
                    "@count": "3",
                    "@pph": "22",
                    "@value": "50"
                }],
                "Symbol": [{
                    "@id": "s10",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s11",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "400"
                }, {
                    "@count": "4",
                    "@pph": "60",
                    "@value": "75"
                }, {
                    "@count": "3",
                    "@pph": "25",
                    "@value": "25"
                }],
                "Symbol": [{
                    "@id": "s11",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s12",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "300"
                }, {
                    "@count": "4",
                    "@pph": "5",
                    "@value": "50"
                }, {
                    "@count": "3",
                    "@pph": "4",
                    "@value": "20"
                }],
                "Symbol": [{
                    "@id": "s12",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s13",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "125"
                }, {
                    "@count": "4",
                    "@pph": "17",
                    "@value": "30"
                }, {
                    "@count": "3",
                    "@pph": "22",
                    "@value": "15"
                }],
                "Symbol": [{
                    "@id": "s13",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s14",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "38",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "10",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "s14",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s15",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "2",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "5",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s15",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s16",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "3",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "11",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s16",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }, {
                "@name": "s17",
                "PrizePay": [{
                    "@count": "5",
                    "@doNotGeneratePrize": "true",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "5",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "4",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "s17",
                    "@required": "false"
                }, {
                    "@id": "w02",
                    "@required": "false"
                }]
            }]
        }, {
            "@name": "PrizeInfoScatterBaseGame",
            "@strategy": "PayAny",
            "Prize": {
                "@name": "s09",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "29190",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "845",
                    "@value": "10"
                }, {
                    "@count": "3",
                    "@pph": "62",
                    "@value": "2"
                }],
                "Symbol": {
                    "@id": "s09",
                    "@required": "false"
                }
            }
        }, {
            "@name": "PrizeInfoScatterFreeSpin",
            "@strategy": "PayAny",
            "Prize": {
                "@name": "s18",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "29545",
                    "@value": "50"
                }, {
                    "@count": "4",
                    "@pph": "852",
                    "@value": "10"
                }, {
                    "@count": "3",
                    "@pph": "62",
                    "@value": "2"
                }],
                "Symbol": {
                    "@id": "s18",
                    "@required": "false"
                }
            }
        }],
        "StripInfo": [{
            "@name": "BaseGame",
            "Strip": [{
                "@name": "Reel0",
                "#text": "s09,s05,s02,s08,s02,b01,s05,s04,s01,b01,s04,s02,s05,s02,s01,s03,s05,s02,s04,s03,s05,s03,s05,s04,b01,s05,s02,s04,s04,s02,s04,s04,s02,s03,s05,s08,b01,s02,s05,b01,s04,s07,b01,s05,s02,b01,s04,s03,s05,b01,s04,s02,s05,s01,s04,s03,s09,s04,s02,s09,s08,s01,b01,s04,s05,b01,s06,s04,b01,s05,s04,b01,s05,s02,b01,s05,s04,s02,s01,s05,b01,s04,s02,s07,b01,s02,s05,s02,s09,s04,s02,b01,s04,s05,b01,s07,s01,s04,s02,s04,s05,s04,s04,s07,s02,s05,b01,s04,s05,s05,s03,s05,b01,s02,s05,s03,s09,s02,s04,s01,s04,s03,b01,s04,s05,s05,s02,b01,s06,s03,s05,b01,s02,s05,s02,s06,s02,s01,s04,b01,s02,s04,s05,s04,s02,s05,s02,b01,s05,s04,b01,s02,s04,s02,s01"
            }, {
                "@name": "Reel1",
                "#text": "s08,s07,s08,s04,s08,s01,s04,s07,s05,s07,s08,s06,s07,b01,b01,s08,s07,s06,b01,s05,s04,s04,s05,s01,s06,s07,s06,s01,s04,s01,s02,s07,s08,s06,b01,s06,s07,s06,s08,s07,s03,s06,s07,s06,s09,s07,s06,s02,s06,s07,b01,b01,s07,s06,s07,s06,s02,s06,s02,s06,s07,s06,s03,s09,s02,b01,b01,s04,s02,s07,s04,s02,s07,s06,s06,b01,b01,s07,s05,s03,s09,s07,s06,b01,s04,s07,s06,s04,b01,s07,s01,s04,s06,s07,s04,s06,b01,s02,s07,s06,s07,b01,s04,s06,s07,s04,s07,s06,s04,b01,b01,s06,s04,s04,b01,s06,s04,s04,s02,s04,s05,b01,s04,s06,s04,s07,s04,b01,s06,s01,s07,s09,s06,s04,s07,s04,s06,b01,s06,s04,s06,s07,b01,s06,s04,s07,b01,s03,s07,s04,s03,s04,s03,s04,b01,s07,s07,s06,s09,s04,s07,s06,b01,s07,s03,s05,s05,w01,w01,w01,w01,w01,s07,s04,s07,s06,s07,b01,s08,s07,s07,s09,s07,s05,b01"
            }, {
                "@name": "Reel2",
                "#text": "s02,s08,b01,s07,s08,s07,s07,s04,b01,b01,s08,s05,s08,s04,s01,s07,s02,s06,s01,s07,b01,s06,s06,s02,s05,b01,s08,s04,s01,s05,b01,s08,s04,s08,s08,s06,s06,s07,s05,b01,b01,b01,s07,s08,s07,s01,b01,s07,s01,s08,s08,s03,s03,b01,s07,s05,s01,s05,s05,s03,s09,s07,s08,s03,b01,s07,s06,s07,s02,s08,b01,s07,s01,s03,s02,s08,s07,s08,b01,s08,s03,s07,s03,s07,s03,s07,s09,s08,s03,s08,s01,s07,s09,s03,s07,s08,s03,s08,s03,b01,s01,s08,s03,s08,s03,s08,s07,s02,w01,w01,w01,w01,w01,s08,s03,s08,s03,s07,s01,s03,s08,s03,s08,b01,s07,s03,s04,s08,s03,s08,b01,s03,s01,s03,s01,s08,s07,b01,s01,s03,s08,s08,s04,s01,s03,b01,s07,s07,s07,s09,s03,s08,b01,s07,s02,s02,s08,s08,b01,s07,s02,s07,s03,s07,b01,s08,s03,s01,s08,b01,s08,s03,s07,s03,s07,s03,s09,s08,s03,s08,s03,s03,s07,s03,s07"
            }, {
                "@name": "Reel3",
                "#text": "s04,s04,s04,s01,s07,s09,s04,s01,s07,s08,s07,s05,s04,s04,s03,s03,s06,s06,s04,s01,s03,s04,s03,s07,s02,s05,s01,s07,s04,s07,s02,s07,s03,s05,s04,s04,s06,b01,s03,s04,s03,s07,s03,s07,s03,s07,s05,s01,s05,s07,s06,s07,s06,s07,s06,s07,s05,s06,s09,s06,s03,s06,s05,s04,s06,s04,s03,s06,s04,s06,s05,s04,s03,s04,s05,s04,s05,s04,s05,s03,s07,s04,s07,s03,s06,s04,b01,b01,s06,s04,s04,s09,s01,s03,s03,s04,b01,s03,s04,s04,b01,s03,s06,s02,s07,w01,w01,w01,w01,w01,s06,s03,s03,s04,s02,s06,s03,b01,s05,s06,s07,s03,s06,s05,s06,b01,b01,s05,s05,s06,s07,b01,s07,s05,s02,s04,s09,s06,s06,b01,s04,s02,s07,s09,s05,s05,s05,s04,b01,s02,s03,s06,s03,s06,s03,s06,s03,b01,s05,s06,s06,s06,s08,s08,s01,s06,s06,b01,s07,s07,s06,s06,s03,s09,s06"
            }, {
                "@name": "Reel4",
                "#text": "s02,s05,s08,s03,s08,s05,s05,s01,s05,s04,s01,s09,s08,s05,s09,s06,s03,s06,s03,b01,s06,s07,s02,s04,b01,s08,s01,s06,s08,s05,s05,s06,s08,s07,s06,s08,b01,s06,s02,s05,s05,s06,s05,s02,s05,s08,s08,s06,s08,s07,s06,s05,s05,s08,s08,s05,b01,s08,s06,s05,s08,s08,s05,s06,s08,s05,s09,s06,s08,s01,s05,s08,s06,s08,s06,s05,s05,s08,s01,s06,s05,s05,s02,s05,s08,s05,b01,s08,s09,s05,s06,s08,s06,s05,b01,s08,s06,s08,s04,s06,s05,s02,s09,s06,s08,s06,s01,s05,b01,s06,s08,s06,s05,s09,s02,s06,s06,s02,s06,s01,s09,s08,s06,s06,s05,s06,s04,b01,s03,s06,s05,s05,s06,s08,s05,b01,s06,s08,s05,s04,s08,b01,s04,s08,s09,s05,s02,s06,s08,s04,b01,s08,s05,s08,s08,s01,s08,s05,s05,s08,s06,s08,s08"
            }]
        }, {
            "@name": "FreeSpin",
            "Strip": [{
                "@name": "Reel0",
                "#text": "s18,s11,s11,s11,b02,s13,s12,s14,s11,b02,s13,s11,s14,s11,s13,s11,s14,s10,s13,s11,s14,s13,s11,s13,b02,s14,s11,s13,s14,s13,s11,s13,s11,s12,s11,s17,b02,s11,s14,b02,s13,s14,b02,s13,s12,s14,s11,s12,s12,s13,s16,s11,s14,s13,s10,s13,s13,s14,s11,s18,s14,s10,b02,s14,s13,b02,s14,s13,b02,s18,s15,b02,s14,s13,b02,s14,s13,s11,s10,s14,b02,s13,s11,s16,b02,s14,s11,s13,s11,s18,s17,b02,s13,s14,b02,s16,s10,s13,s11,s13,s14,s11,s13,s16,s14,s11,s14,s13,s14,s14,s13,s15,s11,s13,s14,s12,s18,s11,s13,s10,s17,s12,s13,s17,s14,s11,s14,b02,s15,s12,s14,b02,s13,s14,s11,s15,s11,s10,s13,b02,s11,s13,s14,s10,s11,s14,s11,s13,b02,s14,s11,b02,s11,s14"
            }, {
                "@name": "Reel1",
                "#text": "s13,s17,s17,s17,s11,s15,s13,s18,s13,s15,s16,s15,s13,s13,b02,s17,s10,s15,s14,s16,w02,w02,w02,s16,s13,s15,s15,s10,s15,b02,s16,s16,s15,s15,b02,s16,s15,s17,s13,b02,b02,s17,s15,s16,s18,s15,s16,s15,w02,w02,w02,s16,s15,s15,s11,b02,s16,s16,s15,s15,s16,b02,s12,s18,s15,b02,s16,s12,w02,w02,w02,b02,s13,s11,s11,s11,s11,s15,s13,s12,s18,s13,s15,b02,s13,s16,s15,s13,b02,s16,s13,s10,s13,s16,s15,s13,b02,s12,s13,s11,s16,b02,s15,s11,s13,s17,b02,s15,s11,s15,b02,w02,w02,w02,s11,s14,b02,s18,s11,s13,s15,b02,s13,s16,s15,s13,s16,b02,s13,s16,s11,w02,w02,w02,w02,s16,s15,b02,s15,s13,s15,b02,s13,s15,s12,s16,s13,s12,b02,s13,s13,s16,s16,s12,b02,s17,s15,s15,b02,s16,s12,s15,b02,s14,s16,s14,s12,s13,w02,w02,w02,s13,s18,s16,s13,s16,s13,b02,s13,s16,s16,s14,s14,b02,s13,s16,s16,s13,b02,s16,s10,s16,b02"
            }, {
                "@name": "Reel2",
                "#text": "s12,s11,s15,s15,b02,s12,s14,s11,s15,b02,s14,s14,s11,s11,b02,s18,s11,s13,s12,s10,b02,w02,w02,w02,w02,s16,s10,s14,s13,s13,b02,s13,s13,s14,s11,b02,s15,s15,s15,s14,s14,s16,s11,s14,b02,b02,b02,s10,s13,s16,s12,s14,s16,s12,s16,s14,s11,s15,s12,s16,s14,b02,s12,s16,w02,w02,w02,s14,s13,s15,b02,s13,s16,s18,s12,s14,s15,b02,s17,s12,s16,s12,b02,s12,s14,s15,s18,s16,s12,s17,s14,s10,b02,s12,s17,s10,s16,s12,b02,s16,s12,s17,s11,s12,s12,s14,s17,s12,s16,w02,w02,w02,w02,s14,s13,s13,s10,s14,s12,s12,s12,s17,s15,s14,s14,s16,s16,s13,s13,s10,s16,s12,s17,s10,s10,s17,s17,w02,w02,w02,w02,s17,s17,s17,b02,s16,s17,s14,s16,b02,s11,s17,s16,s11,s17,s18,s11,s17,w02,w02,w02,w02,w02,s17,s17,s16,s12,s12,s10,s10,s12,s12,s10,s17,s12,s18,s16,s12,s12,s17,s17,s12,s12,s16,s17,s17,s16,s17,s18,s16,s12,s17,s10"
            }, {
                "@name": "Reel3",
                "#text": "s13,s13,s14,s10,s13,s14,s14,s14,b02,s11,s12,s17,s13,s14,s18,s13,s14,s10,b02,s13,s14,s13,s15,s16,s11,s14,s15,b02,s13,s14,s13,s16,s14,s12,s13,s14,s15,s13,w02,w02,w02,b02,s13,s14,s15,s14,s13,s11,b02,s13,s14,s13,s16,s15,s17,s14,s15,s15,s13,s17,s14,s18,s15,w02,w02,w02,s15,s14,s16,s14,s15,s13,s14,s14,s15,s13,b02,b02,s13,s13,s14,w02,w02,w02,s15,s13,s12,b02,s15,s13,s14,s18,s13,s15,s10,s13,b02,s13,s14,s13,b02,s15,s14,s11,s13,s15,w02,w02,w02,s14,s13,s16,s15,s13,s14,s16,s15,b02,s15,s14,s13,s15,b02,s15,s15,s14,b02,s11,s15,s14,s14,b02,w02,w02,w02,s13,s18,s15,s15,s14,s13,s15,s18,s13,s17,s14,s12,s13,s13,s13,s14,b02,s15,s10,s17,s14,s15,s15,s12,b02,s15,s15,s17,s10,s15,s15,b02,s14,s15,s15,s18,s15,s14,s12,s11,w02,w02,w02,w02,s13"
            }, {
                "@name": "Reel4",
                "#text": "s15,s14,s12,s15,s11,s16,s12,s13,s17,s12,s15,s18,s17,s12,s12,s16,s16,s12,s17,s15,s12,s17,s10,s16,s15,s17,s10,s15,s17,s12,s16,s17,s11,s15,s12,s17,s16,s15,s12,s16,s10,s17,s13,s12,s15,s14,s17,s13,s15,s14,s12,s13,s17,s12,s15,s14,s16,s17,s15,s12,s16,s15,s12,s16,s17,s12,s16,s18,s15,s12,s10,s17,s16,s14,s12,s15,s17,s16,s14,s17,s10,s15,s12,b02,s17,s12,s16,s15,s17,s16,s16,s17,s18,s12,s17,s15,s16,s11,s17,s13,s16,s17,s16,s15,s17,s16,s12,s18,s15,s17,s11,s15,s10,s16,s11,s17,s15,s16,s17,s18,s15,s11,b02,s17,s15,b02,s17,s10,s18,s17,s15,b02,s11,s16,b02,s15,s16,b02,s15,s15,b02,s16,s12,b02,s15,s16,s12,b02,s15,s17,s16,s15,s17,s12,s15,s18,s12,s17,s11,b02,s15,s17,s12,s15,s18,s13,s17,s12,s13,s10,s17,s12,s13,s17,b02,s15,s12,b02"
            }]
        }],
        "PatternSliderInfo": {
            "PatternInfo": {
                "@max": "50",
                "@min": "50",
                "Step": "50"
            },
            "BetInfo": {
                "@max": "500",
                "@min": "1",
                "Step": ["1", "2", "3", "5", "10", "20", "30", "50", "100", "200", "300", "500"]
            }
        },
        "AwardCapInfo": "25000000",
        "DenominationList": "1.0",
        "GameBetInfo": {
            "MinChipValue": "1.0",
            "MinBet": "1.0",
            "MaxBet": "50.0"
        },
        "AutoSpinInfo": {
            "@enable": "True",
            "Step": ["10", "20", "30", "40", "50"]
        },
        "VersionInfo": {
            "GameLogicVersion": "1.0"
        }
    }
}';

        $this->outJSON($json);

    }

    protected function startInit($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $balance = $this->getBalance();

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = 'FreeSpin';
        }

        $fs = '';
        $prize = '';
        if($_SESSION['state'] == 'FREE') {

            $balance = $_SESSION['startBalance'];

            $fs = '"FreeSpinOutcome": {
            "@name": "",
            "InitAwarded": "'.$_SESSION['initFS'].'",
            "Awarded": "0",
            "TotalAwarded": "'.$_SESSION['totalAwarded'].'",
            "Count": "'.$_SESSION['fsPlayed'].'",
            "Countdown": "'.$_SESSION['fsLeft'].'",
            "IncrementTriggered": "false",
            "MaxAwarded": "false",
            "MaxSpinsHit": "false"
        },';

            $baseWinLines = gzuncompress(base64_decode($_SESSION['baseWinLines']));
            $prize = '"PrizeOutcome": [{
            "@multiplier": "1",
            "@name": "Game.Total",
            "@pay": "'.$_SESSION['fsTotalWin'].'",
            "@stage": "",
            "@totalPay": "'.$_SESSION['fsTotalWin'].'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$_SESSION['fsTotalWin'].'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$_SESSION['fsTotalWin'].'",
                "@ways": "0"
            }
        }, '.$baseWinLines.',{
            "@multiplier": "1",
            "@name": "FreeSpin.Total",
            "@pay": "'.$_SESSION['fsTotalWin'].'",
            "@stage": "",
            "@totalPay": "'.$_SESSION['fsTotalWin'].'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$_SESSION['fsTotalWin'].'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$_SESSION['fsTotalWin'].'",
                "@ways": "0"
            }
        }],';
        }

        $patternsBet = $this->gameParams->defaultCoinsCount;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }


        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "GameLogicResponse": {
        "OutcomeDetail": {
            "TransactionId": "A4410-14594828150284",
            "Stage": "'.$state.'",
            "NextStage": "'.$state.'",
            "Balance": "'.$balance.'",
            "GameStatus": "Initial",
            "Settled": "0",
            "Pending": "0",
            "Payout": "0"
        },
        '.$fs.$prize.'
        "PopulationOutcome": [{
            "@name": "BaseGame.Reels",
            "@stage": "BaseGame",
            "#text": "s01,s03,s05,s08,s07,s06,b01,w01,w01,w01,w01,w01,s03,s03,s04,s02,s09,s06,s08"
        }, {
            "@name": "FreeSpin.Reels",
            "@stage": "FreeSpin",
            "#text": "s10,s11,s14,b02,s17,s15,s16,w02,w02,w02,w02,w02,s13,s12,b02,s15,s16,s17,s18"
        }],
        "PatternSliderInput": {
            "BetPerPattern": "'.$coinValue.'",
            "PatternsBet": "'.$patternsBet.'"
        },
        "Balances": {
            "@totalBalance": "'.$balance.'",
            "Balance": {
                "@name": "FREE",
                "#text": "'.$balance.'"
            }
        }
    },
    "Paytable": {
        "PaytableStatistics": {
            "@description": "Siberian Storm 720 Multiway 3x4x5x4x3",
            "@maxRTP": "96",
            "@minRTP": "92.52",
            "@name": "Siberian Storm",
            "@type": "Slot"
        },
        "StripInfo": [{
            "@name": "BaseGame",
            "Strip": '.$this->getStripInfo(0).'
        }, {
            "@name": "FreeSpin",
            "Strip": '.$this->getStripInfo(1).'
        }],
        "PatternSliderInfo": {
            "PatternInfo": {
                "@max": "50",
                "@min": "50",
                "Step": "50"
            },
            "BetInfo": {
                "@max": "500",
                "@min": "1",
                "Step": ['.$this->getDenomination().']
            }
        },
        "AwardCapInfo": "25000000",
        "DenominationList": "1.0",
        "GameBetInfo": {
            "MinChipValue": "1.0",
            "MinBet": "1.0",
            "MaxBet": "50.0"
        }
    },
    "CURRENCY": {
        "@currencyCode": "'.$this->gameParams->curiso.'",
        "MAJOR_SYMBOL": ["'.$this->gameParams->currency.'"],
        "MINOR_SYMBOL": [],
        "MAJOR_SYMBOL_ALIGNMENT": "left",
        "MINOR_SYMBOL_ALIGNMENT": "right",
        "MAJOR_SYMBOL_PADDING_SPACE": "false",
        "MINOR_SYMBOL_PADDING_SPACE": "false",
        "DECIMAL_SEPARATOR": ".",
        "THOUSANDS_SEPARATOR": ",",
        "DECIMAL_PRECISION": "2",
        "USE_THOUSANDS_SEPARATOR": "no",
        "MINOR_CURRENCY_LOCK": "no",
        "CHIP_SET_CODE": "chipSet1"
    }
}';

        $this->outJSON($json);
    }

    protected function startSpin($request) {
        $totalBet = $request['GameLogicRequest']['PatternSliderInput']['PatternsBet'];
        $betPerLine = (float) $request['GameLogicRequest']['PatternSliderInput']['BetPerPattern'];

        $stake = $totalBet * $betPerLine;
        $pick = (int) $totalBet;

        $this->checkSpinAvailable($stake);

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($this->gameParams->reels[0], array(3,4,5,4,3));
        $this->slot->rows = 5;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->spinPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FREE':
                $this->showStartFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function startFreeSpin($request) {
        $stake = $_SESSION['lastBet'];
        $pick = $_SESSION['lastPick'];

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(3,4,5,4,3));
        $this->slot->rows = 5;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments(0, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->fsPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        $this->showPlayFreeSpinReport($spinData['report'], $spinData['totalWin']);

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $bonus = array();

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        $fiveCount = 0;
        $noCount = 0;
        foreach($report['winLines'] as $w) {
            if(($w['alias'] == 'b01' || $w['alias'] == 'b02') && $w['count'] == 5) {
                $fiveCount++;
            }
            else {
                $noCount++;
            }
        }

        if($fiveCount > 0) {
            $_SESSION['initFS'] = 8 * $fiveCount;
            $_SESSION['fiveCount'] = $fiveCount;
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = 0;
            //$report['scattersReport']['totalWin'] = $report['betOnLine'] * 50 * $fiveCount;
            //$report['totalWin'] -= $report['scattersReport']['totalWin'];
        }
        else {
            //$respin = true;
        }

        $scatterPayReport = $this->slot->getSymbolAnyCount('s09');

        if($scatterPayReport['count'] >= 3 ) {
            $multiple = 2;
            if($scatterPayReport['count'] == 4) $multiple = 10;
            if($scatterPayReport['count'] == 5) $multiple = 50;
            $report['scattersReport'] = $scatterPayReport;
            $report['scattersReport']['totalWin'] = $report['bet'] * $multiple;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        $scatterPayReport = $this->slot->getSymbolAnyCount('s18');

        if($scatterPayReport['count'] >= 3 ) {
            $multiple = 2;
            if($scatterPayReport['count'] == 4) $multiple = 10;
            if($scatterPayReport['count'] == 5) $multiple = 50;
            $report['scattersReport'] = $scatterPayReport;
            $report['scattersReport']['totalWin'] = $report['bet'] * $multiple;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $display = $this->getDisplay($report);

        $scatterHighlight = $this->getScattersHighlight($report['scattersReport']);
        $highlightLeft = $this->getWaysLeftHighlight($report['winLines']);
        $highlightRight = $this->getWaysRightHighlight($report['winLines']);

        $scatterWin = $this->getScattersPay($report['scattersReport']);
        $winLinesLeft = $this->getLeftWayWinLines($report);
        $winLinesRight = $this->getRightWayWinLines($report);

        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "GameLogicResponse": {
        "OutcomeDetail": {
            "TransactionId": "R0340-14353481221356",
            "Stage": "BaseGame",
            "NextStage": "BaseGame",
            "Balance": "'.$balance.'",
            "GameStatus": "Start",
            "Settled": "'.$report['bet'].'",
            "Pending": "0",
            "Payout": "'.$totalWin.'"
        },
        "FreeSpinOutcome": {
            "@name": "",
            "InitAwarded": "0",
            "Awarded": "0",
            "TotalAwarded": "0",
            "Count": "0",
            "Countdown": "0",
            "IncrementTriggered": "false",
            "MaxAwarded": "false",
            "MaxSpinsHit": "false"
        },
        "PopulationOutcome": [{
            "@name": "BaseGame.Reels",
            "@stage": "BaseGame",
            "#text": "'.$display.'"
        }, {
            "@name": "FreeSpin.Reels",
            "@stage": "FreeSpin",
            "#text": "s10,s11,s14,b02,s17,s15,s16,w02,w02,w02,w02,w02,s13,s12,b02,s15,s16,s17,s18"
        }],
        "AwardCapOutcome": {
            "@name": "AwardCap",
            "AwardCapExceeded": "false"
        },
        "HighlightOutcome": ['.$scatterHighlight.', '.$highlightLeft.', '.$highlightRight.'],
        "PrizeOutcome": ['.$scatterWin.', '.$winLinesLeft.', '.$winLinesRight.', {
            "@multiplier": "1",
            "@name": "Game.Total",
            "@pay": "'.$totalWin.'",
            "@stage": "",
            "@totalPay": "'.$totalWin.'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$totalWin.'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$totalWin.'",
                "@ways": "0"
            }
        }],
        "ActionInput": {
            "Action": "play"
        },
        "PatternSliderInput": {
            "BetPerPattern": "'.$this->slot->betOnLine.'",
            "PatternsBet": "'.$this->slot->linesCount.'"
        },
        "TransactionId": "A4310-14594825789242",
        "Balances": {
            "@totalBalance": "'.$balance.'",
            "Balance": {
                "@name": "FREE",
                "#text": "'.$balance.'"
            }
        }
    }
}';


        $this->outJSON($json);
    }



    protected function showStartFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $display = $this->getDisplay($report);

        $scatterHighlight = $this->getScattersHighlight($report['scattersReport']);
        $highlightLeft = $this->getWaysLeftHighlight($report['winLines']);
        $highlightRight = $this->getWaysRightHighlight($report['winLines']);

        $scatterWin = $this->getScattersPay($report['scattersReport'], 'BaseGame.Scatter', 'b01', true);
        $winLinesLeft = $this->getLeftWayWinLines($report);
        $winLinesRight = $this->getRightWayWinLines($report);

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];
        $_SESSION['startBalance'] = $balance-$totalWin;
        //$_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['fsTotalWin'] = 0;
        $_SESSION['scatterWin'] = $report['betOnLine'] * $_SESSION['fiveCount'] * 50;

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = $_SESSION['initFS'];
        $_SESSION['fsLeft'] = $_SESSION['initFS'];
        $_SESSION['fsPlayed'] = 0;

        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatterPay'] = base64_encode(gzcompress($scatterWin, 9));
        $_SESSION['baseScatterHighlight'] = base64_encode(gzcompress($scatterHighlight, 9));
        $_SESSION['baseHighlight'] = base64_encode(gzcompress($highlightLeft.', '.$highlightRight, 9));
        $_SESSION['baseWinLines'] = base64_encode(gzcompress($winLinesLeft.', '.$winLinesRight, 9));


        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "GameLogicResponse": {
        "OutcomeDetail": {
            "TransactionId": "R0340-14353466481516",
            "Stage": "BaseGame",
            "NextStage": "FreeSpin",
            "Balance": "'.$_SESSION['startBalance'].'",
            "GameStatus": "InProgress",
            "Settled": "0",
            "Pending": "'.$report['bet'].'",
            "Payout": "0"
        },
        "FreeSpinOutcome": {
            "@name": "",
            "InitAwarded": "'.$_SESSION['totalAwarded'].'",
            "Awarded": "'.$_SESSION['totalAwarded'].'",
            "TotalAwarded": "'.$_SESSION['totalAwarded'].'",
            "Count": "0",
            "Countdown": "'.$_SESSION['totalAwarded'].'",
            "IncrementTriggered": "true",
            "MaxAwarded": "false",
            "MaxSpinsHit": "false"
        },
        "PopulationOutcome": [{
            "@name": "BaseGame.Reels",
            "@stage": "BaseGame",
            "#text": "'.$display.'"
        }, {
            "@name": "FreeSpin.Reels",
            "@stage": "FreeSpin",
            "#text": "s10,s11,s14,b02,s17,s15,s16,w02,w02,w02,w02,w02,s13,s12,b02,s15,s16,s17,s18"
        }],
        "AwardCapOutcome": {
            "@name": "AwardCap",
            "AwardCapExceeded": "false"
        },
        "HighlightOutcome": ['.$scatterHighlight.', '.$highlightLeft.', '.$highlightRight.'],
        "TriggerOutcome": {
            "@component": "",
            "@name": "FreeSpin",
            "@stage": ""
        },
        "PrizeOutcome": ['.$scatterWin.', '.$winLinesLeft.', '.$winLinesRight.', {
            "@multiplier": "1",
            "@name": "Game.Total",
            "@pay": "'.$totalWin.'",
            "@stage": "",
            "@totalPay": "'.$totalWin.'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$totalWin.'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$totalWin.'",
                "@ways": "0"
            }
        }],
        "ActionInput": {
            "Action": "play"
        },
        "PatternSliderInput": {
            "BetPerPattern": "'.$this->slot->betOnLine.'",
            "PatternsBet": "'.$this->slot->linesCount.'"
        },
        "TransactionId": "A4510-14585366448626",
        "Balances": {
            "@totalBalance": "'.$balance.'",
            "Balance": {
                "@name": "FREE",
                "#text": "'.$balance.'"
            }
        }
    }
}';

        $this->outJSON($json);
    }

    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $display = $this->getDisplay($report);
        $scatterHighlight = $this->getScattersHighlight($report['scattersReport'], 'FreeSpin.Scatter');
        $scatterWin = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter', 'b02');

        $highlightLeft = $this->getWaysLeftHighlight($report['winLines'], 'FreeSpin');
        $highlightRight = $this->getWaysRightHighlight($report['winLines'], 'FreeSpin');

        $winLinesLeft = $this->getLeftWayWinLines($report, 'FreeSpin');
        $winLinesRight = $this->getRightWayWinLines($report, 'FreeSpin');



        $awarded = 0;
        if($report['scattersReport']['count'] > 2) {
            if($report['type'] == 'FREE') {
                $_SESSION['totalAwarded'] += 8 * $_SESSION['fiveCount'];
                $_SESSION['fsLeft'] += 8 * $_SESSION['fiveCount'];
                $awarded = 8 * $_SESSION['fiveCount'];
                $report['scattersReport']['totalWin'] = 0;
            }
            else {
                if(!empty($report['scattersReport']['totalWin'])) {
                    $scatterWin = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter', 's18');
                }
            }
        }


        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;
        $_SESSION['fsTotalWin'] += $totalWin;

        $needBalance = $_SESSION['startBalance'];
        $nextStage = 'FreeSpin';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        $baseDisplay = gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $baseH = '';
        $baseP = '';

        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $needBalance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';

            $baseScatterPay = gzuncompress(base64_decode($_SESSION['baseScatterPay']));
            $baseScatterHighlight = gzuncompress(base64_decode($_SESSION['baseScatterHighlight']));
            $baseHighlight = gzuncompress(base64_decode($_SESSION['baseHighlight']));
            $baseWinLines = gzuncompress(base64_decode($_SESSION['baseWinLines']));

            $baseH = $baseScatterHighlight.', '.$baseHighlight.', ';
            $baseP = $baseScatterPay.', '.$baseWinLines.', ';
        }

        $fsWin = $_SESSION['fsTotalWin'];
        $gameTotal = $_SESSION['fsTotalWin'];
        if($gameTotal < 0) {
            $gameTotal = 0;
        }

        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "GameLogicResponse": {
        "OutcomeDetail": {
            "TransactionId": "R0340-14353466481516",
            "Stage": "FreeSpin",
            "NextStage": "'.$nextStage.'",
            "Balance": "'.$needBalance.'",
            "GameStatus": "'.$gameStatus.'",
            "Settled": "'.$settled.'",
            "Pending": "'.$pending.'",
            "Payout": "'.$payout.'"
        },
        "FreeSpinOutcome": {
            "@name": "",
            "InitAwarded": "'.$_SESSION['initFS'].'",
            "Awarded": "'.$awarded.'",
            "TotalAwarded": "'.$_SESSION['totalAwarded'].'",
            "Count": "'.$_SESSION['fsPlayed'].'",
            "Countdown": "'.$_SESSION['fsLeft'].'",
            "IncrementTriggered": "'.(($awarded == 1) ? 'true' : 'false').'",
            "MaxAwarded": "false",
            "MaxSpinsHit": "false"
        },
        "PopulationOutcome": [{
            "@name": "FreeSpin.Reels",
            "@stage": "FreeSpin",
            "#text": "'.$display.'"
        }, {
            "@name": "BaseGame.Reels",
            "@stage": "BaseGame",
            "#text": "'.$baseDisplay.'"
        }],
        "AwardCapOutcome": {
            "@name": "AwardCap",
            "AwardCapExceeded": "false"
        },
        "HighlightOutcome": ['.$baseH.$scatterHighlight.', '.$highlightLeft.', '.$highlightRight.'],
        "TriggerOutcome": {
            "@component": "",
            "@name": "FreeSpin",
            "@stage": ""
        },
        "PrizeOutcome": ['.$baseP.$scatterWin.', '.$winLinesLeft.', '.$winLinesRight.', {
            "@multiplier": "1",
            "@name": "Game.Total",
            "@pay": "'.$gameTotal.'",
            "@stage": "",
            "@totalPay": "'.$gameTotal.'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$gameTotal.'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$gameTotal.'",
                "@ways": "0"
            }
        }, {
            "@multiplier": "1",
            "@name": "FreeSpin.Total",
            "@pay": "'.$fsWin.'",
            "@stage": "",
            "@totalPay": "'.$fsWin.'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$fsWin.'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$fsWin.'",
                "@ways": "0"
            }
        }],
        "ActionInput": {
            "Action": "play"
        },
        "PatternSliderInput": {
            "BetPerPattern": "'.$this->slot->betOnLine.'",
            "PatternsBet": "'.$this->slot->linesCount.'"
        },
        "TransactionId": "A4510-14585366448626",
        "Balances": {
            "@totalBalance": "'.$balance.'",
            "Balance": {
                "@name": "FREE",
                "#text": "'.$balance.'"
            }
        }
    }
}';
        $this->outJSON($json);

        if($_SESSION['fsLeft'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['baseWinLinesWin']);
            unset($_SESSION['baseScatterPay']);
            unset($_SESSION['baseScatterHighlight']);
            unset($_SESSION['baseHighlight']);
            unset($_SESSION['baseWinLines']);
        }
    }
}